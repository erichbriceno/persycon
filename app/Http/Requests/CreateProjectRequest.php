<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use App\Model\Project;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\{NameProject, NameProjectUnique, YearBetween};

class CreateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                new NameProject,
                'alpha',
                new NameProjectUnique("$this->name " . "$this->year"),
                ],
            'year' => [
                'required',
                new YearBetween,
                ],
            'description' => [
                'required',
                'string', 
                'max:50'
                ],
            'from' => [
                'required',
                'date_format:d/m/Y',
                'after:now - 1 year',
                'before:now + 1 year',
                ], 
            'to' => [
                'date_format:d/m/Y',
                'nullable',
                'after:from',
                'before:now + 2 year',
                ],
            'state' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('projects.errorsValidations.name.required'),
            'name.alpha' => trans('projects.errorsValidations.name.alpha'),
        ];
    }

    public function createProject()
    {
        $project = Project::create([
            'name' =>"$this->name " . "$this->year",
            'description' => $this->description,
            'start' => Carbon::createFromFormat('d/m/Y', $this->from)->format('Y-m-d'),
            'ending' => $this->to?Carbon::createFromFormat('d/m/Y', $this->to)->format('Y-m-d'):null,
            'state' => true
        ]);
        
        $project->save();
    }
}

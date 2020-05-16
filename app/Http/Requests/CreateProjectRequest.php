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
                'nullable',
                'date_format:d/m/Y',
                'after:from',
                'before:now + 2 year',
                ],
        ];
    }

    public function messages()
    {
        return [
            'description.max' => trans('projects.errorsValidations.description.max'),
            'from.required' => trans('projects.errorsValidations.date.required',['time' => trans('projects.errorsValidations.date.start')]),
            'from.date_format' => trans('projects.errorsValidations.date.date_format'),
            'from.after' => trans('projects.errorsValidations.date.after',['time' => today()->sub('1 year')->format('d/m/Y')]),
            'from.before' => trans('projects.errorsValidations.date.before',['time' => today()->add('1 year')->format('d/m/Y')]),
            'to.date_format' => trans('projects.errorsValidations.date.date_format'),
            'to.after' => trans('projects.errorsValidations.date.toAfter'),
            'to.before' => trans('projects.errorsValidations.date.before',['time' => today()->add('2 year')->format('d/m/Y')]),
        ];
    }

    public function createProject()
    {
        $project = Project::create([
            'name' =>"$this->name " . "$this->year",
            'description' => $this->description,
            'start' => Carbon::createFromFormat('d/m/Y', $this->from)->format('Y-m-d'),
            'ending' => $this->to?Carbon::createFromFormat('d/m/Y', $this->to)->format('Y-m-d'):null,
            'active' => true
        ]);
        
        $project->save();

        $project->categories()->createMany([
            ['name'      => 'T1', 'minimum'   =>  0, 'maximum'   =>  0],
            ['name'      => 'T2', 'minimum'   =>  0, 'maximum'   =>  0],
            ['name'      => 'T3', 'minimum'   =>  0, 'maximum'   =>  0],
            ['name'      => 'T4', 'minimum'   =>  0, 'maximum'   =>  0],
        ]);
    }
}

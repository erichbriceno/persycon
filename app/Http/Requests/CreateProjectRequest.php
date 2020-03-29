<?php

namespace App\Http\Requests;

use App\Model\Project;
use App\Rules\{NameProject, NameProjectUnique, YearBetween};
use Illuminate\Foundation\Http\FormRequest;

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
                'date',
                'after:now - 1 year',
                'before:now + 1 year',
                ], 
            'to' => [
                'date',
                'nullable',
                'after:from',
                'before:now + 2 year',
                ],
            'state' => 'boolean'
        ];
    }

    public function createProject()
    {
        $project = Project::create([
            'name' =>"$this->name " . "$this->year",
            'description' => $this->description,
            'start' => $this->from,
            'ending' => $this->to??null,
            'state' => true
        ]);
        
        $project->save();
    }
}

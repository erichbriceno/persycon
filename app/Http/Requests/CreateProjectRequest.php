<?php

namespace App\Http\Requests;

use App\Model\Project;
use App\Rules\NameProject;
use App\Rules\YearBetween;
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
            //'name' => ['required', 'present','string', 'max:255'],
            'name' => [
                'required',
                new NameProject,
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
            'start' => [
                'required',
                'date',
                'after:now - 1 year',
                'before:now + 1 year',
                ], 
            'ending' => [
                'date',
                'nullable',
                //'after:start',
                //'before:start + 2 year',
                ],
            'state' => ''
        ];
    }

    public function createProject()
    {
        //dd("$this->name " . "$this->year");
        $project = Project::create([
            'name' =>"$this->name " . "$this->year",
            'description' => $this->description,
            'start' => $this->start,
            'ending' => $this->ending??null,
            'state' => true
        ]);

        $project->save();
    }
}

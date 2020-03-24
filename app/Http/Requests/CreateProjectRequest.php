<?php

namespace App\Http\Requests;

use App\Model\Project;
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
            'name' => ['required'],
            'description' => '',
            'start' => '',
            'ending' => '',
            'state' => ''
        ];
    }

    public function createProject()
    {

        $project = Project::create([
            'name' =>"$this->name " . today()->year,
            'description' => $this->description,
            'start' => $this->start,
            'ending' => $this->ending??null,
            'state' => true
        ]);

        $project->save();
    }
}

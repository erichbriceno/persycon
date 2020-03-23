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
            'name' => '',
            'description' => '',
            'start' => '',
            'ending' => '',
            'state' => ''
        ];
    }

    public function createProject()
    {

        $project = Project::create([
            'name' => 'Municipales 2020',
            'description' => 'Elecciones Municipales 2020',
            'start' => now(),
            'ending' => null,
            'state' => true
        ]);

        $project->save();
    }
}

<?php

namespace App\Http\Requests;

use App\Model\Project;
use Illuminate\Foundation\Http\FormRequest;
use App\Rules\{ValidValueCategory, Minimum1Valid, Maximum1Valid, Minimum2Valid, Maximum2Valid, Minimum3Valid, Maximum3Valid, Minimum4Valid, Maximum4Valid,};



class UpdateCategoryRequest extends FormRequest
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
            'min1' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
            'max1' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
            'min2' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
            'max2' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
            'max3' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
            'min4' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
            'max4' => ['required','numeric','min:1', new ValidValueCategory($this->min1, $this->max1, $this->min2, $this->max2, $this->min3, $this->max3, $this->min4, $this->max4)],
        ];
    }

    public function messages()
    {
        return [
            'max1.min' => trans('categories.errorsValidations.zero'),
        ];
    }

    public function updateCategoriesProject(Project $project)
    {
        $project->cat1->minimum = $this->min1;
        $project->cat1->maximum = $this->max1;
        $project->cat2->minimum = $this->min2;
        $project->cat2->maximum = $this->max2;
        $project->cat3->minimum = $this->min3;
        $project->cat3->maximum = $this->max3;
        $project->cat4->minimum = $this->min4;
        $project->cat4->maximum = $this->max4;
        
        $project->push();
    }
}

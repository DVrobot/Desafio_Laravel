<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'name' => 'min:3|max:255|string|unique:courses,name,' . $this->course->id,
            'description' => 'min:3|string',
            'image_link' => 'file|max:512',
            'video' => 'url',
            'category_id' => 'exists:categories,id',
        ];
    }

    public function attributes(){
        return[
            'name' => 'nome',
            'description' => 'descrição',
            'image_link' => 'imagem',
            'video' => 'link do vídeo',
            'category_id' => 'categoria',
        ];
    }
}

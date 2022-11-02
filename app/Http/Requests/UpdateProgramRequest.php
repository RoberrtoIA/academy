<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'filled|max:100',
            'description' => 'filled|max:200',
            'content' => 'filled|min:1',
        ];
    }
}
<<<<<<< HEAD

=======
>>>>>>> 0a925481b51cfebeb56a832de392919b4a9cc15c

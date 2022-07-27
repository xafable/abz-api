<?php

namespace App\Http\Requests;

use App\Rules\LessThan5;
use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
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
            'photo' => ['required', new LessThan5],
            'name' => 'required|min:2|max:60',
            'email' => 'required|min:2|max:100|email:rfc',
            'phone' => 'required|regex:/(^[\+]{0,1}380([0-9]{9})$)/',
            'position_id' => 'required|integer|min:1'
        ];
    }
}

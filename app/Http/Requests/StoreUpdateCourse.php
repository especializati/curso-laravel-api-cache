<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCourse extends FormRequest
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
        $uuid = $this->course ?? '';

        return [
            'name' => ['required', 'min:3', 'max:255', "unique:courses,name,{$uuid},uuid"],
            'description' => ['nullable', 'min:3', 'max:9999'],
        ];
    }
}

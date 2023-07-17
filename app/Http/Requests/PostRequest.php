<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return ['published_at'=>'required'] + ($this->isMethod('POST') ? $this->store() : $this->update());
    }

    public function store(){
        return [
            'title'=>'required|max:255|unique:posts',
            'slug'=>'required|unique:posts',
            'category_id'=>'required',
            'preview'=>'required',
            'content'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|dimensions:max_width=5000,max_height:5000',
        ];
    }

    public function update(){
        return [
            'title'=>'required|max:255',
            'slug'=>'required',
            'category_id'=>'required',
            'preview'=>'required',
            'content'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg,gif|dimensions:max_width=5000,max_height:5000',
        ];
    }
}

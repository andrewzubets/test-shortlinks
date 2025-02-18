<?php

namespace App\Http\Requests;

use App\Models\ShortLink;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateShortLinkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->request->get('id');
        return [
            'url' => [
                'required',
                'regex:/^(http\:\/\/|https\:\/\/).+\..+$/',
                Rule::unique('short_links', 'url')->ignore($id)
            ],
            'short_id' => [
                'required',
                'regex:/^[^\/]+$/',
                Rule::unique('short_links', 'short_id')->ignore($id)
            ]
        ];
    }
}

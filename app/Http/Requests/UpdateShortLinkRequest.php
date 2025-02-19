<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Request for update request processing.
 */
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
     * @return array<string, array>
     */
    public function rules(): array
    {
        $id = $this->getShortLinkId();

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

    private function getShortLinkId(): ?int
    {
        $id = $this->request->get('id');
        if(!empty($id)){
            return $id;
        }
        return \request()->route()->parameter('shortLink')?->id;
    }
}

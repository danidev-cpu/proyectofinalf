<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlayerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'number' => 'required|integer|min:1|max:99',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'twitter' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitch' => 'nullable|string',
            'position' => 'nullable|string|max:50',
            'country' => 'nullable|string|max:50',
            'visible' => 'nullable|boolean',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Enum\NewsSourcesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GetArticlesRequest extends FormRequest
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
        return [
            'search' => 'string|nullable',
            'source' => ['string', 'nullable', Rule::enum(NewsSourcesEnum::class)],
            'category' => 'string|nullable',
            'date' => 'date|nullable',
        ];
    }
}

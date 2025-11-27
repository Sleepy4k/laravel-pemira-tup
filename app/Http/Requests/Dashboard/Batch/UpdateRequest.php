<?php

namespace App\Http\Requests\Dashboard\Batch;

use App\Models\Batch;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth('web')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(#[RouteParameter('batch')] Batch $batch): array
    {
        return [
            'name' => ['required', 'string', 'max:100', Rule::unique(Batch::class, 'name')->ignoreModel($batch)],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }
}

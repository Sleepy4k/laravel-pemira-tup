<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Models\Setting;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;

class VotingRequest extends FormRequest
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
    public function rules(#[RouteParameter('voting')] string $voting): array
    {
        $validationData = Setting::getValidationData();
        $rules = [];

        foreach ($validationData as $key => $rule) {
            if (str_starts_with($key, $voting . '_')) {
                $rules[$key] = $rule;
            }
        }

        return $rules;
    }
}

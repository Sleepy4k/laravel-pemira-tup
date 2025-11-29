<?php

namespace App\Http\Requests\Landing;

use App\Models\Candidate;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoteCandidateRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'string', Rule::exists(User::class, 'id')],
            'candidate_id' => ['required', 'string', Rule::exists(Candidate::class, 'id')],
        ];
    }
}

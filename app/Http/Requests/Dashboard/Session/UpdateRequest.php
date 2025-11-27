<?php

namespace App\Http\Requests\Dashboard\Session;

use App\Models\Batch;
use App\Models\Setting;
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
    public function rules(): array
    {
        $settings = Setting::where('group', 'voting')->get()->pluck('value', 'key')->toArray();
        $start_date = date('Y-m-d\TH:i:s', strtotime($settings['start'] ?? now()));
        $end_date = date('Y-m-d\TH:i:s', strtotime($settings['end'] ?? now()));

        return [
            'batch_id' => ['required', 'string', Rule::exists(Batch::class, 'id')],
            'start_time' => ['required', 'date', 'after_or_equal:' . $start_date, 'before:' . $end_date],
            'end_time' => ['required', 'date', 'after_or_equal:start_time', 'before_or_equal:' . $end_date],
        ];
    }
}

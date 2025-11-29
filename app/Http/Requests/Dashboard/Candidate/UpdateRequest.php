<?php

namespace App\Http\Requests\Dashboard\Candidate;

use App\Enums\FileUploaderType;
use App\Facades\FileUploader;
use App\Models\CandidateType;
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
        $photoUploader = FileUploader::init(FileUploaderType::CANDIDATE_PHOTO);
        $photoType = $photoUploader->get('type', 'image');
        $photoMimes = $photoUploader->get('mimes', 'png,jpg,jpeg');
        $photoMaxSize = $photoUploader->get('max_size', 8192);

        $resumeUploader = FileUploader::init(FileUploaderType::CANDIDATE_RESUME);
        $resumeType = $resumeUploader->get('type', 'file');
        $resumeMimes = $resumeUploader->get('mimes', 'pdf,doc,docx');
        $resumeMaxSize = $resumeUploader->get('max_size', 10240);

        return [
            'number' => ['required', 'integer', 'min:1', 'max:10'],
            'head_name' => ['required', 'string', 'max:100'],
            'vice_name' => ['required', 'string', 'max:100'],
            'candidate_type_id' => ['required', 'string', Rule::exists(CandidateType::class, 'id')],
            'is_blank' => ['required', 'boolean'],
            'vision' => [Rule::requiredIf(!$this->input('is_blank')), 'string', 'max:1000'],
            'missions' => [Rule::requiredIf(!$this->input('is_blank')), 'array', 'min:1', 'max:10'],
            'missions.*' => [Rule::requiredIf(!$this->input('is_blank')), 'string', 'max:255'],
            'photo' => ['nullable', $photoType, 'mimes:'.$photoMimes, 'extensions:'.$photoMimes, 'max:'.$photoMaxSize],
            'resume' => ['nullable', $resumeType, 'mimes:'.$resumeMimes, 'extensions:'.$resumeMimes, 'max:'.$resumeMaxSize],
        ];
    }
}

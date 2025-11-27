<?php

namespace App\Http\Requests\Dashboard\Candidate;

use App\Enums\FileUploaderType;
use App\Facades\FileUploader;
use App\Models\Candidate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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

        $attachmentUploader = FileUploader::init(FileUploaderType::CANDIDATE_ATTACHMENT);
        $attachmentType = $attachmentUploader->get('type', 'file');
        $attachmentMimes = $attachmentUploader->get('mimes', 'pdf,doc,docx');
        $attachmentMaxSize = $attachmentUploader->get('max_size', 20480);

        return [
            'number' => ['required', 'integer', 'min:1', 'max:10',  Rule::unique(Candidate::class, 'number')],
            'head_name' => ['required', 'string', 'max:100'],
            'vice_name' => ['required', 'string', 'max:100'],
            'vision' => ['required', 'string', 'max:1000'],
            'missions' => ['required', 'array', 'min:1', 'max:3'],
            'missions.*' => ['required', 'string', 'max:255'],
            'programs' => ['required', 'array', 'min:1', 'max:5'],
            'programs.*' => ['required', 'string', 'max:255'],
            'photo' => ['required', $photoType, 'mimes:'.$photoMimes, 'extensions:'.$photoMimes, 'max:'.$photoMaxSize],
            'resume' => ['required', $resumeType, 'mimes:'.$resumeMimes, 'extensions:'.$resumeMimes, 'max:'.$resumeMaxSize],
            'attachment' => ['required', $attachmentType, 'mimes:'.$attachmentMimes, 'extensions:'.$attachmentMimes, 'max:'.$attachmentMaxSize],
        ];
    }
}

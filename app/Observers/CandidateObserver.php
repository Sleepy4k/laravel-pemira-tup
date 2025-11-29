<?php

namespace App\Observers;

use App\Enums\UploadFileType;
use App\Facades\File;
use App\Models\Candidate;

class CandidateObserver
{
    /**
     * Handle the Candidate "creating" event.
     */
    public function creating(Candidate $candidate): void
    {
        $candidate->photo = $candidate->photo
            ? File::saveSingleFile(UploadFileType::CANDIDATE_PHOTO, $candidate->photo)
            : null;

        $candidate->resume = $candidate->resume
            ? File::saveSingleFile(UploadFileType::CANDIDATE_DOCUMENT, $candidate->resume)
            : null;
    }

    /**
     * Handle the Candidate "updating" event.
     */
    public function updating(Candidate $candidate): void
    {
        if ($candidate->isDirty('photo') && ($candidate->photo != null || $candidate->photo != '')) {
            $oldImage = $candidate->getOriginal('photo', null);

            if ($oldImage == null) {
                $candidate->photo = $candidate->photo
                    ? File::saveSingleFile(UploadFileType::CANDIDATE_PHOTO, $candidate->photo)
                    : null;
            } else {
                $candidate->photo = $candidate->photo
                    ? File::updateSingleFile(UploadFileType::CANDIDATE_PHOTO, $candidate->photo, $oldImage)
                    : File::deleteFile(UploadFileType::CANDIDATE_PHOTO, $oldImage);
            }
        }

        if ($candidate->isDirty('resume') && ($candidate->resume != null || $candidate->resume != '')) {
            $oldFile = $candidate->getOriginal('resume', null);

            if ($oldFile == null) {
                $candidate->resume = $candidate->resume
                    ? File::saveSingleFile(UploadFileType::CANDIDATE_DOCUMENT, $candidate->resume)
                    : null;
            } else {
                $candidate->resume = $candidate->resume
                    ? File::updateSingleFile(UploadFileType::CANDIDATE_DOCUMENT, $candidate->resume, $oldFile)
                    : File::deleteFile(UploadFileType::CANDIDATE_DOCUMENT, $oldFile);
            }
        }
    }

    /**
     * Handle the Candidate "deleting" event.
     */
    public function deleting(Candidate $candidate): void
    {
        $candidate->photo
            ? File::deleteFile(UploadFileType::CANDIDATE_PHOTO, $candidate->photo)
            : null;

        $candidate->resume
            ? File::deleteFile(UploadFileType::CANDIDATE_DOCUMENT, $candidate->resume)
            : null;
    }
}

<?php

namespace App\Imports;

use App\Models\Batch;
use App\Models\Voter;
use App\Support\AttributeEncryptor;
use App\Support\GenerateVoteToken;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VoterImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @return int
    */
    public function chunkSize(): int
    {
        return 100;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (empty($row['email']) || empty($row['name']) || empty($row['batch'])) {
            return null;
        }

        if (Voter::where('email', AttributeEncryptor::encrypt($row['email']))->exists()) {
            return null;
        }

        $batchId = Batch::query()->firstOrCreate(['name' => $row['batch']])->id;

        return new Voter([
            'name'  => $row['name'],
            'email' => $row['email'],
            'batch_id' => $batchId,
            'vote_token' => GenerateVoteToken::generate($row['email']),
        ]);
    }
}

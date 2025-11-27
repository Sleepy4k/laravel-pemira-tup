<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoterTemplate implements FromCollection, WithHeadings
{
    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'name',
            'email',
            'batch',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            [
                'name' => 'Siska Yulianti',
                'email' => 'siska.yulianti@student.telkomuniversity.ac.id',
                'batch' => '2024',
            ]
        ]);
    }
}

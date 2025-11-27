<?php

namespace App\Http\Controllers\Dashboard\Voter;

use App\Exports\VoterTemplate;
use App\Http\Controllers\Controller;
use App\Imports\VoterImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class VoterDataController extends Controller
{
    /**
     * Handle the incoming request to import voters.
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'extensions:xlsx,xls,csv'],
        ]);

        $file = $request->file('file');

        try {
            Excel::import(new VoterImport, $file);

            return response()->json([
                'status' => 'success',
                'message' => 'Voters imported successfully.',
            ]);
        } catch (\Throwable $th) {
            Log::error('Error importing voters: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to import voters.',
            ], 500);
        }
    }

    /**
     * Handle the incoming request to download voter template.
     */
    public function template(Request $request)
    {
        return Excel::download(new VoterTemplate, 'voter_template.xlsx');
    }
}

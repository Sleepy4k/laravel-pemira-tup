<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Enums\ApplicationSettingType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\VotingRequest;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VotingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenanceFile = storage_path('framework/down');
        $isMaintenanceMode = file_exists($maintenanceFile);
        $settings = Setting::allAsKeyValue();
        $timezones = timezone_identifiers_list();
        $types = ApplicationSettingType::toArray();
        $types = array_combine($types, $types);
        $activeTab = request('tab', 'voting');
        $settingsTabs = [
            'voting' => 'Voting Settings',
        ];

        return view('dashboard.settings.voting', compact('isMaintenanceMode', 'settings', 'timezones', 'types', 'activeTab', 'settingsTabs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VotingRequest $request, string $voting)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            foreach ($data as $key => $value) {
                $settingKey = str_replace("{$voting}_", '', $key);

                if (is_null($value) || empty($value)) {
                    continue;
                }

                Setting::updateOrCreate(
                    ['group' => $voting, 'key' => $settingKey],
                    ['value' => $value]
                );
            }

            DB::commit();

            return to_route('dashboard.voting.index', ['tab' => $voting])->with('success', 'Settings updated successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to update setting: ' . $th->getMessage());
            return back()->withErrors('Failed to update settings. Please try again.');
        }
    }
}

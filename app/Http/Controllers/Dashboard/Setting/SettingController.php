<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Enums\ApplicationSettingType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Setting\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
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
        $activeTab = request('tab', 'app');
        $settingsTabs = [
            'app' => 'App Settings',
            'seo' => 'SEO Settings',
        ];

        return view('dashboard.settings.app', compact('isMaintenanceMode', 'settings', 'timezones', 'types', 'activeTab', 'settingsTabs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'secret' => ['required', 'string', 'min:8', 'max:20'],
        ]);

        try {
            if (file_exists(storage_path('framework/down'))) {
                Artisan::call('up');
            } else {
                Artisan::call('down', [
                    '--secret' => $data['secret'],
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Maintenance mode toggled successfully.',
            ]);
        } catch (\Throwable $th) {
            Log::error('Failed to toggle maintenance mode: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to toggle maintenance mode.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $setting)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            foreach ($data as $key => $value) {
                $settingKey = str_replace("{$setting}_", '', $key);

                if (is_null($value) || empty($value)) {
                    continue;
                }

                Setting::updateOrCreate(
                    ['group' => $setting, 'key' => $settingKey],
                    ['value' => $value]
                );
            }

            DB::commit();

            return to_route('dashboard.settings.index', ['tab' => $setting])->with('success', 'Settings updated successfully.');
        } catch (\Throwable $th) {
            Log::error('Failed to update setting: ' . $th->getMessage());
            return back()->withErrors('Failed to update settings. Please try again.');
        }
    }
}

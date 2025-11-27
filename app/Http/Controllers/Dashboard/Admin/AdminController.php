<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\DataTables\Admin\AdminDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\StoreRequest;
use App\Http\Requests\Dashboard\Admin\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        try {
            $admin = User::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Admin created successfully.',
                'data' => $admin,
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error creating admin: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create admin.',
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $admin)
    {
        $data = $request->validated();

        try {
            if (!isset($data['password']) || empty($data['password'])) {
                unset($data['password']);
            }

            $admin->update($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Admin updated successfully.',
                'data' => $admin,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error updating admin: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to update admin.',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $admin)
    {
        try {
            $admin->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Admin deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error deleting admin: ' . $th->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete admin.',
            ], 500);
        }
    }
}

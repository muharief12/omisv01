<?php

namespace App\Http\Controllers;

use App\Models\AdminFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdminFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminFees = AdminFee::all();
        return view('admin.admin_fees.index', compact('adminFees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin_fees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tax' => 'required|integer|max:100|min:0',
            'insurance' => 'required|integer|max:100|min:0',
            'delivery' => 'required|integer|max:100|min:0',
        ]);

        DB::beginTransaction();
        try {
            $validated['user_id'] = Auth::user()->id;
            $validated['is_active'] = false;

            $newAdminFee = AdminFee::create($validated);
            DB::commit();

            return redirect()->route('admin.admin_fees.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()]
            ]);

            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminFee $adminFee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminFee $adminFee)
    {
        return view('admin.admin_fees.edit', compact('adminFee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminFee $adminFee)
    {
        $validated = $request->validate([
            'tax' => 'sometimes|integer|max:100|min:0',
            'insurance' => 'sometimes|integer|max:100|min:0',
            'delivery' => 'sometimes|integer|max:100|min:0',
            'is_active' => 'sometimes',
        ]);

        DB::beginTransaction();
        try {
            $validated['user_id'] = Auth::user()->id;
            $adminFee->update($validated);
            DB::commit();

            return redirect()->route('admin.admin_fees.index');

        } catch (\Throwable $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error!' . $e->getMessage()]
            ]);

            throw $error;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminFee $adminFee)
    {
        //
    }
}

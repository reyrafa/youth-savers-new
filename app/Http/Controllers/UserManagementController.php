<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficerRequest;
use App\Models\BranchModel;
use App\Models\OfficerModel;
use App\Models\User;
use App\Models\UserStatusModel;
use App\Models\UserTypeModel;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index()
    {

        $officers = OfficerModel::with('branch', 'users', 'users.status', 'users.type')->get();
        $user_types = UserTypeModel::all();
        $status = UserStatusModel::all();
        $branchs = BranchModel::all();
        return view('pages.user-management.index', compact('branchs', 'user_types', 'status', 'officers'));
    }

    public function store(OfficerRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated['users']);
        $officer = OfficerModel::create($validated['officer']);

        $user->password = bcrypt($validated['users']['password']);
        $user->save();

        $officer->uid = $user->id;
        $officer->company_id = $user->company_id;
        $officer->save();
        return back()->with('success', 'Officer is added successfully.');
    }


    public function edit(Request $request)
    {
        $officer = OfficerModel::where('id', $request->id)->first();

        $user = User::where('id', $officer->uid)->first();

        $response = [
            'officer' => $officer,
            'user' => $user
        ];
        return response()->json($response);
    }

    public function update(OfficerRequest $request, $id)
    {
        $validated = $request->validated();

        $officer = OfficerModel::findOrFail($id);
        $user = User::findOrFail($officer->uid);

        $officer->update($validated['officer']);
        $user->update($validated['users']);

        $officer->updated_at = now();
        $officer->save();
        $user->updated_at = now();
        $user->save();

        return back()->with('success', 'Officer Updated Successfully');
    }

    public function destroy($id)
    {
        $officer = OfficerModel::findOrFail($id);
        $user = User::findOrFail($officer->uid);
        $officer->delete();
        $user->delete();

        return back()->with('success', 'Officer Deleted Successfully');
    }
}

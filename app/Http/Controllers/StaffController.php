<?php

namespace App\Http\Controllers;

use App\Consts\Roles;
use App\Http\Requests\StaffRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function index()
    {
        $staffs = Staff::paginate();
        $headers = ['Staffs'];

        return view('staffs.index', compact('staffs', 'headers'));
    }

    public function create()
    {
        $staff = new Staff();
        $headers = ['Staffs', 'Create'];
        $roles = Roles::ROLES_MAP;

        return view('staffs.create', compact('staff', 'headers', 'roles'));
    }

    public function store(StaffRequest $request)
    {
        $staff =  Staff::create(['role' => $request->role]);

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $staff->user()->create(collect($data)->except('role')->all());

        return redirect()->route('staffs.index');
    }

    public function edit(Staff $staff)
    {
        $headers = ['Staffs', 'Edit'];
        $roles = Roles::ROLES_MAP;

        return view('staffs.edit', compact('staff', 'headers', 'roles'));
    }

    public function update(StaffRequest $request, Staff $staff)
    {
        $staff->update([
            'role' => $request->role
        ]);

        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $staff->user->update(collect($data)->except('role')->all());

        return redirect()->route('staffs.index');
    }

    public function destroy(Staff $staff)
    {
        $staff->user()->delete();
        $staff->delete();

        return redirect()->route('staffs.index');
    }
}

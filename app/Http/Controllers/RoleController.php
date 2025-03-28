<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index() {
        return response()->json(Role::all());
    }

    public function store(Request $request) {
        $role = Role::create($request->validate(['name' => 'required|unique:roles']));
        return response()->json($role);
    }
}

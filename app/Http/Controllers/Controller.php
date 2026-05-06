<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //use Spatie\Permission\Models\Role;

public function roles()
{
    $roles = Role::all();
    return view('roles.index', compact('roles'));
}
}

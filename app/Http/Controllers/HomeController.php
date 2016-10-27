<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return User::all();
    }

    /**
     * @param $userId
     * @param $role
     *
     * @return mixed
     */
    public function attachUserRole($userId, $role)
    {
        $user = User::find($userId);
        $roleId = Role::where('name' ,$role)->first();
        $user->roles()->attach($roleId);

        return $user;
    }

    /**
     * @param $userId
     *
     * @return mixed
     */
    public function getUserRoles($userId)
    {
        return User::find($userId)->roles;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function attachPermission(Request $request)
    {
        $parameters = $request->only('permission', 'role');

        $permissionParam = $parameters['permission'];
        $roleParam = $parameters['role'];

        $role = Role::where('name', $roleParam)->first();
        $permission = Permission::where('name', $permissionParam)->first();

        $role->attachPermission($permission);

        return $this->response->created();
    }

    /**
     * @param $roleParam
     *
     * @return mixed
     */
    public function getPermissions($roleParam)
    {
        $role = Role::where('name', $roleParam)->first();

        return $this->response->array($role->perms);
    }
}

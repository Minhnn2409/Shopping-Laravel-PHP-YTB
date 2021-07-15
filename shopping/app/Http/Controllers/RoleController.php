<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    private $role;
    private $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->paginate(5);
        return view('admin.role.index', compact('roles'));
    }

    public function add()
    {
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('permissionParents'));
    }

    public function create(Request $request)
    {
        $role = $this->role->create([
            'name' => $request->name,
            'display_name' => $request->display_name
        ]);
        $role->getPermissions()->attach($request->permission_id);
        return redirect()->route('role.index');
    }

    public function edit($id)
    {
        $role = $this->role->find($id);
        $permissionParents = $this->permission->where('parent_id', 0)->get();
        $permissionChecked = $role->getPermissions;
        return view('admin.role.edit', compact('role', 'permissionParents', 'permissionChecked'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);
            $role->getPermissions()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('role.index');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message:' . $exception->getMessage() . '---Line: ' . $exception->getLine());
        }

    }
}

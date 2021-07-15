<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function add()
    {
        $moduleParents = config('permissions.module_parent');
        $moduleChildren = config('permissions.module_children');
        return view('admin.permission.add', compact('moduleParents', 'moduleChildren'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $permissionParent = $this->permission->create([
                'name' => $request->name,
                'display_name' => $request->name,
                'parent_id' => 0,
                'key_code' => ''
            ]);

            $moduleChildren = $request->module_children;
            foreach ($moduleChildren as $moduleChild) {
                $this->permission->create([
                    'name' => $moduleChild,
                    'display_name' => $moduleChild,
                    'parent_id' => $permissionParent->id,
                    'key_code' => $permissionParent->name . '_' . $moduleChild
                ]);
            }
            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . '--Line: ' . $exception->getLine());
        }

    }
}

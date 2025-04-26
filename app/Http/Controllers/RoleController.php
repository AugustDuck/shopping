<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $roles = Role::with('permissions')->get();
        
        if ($request->expectsJson()){
            return response()->json([
                'status' => 'success',
                'data' => $roles,
                'message' => 'Roles retrieved successfully',
                'code' => 200,
                'type' => 'roles'
            ]);
        }
        return view('admin.roles.index',[
            'roles' => $roles,
        ]);
    }

    public function edit(Role $role){
        $role = Role::with('permissions')->findOrFail($role->id);
        $permissionsList = Permission::all();
        // dd($role->toArray());
        return view('admin.roles.edit',[
            'role' => $role,
            'permissionsList' => $permissionsList
        ]);
    }

    public function create()
    {
        $roles = Role::with('permissions')->get();
        
        // dd($roles->toArray());
        return view('admin.roles.create',[
            'roles' => $roles,
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        // trong RoleController@store
        $validated = $request->validate([
            'name'          => 'required|string|max:255|unique:roles,name',
            'permissions'   => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        
        
        try {
            DB::beginTransaction();
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'sanctum',
            ]);
            
            $permissions = Permission::whereIn('name', $validated['permissions'])->where('guard_name', 'sanctum')->get();
            $role->syncPermissions($permissions);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'data' => $role,
                'message' => 'Roles retrieved successfully',
            ]); 

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name'          => '|required|string|max:255',
            'permissions'   => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        try {
            DB::beginTransaction();
            $role->update([
                'name' => $validated['name'],
                'guard_name' => 'sanctum',
            ]);
            
            $permissions = Permission::whereIn('name', $validated['permissions'])->where('guard_name', 'sanctum')->get();
            $role->syncPermissions($permissions);
            DB::commit();
            return response()->json([
                'status' => 'success',
                'data' => $role,
                'message' => 'Roles retrieved successfully',
            ]); 

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            DB::beginTransaction();
            \Log::info('Role object:', ['role' => $role]);
            \Log::info('Guard model:', ['model' => getModelForGuard($role->guard_name)]);
            $role->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'data' => $role,
                'message' => 'Role deleted successfully',
            ]);
 
    
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra, rollback lại transaction
            DB::rollBack();
            
            // Trả về thông báo lỗi
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    
    
    public function getRoleByUserId($userId)
    {
        try {
            $user = User::with(['roles'])->findOrFail($userId);
            return response()->json($user->roles);
        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['error' => 'User not found'], 404);
            } else if ($e instanceof \Illuminate\Database\Eloquent\RelationNotFoundException) {
                return response()->json(['error' => 'No roles found for this user'], 404);
            }
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}

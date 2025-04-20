<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        
        return response()->json([
            'status' => 'success',
            'data' => $roles,
            'message' => 'Roles retrieved successfully',
            'code' => 200,
            'type' => 'roles'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

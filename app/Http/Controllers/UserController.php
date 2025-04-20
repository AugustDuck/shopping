<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use App\Models\Phone;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Log;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        $addresses = Address::all();
        $phones = Phone::all();
        return view('admin.users.create', [
            'users' => $users,
            'roles' => $roles,
            'addresses' => $addresses,
            'phones' => $phones,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password'=>'required',
            'roles' => 'required|array',
            'phones' => 'required|array',
            'addresses' => 'required|array'
        ]);


        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password'=>$validated['password']
            ]);
            
            $user->assignRole($validated['roles']);

            foreach ($validated['phones'] as $phone) {
                $user->phones()->create([
                    'phone_number' => $phone
                ]);
            }

            foreach ($validated['addresses'] as $address) {
                $user->addresses()->create([
                    'address' => $address
                ]);
            }
            Log::info("Creating user...");

            DB::commit();

            return response()->json([
                'status' => 'success',
                'data' => $user,
                'message' => 'User created successfully',
                'code' => 201,
            ]);

        } catch (\Throwable $th) {
           DB::rollBack();
           \Log::error($th->getMessage());
           return response()->json([
            'status' => 'error',            
            'message' => 'Error creating user',
            'code' => 500
           ]);
        }

  
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {   
        try {
            $user = User::with(['phones','addresses','roles'])->findOrFail($user->id);
           
            return view('admin.users.edit', [
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'roles' => 'required|array',
            'phones' => 'required|array',
            'addresses' => 'required|array',
            'password'=>'nullable|max:50'
        ]);

        try {
            DB::beginTransaction();
          
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                // 'password'=>$validated['password']
            ]);
            
            $user->syncRoles(collect($validated['roles'])->pluck('name')->toArray());

            $phone_numbers = collect($validated['phones'])->pluck('phone_number')->toArray();


            $user->phones()->whereNotIn('phone_number',$phone_numbers )->delete();

            foreach ($validated['phones'] as $phone) {

                $user->phones()
                    ->withTrashed()
                    ->updateOrCreate(
                        ['phone_number' => $phone['phone_number']],
                        ['deleted_at' => null]
                    );
            }

            $addresses = collect($validated['addresses'])->pluck('address')->toArray();
            $user->addresses()->whereNotIn('address', $addresses)->delete();

            foreach ($validated['addresses'] as $address) {
                $user->addresses()->withTrashed()->updateOrCreate(
                    ['address' => $address['address']],
                    ['deleted_at' => null]
                );
            }
            DB::commit();
            return response()->json([
                'status' => 'success',
                'data' => $user->with(['phones','addresses','roles'])->find($user->id),
                'message' => 'User updated successfully',
                'code' => 201,
            ]);

    } catch (\Throwable $th) {
        DB::rollBack();
        \Log::error($th->getMessage());
        return response()->json(data: [
         'status' => 'error',            
         'message' => $th->getMessage(),
         'code' => 500
        ]);
     }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error deleting user',
                'code' => 500,
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $user,
            'message' => 'User deleted successfully',
            'code' => 200,
        ]);
    }
}

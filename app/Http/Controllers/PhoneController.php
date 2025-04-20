<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Phone;
class PhoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $phones = Phone::all();
        return response()->json([
            'status' => 'success',
            'data' => $phones,
            'message' => 'Phones retrieved successfully',
            'code' => 200,
            'type' => 'phones'
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
    public function getPhoneByUserId($userId)
    {
        try {
            $user = User::with(['phones'])->findOrFail($userId);
            return response()->json($user->phones);
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

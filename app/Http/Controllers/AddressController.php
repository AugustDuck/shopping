<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use App\Models\User;
class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::all();
        return response()->json([
            'status' => 'success',
            'data' => $addresses,
            'message' => 'Addresses retrieved successfully',
            'code' => 200,
            'type' => 'addresses'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        //
    }
    public function getAddressByUserId($userId)
    {
        try {
            $user = User::with(['addresses'])->findOrFail($userId);
            return response()->json($user->addresses);
        } catch (\Exception $e) {
            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['error' => 'User not found'], 404);
            } else if ($e instanceof \Illuminate\Database\Eloquent\RelationNotFoundException) {
                return response()->json(['error' => 'No addresses found for this user'], 404);
            }
            return response()->json(['error' => 'An error occurred'], 500);
        }
;
    }
}

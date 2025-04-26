<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

use function PHPSTORM_META\map;

class PermissionController extends Controller
{
    //
    public function index()  {

        try{
            $permissions = Permission::all();
          
            return response()->json([
                'status' => 'success',
                'data' => $permissions,
                'message' => 'Permissions retrieved successfully',
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Error retrieving permissions ' .$th->getMessage(),
                'code' => 500,
            ]);
        }
    }
}

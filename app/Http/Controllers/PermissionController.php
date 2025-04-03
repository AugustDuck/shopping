<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PermissionController extends Controller
{
    //
    public function index()  {
        // $permission = DB::select("SELECT name FROM permission WHERE id = :id",
        // [
        //     'id' => 21
        // ]);
        $permission = DB::table('permission')
                        ->where('id' ,'=',21)
                        ->delete();
        dd($permission);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $content = 'welcome to controller';
        $menus = Menu::all();
        $parentMenus = $menus->whereNull('parent_id');
        $childMenus = $menus->whereNotNull('parent_id');

   
        return view('home',
        [
            'content'=>$content,
            'parentMenus'=>$parentMenus,
            'childMenus'=>$childMenus
        ]);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    public function index(){
        $content = 'welcome to controller';
        $menus = Menu::all();
        $parentMenus = $menus->whereNull('parentId');
        $childMenus = $menus->whereNotNull('parentId');
        return view('home',
        [
            'content'=>$content,
            'parentMenus'=>$parentMenus,
            'childMenus'=>$childMenus
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Components\MenuRecursive;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    private $menuRecursive;
    private $menu;
    public function __construct(MenuRecursive $menuRecursive, Menu $menu)
    {
        $this->menuRecursive = $menuRecursive;
        $this->menu = $menu;
    }

//    public function getMenu($parentId){
//        $data = $this->menu->all();
//        $menuRecursive = new MenuRecursive($data);
//        return $menuRecursive -> MenuRecursiveAdd($parentId);
//    }

    public function index()
    {
        $menus = $this->menu->paginate(10);
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $htmlOption = $this->menuRecursive->MenuRecursiveAdd();
        return view('admin.menu.add', compact('htmlOption'));
    }

    public function store(Request $request)
    {
        $this->menu->create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id
        ]);

        return redirect()->route('menu.index');
    }

    public function edit($id)
    {
        $menu = $this->menu->find($id);
        $htmlOption = $this->menuRecursive->MenuRecursiveEdit($menu->parent_id);
        return view('admin.menu.edit', compact('menu', 'htmlOption'));
    }

    public function update($id, Request $request)
    {
        $this->menu->find($id)->update([
            'name' =>  $request->name,
            'parent_id' => $request->parent_id,
            'slug' => str_slug($request->name),
        ]);

        return redirect()->route('menu.index');
    }

    public function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->route('menu.index');
    }
}

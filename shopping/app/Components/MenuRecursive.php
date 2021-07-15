<?php
namespace App\Components;

use App\Models\Menu;

class MenuRecursive {
    private $htmlOption;
    public function __construct()
    {
        $this->htmlOption='';
    }

    public function MenuRecursiveAdd($parent_id = 0, $subMark='')
    {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $value)
        {
            $this->htmlOption .= "<option value='". $value->id."'>".$subMark.$value->name."</option>";
            $this->MenuRecursiveAdd($value->id, $subMark.'--');
        }
        return $this->htmlOption;
    }

    public function MenuRecursiveEdit($menuParentId, $parent_id=0, $subMark=''){
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $value){
            if($menuParentId == $value->id){
                $this->htmlOption .= "<option selected value='". $value->id."'>".$subMark.$value->name."</option>";
            }
            else{
                $this->htmlOption .= "<option value='". $value->id."'>".$subMark.$value->name."</option>";
            }
            $this->MenuRecursiveEdit($menuParentId, $value->id, $subMark.'--');
        }
        return $this->htmlOption;
    }
}

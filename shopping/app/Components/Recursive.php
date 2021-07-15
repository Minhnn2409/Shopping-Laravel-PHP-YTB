<?php
namespace App\Components;

class Recursive {
    private $data;
    private $htmlSelected = '';
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function categoryRecursive($parent_id, $id=0,$text=''){
        foreach ($this->data as $value){
            if ($value['parent_id'] == $id){
                if(!empty($parent_id) && $parent_id == $value['id']){
                    $this->htmlSelected .= "<option selected value = '". $value['id']."'>" .$text . $value['name']."</option>";
                }
                else{
                    $this->htmlSelected .= "<option value = '". $value['id']."'>" .$text . $value['name']."</option>";
                }
                $this->categoryRecursive($parent_id, $value['id'], $text."--");
            }
        }
        return $this->htmlSelected;
    }
}

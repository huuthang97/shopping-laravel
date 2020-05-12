<?php
namespace App\Components;

class MenuRecusive  {
    private $html = '';
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
        $this->html = ''; 
    }


    function menuRecusiveAdd($parent_id, $id_select, $text = '') {
        $data = $this->data;
        foreach($data as $value) {
            if ($value['parent_id'] == $parent_id) {
                if ($id_select && $id_select == $value['id']){
                    $this->html .= '<option selected value=' . $value['id'] . '>'. $text . $value['name'] .'</option>';
                }
                else{
                    $this->html .= '<option value=' . $value['id'] . '>'. $text . $value['name'] .'</option>';
                }
                
                $this->menuRecusiveAdd($value['id'], $id_select, $text . '--');
            }
        }
        return $this->html;
    }
}
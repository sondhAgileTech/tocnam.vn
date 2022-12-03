<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminCategories extends Model
{
    //
    protected $table = 'categories';

    protected static function getAllList()
    {
        $data = AdminCategories::select('id','name')->get();
        $categories = Array();
        foreach ($data as $value)
        {
            $categories[$value->id] = $value->name;
        }
        return $categories;
    }

    protected static function getChildList()
    {
        $data = AdminCategories::select('id','name')->where('id_child','<>',0)->get();
        $categories = Array();
        foreach ($data as $value)
        {
            $categories[$value->id] = $value->name;
        }
        return $categories;
    }

    protected static function getParentList()
    {
        $data = AdminCategories::select('id','name')->where('id_child','=',0)->get();
        $categories = Array();
        foreach ($data as $value)
        {
            $categories[$value->id] = $value->name;
        }
        return $categories;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $table = 'pages';

    protected function getPageDetail($slugs)
    {
        return Page::select('*')->where('slugs',$slugs)->first();
    }
}

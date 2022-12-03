<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            //->description('Admin Control Panel')
            ->row('<center><h1>Admin Control Panel Version 1.5.x-dev</h1>
            <p><a href="/admin/categories" class="btn btn-danger"><i class="fa fa-list-alt"></i> Categories Manager</a>
            <a href="/admin/news" class="btn btn-warning"><i class="fa fa-newspaper-o"></i> News Manager</a>
            <a href="/admin/media" class="btn btn-primary"><i class="fa fa-folder-open"></i> File Manager</a></p>
            </center>');
    }
}

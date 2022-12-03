<?php

namespace App;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class AdminWidgets extends Model
{
    //
    use ModelTree, AdminBuilder;

    protected $table = 'widgets';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setParentColumn('parent');
        $this->setOrderColumn('order');
        $this->setTitleColumn('name');
    }
}

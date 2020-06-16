<?php

namespace App;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    public function permissionChildrent() {
        return $this->hasMany('App\Permission', 'parent_id', 'id');
    }


}

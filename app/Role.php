<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    public function permission()
    {
        return $this->belongsToMany('App\Permission');
    }
    public function users()
    {
        return $this->belongsToMany('App\user');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Foundation\Auth\User as Authenticatabl;


class Admin extends Authenticatabl
{
    protected $table = 'admin';

    public $timestamps = false;

    public $primaryKey = 'id';


}
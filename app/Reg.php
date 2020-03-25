<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reg extends Model
{
    public $primaryKey='id';
    protected $table='user';
    public $timestamps=false;

    //白名单  表设计中不允许为空的
    // protected $fillable = ['brand_name','brand_url'];
    //黑名单   表设计中允许为空的
    protected $guarded = [];
}

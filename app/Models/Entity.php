<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Entity extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
       'nif',
       'email',
       'name',
       'short_name',
       'phone_number',
       'image',
       'api_token',
       'code',

    ];
    protected $dates = ['deleted_at'];
  

}

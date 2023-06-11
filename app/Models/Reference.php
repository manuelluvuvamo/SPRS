<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Reference extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
       'amount',
       'end_datetime',
       'reference_id',
       'entity_code',
       'id_entity',
       'status',

    ];
    protected $dates = ['deleted_at'];
  

}

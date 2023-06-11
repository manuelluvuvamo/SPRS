<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
       'amount',
       'reference_id',
       'id_reference',
       'entity_code',


    ];
    protected $dates = ['deleted_at'];
  

}

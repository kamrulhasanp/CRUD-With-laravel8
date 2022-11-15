<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $softDelete = true;
    

    protected $fillable = [
        'user_id',
        'category_name',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

   

}



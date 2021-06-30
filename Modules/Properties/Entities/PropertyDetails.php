<?php

namespace Modules\Properties\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyDetails extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','user_id','property_size','bedroom','bathroom','garage',
                           'location','description','price','image','property_status'];
    
    protected static function newFactory()
    {
        return \Modules\Properties\Database\factories\PropertyDetailsFactory::new();
    }
}

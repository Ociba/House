<?php

namespace Modules\Agents\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone_number','current_location','photo','created_by'];
    
    protected static function newFactory()
    {
        return \Modules\Agents\Database\factories\OwnerFactory::new();
    }
}

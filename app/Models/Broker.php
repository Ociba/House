<?php

namespace Modules\Agents\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = ['name','email','phone_number','current_location','photo'];
    
    protected static function newFactory()
    {
        return \Modules\Agents\Database\factories\BrokerFactory::new();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class broker extends Model
{
    use HasFactory;
    
   protected $fillable=['name','email','phone_number','current_location','created_by'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRoleModel extends Model
{
    use HasFactory;

    protected $table = 'user_roles';
    protected $fillable = ['name'];
    
}

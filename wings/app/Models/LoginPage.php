<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LoginPage extends Authenticatable
{
    use HasFactory;
	
	protected $table = 'login';
	protected $primaryKey = 'user';
	protected $keyType = 'string';
	
    protected $fillable = ['user', 'password'];
	protected $hidden  = ['password'];
	
	public function getAuthPassword(){
        return bcrypt($this->password);
    }
	
}

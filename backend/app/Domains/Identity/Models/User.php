<?php
declare(strict_types=1);
namespace App\Domains\Identity\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
final class User extends Authenticatable {
 use HasApiTokens, HasFactory, HasRoles;
 protected $fillable=['name','email','phone','password','status','email_verified_at'];
 protected $hidden=['password','remember_token'];
 protected function casts(): array { return ['password'=>'hashed','email_verified_at'=>'datetime']; }
}
<?php
namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent

{

  protected $fillable = ['email', 'password'];
   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

 }
<?php
namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Person extends Eloquent

{
   /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */

   public function tickets()

   {
       return $this->hasMany(Ticket::class);

   }

 }
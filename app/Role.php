<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    // Definimos los roles de usuario.
    const ADMIN = 1;
    const TEACHER = 2;
    const STUDENT = 3;

}

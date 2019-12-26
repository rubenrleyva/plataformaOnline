<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    // Posibles estados de los cursos
    const PUBLISHED = 1;
    const PENDING = 2;
    const REJECTED = 3;
}

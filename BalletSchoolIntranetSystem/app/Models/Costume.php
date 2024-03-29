<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Costume extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $fillable = ['name', 'color', 'size', 'picture'];

   



}


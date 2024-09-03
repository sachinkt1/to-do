<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Add title and any other attributes you want to allow for mass assignment
    protected $fillable = ['title', 'completed'];
}


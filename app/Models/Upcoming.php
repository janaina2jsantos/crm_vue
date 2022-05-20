<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upcoming extends Model
{
    use HasFactory;

    protected $table    = "upcomings";
    protected $fillable = ['task_id', 'title', 'completed', 'approved', 'waiting'];
}

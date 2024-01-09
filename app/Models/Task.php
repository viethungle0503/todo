<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // Define table name and column
    protected $table = 'todos';

    protected $fillable = [
        'task', 'content', 'status', 'created_at', 'updated_at',
    ];

    public static function getAll()
    {
        return Task::all();
    }
}

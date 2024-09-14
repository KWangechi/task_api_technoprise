<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Laravel\Lumen\Auth\Authorizable;


class Task extends Model
{
    use HasFactory;

    protected $table = "tasks";

    // protected $fillable = ['title', 'description', 'status', 'due_date'];
    protected $guarded = [];

    public function rules()
    {
        return [
            'title' => 'required|string|unique',
            'description' => 'string',
            'due_date' => 'datetime',
           'status' => 'in:pending,completed,cancelled'
        ];
    }
}

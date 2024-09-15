<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Laravel\Lumen\Auth\Authorizable;


class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'due_date'];

    // const TASK_STATUS = [
    //     'pending' => 'Pending',
    //     'completed' => 'Completed',
    //     'in_progress' => 'In Progress',
    // ];

    public function rules()
    {
        return [
            'title' => 'required|string|unique:tasks',
            'description' => 'string|required',
            'due_date' => 'required|date',
            'status' => 'required|in:Pending,Completed,In Progress'
        ];
    }
}

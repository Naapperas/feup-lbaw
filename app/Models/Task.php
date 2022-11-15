<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'edit_date',
        'state',
        'position'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'fts_search'
    ];

    public function project() {
        return $this->hasOneThrough(
            Project::class,
            TaskGroup::class,
            null,
            null,
            'task_group',
            'project'
        );
    }

    public function taskGroup() {
        return $this->belongsTo(
            TaskGroup::class,
            'task_group'
        );
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator');
    }

    public function comments() {
        return $this->hasMany(
            TaskComment::class,
            'task'
        );
    }

    protected $table = 'task';
}
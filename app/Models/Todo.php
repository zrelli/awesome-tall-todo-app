<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'is_completed', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'todo_subscriptions', 'todo_id', 'subscriber_id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function isSubscribed()
    {
        $user = auth()->user();
        if ($user) {
            return $this->subscribers->contains($user);
        }
        return false;
    }


    public function subscribe()
    {
        $this->subscribers()->attach(auth()->user()->id);
    }


    public function unsubscribe()
    {
        $this->subscribers()->detach(auth()->user()->id);
    }
}

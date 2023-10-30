<?php
namespace App\Policies;
use App\Models\Todo;
use App\Models\User;
class TodoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function update(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }
    public function delete(User $user, Todo $todo): bool
    {
        return $user->id === $todo->user_id;
    }
    public function subscribe(User $user, Todo $todo)
    {
        return $user->id !== $todo->user_id;
    }
    public function createTask(User $user, Todo $todo)
    {
        return $user->id === $todo->user_id;
    }
}

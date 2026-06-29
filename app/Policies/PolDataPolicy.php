<?php

namespace App\Policies;

use App\Models\PolData;
use App\Models\User;

class PolDataPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, PolData $polData): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, PolData $polData = null): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, PolData $polData = null): bool
    {
        return $user->isAdmin();
    }
}

<?php

namespace App\Policies;

use App\Models\Route;
use App\Models\User;
use App\Enums\RouteStatusEnum;

class RoutePolicy
{
    /**
     * Determine whether the user can view the route.
     */
    public function view(User $user, Route $route): bool
    {
        // User must be either sender or receiver
        return $user->airline->id === $route->sender_id ||
            $user->airline->id === $route->receiver_id ||
            $user->isAdmin();
    }

    /**
     * Determine whether the user can update the route.
     */
    public function update(User $user, Route $route): bool
    {
        // Only sender can update pending routes
        return ($user->airline->id === $route->sender_id &&
                $route->status === RouteStatusEnum::PENDING->value) ||
            $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the route.
     */
    public function delete(User $user, Route $route): bool
    {
        // Only sender can delete pending routes
        return ($user->airline->id === $route->sender_id &&
                $route->status === RouteStatusEnum::PENDING->value) ||
            $user->isAdmin();
    }
}
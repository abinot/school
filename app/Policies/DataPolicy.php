<?php

namespace App\Policies;

use App\Models\Data;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DataPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Data $data): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Data $data): bool
    {
        return $data->user()->is($user);
     
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Data $data): bool
    {
      return $this->update($user, $data);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Data $data): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Data $data): bool
    {
        return false;
    }
}

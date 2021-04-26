<?php

declare(strict_types=1);

namespace App\Services\Handlers\User;

use App\Models\User;

/**
 * Class EditProfileHandler
 * @package App\Services\Handlers\User
 */
class EditProfileHandler
{
    /**
     * @param User $user
     * @param array $data
     * @return User
     */
    public function handle(User $user, array $data): User
    {
        $user->update($data);
        return $user->refresh();
    }
}

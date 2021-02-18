<?php

declare(strict_types=1);

namespace App\Services\Handlers\User;

use App\Exceptions\NotVerifiedPhone;
use App\Models\User;
use App\Services\DTO\User\RegisterUserDTO;
use App\Services\Handlers\User\RegisterPipes\UserRegisterPipe;
use App\Services\Handlers\User\RegisterPipes\ValidateRegisterPipe;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

/**
 * Class RegisterUserHandler
 * @package App\Services\Handlers\User
 */
class RegisterUserHandler
{
    /** @var Pipeline */
    private $pipeline;

    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    public function loadPipes(): array
    {
        return [
            ValidateRegisterPipe::class,
            UserRegisterPipe::class
        ];
    }

    /**
     * @param RegisterUserDTO $registerDTO
     * @return User
     * @throws NotVerifiedPhone
     */
    public function handle(RegisterUserDTO $registerDTO): User
    {
        DB::transaction(function () use ($registerDTO) {
            $this->pipeline
                ->send($registerDTO)
                ->through($this->loadPipes())
                ->thenReturn();
        });

        return $registerDTO->user;
    }
}

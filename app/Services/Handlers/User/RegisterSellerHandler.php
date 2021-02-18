<?php

declare(strict_types=1);

namespace App\Services\Handlers\User;

use App\Exceptions\NotVerifiedPhone;
use App\Models\User;
use App\Services\DTO\User\RegisterSellerDTO;
use App\Services\Handlers\User\RegisterPipes\CreateHousesPipe;
use App\Services\Handlers\User\RegisterPipes\SellerRegisterPipe;
use App\Services\Handlers\User\RegisterPipes\ValidateRegisterPipe;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

/**
 * Class RegisterSellerHandler
 * @package App\Services\Handlers\User
 */
class RegisterSellerHandler
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
            SellerRegisterPipe::class,
            CreateHousesPipe::class,
        ];
    }

    /**
     * @param RegisterSellerDTO $registerDTO
     * @return User
     * @throws NotVerifiedPhone
     */
    public function handle(RegisterSellerDTO $registerDTO): User
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

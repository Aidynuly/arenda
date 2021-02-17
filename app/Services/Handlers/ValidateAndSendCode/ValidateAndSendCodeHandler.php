<?php

declare(strict_types=1);

namespace App\Services\Handlers\ValidateAndSendCode;

use App\Services\DTO\ValidateAndSendCodeDTO;
use App\Services\Handlers\ValidateAndSendCode\Pipes\SendCodePipe;
use App\Services\Handlers\ValidateAndSendCode\Pipes\ValidatePhonePipe;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

/**
 * Class ValidateAndSendCodeHandler
 * @package App\Services\Handlers\ValidateAndSendCode
 */
class ValidateAndSendCodeHandler
{
    /** @var Pipeline */
    private $pipeline;

    /**
     * ValidateAndSendCodeHandler constructor.
     * @param Pipeline $pipeline
     */
    public function __construct(Pipeline $pipeline)
    {
        $this->pipeline = $pipeline;
    }

    /**
     * @return array
     */
    private function loadPipes(): array
    {
        return [
            ValidatePhonePipe::class,
            SendCodePipe::class,
        ];
    }

    /**
     * @param ValidateAndSendCodeDTO $dto
     */
    public function handle(ValidateAndSendCodeDTO $dto)
    {
        DB::transaction(function () use ($dto) {
            $this->pipeline
                ->send($dto)
                ->through($this->loadPipes())
                ->thenReturn();
        });
    }
}

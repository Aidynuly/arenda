<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ValidatePhoneRequest;
use App\Http\Resources\UserResource;
use App\Services\Handlers\User\RegisterHandler;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    use ResponseTrait;

    /**
     * @param RegisterRequest $request
     * @param RegisterHandler $handler
     * @return JsonResponse
     */
    public function register(RegisterRequest $request, RegisterHandler $handler): JsonResponse
    {
        $user = $handler->handle($request->getDTO());

        return $this->response('Успешная регистрация', new UserResource($user));
    }

    public function auth(AuthRequest $request)
    {

    }


    public function validatePhone(ValidatePhoneRequest $request)
    {
        //1 check for phone if exists: return exists
        //2 check for phone code existence if exists more than 10 > error
        //3 generate code for sending
        //4 send code
        //5 return success response
    }
}

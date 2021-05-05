<?php

declare(strict_types=1);

namespace App\Http\Controllers\V1;

use App\Exceptions\AlreadyHasReviewException;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Services\DTO\ReviewDTO;
use App\Services\Handlers\Reviews\CreateReviewHandler;
use App\Services\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

/**
 * Class ReviewController
 * @package App\Http\Controllers\V1
 */
final class ReviewController extends Controller
{
    use ResponseTrait;

    /**
     * @param CreateReviewRequest $request
     * @param CreateReviewHandler $handler
     * @return JsonResponse
     * @throws AlreadyHasReviewException
     */
    public function createReview(CreateReviewRequest $request, CreateReviewHandler $handler): JsonResponse
    {
       $review = $handler->handle(ReviewDTO::fromArray([
           'user'       => $request->get('user'),
           'text'       => $request->get('text'),
           'star'       => $request->get('star'),
           'house_id'   => $request->get('house_id'),
       ]));

       return $this->response('Отзыв оставлен успешно', new ReviewResource($review));
    }
}

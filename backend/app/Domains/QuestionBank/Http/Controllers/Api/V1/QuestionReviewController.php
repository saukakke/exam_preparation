<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\ApproveQuestionAction;
use App\Domains\QuestionBank\Actions\RejectQuestionAction;
use App\Domains\QuestionBank\Actions\SubmitQuestionForReviewAction;
use App\Domains\QuestionBank\Http\Requests\ReviewQuestionRequest;
use App\Domains\QuestionBank\Http\Resources\QuestionResource;
use App\Domains\QuestionBank\Models\Question;
use Illuminate\Http\JsonResponse;

final class QuestionReviewController
{
    public function submit(Question $question, SubmitQuestionForReviewAction $action): JsonResponse { return (new QuestionResource($action->execute(request()->user(), $question)))->response(); }
    public function review(ReviewQuestionRequest $request, Question $question, ApproveQuestionAction $approve, RejectQuestionAction $reject): JsonResponse {
        $result = $request->validated()['action'] === 'approve' ? $approve->execute($request->user(), $question, $request->validated()['comment'] ?? null) : $reject->execute($request->user(), $question, $request->validated()['comment']);
        return (new QuestionResource($result))->response();
    }
}

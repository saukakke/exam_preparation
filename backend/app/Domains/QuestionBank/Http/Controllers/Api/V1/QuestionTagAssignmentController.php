<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\AssignQuestionTagsAction;
use App\Domains\QuestionBank\Http\Requests\AssignQuestionTagsRequest;
use App\Domains\QuestionBank\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class QuestionTagAssignmentController extends Controller
{
    public function sync(AssignQuestionTagsRequest $request, Question $question, AssignQuestionTagsAction $action): JsonResponse
    {
        return response()->json(['data'=>$action->execute($request->user(), $question, $request->validated()['tag_ids'])]);
    }
}

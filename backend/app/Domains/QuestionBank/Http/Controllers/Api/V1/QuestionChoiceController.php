<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\ManageQuestionChoiceAction;
use App\Domains\QuestionBank\Http\Requests\QuestionChoiceRequest;
use App\Domains\QuestionBank\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class QuestionChoiceController extends Controller
{
    public function store(QuestionChoiceRequest $request, Question $question, ManageQuestionChoiceAction $action): JsonResponse
    {
        $choice = $action->create($request->user(), $question, $request->validated());
        return response()->json(['data'=>$choice], 201);
    }
}

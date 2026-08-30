<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\DeleteQuestionChoiceAction;
use App\Domains\QuestionBank\Actions\ManageQuestionChoiceAction;
use App\Domains\QuestionBank\Actions\UpdateQuestionChoiceAction;
use App\Domains\QuestionBank\Http\Requests\QuestionChoiceRequest;
use App\Domains\QuestionBank\Http\Requests\UpdateQuestionChoiceRequest;
use App\Domains\QuestionBank\Models\Question;
use App\Domains\QuestionBank\Models\QuestionChoice;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class QuestionChoiceController extends Controller
{
    public function store(QuestionChoiceRequest $request, Question $question, ManageQuestionChoiceAction $action): JsonResponse { return response()->json(['data'=>$action->create($request->user(),$question,$request->validated())],201); }
    public function update(UpdateQuestionChoiceRequest $request, QuestionChoice $choice, UpdateQuestionChoiceAction $action): JsonResponse { return response()->json(['data'=>$action->execute($request->user(),$choice,$request->validated())]); }
    public function destroy(QuestionChoice $choice, DeleteQuestionChoiceAction $action): JsonResponse { $action->execute(request()->user(),$choice); return response()->json([],204); }
}

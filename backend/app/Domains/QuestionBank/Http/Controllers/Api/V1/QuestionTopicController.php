<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\CreateQuestionTopicAction;
use App\Domains\QuestionBank\Actions\UpdateQuestionTopicAction;
use App\Domains\QuestionBank\Http\Requests\QuestionTopicRequest;
use App\Domains\QuestionBank\Http\Requests\UpdateQuestionTopicRequest;
use App\Domains\QuestionBank\Http\Resources\QuestionTopicResource;
use App\Domains\QuestionBank\Models\QuestionTopic;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class QuestionTopicController extends Controller
{
    public function index(): JsonResponse { return QuestionTopicResource::collection(QuestionTopic::query()->with('children')->orderBy('name')->paginate(50))->response(); }
    public function store(QuestionTopicRequest $request, CreateQuestionTopicAction $action): JsonResponse { return (new QuestionTopicResource($action->execute($request->validated())))->response()->setStatusCode(201); }
    public function update(UpdateQuestionTopicRequest $request, QuestionTopic $topic, UpdateQuestionTopicAction $action): JsonResponse { return response()->json(['data'=>$action->execute($topic,$request->validated())]); }
    public function destroy(QuestionTopic $topic): JsonResponse { if ($topic->children()->exists() || $topic->questions()->exists()) return response()->json(['message'=>'Topic cannot be deleted while it has children or questions.'],422); $topic->delete(); return response()->json([],204); }
}

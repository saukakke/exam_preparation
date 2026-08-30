<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\CreateQuestionAction;
use App\Domains\QuestionBank\DTOs\CreateQuestionData;
use App\Domains\QuestionBank\Enums\QuestionDifficulty;
use App\Domains\QuestionBank\Enums\QuestionType;
use App\Domains\QuestionBank\Http\Requests\CreateQuestionRequest;
use App\Domains\QuestionBank\Http\Resources\QuestionResource;
use App\Domains\QuestionBank\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class QuestionController extends Controller
{
    public function index(): JsonResponse
    {
        $questions = Question::query()->with('choices')->where('status', 'approved')->latest()->paginate(25);
        return QuestionResource::collection($questions)->response();
    }

    public function store(CreateQuestionRequest $request, CreateQuestionAction $action): JsonResponse
    {
        $data = $request->validated();
        $question = $action->execute($request->user(), new CreateQuestionData((int)$data['subject_id'], isset($data['topic_id']) ? (int)$data['topic_id'] : null, QuestionType::from($data['type']), QuestionDifficulty::from($data['difficulty']), $data['stem'], $data['explanation'] ?? null, (float)$data['points'], (float)($data['negative_marks'] ?? 0), $data['metadata'] ?? []));
        return (new QuestionResource($question))->response()->setStatusCode(201);
    }
}

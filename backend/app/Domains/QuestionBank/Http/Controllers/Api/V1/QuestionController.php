<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\CreateQuestionAction;
use App\Domains\QuestionBank\DTOs\CreateQuestionData;
use App\Domains\QuestionBank\Enums\QuestionDifficulty;
use App\Domains\QuestionBank\Enums\QuestionType;
use App\Domains\QuestionBank\Http\Requests\CreateQuestionRequest;
use App\Domains\QuestionBank\Http\Requests\ListQuestionsRequest;
use App\Domains\QuestionBank\Http\Resources\QuestionResource;
use App\Domains\QuestionBank\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

final class QuestionController extends Controller
{
    public function index(ListQuestionsRequest $request): JsonResponse
    {
        $data=$request->validated();
        $query=Question::query()->with(['choices','tags','versions'])->when(isset($data['subject_id']),fn($q)=>$q->where('subject_id',$data['subject_id']))->when(isset($data['topic_id']),fn($q)=>$q->where('topic_id',$data['topic_id']))->when(isset($data['difficulty']),fn($q)=>$q->where('difficulty',$data['difficulty']))->when(isset($data['type']),fn($q)=>$q->where('type',$data['type']))->when(isset($data['bloom_level']),fn($q)=>$q->where('bloom_level',$data['bloom_level']))->when(isset($data['status']),fn($q)=>$q->where('status',$data['status']))->when(isset($data['search']),fn($q)=>$q->where('stem','like','%'.$data['search'].'%'));
        if (! isset($data['status'])) $query->where('status','approved');
        $query->orderBy($data['sort'] ?? 'created_at',$data['direction'] ?? 'desc');
        return QuestionResource::collection($query->paginate($data['per_page'] ?? 25)->withQueryString())->response();
    }

    public function store(CreateQuestionRequest $request, CreateQuestionAction $action): JsonResponse
    {
        $data=$request->validated();
        $question=$action->execute($request->user(),new CreateQuestionData((int)$data['subject_id'],isset($data['topic_id'])?(int)$data['topic_id']:null,QuestionType::from($data['type']),QuestionDifficulty::from($data['difficulty']),$data['stem'],$data['explanation']??null,(float)$data['points'],(float)($data['negative_marks']??0),$data['metadata']??[]));
        return (new QuestionResource($question))->response()->setStatusCode(201);
    }
}

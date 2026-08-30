<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Controllers\Api\V1;

use App\Domains\QuestionBank\Actions\CreateQuestionTagAction;
use App\Domains\QuestionBank\Models\QuestionTag;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class QuestionTagController extends Controller
{
    public function index(): JsonResponse { return response()->json(['data'=>QuestionTag::query()->orderBy('name')->paginate(100)]); }
    public function store(Request $request, CreateQuestionTagAction $action): JsonResponse { $data=$request->validate(['name'=>['required','string','max:100']]); return response()->json(['data'=>$action->execute($data['name'])],201); }
}

<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Enums\QuestionStatus;
use App\Domains\QuestionBank\Models\Question;
use Illuminate\Database\DatabaseManager;
use Illuminate\Validation\ValidationException;

final class UpdateQuestionAction
{
    public function __construct(private readonly DatabaseManager $db) {}
    public function execute(User $actor, Question $question, array $data): Question
    {
        if ($question->author_id !== $actor->id && ! $actor->can('questions.update')) throw ValidationException::withMessages(['question'=>'You are not allowed to update this question.']);
        if ($question->status === QuestionStatus::Approved) throw ValidationException::withMessages(['question'=>'Approved questions require a new revision workflow.']);
        return $this->db->transaction(function () use ($actor,$question,$data): Question {
            $question->update(array_intersect_key($data, array_flip(['subject_id','topic_id','type','difficulty','bloom_level','stem','explanation','points','negative_marks','metadata','source_type','source_reference'])));
            $question->increment('version');
            $question->versions()->create(['version'=>$question->version,'stem'=>$question->stem,'explanation'=>$question->explanation,'snapshot'=>$question->fresh()->toArray(),'created_by'=>$actor->id]);
            return $question->fresh();
        });
    }
}

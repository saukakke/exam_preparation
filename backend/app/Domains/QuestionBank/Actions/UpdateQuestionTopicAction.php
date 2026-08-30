<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\QuestionBank\Models\QuestionTopic;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final class UpdateQuestionTopicAction
{
    public function execute(QuestionTopic $topic, array $data): QuestionTopic
    {
        if (isset($data['parent_id']) && (int)$data['parent_id'] === $topic->id) throw ValidationException::withMessages(['parent_id'=>'A topic cannot be its own parent.']);
        if (isset($data['name']) && ! isset($data['slug'])) $data['slug'] = Str::slug($data['name']);
        $topic->update($data);
        return $topic->fresh();
    }
}

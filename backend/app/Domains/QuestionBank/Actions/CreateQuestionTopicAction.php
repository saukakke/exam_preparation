<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\QuestionBank\Models\QuestionTopic;
use Illuminate\Support\Str;

final class CreateQuestionTopicAction
{
    public function execute(array $data): QuestionTopic
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        return QuestionTopic::query()->create($data);
    }
}

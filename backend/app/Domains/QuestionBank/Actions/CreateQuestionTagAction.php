<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Actions;

use App\Domains\QuestionBank\Models\QuestionTag;
use Illuminate\Support\Str;

final class CreateQuestionTagAction
{
    public function execute(string $name): QuestionTag { return QuestionTag::query()->firstOrCreate(['slug'=>Str::slug($name)], ['name'=>trim($name)]); }
}

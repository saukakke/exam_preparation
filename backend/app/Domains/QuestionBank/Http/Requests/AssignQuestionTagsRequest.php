<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AssignQuestionTagsRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['tag_ids'=>['required','array','max:50'],'tag_ids.*'=>['integer','distinct','exists:question_tags,id']]; }
}

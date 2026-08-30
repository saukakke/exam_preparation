<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class DeleteQuestionTopicRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return []; }
}

<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ReviewQuestionRequest extends FormRequest
{
    public function authorize(): bool { return $this->user()?->can('questions.approve') === true; }
    public function rules(): array { return ['comment'=>['required_if:action,reject','nullable','string','max:5000'],'action'=>['required','in:approve,reject']]; }
}

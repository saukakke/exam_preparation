<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateQuestionTopicRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['parent_id'=>['sometimes','nullable','integer','exists:question_topics,id'],'name'=>['sometimes','string','max:150'],'slug'=>['sometimes','string','max:180','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],'description'=>['sometimes','nullable','string','max:10000']]; }
}

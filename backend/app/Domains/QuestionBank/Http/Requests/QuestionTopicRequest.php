<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class QuestionTopicRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['subject_id'=>['required','integer','exists:subjects,id'],'parent_id'=>['nullable','integer','exists:question_topics,id'],'name'=>['required','string','max:150'],'slug'=>['nullable','string','max:180','regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],'description'=>['nullable','string','max:10000']]; }
}

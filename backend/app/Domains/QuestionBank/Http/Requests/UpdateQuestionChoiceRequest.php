<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateQuestionChoiceRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['content'=>['sometimes','string','max:20000'],'is_correct'=>['sometimes','boolean'],'position'=>['sometimes','integer','min:1','max:100'],'metadata'=>['sometimes','nullable','array']]; }
}

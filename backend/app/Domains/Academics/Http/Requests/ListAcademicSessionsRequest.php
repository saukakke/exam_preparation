<?php

declare(strict_types=1);

namespace App\Domains\Academics\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ListAcademicSessionsRequest extends FormRequest
{
    public function authorize(): bool { return $this->user() !== null; }
    public function rules(): array { return ['organization_id'=>['required','integer','exists:organizations,id'],'per_page'=>['sometimes','integer','min:1','max:100']]; }
}

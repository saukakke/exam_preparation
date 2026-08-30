<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class QuestionTag extends Model
{
    protected $fillable = ['name','slug'];
    public function questions(): BelongsToMany { return $this->belongsToMany(Question::class, 'question_question_tag'); }
}

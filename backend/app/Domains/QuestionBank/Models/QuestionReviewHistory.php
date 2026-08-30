<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Models;

use App\Domains\Identity\Models\User;
use App\Domains\QuestionBank\Enums\QuestionReviewAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class QuestionReviewHistory extends Model
{
    protected $fillable = ['question_id','reviewer_id','action','comment','metadata'];
    protected function casts(): array { return ['action'=>QuestionReviewAction::class,'metadata'=>'array']; }
    public function question(): BelongsTo { return $this->belongsTo(Question::class); }
    public function reviewer(): BelongsTo { return $this->belongsTo(User::class, 'reviewer_id'); }
}

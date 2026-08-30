<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class QuestionChoice extends Model
{
    protected $fillable = ['question_id','content','is_correct','position','metadata'];
    protected function casts(): array { return ['is_correct'=>'boolean','position'=>'integer','metadata'=>'array']; }
    public function question(): BelongsTo { return $this->belongsTo(Question::class); }
}

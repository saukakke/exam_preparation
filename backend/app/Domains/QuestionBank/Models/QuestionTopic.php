<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class QuestionTopic extends Model
{
    protected $table = 'question_topics';
    protected $fillable = ['subject_id','parent_id','name','slug','description'];
    public function parent(): BelongsTo { return $this->belongsTo(self::class, 'parent_id'); }
    public function children(): HasMany { return $this->hasMany(self::class, 'parent_id'); }
}

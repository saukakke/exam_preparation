<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Models;

use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class QuestionVersion extends Model
{
    protected $fillable = ['question_id','version','stem','explanation','snapshot','created_by'];
    protected function casts(): array { return ['snapshot'=>'array','version'=>'integer']; }
    public function question(): BelongsTo { return $this->belongsTo(Question::class); }
    public function creator(): BelongsTo { return $this->belongsTo(User::class, 'created_by'); }
}

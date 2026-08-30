<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Models;

use App\Domains\QuestionBank\Enums\BloomLevel;
use App\Domains\QuestionBank\Enums\QuestionDifficulty;
use App\Domains\QuestionBank\Enums\QuestionStatus;
use App\Domains\QuestionBank\Enums\QuestionType;
use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Question extends Model
{
    protected $fillable = ['organization_id','subject_id','topic_id','author_id','type','difficulty','bloom_level','status','stem','explanation','points','negative_marks','metadata','version','source_type','source_reference'];
    protected function casts(): array { return ['type'=>QuestionType::class,'difficulty'=>QuestionDifficulty::class,'bloom_level'=>BloomLevel::class,'status'=>QuestionStatus::class,'metadata'=>'array','points'=>'decimal:2','negative_marks'=>'decimal:2']; }
    public function author(): BelongsTo { return $this->belongsTo(User::class, 'author_id'); }
    public function choices(): HasMany { return $this->hasMany(QuestionChoice::class); }
    public function versions(): HasMany { return $this->hasMany(QuestionVersion::class); }
    public function tags(): BelongsToMany { return $this->belongsToMany(QuestionTag::class, 'question_question_tag'); }
}

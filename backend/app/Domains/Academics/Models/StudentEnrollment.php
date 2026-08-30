<?php

declare(strict_types=1);

namespace App\Domains\Academics\Models;

use App\Domains\Academics\Enums\EnrollmentStatus;
use App\Domains\Identity\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class StudentEnrollment extends Model
{
    protected $fillable = ['organization_id','academic_session_id','student_id','class_id','status','enrolled_at'];
    protected function casts(): array { return ['status'=>EnrollmentStatus::class,'enrolled_at'=>'datetime']; }
    public function organization(): BelongsTo { return $this->belongsTo(\App\Domains\Organizations\Models\Organization::class); }
    public function session(): BelongsTo { return $this->belongsTo(AcademicSession::class, 'academic_session_id'); }
    public function student(): BelongsTo { return $this->belongsTo(User::class, 'student_id'); }
    public function class(): BelongsTo { return $this->belongsTo(AcademicClass::class, 'class_id'); }
}

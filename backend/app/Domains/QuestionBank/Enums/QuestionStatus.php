<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Enums;

enum QuestionStatus: string
{
    case Draft = 'draft';
    case InReview = 'in_review';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Archived = 'archived';
}

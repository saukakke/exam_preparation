<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Enums;

enum QuestionReviewAction: string
{
    case Submitted = 'submitted';
    case Approved = 'approved';
    case Rejected = 'rejected';
}

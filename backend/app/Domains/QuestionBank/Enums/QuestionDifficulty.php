<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Enums;

enum QuestionDifficulty: string
{
    case VeryEasy = 'very_easy';
    case Easy = 'easy';
    case Medium = 'medium';
    case Hard = 'hard';
    case VeryHard = 'very_hard';
}

<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Enums;

enum BloomLevel: string
{
    case Remember = 'remember';
    case Understand = 'understand';
    case Apply = 'apply';
    case Analyze = 'analyze';
    case Evaluate = 'evaluate';
    case Create = 'create';
}

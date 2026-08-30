<?php

declare(strict_types=1);

namespace App\Domains\QuestionBank\Enums;

enum QuestionType: string
{
    case MultipleChoice = 'multiple_choice';
    case TrueFalse = 'true_false';
    case Essay = 'essay';
    case FillBlank = 'fill_blank';
    case Matching = 'matching';
    case Ordering = 'ordering';
    case DragDrop = 'drag_drop';
    case Coding = 'coding';
    case Diagram = 'diagram';
    case ImageBased = 'image_based';
    case Audio = 'audio';
    case Video = 'video';
    case Hotspot = 'hotspot';
}

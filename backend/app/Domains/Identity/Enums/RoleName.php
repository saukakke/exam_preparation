<?php

declare(strict_types=1);

namespace App\Domains\Identity\Enums;

enum RoleName: string
{
    case SuperAdmin = 'Super Admin';
    case OrganizationOwner = 'Organization Owner';
    case SchoolAdministrator = 'School Administrator';
    case Teacher = 'Teacher';
    case ExamCoordinator = 'Exam Coordinator';
    case QuestionModerator = 'Question Moderator';
    case Student = 'Student';
    case Parent = 'Parent';
    case SupportStaff = 'Support Staff';
    case ContentReviewer = 'Content Reviewer';
    case FinanceOfficer = 'Finance Officer';
}

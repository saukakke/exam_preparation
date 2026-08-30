# Database Architecture

Core identity tables are globally scoped. Tenant resources reference organizations.

Migration order: Identity, Organizations, Memberships, Academics, Question Bank, Examinations, Attempts, Results, Learning, Billing, Analytics.
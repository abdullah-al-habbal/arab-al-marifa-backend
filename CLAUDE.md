# CLAUDE.md — LMS Platform: Project Intelligence File

> **Purpose:** This file is the single source of truth for AI-assisted development on this project.
> Every session must start by reading this file. Every architectural decision made here is final
> unless explicitly superseded by a signed ADR (Architecture Decision Record).

---

## 1. Project Identity

| Field | Value |
|---|---|
| **Project Name** | EduCore LMS |
| **Type** | Learning Management System (Video-on-Demand + Assessment + Library) |
| **Client Context** | Private training center, Syria |
| **Document Ref** | SRD-LMS-003 |
| **Version** | 1.0.0 |
| **Stack Decision** | Platinum Package — Flutter (mobile + desktop) + Laravel 13 + Filament |

---

## 2. System Goal

Build a modular, multi-client LMS platform that serves pre-recorded educational video content
across a deep educational hierarchy. The system must support:

- Bandwidth-aware video delivery (multiple quality tracks per lesson)
- Flexible polymorphic subscription model (manual, admin-activated)
- Lesson-scoped student–teacher communication channels
- A polymorphic question bank driving randomly-generated assessments
- Hard progression gates (quiz-pass required before unlocking next lesson)
- Content DRM enforced at the native app layer (Flutter screen-capture prevention)

---

## 3. Client Applications

| Client | Technology | Platforms | Auth Token |
|---|---|---|---|
| **TeacherApp** | Flutter | Android, iOS | Bearer JWT |
| **StudentApp** | Flutter | Android, iOS | Bearer JWT |
| **StudentDesktop** | Flutter | Windows, macOS | Bearer JWT |
| **Website** | React (SPA) | Browser | Bearer JWT |
| **AdminPanel** | Filament v3 | Browser (web-only) | Session + Sanctum |

> All clients communicate exclusively through versioned REST APIs (`/api/v1/...`).
> Filament operates inside the Laravel process (not via API).

---

## 4. Technology Stack

### Backend
| Layer | Technology |
|---|---|
| Framework | Laravel 13 |
| PHP Version | PHP 8.3+ |
| Database | MySQL 8.0+ |
| Auth | Laravel Sanctum (API tokens) |
| Admin Panel | Filament v3 |
| File Storage | Laravel Storage (local / S3-compatible) |
| Queue | Laravel Queues (database driver → Redis in production) |
| Cache | Redis |
| API Style | RESTful, versioned (`/api/v1/`) |
| Validation | Laravel Form Requests (per client per module) |

### Frontend Clients
| Client | Framework | State Management |
|---|---|---|
| TeacherApp | Flutter | Riverpod / BLoC |
| StudentApp | Flutter | Riverpod / BLoC |
| StudentDesktop | Flutter | Riverpod / BLoC |
| Website | React 18 | React Query + Zustand |

---

## 5. Backend Architecture Philosophy

### 5.1 Modular Structure

The backend is **feature-based modular**. Every domain entity lives in its own module
under `modules/` in the project root. The PSR-4 namespace root for all modules is
`Modules\` and must be registered in `composer.json`.

```json
// composer.json (partial)
{
  "autoload": {
    "psr-4": {
      "App\\": "app/",
      "Modules\\": "modules/"
    }
  }
}
```

### 5.2 The Action → Handler → Resolver Pattern

> **No Services. No Repositories. Only Actions, Handlers, and Resolvers.**

This is the core architectural rule. Violating it requires a team ADR.

| Layer | Responsibility | Rule |
|---|---|---|
| **Action** | HTTP entry point (controller equivalent) | One Action per HTTP endpoint. May inject multiple Handlers. |
| **Handler** | Business logic orchestration | One Handler per use-case. May inject multiple Resolvers. |
| **Resolver** | Eloquent data access layer | Must inject **only one Model**. All Eloquent operations live here exclusively. |

**Dependency flow:**
```
HTTP Request → Action → Handler(s) → Resolver(s) → Model → Database
```

**Rules enforced:**
- Eloquent must **never** appear in an Action or Handler.
- Business logic must **never** appear in a Resolver.
- HTTP concerns (Request, Response, status codes) must **never** appear in a Handler or Resolver.
- A Resolver is not a Repository. It has no `findAll`, `findById` generics — it has
  semantically named methods: `findPublishedLessonsForSubject()`, `resolveActiveSubscription()`.

### 5.3 Client Segregation

Every module's HTTP and business layers are physically segregated by client context.
This prevents cross-client logic bleed and allows independent API evolution per client.

```
Modules/
└── {ModuleName}/
    ├── Http/
    │   ├── Actions/
    │   │   ├── TeacherApp/
    │   │   ├── StudentApp/
    │   │   ├── StudentDesktop/
    │   │   ├── Common/           ← shared across all API clients
    │   │   └── Website/
    │   └── Requests/
    │       ├── TeacherApp/
    │       ├── StudentApp/
    │       ├── StudentDesktop/
    │       ├── Common/
    │       └── Website/
    ├── Handlers/
    │   ├── TeacherApp/
    │   ├── StudentApp/
    │   ├── StudentDesktop/
    │   ├── Common/
    │   └── Website/
    ├── Eloquent/
    │   └── Resolvers/
    │       ├── TeacherApp/
    │       ├── StudentApp/
    │       ├── StudentDesktop/
    │       ├── Common/
    │       └── Website/
    ├── Filament/
    │   └── Panel/                ← Resources, Pages, Widgets
    ├── Models/
    ├── Events/
    ├── Listeners/
    ├── Policies/
    ├── Enums/
    ├── DTOs/                     ← Typed data transfer objects (no plain arrays)
    ├── routes/
    │   ├── teacher-app.php
    │   ├── student-app.php
    │   ├── student-desktop.php
    │   ├── common.php
    │   └── website.php
    └── Providers/
        └── {ModuleName}ServiceProvider.php
```

---

## 6. Domain Modules

The following modules are the canonical bounded contexts of the system.

| Module | Core Models | Priority |
|---|---|---|
| `Auth` | User, Student, Teacher | P0 |
| `Hierarchy` | EducationalStage, EducationalSubStage, CourseType | P0 |
| `Catalog` | Subject, SubjectCategory | P0 |
| `Content` | Unit, Lesson, VideoFile, LessonAttachment | P0 |
| `Subscription` | Subscription (polymorphic) | P0 |
| `Assessment` | QuestionBank, Question, QuestionOption, Exam, ExamAttempt | P1 |
| `Library` | LibraryItem (polymorphic) | P1 |
| `Communication` | ConversationChannel, Message, MessageAttachment | P2 |
| `CMS` | StaticPage | P2 |

---

## 7. Educational Hierarchy (Domain Model)

```
EducationalStage          (e.g., Secondary, Intermediate)
└── EducationalSubStage   (e.g., Scientific, Literary)
    └── CourseType        (e.g., Winter Course, Intensive, Exam Sessions)
        └── Subject       (e.g., Mathematics, Physics)
            └── SubjectCategory  (e.g., Algebra, Geometry)
                └── Unit  [via lesson tags — not a hard FK]
                    └── Lesson
                        ├── VideoFile[]   (low / medium / high quality)
                        ├── LessonAttachment  (PDF)
                        └── TeacherAssignment → Teacher
```

**Key design decisions:**
- `EducationalStage` and `EducationalSubStage` are **self-referential / abstract** — the stage
  model uses a `parent_id` nullable FK to itself (or a separate sub-stage model for clarity).
- `Unit` is implemented as a **tagging system** on Lessons, not a hard foreign key chain.
  This allows a Lesson to belong to one or more Units (classification tags) without rigid
  hierarchy coupling.
- `TeacherAssignment` is a pivot between `Teacher` and `Lesson` — a teacher owns specific
  lessons, not an entire subject.

---

## 8. Subscription System (Polymorphic)

Subscriptions use Laravel's polymorphic relations. A subscription record points to **any
subscribable entity** via `subscribable_type` + `subscribable_id`.

**Subscribable targets:**
- `Modules\Hierarchy\Models\EducationalStage`
- `Modules\Hierarchy\Models\EducationalSubStage`
- `Modules\Catalog\Models\Subject`
- `Modules\Catalog\Models\SubjectCategory`

**Access resolution logic** (evaluated in SubscriptionResolver):

```
Can student access Lesson L?
→ Student has active Subscription where subscribable covers L's hierarchy path
→ Path: Lesson → SubjectCategory → Subject → EducationalSubStage → EducationalStage
→ If any node in path has an active subscription = ACCESS GRANTED
```

**Subscription lifecycle:**
1. Student pays in person at the center.
2. Admin activates via Filament panel (sets `activated_at`, `expires_at`).
3. System checks `status = active AND expires_at > now()` on every content access.

---

## 9. Question Bank & Assessment System

### Question Bank
- Questions belong to a `Subject` + optionally scoped to specific `Lesson` IDs.
- Questions are tagged with `unit_tags[]` — the same tag taxonomy used on Lessons.
- Question types (v1): Single-choice MCQ only.

### Exam Generation
```
Admin/Teacher defines exam:
  - Subject ID (required)
  - Unit tags filter (optional)
  - Lesson IDs filter (optional)
  - Question count (required)
  → System random-selects N questions from matching bank entries
  → Exam is generated and linked to a progression trigger point
```

### Progression Gate
- An `ExamTrigger` record links an `Exam` to a `Lesson` (the lesson after which the exam appears).
- Student cannot unlock `Lesson[n+1]` while `ExamAttempt.status != passed` for the gate exam.
- Evaluated server-side on every lesson-unlock request — never client-only.

---

## 10. Communication System (Lesson-Scoped Channels)

- One `ConversationChannel` per `(student_id, teacher_id, lesson_id)` tuple. Unique constraint.
- Only the assigned Teacher of the Lesson may participate in channels for that lesson.
- Message types:

| Type | Text body | Attachment |
|---|---|---|
| `text` | required | not allowed |
| `voice` | not allowed | required (audio file) |
| `image` | optional (caption) | required (image file) |
| `video` | optional (caption) | required (video file) |

- Teacher authorization: `teacher_id` on the channel **must match** `lesson.teacher_assignment.teacher_id`.

---

## 11. Content Protection (Platinum Package)

| Platform | Mechanism |
|---|---|
| Android / iOS (Flutter) | `FLAG_SECURE` / `isSecureMode` — system-level screen capture block |
| Windows (Flutter Desktop) | `SetWindowDisplayAffinity(HANDLE, WDA_EXCLUDEFROMCAPTURE)` via FFI |
| macOS (Flutter Desktop) | `NSWindow.sharingType = .none` via method channel |
| Video URLs | Signed temporary URLs (S3-presigned or Laravel `temporaryUrl()`, 15-min expiry) |
| PDF Viewer | In-app renderer only — no system share sheet, no download button exposed |

---

## 12. API Design Standards

- **Base URL:** `https://api.educore.sy/api/v1/`
- **Versioning:** URI versioning (`/v1/`, `/v2/`)
- **Auth header:** `Authorization: Bearer {token}`
- **Response envelope:**

```json
{
  "success": true,
  "data": {},
  "message": "Resource retrieved successfully.",
  "meta": {
    "pagination": {}
  }
}
```

- **Error envelope:**

```json
{
  "success": false,
  "error": {
    "code": "SUBSCRIPTION_REQUIRED",
    "message": "Your subscription does not cover this resource.",
    "details": {}
  }
}
```

- **HTTP Status codes used:**
  - `200 OK` — successful read
  - `201 Created` — successful creation
  - `204 No Content` — successful deletion
  - `400 Bad Request` — validation failure (with field errors)
  - `401 Unauthorized` — missing or invalid token
  - `403 Forbidden` — authenticated but not authorized
  - `404 Not Found` — resource does not exist
  - `422 Unprocessable Entity` — domain rule violation
  - `500 Internal Server Error` — unhandled exception

---

## 13. Security Rules

- JWT via Laravel Sanctum (token-based, not session for API clients).
- Role-based access: `admin`, `teacher`, `student` — enforced via `Policy` classes per model.
- All routes behind `auth:sanctum` middleware. Public routes: `POST /auth/login` only.
- Signed video URLs rotate every 15 minutes. Client must re-fetch on `403`.
- Input validation via `FormRequest` classes — no validation in Actions directly.
- Rate limiting: `60 req/min` general, `10 req/min` for auth endpoints.

---

## 14. Database Standards

- All tables use `unsigned bigint` PKs named `id`.
- All timestamps: `created_at`, `updated_at` (standard Laravel).
- Soft deletes on: User, Lesson, Subject, Subscription.
- All polymorphic columns follow the `{relation}_type` / `{relation}_id` naming convention.
- Migrations are the single source of schema truth — no manual DB changes.
- Indexes required on: all FK columns, all polymorphic pairs, `status` columns used in WHERE filters.

---

## 15. Code Style Enforcement

- PHP: PSR-12 + Laravel Pint (enforced in CI).
- No `mixed`, no untyped properties, no `array` without type hints — use DTOs.
- All public methods must have full type signatures (parameter + return types).
- Strict types declared in every PHP file: `declare(strict_types=1);`
- No business logic in migrations, seeders, or Filament resource files.

---

## 16. Module Naming Convention (File examples)

```
# Action (HTTP layer — one per endpoint)
Modules/Lesson/Http/Actions/StudentApp/ShowLessonAction.php
Modules/Lesson/Http/Actions/TeacherApp/ListAssignedLessonsAction.php

# Request (validation layer)
Modules/Lesson/Http/Requests/StudentApp/ShowLessonRequest.php

# Handler (business logic)
Modules/Lesson/Handlers/StudentApp/FetchLessonForStudentHandler.php

# Resolver (Eloquent layer — injects ONE model)
Modules/Lesson/Eloquent/Resolvers/StudentApp/LessonResolver.php

# Filament
Modules/Lesson/Filament/Panel/LessonResource.php
Modules/Lesson/Filament/Panel/Pages/ManageLessonVideos.php

# Model
Modules/Lesson/Models/Lesson.php
Modules/Lesson/Models/VideoFile.php
```

---

## 17. Development Workflow

- **Branching:** `main` → `develop` → `feature/{module}-{task}` → PR → `develop`
- **Commits:** Conventional Commits (`feat:`, `fix:`, `refactor:`, `chore:`, `docs:`)
- **PR requirement:** All PRs must pass: Pint, PHPStan level 8, feature tests.
- **Migrations:** Never edit existing migrations. Always add new migrations.
- **Seeding:** `DatabaseSeeder` calls module seeders. Each module has its own `{Module}Seeder`.

---

## 18. Build Sequence (Phase Order)

Implement modules in this order to respect dependency chains:

```
Phase 1 (Foundation):
  Auth → Hierarchy → Catalog → Content (Lesson + Video)

Phase 2 (Transactional):
  Subscription → Library → Assessment (QuestionBank + Exam)

Phase 3 (Communication + CMS):
  Communication → StaticPage (CMS)

Phase 4 (Admin Panel):
  Filament resources for all Phase 1–3 modules

Phase 5 (Client APIs):
  TeacherApp APIs → StudentApp APIs → StudentDesktop APIs → Website APIs
```

---

## 19. Key Architectural Constraints (Non-negotiable)

1. **No Service classes.** Use Handlers. Handlers are use-case scoped, Services are not.
2. **No Repository classes.** Use Resolvers. Resolvers are model-scoped and Eloquent-exclusive.
3. **One model per Resolver.** A Resolver injecting two models is a design error.
4. **One endpoint per Action.** Actions are not controllers with multiple methods.
5. **Client folders are mandatory.** Even if TeacherApp and StudentApp share 90% logic,
   they get separate files. Shared logic lives in `Common/`.
6. **No raw SQL.** All queries through Eloquent in Resolvers.
7. **No `array` DTOs.** All data transfer between layers uses typed DTO classes.

---

*This file is maintained by the lead architect. Last updated: 2026-05-23.*
*Next file to read: `docs/SRD.md` for full domain requirements.*

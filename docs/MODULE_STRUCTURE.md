# docs/MODULE_STRUCTURE.md
# EduCore LMS — Module Structure & Class Scaffolding Guide

| Field | Value |
|---|---|
| **Document Ref** | DEV-LMS-001 |
| **Version** | 1.0.0 |
| **Relates to** | `CLAUDE.md` §5, `SRD.md` §4 |
| **Purpose** | Canonical file layout, class names, and namespace map for every module |

> **Reading order:** Read `CLAUDE.md` first, then `SRD.md`, then this file.
> This document is the direct input for scaffolding. Every class listed here must exist
> before the module is considered "structured". Implementation comes after structure.

---

## Table of Contents

1. [Composer Namespace Registration](#1-composer-namespace-registration)
2. [Module Root Conventions](#2-module-root-conventions)
3. [Base Classes & Interfaces](#3-base-classes--interfaces)
4. [Module: Auth](#4-module-auth)
5. [Module: Hierarchy](#5-module-hierarchy)
6. [Module: Catalog](#6-module-catalog)
7. [Module: Content](#7-module-content)
8. [Module: Subscription](#8-module-subscription)
9. [Module: Assessment](#9-module-assessment)
10. [Module: Library](#10-module-library)
11. [Module: Communication](#11-module-communication)
12. [Module: CMS](#12-module-cms)
13. [Route File Registration](#13-route-file-registration)
14. [Service Provider Registration](#14-service-provider-registration)
15. [Naming Cheat-Sheet](#15-naming-cheat-sheet)

---

## 1. Composer Namespace Registration

Add the `Modules\\` PSR-4 root to `composer.json` alongside the default `App\\` entry.
Run `composer dump-autoload` after any new module is created.

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "modules/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    }
}
```

**Project root layout after this change:**

```
educore-lms/
├── app/                        ← Laravel core (kept minimal)
│   ├── Http/
│   │   └── Middleware/         ← Global middleware only
│   ├── Exceptions/
│   │   └── Handler.php
│   └── Providers/
│       └── AppServiceProvider.php  ← Registers all ModuleServiceProviders
│
├── modules/                    ← All feature modules live here
│   ├── Auth/
│   ├── Hierarchy/
│   ├── Catalog/
│   ├── Content/
│   ├── Subscription/
│   ├── Assessment/
│   ├── Library/
│   ├── Communication/
│   └── CMS/
│
├── bootstrap/
├── config/
├── database/
│   └── migrations/             ← All migrations centralised here
├── routes/
│   └── api.php                 ← Imports module route files
├── storage/
├── tests/
│   ├── Unit/
│   └── Feature/
│       └── Modules/            ← Mirror of modules/ structure
└── composer.json
```

---

## 2. Module Root Conventions

Every module follows this **identical internal layout**. Folders are created even if
initially empty — they signal intent and prevent future structural drift.

```
modules/{ModuleName}/
│
├── DTOs/                           ← Typed data transfer objects (no plain arrays)
├── Enums/                          ← PHP 8.1+ backed enums
├── Events/                         ← Domain events
├── Listeners/                      ← Event listeners
├── Policies/                       ← Laravel Gate policies (one per model)
│
├── Models/                         ← Eloquent models
│
├── Http/
│   ├── Actions/                    ← One class per endpoint (replaces controllers)
│   │   ├── TeacherApp/
│   │   ├── StudentApp/
│   │   ├── StudentDesktop/
│   │   ├── Common/                 ← Shared across API clients
│   │   └── Website/
│   └── Requests/                   ← FormRequest validation classes
│       ├── TeacherApp/
│       ├── StudentApp/
│       ├── StudentDesktop/
│       ├── Common/
│       └── Website/
│
├── Handlers/                       ← Business logic (one class per use-case)
│   ├── TeacherApp/
│   ├── StudentApp/
│   ├── StudentDesktop/
│   ├── Common/
│   └── Website/
│
├── Eloquent/
│   └── Resolvers/                  ← Eloquent operations (one class per model)
│       ├── TeacherApp/
│       ├── StudentApp/
│       ├── StudentDesktop/
│       ├── Common/
│       └── Website/
│
├── Filament/
│   └── Panel/                      ← Filament Resources, Pages, Widgets
│
├── routes/
│   ├── teacher-app.php
│   ├── student-app.php
│   ├── student-desktop.php
│   ├── common.php
│   └── website.php
│
└── Providers/
    └── {ModuleName}ServiceProvider.php
```

### 2.1 Namespace Pattern

```
Modules\{ModuleName}\{Layer}\{ClientContext}\{ClassName}
```

Examples:
```
Modules\Content\Http\Actions\StudentApp\ShowLessonAction
Modules\Content\Handlers\StudentApp\FetchLessonForStudentHandler
Modules\Content\Eloquent\Resolvers\Common\LessonResolver
Modules\Content\Models\Lesson
Modules\Content\Filament\Panel\LessonResource
```

### 2.2 Class Suffix Rules

| Layer | Suffix | Example |
|---|---|---|
| Action | `Action` | `ShowLessonAction` |
| FormRequest | `Request` | `ShowLessonRequest` |
| Handler | `Handler` | `FetchLessonForStudentHandler` |
| Resolver | `Resolver` | `LessonResolver` |
| Model | *(none)* | `Lesson` |
| DTO | `Data` | `LessonData` |
| Enum | *(none)* | `VideoQuality` |
| Event | `Event` | `SubscriptionActivatedEvent` |
| Listener | `Listener` | `SendSubscriptionConfirmationListener` |
| Policy | `Policy` | `LessonPolicy` |
| Filament Resource | `Resource` | `LessonResource` |

---

## 3. Base Classes & Interfaces

Place these in `app/` — they are framework-level contracts, not module-level.

### 3.1 Base Action

```
app/Http/Actions/BaseAction.php
Namespace: App\Http\Actions
```

```php
<?php

declare(strict_types=1);

namespace App\Http\Actions;

use Illuminate\Http\JsonResponse;

abstract class BaseAction
{
    protected function success(
        mixed $data = null,
        string $message = 'OK',
        int $status = 200,
        array $meta = [],
    ): JsonResponse {
        $payload = ['success' => true, 'message' => $message];

        if ($data !== null) {
            $payload['data'] = $data;
        }

        if (! empty($meta)) {
            $payload['meta'] = $meta;
        }

        return response()->json($payload, $status);
    }

    protected function created(mixed $data, string $message = 'Created.'): JsonResponse
    {
        return $this->success($data, $message, 201);
    }

    protected function noContent(): JsonResponse
    {
        return response()->json(null, 204);
    }
}
```

### 3.2 Base Handler

```
app/Handlers/BaseHandler.php
Namespace: App\Handlers
```

```php
<?php

declare(strict_types=1);

namespace App\Handlers;

// Handlers contain business logic only.
// They must never import Request, Response, or JsonResponse.
// They receive DTOs and return DTOs or primitives.
abstract class BaseHandler {}
```

### 3.3 Base Resolver

```
app/Eloquent/Resolvers/BaseResolver.php
Namespace: App\Eloquent\Resolvers
```

```php
<?php

declare(strict_types=1);

namespace App\Eloquent\Resolvers;

use Illuminate\Database\Eloquent\Model;

// Resolvers wrap Eloquent operations for a single model.
// They must never contain business logic or HTTP concerns.
abstract class BaseResolver
{
    abstract protected function model(): Model;
}
```

### 3.4 Base DTO

```
app/DTOs/BaseData.php
Namespace: App\DTOs
```

```php
<?php

declare(strict_types=1);

namespace App\DTOs;

abstract class BaseData
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
```

---

## 4. Module: Auth

**Namespace root:** `Modules\Auth`
**Depends on:** nothing (foundation module)

```
modules/Auth/
│
├── DTOs/
│   ├── LoginData.php
│   └── AuthenticatedUserData.php
│
├── Enums/
│   ├── UserRole.php               ← enum UserRole: string { Admin='admin'; Teacher='teacher'; Student='student'; }
│   └── UserStatus.php             ← enum UserStatus: string { Active='active'; Suspended='suspended'; }
│
├── Models/
│   ├── User.php
│   ├── Student.php
│   └── Teacher.php
│
├── Policies/
│   └── UserPolicy.php
│
├── Http/
│   ├── Actions/
│   │   └── Common/
│   │       ├── LoginAction.php           ← POST /api/v1/auth/login
│   │       ├── LogoutAction.php          ← POST /api/v1/auth/logout
│   │       └── MeAction.php              ← GET  /api/v1/auth/me
│   └── Requests/
│       └── Common/
│           └── LoginRequest.php
│
├── Handlers/
│   └── Common/
│       ├── AuthenticateUserHandler.php
│       └── RevokeUserTokenHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       └── Common/
│           ├── UserResolver.php
│           ├── StudentResolver.php
│           └── TeacherResolver.php
│
├── Filament/
│   └── Panel/
│       ├── UserResource.php
│       ├── StudentResource.php
│       └── TeacherResource.php
│
├── routes/
│   └── common.php
│
└── Providers/
    └── AuthServiceProvider.php
```

### 4.1 Key Class Contracts

**`LoginAction`** injects `LoginRequest` + `AuthenticateUserHandler`. Returns token.

**`AuthenticateUserHandler`** injects `UserResolver`. Verifies credentials, creates
Sanctum token, returns `AuthenticatedUserData`.

**`UserResolver`** injects `User` model. Methods:
- `findByPhone(string $phone): ?User`
- `findByIdWithRole(int $id): ?User`

**`StudentResolver`** injects `Student` model. Methods:
- `findByUserId(int $userId): ?Student`
- `findWithSubscriptions(int $studentId): Student`

---

## 5. Module: Hierarchy

**Namespace root:** `Modules\Hierarchy`
**Depends on:** `Auth`

```
modules/Hierarchy/
│
├── DTOs/
│   ├── EducationalStageData.php
│   ├── EducationalSubStageData.php
│   └── CourseTypeData.php
│
├── Enums/
│   └── (none in v1)
│
├── Models/
│   ├── EducationalStage.php
│   ├── EducationalSubStage.php
│   └── CourseType.php
│
├── Policies/
│   ├── EducationalStagePolicy.php
│   ├── EducationalSubStagePolicy.php
│   └── CourseTypePolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── Common/
│   │   │   ├── ListEducationalStagesAction.php      ← GET  /api/v1/stages
│   │   │   ├── ShowEducationalStageAction.php       ← GET  /api/v1/stages/{id}
│   │   │   ├── ListSubStagesAction.php              ← GET  /api/v1/stages/{id}/sub-stages
│   │   │   ├── ShowSubStageAction.php               ← GET  /api/v1/sub-stages/{id}
│   │   │   ├── ListCourseTypesAction.php            ← GET  /api/v1/sub-stages/{id}/course-types
│   │   │   └── ShowCourseTypeAction.php             ← GET  /api/v1/course-types/{id}
│   │   └── (no client-specific actions — hierarchy is read-only for all clients)
│   └── Requests/
│       └── Common/
│           ├── ListEducationalStagesRequest.php
│           └── ListSubStagesRequest.php
│
├── Handlers/
│   └── Common/
│       ├── FetchStagesHandler.php
│       ├── FetchSubStagesForStageHandler.php
│       └── FetchCourseTypesForSubStageHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       └── Common/
│           ├── EducationalStageResolver.php
│           ├── EducationalSubStageResolver.php
│           └── CourseTypeResolver.php
│
├── Filament/
│   └── Panel/
│       ├── EducationalStageResource.php
│       ├── EducationalSubStageResource.php
│       └── CourseTypeResource.php
│
├── routes/
│   ├── common.php
│   └── (no client-specific route files needed)
│
└── Providers/
    └── HierarchyServiceProvider.php
```

### 5.1 Key Resolver Contracts

**`EducationalStageResolver`** injects `EducationalStage` model. Methods:
- `listActive(): Collection`
- `findWithSubStages(int $id): EducationalStage`

**`EducationalSubStageResolver`** injects `EducationalSubStage` model. Methods:
- `listActiveForStage(int $stageId): Collection`
- `findWithCourseTypes(int $id): EducationalSubStage`

**`CourseTypeResolver`** injects `CourseType` model. Methods:
- `listActiveForSubStage(int $subStageId): Collection`
- `findWithSubjects(int $id): CourseType`

---

## 6. Module: Catalog

**Namespace root:** `Modules\Catalog`
**Depends on:** `Auth`, `Hierarchy`

```
modules/Catalog/
│
├── DTOs/
│   ├── SubjectData.php
│   └── SubjectCategoryData.php
│
├── Models/
│   ├── Subject.php
│   └── SubjectCategory.php
│
├── Policies/
│   ├── SubjectPolicy.php
│   └── SubjectCategoryPolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── Common/
│   │   │   ├── ListSubjectsAction.php               ← GET /api/v1/subjects
│   │   │   ├── ShowSubjectAction.php                ← GET /api/v1/subjects/{id}
│   │   │   ├── ListSubjectCategoriesAction.php      ← GET /api/v1/subjects/{id}/categories
│   │   │   └── ShowSubjectCategoryAction.php        ← GET /api/v1/subject-categories/{id}
│   │   ├── StudentApp/
│   │   │   └── ListSubscribedSubjectsAction.php     ← GET /api/v1/student/subjects (with sub state)
│   │   ├── StudentDesktop/
│   │   │   └── ListSubscribedSubjectsAction.php     ← mirrors StudentApp
│   │   ├── Website/
│   │   │   └── ListSubscribedSubjectsAction.php     ← mirrors StudentApp
│   │   └── TeacherApp/
│   │       └── ListAssignedSubjectsAction.php       ← GET /api/v1/teacher/subjects
│   └── Requests/
│       ├── Common/
│       │   └── ListSubjectsRequest.php
│       ├── StudentApp/
│       │   └── ListSubscribedSubjectsRequest.php
│       ├── StudentDesktop/
│       │   └── ListSubscribedSubjectsRequest.php
│       ├── Website/
│       │   └── ListSubscribedSubjectsRequest.php
│       └── TeacherApp/
│           └── ListAssignedSubjectsRequest.php
│
├── Handlers/
│   ├── Common/
│   │   ├── FetchSubjectsHandler.php
│   │   └── FetchSubjectCategoriesHandler.php
│   ├── StudentApp/
│   │   └── FetchSubscribedSubjectsHandler.php
│   ├── StudentDesktop/
│   │   └── FetchSubscribedSubjectsHandler.php
│   ├── Website/
│   │   └── FetchSubscribedSubjectsHandler.php
│   └── TeacherApp/
│       └── FetchAssignedSubjectsForTeacherHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       ├── Common/
│       │   ├── SubjectResolver.php
│       │   └── SubjectCategoryResolver.php
│       ├── StudentApp/
│       │   └── SubjectResolver.php          ← extends Common, adds subscription state
│       ├── StudentDesktop/
│       │   └── SubjectResolver.php
│       ├── Website/
│       │   └── SubjectResolver.php
│       └── TeacherApp/
│           └── SubjectResolver.php          ← filters by teacher lesson assignments
│
├── Filament/
│   └── Panel/
│       ├── SubjectResource.php
│       └── SubjectCategoryResource.php
│
├── routes/
│   ├── common.php
│   ├── student-app.php
│   ├── student-desktop.php
│   ├── website.php
│   └── teacher-app.php
│
└── Providers/
    └── CatalogServiceProvider.php
```

---

## 7. Module: Content

**Namespace root:** `Modules\Content`
**Depends on:** `Auth`, `Hierarchy`, `Catalog`, `Subscription`

This is the largest module. Every client has meaningfully different access semantics.

```
modules/Content/
│
├── DTOs/
│   ├── LessonData.php
│   ├── LessonListItemData.php       ← Lightweight for list views (no video URLs)
│   ├── VideoFileData.php
│   ├── LessonAttachmentData.php
│   ├── SignedUrlData.php            ← Wraps {url, expires_at}
│   └── TeacherAssignmentData.php
│
├── Enums/
│   └── VideoQuality.php             ← enum VideoQuality: string { Low='low'; Medium='medium'; High='high'; }
│
├── Models/
│   ├── Lesson.php
│   ├── VideoFile.php
│   ├── LessonAttachment.php
│   └── LessonTeacherAssignment.php
│
├── Policies/
│   ├── LessonPolicy.php
│   ├── VideoFilePolicy.php
│   └── LessonAttachmentPolicy.php
│
├── Http/
│   ├── Actions/
│   │   │
│   │   ├── Common/
│   │   │   └── (none — no shared content endpoint across all clients)
│   │   │
│   │   ├── StudentApp/
│   │   │   ├── ListLessonsAction.php             ← GET  /api/v1/student/lessons
│   │   │   ├── ShowLessonAction.php              ← GET  /api/v1/student/lessons/{id}
│   │   │   ├── GetVideoSignedUrlAction.php       ← GET  /api/v1/student/lessons/{id}/video-url
│   │   │   └── GetAttachmentSignedUrlAction.php  ← GET  /api/v1/student/lessons/{id}/attachment-url
│   │   │
│   │   ├── StudentDesktop/
│   │   │   ├── ListLessonsAction.php             ← mirrors StudentApp
│   │   │   ├── ShowLessonAction.php
│   │   │   ├── GetVideoSignedUrlAction.php
│   │   │   └── GetAttachmentSignedUrlAction.php
│   │   │
│   │   ├── Website/
│   │   │   ├── ListLessonsAction.php             ← mirrors StudentApp
│   │   │   ├── ShowLessonAction.php
│   │   │   ├── GetVideoSignedUrlAction.php
│   │   │   └── GetAttachmentSignedUrlAction.php
│   │   │
│   │   └── TeacherApp/
│   │       ├── ListAssignedLessonsAction.php     ← GET  /api/v1/teacher/lessons
│   │       └── ShowAssignedLessonAction.php      ← GET  /api/v1/teacher/lessons/{id}
│   │
│   └── Requests/
│       ├── StudentApp/
│       │   ├── ListLessonsRequest.php
│       │   ├── ShowLessonRequest.php
│       │   └── GetVideoSignedUrlRequest.php      ← includes: quality (enum: low|medium|high)
│       ├── StudentDesktop/
│       │   ├── ListLessonsRequest.php
│       │   ├── ShowLessonRequest.php
│       │   └── GetVideoSignedUrlRequest.php
│       ├── Website/
│       │   ├── ListLessonsRequest.php
│       │   ├── ShowLessonRequest.php
│       │   └── GetVideoSignedUrlRequest.php
│       └── TeacherApp/
│           ├── ListAssignedLessonsRequest.php
│           └── ShowAssignedLessonRequest.php
│
├── Handlers/
│   ├── StudentApp/
│   │   ├── ListLessonsForStudentHandler.php
│   │   │   └── // injects: LessonResolver, SubscriptionAccessHandler (from Subscription module)
│   │   ├── ShowLessonForStudentHandler.php
│   │   │   └── // runs: subscription check → progression gate check → return lesson
│   │   ├── GenerateVideoSignedUrlHandler.php
│   │   │   └── // injects: VideoFileResolver, signs URL via Storage
│   │   └── GenerateAttachmentSignedUrlHandler.php
│   ├── StudentDesktop/
│   │   ├── ListLessonsForStudentHandler.php      ← identical to StudentApp
│   │   ├── ShowLessonForStudentHandler.php
│   │   ├── GenerateVideoSignedUrlHandler.php
│   │   └── GenerateAttachmentSignedUrlHandler.php
│   ├── Website/
│   │   ├── ListLessonsForStudentHandler.php
│   │   ├── ShowLessonForStudentHandler.php
│   │   ├── GenerateVideoSignedUrlHandler.php
│   │   └── GenerateAttachmentSignedUrlHandler.php
│   └── TeacherApp/
│       ├── ListAssignedLessonsHandler.php
│       └── ShowAssignedLessonHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       ├── Common/
│       │   ├── LessonResolver.php              ← injects: Lesson
│       │   ├── VideoFileResolver.php           ← injects: VideoFile
│       │   ├── LessonAttachmentResolver.php    ← injects: LessonAttachment
│       │   └── LessonTeacherAssignmentResolver.php  ← injects: LessonTeacherAssignment
│       ├── StudentApp/
│       │   └── LessonResolver.php              ← injects: Lesson — adds subscription state eager load
│       ├── StudentDesktop/
│       │   └── LessonResolver.php
│       ├── Website/
│       │   └── LessonResolver.php
│       └── TeacherApp/
│           └── LessonResolver.php              ← injects: Lesson — filters by teacher_id
│
├── Filament/
│   └── Panel/
│       ├── LessonResource.php
│       ├── Pages/
│       │   ├── ManageLessonVideos.php
│       │   └── ManageLessonAttachment.php
│       └── Widgets/
│           └── LessonProgressWidget.php
│
├── routes/
│   ├── student-app.php
│   ├── student-desktop.php
│   ├── website.php
│   └── teacher-app.php
│
└── Providers/
    └── ContentServiceProvider.php
```

### 7.1 Resolver Method Contracts

**`Common/LessonResolver`** injects `Lesson`:
- `findPublishedById(int $id): ?Lesson`
- `listPublishedForCategory(int $categoryId): Collection`
- `findNextLesson(int $currentLessonId, int $categoryId): ?Lesson`
- `existsAssignmentForTeacher(int $lessonId, int $teacherId): bool`

**`Common/VideoFileResolver`** injects `VideoFile`:
- `findByLessonAndQuality(int $lessonId, VideoQuality $quality): ?VideoFile`
- `listForLesson(int $lessonId): Collection`

**`TeacherApp/LessonResolver`** injects `Lesson`:
- `listForTeacher(int $teacherId): Collection`
- `findForTeacher(int $lessonId, int $teacherId): ?Lesson`

---

## 8. Module: Subscription

**Namespace root:** `Modules\Subscription`
**Depends on:** `Auth`, `Hierarchy`, `Catalog`

```
modules/Subscription/
│
├── DTOs/
│   ├── SubscriptionData.php
│   ├── SubscriptionScopeData.php    ← wraps {subscribable_type, subscribable_id, label}
│   └── AccessCheckResultData.php   ← wraps {has_access: bool, blocking_node: ?string}
│
├── Enums/
│   └── SubscriptionStatus.php      ← enum: pending|active|expired|cancelled
│
├── Events/
│   └── SubscriptionActivatedEvent.php
│
├── Listeners/
│   └── (future: SendActivationNotificationListener.php)
│
├── Models/
│   └── Subscription.php
│
├── Policies/
│   └── SubscriptionPolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── StudentApp/
│   │   │   └── ListMySubscriptionsAction.php       ← GET  /api/v1/student/subscriptions
│   │   ├── StudentDesktop/
│   │   │   └── ListMySubscriptionsAction.php
│   │   ├── Website/
│   │   │   └── ListMySubscriptionsAction.php
│   │   └── (TeacherApp has no subscription endpoints)
│   └── Requests/
│       ├── StudentApp/
│       │   └── ListMySubscriptionsRequest.php
│       ├── StudentDesktop/
│       │   └── ListMySubscriptionsRequest.php
│       └── Website/
│           └── ListMySubscriptionsRequest.php
│
├── Handlers/
│   ├── Common/
│   │   ├── ResolveStudentAccessHandler.php
│   │   │   └── // The shared access-check handler injected by Content, Library, etc.
│   │   │   └── // Returns AccessCheckResultData — never throws directly
│   │   └── ResolveProgressionGateHandler.php
│   │       └── // Checks ExamAttempt status before lesson unlock
│   ├── StudentApp/
│   │   └── FetchMySubscriptionsHandler.php
│   ├── StudentDesktop/
│   │   └── FetchMySubscriptionsHandler.php
│   └── Website/
│       └── FetchMySubscriptionsHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       ├── Common/
│       │   └── SubscriptionResolver.php            ← injects: Subscription
│       │       ├── hasActiveSubscriptionCoveringLesson(int $studentId, int $lessonId): bool
│       │       ├── resolveHierarchyPath(int $lessonId): array  ← [stage_id, sub_stage_id, ...]
│       │       └── listActiveForStudent(int $studentId): Collection
│       ├── StudentApp/
│       │   └── SubscriptionResolver.php
│       ├── StudentDesktop/
│       │   └── SubscriptionResolver.php
│       └── Website/
│           └── SubscriptionResolver.php
│
├── Filament/
│   └── Panel/
│       ├── SubscriptionResource.php
│       └── Pages/
│           └── ActivateSubscription.php
│
├── routes/
│   ├── student-app.php
│   ├── student-desktop.php
│   └── website.php
│
└── Providers/
    └── SubscriptionServiceProvider.php
```

### 8.1 `ResolveStudentAccessHandler` — Critical Contract

This handler is the single authority for the access check described in SRD §4.4.2.
It is injected by handlers in the `Content`, `Library`, and `Assessment` modules.
It must **never** be duplicated — it lives in `Subscription/Handlers/Common/`.

```
Input:  int $studentId, int $lessonId
Output: AccessCheckResultData { has_access: bool, reason_code: ?string }

Reason codes:
  null                         → access granted
  'SUBSCRIPTION_REQUIRED'     → no active subscription covers this lesson
  'PROGRESSION_GATE_BLOCKED'  → subscription OK, but exam gate not passed
```

---

## 9. Module: Assessment

**Namespace root:** `Modules\Assessment`
**Depends on:** `Auth`, `Catalog`, `Content`, `Subscription`

```
modules/Assessment/
│
├── DTOs/
│   ├── QuestionData.php             ← Question + options (without correct_option_id)
│   ├── ExamData.php
│   ├── ExamAttemptData.php
│   ├── ExamSubmissionData.php       ← Input: [{question_id, selected_option_id}]
│   └── ExamResultData.php           ← Output: {score_percent, status, correct_count, total}
│
├── Enums/
│   ├── QuestionType.php             ← single_choice
│   ├── Difficulty.php               ← easy|medium|hard
│   ├── AttemptStatus.php            ← in_progress|passed|failed|timed_out
│   └── GenerationStrategy.php      ← random
│
├── Models/
│   ├── QuestionBank.php
│   ├── QuestionOption.php
│   ├── Exam.php
│   ├── ExamTrigger.php
│   ├── ExamAttempt.php
│   └── ExamAttemptAnswer.php
│
├── Policies/
│   ├── QuestionBankPolicy.php
│   ├── ExamPolicy.php
│   └── ExamAttemptPolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── StudentApp/
│   │   │   ├── GetLessonExamAction.php            ← GET  /api/v1/student/lessons/{id}/exam
│   │   │   ├── StartExamAttemptAction.php         ← POST /api/v1/student/exams/{id}/start
│   │   │   └── SubmitExamAttemptAction.php        ← POST /api/v1/student/exam-attempts/{id}/submit
│   │   ├── StudentDesktop/
│   │   │   ├── GetLessonExamAction.php
│   │   │   ├── StartExamAttemptAction.php
│   │   │   └── SubmitExamAttemptAction.php
│   │   ├── Website/
│   │   │   ├── GetLessonExamAction.php
│   │   │   ├── StartExamAttemptAction.php
│   │   │   └── SubmitExamAttemptAction.php
│   │   └── TeacherApp/
│   │       └── ListLessonExamResultsAction.php    ← GET  /api/v1/teacher/lessons/{id}/exam-results
│   └── Requests/
│       ├── StudentApp/
│       │   ├── GetLessonExamRequest.php
│       │   ├── StartExamAttemptRequest.php
│       │   └── SubmitExamAttemptRequest.php
│       ├── StudentDesktop/
│       │   ├── GetLessonExamRequest.php
│       │   ├── StartExamAttemptRequest.php
│       │   └── SubmitExamAttemptRequest.php
│       ├── Website/
│       │   ├── GetLessonExamRequest.php
│       │   ├── StartExamAttemptRequest.php
│       │   └── SubmitExamAttemptRequest.php
│       └── TeacherApp/
│           └── ListLessonExamResultsRequest.php
│
├── Handlers/
│   ├── Common/
│   │   ├── GenerateExamQuestionsHandler.php
│   │   │   └── // Random draw from QuestionBankResolver with filters
│   │   └── ScoreExamAttemptHandler.php
│   │       └── // Compares selected_option_id vs correct_option_id per question
│   ├── StudentApp/
│   │   ├── FetchLessonExamHandler.php
│   │   ├── StartExamAttemptHandler.php
│   │   └── SubmitExamAttemptHandler.php
│   ├── StudentDesktop/
│   │   ├── FetchLessonExamHandler.php
│   │   ├── StartExamAttemptHandler.php
│   │   └── SubmitExamAttemptHandler.php
│   ├── Website/
│   │   ├── FetchLessonExamHandler.php
│   │   ├── StartExamAttemptHandler.php
│   │   └── SubmitExamAttemptHandler.php
│   └── TeacherApp/
│       └── FetchLessonExamResultsHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       ├── Common/
│       │   ├── QuestionBankResolver.php       ← injects: QuestionBank
│       │   │   ├── drawRandom(int $examId, array $filters): Collection
│       │   │   └── (NEVER exposes correct_option_id to external callers)
│       │   ├── ExamResolver.php               ← injects: Exam
│       │   ├── ExamTriggerResolver.php        ← injects: ExamTrigger
│       │   ├── ExamAttemptResolver.php        ← injects: ExamAttempt
│       │   └── ExamAttemptAnswerResolver.php  ← injects: ExamAttemptAnswer
│       ├── StudentApp/
│       │   ├── ExamResolver.php
│       │   └── ExamAttemptResolver.php
│       ├── StudentDesktop/
│       │   ├── ExamResolver.php
│       │   └── ExamAttemptResolver.php
│       ├── Website/
│       │   ├── ExamResolver.php
│       │   └── ExamAttemptResolver.php
│       └── TeacherApp/
│           └── ExamAttemptResolver.php        ← injects: ExamAttempt — filters by teacher's lessons
│
├── Filament/
│   └── Panel/
│       ├── QuestionBankResource.php
│       ├── ExamResource.php
│       └── Pages/
│           ├── GenerateExam.php
│           └── ViewExamResults.php
│
├── routes/
│   ├── student-app.php
│   ├── student-desktop.php
│   ├── website.php
│   └── teacher-app.php
│
└── Providers/
    └── AssessmentServiceProvider.php
```

### 9.1 Security Constraint — Correct Answer Isolation

`QuestionBankResolver::drawRandom()` must return a `Collection` of objects that
**do not include** `correct_option_id`. The resolver applies a `select()` exclusion.
This is the only place this data control lives — no other layer may compensate for a
failure here.

```php
// Inside QuestionBankResolver::drawRandom()
return QuestionBank::query()
    ->with(['options' => fn($q) => $q->select('id', 'question_id', 'body', 'sort_order')])
    ->select(['id', 'stem', 'question_type', 'difficulty']) // correct_option_id intentionally excluded
    ->...
    ->get();
```

---

## 10. Module: Library

**Namespace root:** `Modules\Library`
**Depends on:** `Auth`, `Hierarchy`, `Catalog`, `Content`, `Subscription`

```
modules/Library/
│
├── DTOs/
│   ├── LibraryItemData.php
│   └── LibraryItemListData.php
│
├── Enums/
│   └── LibraryItemType.php          ← government_book|study_notes|lesson_attachment
│
├── Models/
│   └── LibraryItem.php
│
├── Policies/
│   └── LibraryItemPolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── Common/
│   │   │   └── ListLibraryItemsAction.php           ← GET /api/v1/library
│   │   ├── StudentApp/
│   │   │   └── GetLibraryItemDownloadUrlAction.php  ← GET /api/v1/library/{id}/download-url
│   │   ├── StudentDesktop/
│   │   │   └── GetLibraryItemDownloadUrlAction.php
│   │   └── Website/
│   │       └── GetLibraryItemDownloadUrlAction.php
│   └── Requests/
│       ├── Common/
│       │   └── ListLibraryItemsRequest.php          ← filters: type, stage_id, sub_stage_id
│       ├── StudentApp/
│       │   └── GetLibraryItemDownloadUrlRequest.php
│       ├── StudentDesktop/
│       │   └── GetLibraryItemDownloadUrlRequest.php
│       └── Website/
│           └── GetLibraryItemDownloadUrlRequest.php
│
├── Handlers/
│   ├── Common/
│   │   └── FetchLibraryItemsHandler.php
│   ├── StudentApp/
│   │   └── GenerateLibraryItemDownloadUrlHandler.php
│   ├── StudentDesktop/
│   │   └── GenerateLibraryItemDownloadUrlHandler.php
│   └── Website/
│       └── GenerateLibraryItemDownloadUrlHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       ├── Common/
│       │   └── LibraryItemResolver.php              ← injects: LibraryItem
│       │       ├── listFiltered(array $filters, ?int $studentId): Collection
│       │       └── findById(int $id): ?LibraryItem
│       ├── StudentApp/
│       │   └── LibraryItemResolver.php              ← applies subscription scope
│       ├── StudentDesktop/
│       │   └── LibraryItemResolver.php
│       └── Website/
│           └── LibraryItemResolver.php
│
├── Filament/
│   └── Panel/
│       └── LibraryItemResource.php
│
├── routes/
│   ├── common.php
│   ├── student-app.php
│   ├── student-desktop.php
│   └── website.php
│
└── Providers/
    └── LibraryServiceProvider.php
```

---

## 11. Module: Communication

**Namespace root:** `Modules\Communication`
**Depends on:** `Auth`, `Content`, `Subscription`
**Phase:** P2 (after P0 and P1 modules are stable)

```
modules/Communication/
│
├── DTOs/
│   ├── ConversationChannelData.php
│   ├── MessageData.php
│   └── SendMessageData.php          ← Input DTO for message creation
│
├── Enums/
│   ├── MessageType.php              ← text|voice|image|video
│   └── SenderType.php               ← student|teacher
│
├── Models/
│   ├── ConversationChannel.php
│   └── Message.php
│
├── Policies/
│   ├── ConversationChannelPolicy.php
│   └── MessagePolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── StudentApp/
│   │   │   ├── GetOrCreateLessonChannelAction.php    ← GET  /api/v1/student/lessons/{id}/channel
│   │   │   ├── ListChannelMessagesAction.php         ← GET  /api/v1/student/lessons/{id}/channel/messages
│   │   │   └── SendMessageAction.php                 ← POST /api/v1/student/lessons/{id}/channel/messages
│   │   ├── StudentDesktop/
│   │   │   ├── GetOrCreateLessonChannelAction.php
│   │   │   ├── ListChannelMessagesAction.php
│   │   │   └── SendMessageAction.php
│   │   ├── Website/
│   │   │   ├── GetOrCreateLessonChannelAction.php
│   │   │   ├── ListChannelMessagesAction.php
│   │   │   └── SendMessageAction.php
│   │   └── TeacherApp/
│   │       ├── ListTeacherChannelsAction.php         ← GET  /api/v1/teacher/channels
│   │       ├── ListChannelMessagesAction.php         ← GET  /api/v1/teacher/channels/{id}/messages
│   │       ├── ReplyToChannelAction.php              ← POST /api/v1/teacher/channels/{id}/messages
│   │       └── MarkMessageReadAction.php             ← PATCH /api/v1/messages/{id}/read
│   └── Requests/
│       ├── StudentApp/
│       │   ├── GetOrCreateLessonChannelRequest.php
│       │   ├── ListChannelMessagesRequest.php
│       │   └── SendMessageRequest.php                ← includes MessageTypeRule validation
│       ├── StudentDesktop/
│       │   ├── GetOrCreateLessonChannelRequest.php
│       │   ├── ListChannelMessagesRequest.php
│       │   └── SendMessageRequest.php
│       ├── Website/
│       │   ├── GetOrCreateLessonChannelRequest.php
│       │   ├── ListChannelMessagesRequest.php
│       │   └── SendMessageRequest.php
│       └── TeacherApp/
│           ├── ListTeacherChannelsRequest.php
│           ├── ListChannelMessagesRequest.php
│           ├── ReplyToChannelRequest.php             ← includes MessageTypeRule validation
│           └── MarkMessageReadRequest.php
│
├── Rules/
│   └── MessageTypeRule.php          ← Custom validation: enforces body/attachment constraints per type
│
├── Handlers/
│   ├── Common/
│   │   └── ResolveOrCreateChannelHandler.php
│   │       └── // Finds existing channel or creates new one; resolves teacher_id from lesson
│   ├── StudentApp/
│   │   ├── FetchLessonChannelHandler.php
│   │   ├── FetchChannelMessagesHandler.php
│   │   └── SendMessageHandler.php
│   ├── StudentDesktop/
│   │   ├── FetchLessonChannelHandler.php
│   │   ├── FetchChannelMessagesHandler.php
│   │   └── SendMessageHandler.php
│   ├── Website/
│   │   ├── FetchLessonChannelHandler.php
│   │   ├── FetchChannelMessagesHandler.php
│   │   └── SendMessageHandler.php
│   └── TeacherApp/
│       ├── FetchTeacherChannelsHandler.php
│       ├── FetchChannelMessagesHandler.php
│       ├── SendReplyHandler.php
│       └── MarkMessageReadHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       ├── Common/
│       │   ├── ConversationChannelResolver.php  ← injects: ConversationChannel
│       │   │   ├── findByLessonAndStudent(int $lessonId, int $studentId): ?ConversationChannel
│       │   │   └── createChannel(int $lessonId, int $studentId, int $teacherId): ConversationChannel
│       │   └── MessageResolver.php              ← injects: Message
│       │       ├── listForChannel(int $channelId, int $perPage): LengthAwarePaginator
│       │       └── create(SendMessageData $data): Message
│       ├── StudentApp/
│       │   ├── ConversationChannelResolver.php
│       │   └── MessageResolver.php
│       ├── StudentDesktop/
│       │   ├── ConversationChannelResolver.php
│       │   └── MessageResolver.php
│       ├── Website/
│       │   ├── ConversationChannelResolver.php
│       │   └── MessageResolver.php
│       └── TeacherApp/
│           ├── ConversationChannelResolver.php  ← filters channels by teacher_id
│           └── MessageResolver.php
│
├── Filament/
│   └── Panel/
│       └── ConversationChannelResource.php      ← Admin view-only (no write)
│
├── routes/
│   ├── student-app.php
│   ├── student-desktop.php
│   ├── website.php
│   └── teacher-app.php
│
└── Providers/
    └── CommunicationServiceProvider.php
```

---

## 12. Module: CMS

**Namespace root:** `Modules\CMS`
**Depends on:** `Auth`

```
modules/CMS/
│
├── DTOs/
│   └── StaticPageData.php
│
├── Models/
│   └── StaticPage.php
│
├── Policies/
│   └── StaticPagePolicy.php
│
├── Http/
│   ├── Actions/
│   │   ├── Common/
│   │   │   └── (none — static pages are public)
│   │   └── Website/
│   │       ├── ListStaticPagesAction.php        ← GET /api/v1/pages
│   │       └── ShowStaticPageAction.php         ← GET /api/v1/pages/{slug}
│   └── Requests/
│       └── Website/
│           ├── ListStaticPagesRequest.php
│           └── ShowStaticPageRequest.php
│
├── Handlers/
│   └── Website/
│       ├── FetchStaticPagesHandler.php
│       └── FetchStaticPageBySlugHandler.php
│
├── Eloquent/
│   └── Resolvers/
│       └── Website/
│           └── StaticPageResolver.php           ← injects: StaticPage
│               ├── listPublished(): Collection
│               └── findBySlug(string $slug): ?StaticPage
│
├── Filament/
│   └── Panel/
│       └── StaticPageResource.php
│
├── routes/
│   └── website.php
│
└── Providers/
    └── CMSServiceProvider.php
```

---

## 13. Route File Registration

All module route files are imported into the main API route loader in `routes/api.php`.
Each module's routes are grouped by client with appropriate middleware.

```php
// routes/api.php

use Illuminate\Support\Facades\Route;

// ── Public routes (no auth) ──────────────────────────────────────────────────
Route::prefix('v1')->group(function () {

    // Auth
    require base_path('modules/Auth/routes/common.php');

    // CMS (public — no auth)
    require base_path('modules/CMS/routes/website.php');
});

// ── Authenticated API routes ─────────────────────────────────────────────────
Route::prefix('v1')->middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {

    // ── Common (shared across all clients) ───────────────────────────────
    Route::group([], function () {
        require base_path('modules/Hierarchy/routes/common.php');
        require base_path('modules/Library/routes/common.php');
    });

    // ── StudentApp ───────────────────────────────────────────────────────
    Route::middleware('role:student')->group(function () {
        require base_path('modules/Catalog/routes/student-app.php');
        require base_path('modules/Content/routes/student-app.php');
        require base_path('modules/Subscription/routes/student-app.php');
        require base_path('modules/Assessment/routes/student-app.php');
        require base_path('modules/Library/routes/student-app.php');
        require base_path('modules/Communication/routes/student-app.php');
    });

    // ── StudentDesktop ───────────────────────────────────────────────────
    Route::middleware('role:student')->prefix('desktop')->group(function () {
        require base_path('modules/Catalog/routes/student-desktop.php');
        require base_path('modules/Content/routes/student-desktop.php');
        require base_path('modules/Subscription/routes/student-desktop.php');
        require base_path('modules/Assessment/routes/student-desktop.php');
        require base_path('modules/Library/routes/student-desktop.php');
        require base_path('modules/Communication/routes/student-desktop.php');
    });

    // ── Website (React SPA) ──────────────────────────────────────────────
    Route::middleware('role:student')->prefix('web')->group(function () {
        require base_path('modules/Catalog/routes/website.php');
        require base_path('modules/Content/routes/website.php');
        require base_path('modules/Subscription/routes/website.php');
        require base_path('modules/Assessment/routes/website.php');
        require base_path('modules/Library/routes/website.php');
        require base_path('modules/Communication/routes/website.php');
    });

    // ── TeacherApp ───────────────────────────────────────────────────────
    Route::middleware('role:teacher')->prefix('teacher')->group(function () {
        require base_path('modules/Catalog/routes/teacher-app.php');
        require base_path('modules/Content/routes/teacher-app.php');
        require base_path('modules/Assessment/routes/teacher-app.php');
        require base_path('modules/Communication/routes/teacher-app.php');
    });
});
```

---

## 14. Service Provider Registration

Each module has its own `ServiceProvider` that registers routes, policies, and bindings.
All module providers are boot-strapped from `app/Providers/AppServiceProvider.php`.

```php
// app/Providers/AppServiceProvider.php

public function register(): void
{
    $this->app->register(\Modules\Auth\Providers\AuthServiceProvider::class);
    $this->app->register(\Modules\Hierarchy\Providers\HierarchyServiceProvider::class);
    $this->app->register(\Modules\Catalog\Providers\CatalogServiceProvider::class);
    $this->app->register(\Modules\Content\Providers\ContentServiceProvider::class);
    $this->app->register(\Modules\Subscription\Providers\SubscriptionServiceProvider::class);
    $this->app->register(\Modules\Assessment\Providers\AssessmentServiceProvider::class);
    $this->app->register(\Modules\Library\Providers\LibraryServiceProvider::class);
    $this->app->register(\Modules\Communication\Providers\CommunicationServiceProvider::class);
    $this->app->register(\Modules\CMS\Providers\CMSServiceProvider::class);
}
```

**Template for a module `ServiceProvider`:**

```php
// modules/{Module}/Providers/{Module}ServiceProvider.php

declare(strict_types=1);

namespace Modules\Content\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Modules\Content\Models\Lesson;
use Modules\Content\Policies\LessonPolicy;

final class ContentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind resolvers, handlers, etc. via the container if needed.
        // Prefer constructor injection — only use explicit bindings for interfaces.
    }

    public function boot(): void
    {
        Gate::policy(Lesson::class, LessonPolicy::class);
        // Register additional model policies here.
    }
}
```

---

## 15. Naming Cheat-Sheet

Quick reference for when to create a new class versus extending an existing one.

### Creating a new Action

> Trigger: A new HTTP endpoint is added.

```
File: modules/{Module}/Http/Actions/{Client}/{Verb}{Resource}Action.php
Class: {Verb}{Resource}Action extends BaseAction
Injects: {UseCase}Request (FormRequest), {UseCase}Handler
Returns: JsonResponse via $this->success() / $this->created() / $this->noContent()
```

### Creating a new Handler

> Trigger: A new use-case is needed (even if the endpoint already exists).

```
File: modules/{Module}/Handlers/{Client}/{Describe}Handler.php
Class: {Describe}Handler extends BaseHandler
Injects: One or more Resolvers (from any module). May inject other Handlers.
Returns: DTO or primitive. Never JsonResponse. Never Request.
```

### Creating a new Resolver

> Trigger: A model needs new Eloquent query logic.

```
File: modules/{Module}/Eloquent/Resolvers/{Client}/{Model}Resolver.php
Class: {Model}Resolver extends BaseResolver
Injects: Exactly ONE Eloquent Model class. Nothing else.
Returns: Model | Collection | LengthAwarePaginator | bool | int | null
```

### Creating a new DTO

> Trigger: Data is passed between layers with more than 2 fields.

```
File: modules/{Module}/DTOs/{Name}Data.php
Class: {Name}Data extends BaseData
All properties: typed, readonly (PHP 8.2+ readonly class preferred)
```

### Common anti-patterns to reject in code review

| Anti-pattern | Correct approach |
|---|---|
| `DB::table(...)` anywhere | Use Eloquent inside a Resolver |
| `Request $request` in a Handler | Inject a DTO instead |
| `JsonResponse` returned by a Handler | Handler returns DTO; Action wraps it |
| Business logic in a Resolver method | Move to a Handler |
| Two models injected into one Resolver | Split into two Resolvers |
| `array` parameter with no type shape | Create a DTO |
| `ServiceClass` with 5+ public methods | Split into focused Handlers |

---

*DEV-LMS-001 | EduCore LMS | Module Structure v1.0.0 | 2026-05-23*
*Next: `docs/API_CONTRACTS.md` — full request/response payload specifications per endpoint.*

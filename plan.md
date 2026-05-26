# EduCore LMS — Build Plan

## 1. Autoload & Composer

- **PSR-4 mapping:** `Modules\\` → `modules/` added to `composer.json` alongside `App\\`
- **Composer dump-autoload:** Executed successfully (8562 classes)
- **Filament version:** `filament/filament: ^5.6` installed

## 2. Filament Installation

- **Panel ID:** `admin`
- **Panel path:** `/admin`
- **Panel provider:** `app/Providers/Filament/AdminPanelProvider.php`
- **Discovery:** Dynamic resource discovery for all 23 module directories via `glob()` in the panel provider. Each module's `Filament/Panel/` directory is discovered under its own `Modules\{Name}\Filament\Panel` namespace.
- **Verification:** `php artisan filament:check` passes (only translation missing warnings — no resource errors)

## 3. Module Progress Table

| # | Module | Model | Migration | Filament Resource | Status |
|---|--------|-------|-----------|-------------------|--------|
| 1 | User | `Modules\User\Models\User` | ✅ | `UserResource` | ✅ |
| 2 | Student | `Modules\Student\Models\Student` | ✅ | `StudentResource` | ✅ |
| 3 | Teacher | `Modules\Teacher\Models\Teacher` | ✅ | `TeacherResource` | ✅ |
| 4 | EducationalStage | `Modules\EducationalStage\Models\EducationalStage` | ✅ | `EducationalStageResource` | ✅ |
| 5 | EducationalSubStage | `Modules\EducationalSubStage\Models\EducationalSubStage` | ✅ | `EducationalSubStageResource` | ✅ |
| 6 | CourseType | `Modules\CourseType\Models\CourseType` | ✅ | `CourseTypeResource` | ✅ |
| 7 | Subject | `Modules\Subject\Models\Subject` | ✅ | `SubjectResource` | ✅ |
| 8 | SubjectCategory | `Modules\SubjectCategory\Models\SubjectCategory` | ✅ | `SubjectCategoryResource` | ✅ |
| 9 | Unit | `Modules\Unit\Models\Unit` | ✅ | `UnitResource` | ✅ |
| 10 | Lesson | `Modules\Lesson\Models\Lesson` | ✅ | `LessonResource` | ✅ |
| 11 | VideoFile | `Modules\VideoFile\Models\VideoFile` | ✅ | `VideoFileResource` | ✅ |
| 12 | LessonAttachment | `Modules\LessonAttachment\Models\LessonAttachment` | ✅ | `LessonAttachmentResource` | ✅ |
| 13 | Subscription | `Modules\Subscription\Models\Subscription` | ✅ | `SubscriptionResource` | ✅ |
| 14 | QuestionBank | `Modules\QuestionBank\Models\QuestionBank` | ✅ | `QuestionBankResource` | ✅ |
| 15 | Question | `Modules\Question\Models\Question` | ✅ | `QuestionResource` | ✅ |
| 16 | QuestionOption | `Modules\QuestionOption\Models\QuestionOption` | ✅ | `QuestionOptionResource` | ✅ |
| 17 | Exam | `Modules\Exam\Models\Exam` | ✅ | `ExamResource` | ✅ |
| 18 | ExamAttempt | `Modules\ExamAttempt\Models\ExamAttempt` | ✅ | `ExamAttemptResource` | ✅ |
| 19 | LibraryItem | `Modules\LibraryItem\Models\LibraryItem` | ✅ | `LibraryItemResource` | ✅ |
| 20 | ConversationChannel | `Modules\ConversationChannel\Models\ConversationChannel` | ✅ | `ConversationChannelResource` | ✅ |
| 21 | Message | `Modules\Message\Models\Message` | ✅ | `MessageResource` | ✅ |
| 22 | MessageAttachment | `Modules\MessageAttachment\Models\MessageAttachment` | ✅ | `MessageAttachmentResource` | ✅ |
| 23 | StaticPage | `Modules\StaticPage\Models\StaticPage` | ✅ | `StaticPageResource` | ✅ |

**Migrations executed:** 23/23 passed via `php artisan migrate:fresh`

## 4. Pending Items

- **QuestionBank migration** — `correct_option_id` FK removed (references `question_options` which is created later). Column exists as plain `unsignedBigInteger` — model relationship works but no DB-level FK constraint.
- **App\Models\User** — The old `app/Models/User.php` still exists but is no longer used for auth (config/auth.php points to `Modules\User\Models\User`). Should be removed or refactored in a future cleanup.
- **Filament navigation icons** — Disabled due to PHP 8.3 property type invariance (parent uses `string|\BackedEnum|null`, child can't use `?string`). Navigation icons default to `null`. They can be re-enabled via separate method overrides.
- **Seeders/Factories** — Not yet created for any module.
- **Policies** — Not yet created for any module.
- **Validation rules** — Filament resources have basic field types but no custom validation rules beyond what Filament provides.
- **Translation strings** — All Filament labels are hardcoded (not translatable).

## 5. Next Steps

- All current work is only the **admin panel (Filament) layer**.
- **APIs (Actions, Handlers, Resolvers)** will be implemented in a future phase.
- The next phase will build per-client segregated API endpoints following the Action → Handler → Resolver pattern from `CLAUDE.md`.
- No Service classes, no Repositories — architecture rule enforced when APIs are built.

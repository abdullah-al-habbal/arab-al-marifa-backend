# Software Requirements Document (SRD)
# EduCore LMS — Learning Management System

| Field | Value |
|---|---|
| **Document Ref** | SRD-LMS-003 |
| **Version** | 1.0.0 |
| **Status** | Approved — Baseline |
| **Date** | 2026-05-23 |
| **Author** | System Architect |
| **Relates to** | `CLAUDE.md` v1.0.0 |

> **Scope Notice:** This document defines the complete functional and technical requirements
> for the EduCore LMS backend and all client-facing surfaces. Any feature not listed here
> is **out of scope** for the contracted delivery. Additions require a formal change request
> and will affect timeline and cost estimates.

---

## Table of Contents

1. [System Overview](#1-system-overview)
2. [System Boundaries & Clients](#2-system-boundaries--clients)
3. [User Roles & Permissions](#3-user-roles--permissions)
4. [Domain Modules](#4-domain-modules)
   - 4.1 [Educational Hierarchy](#41-educational-hierarchy-module)
   - 4.2 [Catalog (Subjects & Categories)](#42-catalog-module)
   - 4.3 [Content (Units, Lessons & Media)](#43-content-module)
   - 4.4 [Subscription & Access Control](#44-subscription--access-control-module)
   - 4.5 [Assessment & Question Bank](#45-assessment--question-bank-module)
   - 4.6 [Library](#46-library-module)
   - 4.7 [Communication (Lesson Channels)](#47-communication-module)
   - 4.8 [CMS (Static Pages)](#48-cms-module)
5. [Entity Specifications](#5-entity-specifications)
6. [Business Rules & Validation Constraints](#6-business-rules--validation-constraints)
7. [API Surface Overview](#7-api-surface-overview)
8. [Non-Functional Requirements](#8-non-functional-requirements)
9. [Data Integrity & Database Contracts](#9-data-integrity--database-contracts)
10. [Out of Scope](#10-out-of-scope)

---

## 1. System Overview

**EduCore LMS** is a Video-on-Demand learning management platform built for a private
training center. The system delivers pre-recorded educational content organized around a
deep academic classification tree. It enforces subscription-gated access, mandatory
assessment progression gates, and lesson-scoped teacher–student communication.

### 1.1 Design Constraints Driving Architecture

| Constraint | Design Response |
|---|---|
| Poor internet quality in target region | Multiple video quality tracks per lesson (low / medium / high) |
| Content piracy risk | Native Flutter apps with OS-level screen-capture prevention |
| Manual payment workflows | Admin-activated subscriptions via Filament panel |
| Multi-client surface (5 apps) | Per-client segregated Actions, Handlers, Resolvers |
| Deep content hierarchy | Polymorphic subscriptions covering any hierarchy node |

---

## 2. System Boundaries & Clients

### 2.1 Client Applications

```
┌─────────────────────────────────────────────────────────┐
│                    EduCore Platform                      │
│                                                          │
│  ┌──────────────┐  ┌──────────────┐  ┌───────────────┐  │
│  │  TeacherApp  │  │  StudentApp  │  │StudentDesktop │  │
│  │ Flutter      │  │ Flutter      │  │ Flutter       │  │
│  │ Android/iOS  │  │ Android/iOS  │  │ Win / macOS   │  │
│  └──────┬───────┘  └──────┬───────┘  └──────┬────────┘  │
│         │                 │                  │           │
│  ┌──────┴─────────────────┴──────────────────┴────────┐  │
│  │              REST API  /api/v1/                     │  │
│  │              Laravel 13 + Sanctum                   │  │
│  └──────────────────────┬──────────────────────────────┘  │
│                         │                                │
│  ┌──────────┐  ┌────────┴──────────┐                    │
│  │  Website │  │   Admin Panel     │                    │
│  │  React   │  │   Filament v3     │                    │
│  │  (SPA)   │  │   (in-process)    │                    │
│  └──────────┘  └───────────────────┘                    │
└─────────────────────────────────────────────────────────┘
```

### 2.2 Client Responsibilities

| Client | Primary Audience | Key Capabilities |
|---|---|---|
| **TeacherApp** | Teachers | View assigned lessons, reply to student messages, view quiz results for own lessons |
| **StudentApp** | Students | Browse content, watch videos, take exams, send lesson messages, access library |
| **StudentDesktop** | Students | Same as StudentApp with OS-level DRM (screen-capture blocked) |
| **Website** | Students + Public | Browse, watch videos, take exams, library access (React SPA, medium DRM) |
| **AdminPanel** | Administrators | Full CRUD on all entities, subscription activation, exam management |

---

## 3. User Roles & Permissions

### 3.1 Role Definitions

#### Administrator
- Full read/write access to all entities system-wide.
- Only role that can create/edit the educational hierarchy.
- Only role that can activate or deactivate student subscriptions.
- Only role that can manage teacher assignments to lessons.
- Can create and manage question banks and exam configurations.

#### Teacher
- Read access to lessons they are **explicitly assigned to**.
- Cannot see or interact with lessons assigned to other teachers, even within the same subject.
- Can view `ExamAttempt` results for students in their assigned lessons only.
- Can read and reply to `ConversationChannel` messages for their assigned lessons only.
- Cannot create or delete content.

#### Student
- Access to content is **entirely gated by active subscriptions**.
- Can view lesson metadata (title, teacher name, duration) for locked lessons but cannot access video or PDF.
- Can submit exam attempts for exams they are eligible to take.
- Can initiate a `ConversationChannel` with the teacher of any lesson they have access to.
- Cannot see other students' conversation channels.

### 3.2 Permission Matrix

| Action | Admin | Teacher | Student |
|---|---|---|---|
| Manage Educational Hierarchy | ✅ | ❌ | ❌ |
| Manage Subjects & Categories | ✅ | ❌ | ❌ |
| Create / Edit Lessons | ✅ | ❌ | ❌ |
| Assign Teachers to Lessons | ✅ | ❌ | ❌ |
| Upload Video Files | ✅ | ❌ | ❌ |
| Upload Lesson PDFs | ✅ | ❌ | ❌ |
| Activate Student Subscriptions | ✅ | ❌ | ❌ |
| View Assigned Lessons | ✅ | ✅ (own only) | ✅ (subscribed) |
| Watch Lesson Video | ✅ | ✅ (own) | ✅ (subscribed + unlocked) |
| Download / View Lesson PDF | ✅ | ✅ (own) | ✅ (subscribed + unlocked) |
| Submit Exam Attempt | ❌ | ❌ | ✅ |
| View Exam Results | ✅ | ✅ (own lessons) | ✅ (own attempts) |
| Create Question Bank Entries | ✅ | ❌ | ❌ |
| Generate Exam from Question Bank | ✅ | ❌ | ❌ |
| Send Message in Lesson Channel | ❌ | ✅ (own lessons) | ✅ (subscribed lesson) |
| Read Lesson Channel Messages | ✅ | ✅ (own lessons) | ✅ (own channels) |
| Manage Library Items | ✅ | ❌ | ❌ |
| Browse Library | ✅ | ✅ | ✅ (subscribed scope) |
| Manage Static Pages (CMS) | ✅ | ❌ | ❌ |

---

## 4. Domain Modules

### 4.1 Educational Hierarchy Module

**Purpose:** Defines the academic classification tree that all content, subscriptions,
and assessments are anchored to.

#### 4.1.1 Hierarchy Tree

```
EducationalStage  (root, abstract parent)
│  e.g., "Secondary Education", "Intermediate Education"
│
└── EducationalSubStage  (child of Stage)
    │  e.g., "Scientific Track", "Literary Track", "Grade 9"
    │
    └── CourseType  (child of SubStage)
           e.g., "Winter Course", "Summer Course", "Intensive", "Exam Sessions"
```

#### 4.1.2 EducationalStage Requirements

- Name (string, required, unique per system).
- Description (text, optional).
- Display order (integer, for UI sequencing).
- Active flag (boolean) — inactive stages are hidden from all client APIs.
- A stage may have many sub-stages.
- A stage may be targeted directly by a `Subscription` (polymorphic).

#### 4.1.3 EducationalSubStage Requirements

- Name (string, required).
- Must belong to exactly one `EducationalStage` (FK: `stage_id`).
- Display order (integer).
- Active flag (boolean).
- A sub-stage may have many `CourseTypes`.
- A sub-stage may be targeted directly by a `Subscription` (polymorphic).

#### 4.1.4 CourseType Requirements

- Name (string, required).
  - e.g., `winter_course`, `summer_course`, `intensive`, `exam_sessions`
- Must belong to exactly one `EducationalSubStage`.
- A `CourseType` groups the `Subjects` taught within that sub-stage during that period.
- A `CourseType` is NOT independently subscribable — access flows from Stage or SubStage.

---

### 4.2 Catalog Module

**Purpose:** Manages the subject catalogue — what is taught, under which classification,
and which categories it is divided into.

#### 4.2.1 Subject Requirements

- Name (string, required).
- Belongs to exactly one `CourseType`.
- Has many `SubjectCategories`.
- A `Subject` may be targeted directly by a `Subscription` (polymorphic).
- A `Subject` may have many `Teachers` assigned through `LessonTeacherAssignment`
  (pivot through Lessons — teachers are NOT assigned at the subject level directly;
  they are assigned per Lesson).
- Has many `QuestionBank` entries.

#### 4.2.2 SubjectCategory Requirements

- Name (string, required). e.g., "Algebra", "Geometry", "Mechanics"
- Belongs to exactly one `Subject`.
- Display order (integer).
- Active flag (boolean).
- A `SubjectCategory` may be targeted directly by a `Subscription` (polymorphic).
- A `SubjectCategory` groups `Lessons` — a lesson belongs to a `SubjectCategory`.

---

### 4.3 Content Module

**Purpose:** Manages the deliverable content units — lessons and their associated media.

#### 4.3.1 Unit (Tag-based Classification)

> **Design Note:** `Unit` is implemented as a **tagging system**, not a hard relational
> table. Lessons carry `unit_tag` strings (e.g., `"unit_1"`, `"unit_2"`). This allows
> flexible grouping without rigid FK chains. The tag vocabulary is defined per Subject.

- `unit_tag` is a string stored on the `Lesson` record.
- The Admin Panel provides a UI to define the tag vocabulary per Subject.
- The Assessment module uses `unit_tag` values to scope question bank queries.
- A Lesson carries exactly one `unit_tag` (a lesson belongs to one unit).

#### 4.3.2 Lesson Requirements

- Title (string, required).
- Description (text, optional).
- Belongs to exactly one `SubjectCategory`.
- `unit_tag` (string, required) — which unit this lesson belongs to.
- `sort_order` (integer) — sequential order within the category.
- `is_published` (boolean) — unpublished lessons are invisible to all clients.
- Has one `LessonAttachment` (PDF).
- Has many `VideoFile` records (one per quality level).
- Has one `TeacherAssignment` → links to one `Teacher`.
- May have one `ExamTrigger` — the exam that gates access to the next lesson.
- Has many `ConversationChannel` records (one per student who initiated).

#### 4.3.3 TeacherAssignment Requirements

- Pivot record: `lesson_id` + `teacher_id`.
- A lesson has exactly one teacher assignment (one teacher per lesson).
- A teacher may be assigned to many lessons across multiple subjects.
- This assignment is the authority record for:
  - Teacher access to the lesson's conversation channels.
  - Teacher access to exam results for this lesson.

#### 4.3.4 VideoFile Requirements

- Belongs to exactly one `Lesson`.
- `quality` enum: `low` | `medium` | `high`
  - `low` ≈ 240p / 360p (bandwidth-constrained networks)
  - `medium` ≈ 480p / 720p
  - `high` ≈ 1080p
- `storage_path` (string) — path in the storage disk.
- `mime_type` (string) — e.g., `video/mp4`.
- `file_size_bytes` (unsigned bigint).
- `duration_seconds` (unsigned integer).
- Constraint: Each lesson must have **at least one** `VideoFile`. At most one per quality level.
- URLs served as **signed temporary URLs** (15-minute TTL). No permanent public URLs for video files.

#### 4.3.5 LessonAttachment (PDF) Requirements

- Belongs to exactly one `Lesson` (one-to-one).
- `storage_path` (string).
- `original_filename` (string) — displayed in the UI.
- `file_size_bytes` (unsigned bigint).
- Served as a signed temporary URL (15-minute TTL).
- Client apps must render PDF in-app only. No system share sheet or download action exposed.

---

### 4.4 Subscription & Access Control Module

**Purpose:** Controls which students have access to which content nodes,
using a polymorphic flexible subscription model.

#### 4.4.1 Subscription Requirements

| Field | Type | Description |
|---|---|---|
| `student_id` | FK → students | The subscribing student |
| `subscribable_type` | string (morph) | FQCN of the target model |
| `subscribable_id` | unsigned bigint | ID of the target record |
| `activated_at` | timestamp | When admin activated (nullable until activation) |
| `expires_at` | timestamp | Expiry date (nullable = never expires) |
| `status` | enum | `pending` \| `active` \| `expired` \| `cancelled` |
| `notes` | text | Admin notes on payment / activation |
| `activated_by` | FK → users | Admin who activated this subscription |

**Subscribable types (polymorphic targets):**

```
Modules\Hierarchy\Models\EducationalStage      → grants access to ALL content in stage
Modules\Hierarchy\Models\EducationalSubStage   → grants access to ALL content in sub-stage
Modules\Catalog\Models\Subject                 → grants access to all lessons in subject
Modules\Catalog\Models\SubjectCategory         → grants access to lessons in that category
```

#### 4.4.2 Access Resolution Algorithm

When a student requests access to a `Lesson`, the server evaluates:

```
1. Resolve lesson → SubjectCategory → Subject → CourseType → SubStage → Stage
2. Collect IDs at each level into: [stage_id, sub_stage_id, subject_id, category_id]
3. Query Subscription:
     WHERE student_id = :student
     AND status = 'active'
     AND (expires_at IS NULL OR expires_at > NOW())
     AND (
       (subscribable_type = 'EducationalStage'    AND subscribable_id IN [stage_ids])
       OR
       (subscribable_type = 'EducationalSubStage' AND subscribable_id IN [sub_stage_ids])
       OR
       (subscribable_type = 'Subject'             AND subscribable_id IN [subject_ids])
       OR
       (subscribable_type = 'SubjectCategory'     AND subscribable_id IN [category_ids])
     )
4. If any row found → GRANTED
5. Else → 403 Forbidden with error code SUBSCRIPTION_REQUIRED
```

#### 4.4.3 Progression Gate Check

Evaluated **after** subscription check, **before** returning lesson content:

```
1. Find the lesson's sort_order (N) within its SubjectCategory.
2. Check if any Lesson at sort_order < N in the same SubjectCategory
   has an ExamTrigger where:
     ExamAttempt WHERE student_id = :student AND exam_id = trigger.exam_id
     AND status != 'passed'
   exists.
3. If such a blocking trigger exists → 403 Forbidden with error code PROGRESSION_GATE_BLOCKED
4. Else → proceed to return lesson data.
```

---

### 4.5 Assessment & Question Bank Module

**Purpose:** Manages the question bank, exam generation, and attempt tracking.

#### 4.5.1 QuestionBank Requirements

- Belongs to exactly one `Subject`.
- `lesson_id` (FK, nullable) — optionally scoped to a specific lesson.
- `unit_tag` (string, nullable) — optionally scoped to a unit tag.
- `stem` (text, required) — the question text.
- `question_type` enum: `single_choice` (v1 scope; `multi_choice`, `true_false` in future).
- Has many `QuestionOption` records.
- `correct_option_id` (FK → QuestionOption) — the correct answer.
- `difficulty` enum: `easy` | `medium` | `hard` (optional, for future weighting).
- `is_active` (boolean) — inactive questions excluded from generation.

#### 4.5.2 QuestionOption Requirements

- Belongs to exactly one `QuestionBank` entry.
- `body` (string, required) — option text.
- `sort_order` (integer) — display order for the client.

#### 4.5.3 Exam Requirements

- `title` (string, required).
- `subject_id` (FK → Subject, required).
- `question_count` (unsigned integer, required) — how many questions to draw.
- `passing_score_percent` (unsigned tinyint) — e.g., `70` = must score 70% to pass.
- `time_limit_minutes` (unsigned integer, nullable) — null = no time limit.
- `unit_tags_filter` (JSON array, nullable) — restrict bank to these unit tags.
- `lesson_ids_filter` (JSON array, nullable) — restrict bank to these lesson IDs.
- `generation_strategy` enum: `random` (v1 scope).

#### 4.5.4 ExamTrigger Requirements

- Links an `Exam` to a `Lesson` as a progression gate.
- `exam_id` (FK → Exam).
- `lesson_id` (FK → Lesson) — the lesson **after which** the exam appears.
- `blocks_next_lesson` (boolean, default true) — if true, next lesson is locked until passed.
- Unique constraint: one trigger per lesson.

#### 4.5.5 ExamAttempt Requirements

- `student_id` (FK → students).
- `exam_id` (FK → Exam).
- `started_at` (timestamp).
- `submitted_at` (timestamp, nullable).
- `score_percent` (decimal 5,2, nullable — populated on submission).
- `status` enum: `in_progress` | `passed` | `failed` | `timed_out`.
- Has many `ExamAttemptAnswer` records.
- Business rule: a student may re-attempt a failed exam (no limit in v1).

#### 4.5.6 ExamAttemptAnswer Requirements

- Belongs to one `ExamAttempt`.
- `question_bank_id` (FK).
- `selected_option_id` (FK → QuestionOption, nullable — null if unanswered).
- `is_correct` (boolean, populated on submission).

#### 4.5.7 Exam Generation Process

```
Admin defines Exam config (subject, count, filters).
On student entry (GET /exams/{exam}/start):
  1. Fetch active QuestionBank entries filtered by:
     - subject_id = exam.subject_id
     - IF unit_tags_filter SET: unit_tag IN exam.unit_tags_filter
     - IF lesson_ids_filter SET: lesson_id IN exam.lesson_ids_filter
     - is_active = true
  2. Shuffle the result set.
  3. Take first exam.question_count entries.
  4. Create ExamAttempt record (status = in_progress).
  5. Create one ExamAttemptAnswer stub per selected question.
  6. Return attempt ID + questions (without correct_option_id — never exposed to client).
```

---

### 4.6 Library Module

**Purpose:** Central file repository accessible by subscribed students and all teachers.

#### 4.6.1 LibraryItem Requirements

| Field | Type | Description |
|---|---|---|
| `title` | string | Display name |
| `item_type` | enum | `government_book` \| `study_notes` \| `lesson_attachment` |
| `storage_path` | string | File path in storage disk |
| `file_size_bytes` | unsigned bigint | |
| `mime_type` | string | e.g., `application/pdf` |
| `classifiable_type` | string (morph) | Hierarchy node this item belongs to |
| `classifiable_id` | unsigned bigint | |
| `is_downloadable` | boolean | Whether the student can download (vs. in-app read only) |
| `sort_order` | integer | |
| `is_active` | boolean | |

**Classifiable targets (polymorphic):**
- `EducationalStage` — government books available for a full stage.
- `EducationalSubStage` — notes specific to a sub-stage track.
- `CourseType` — notes for a specific course session.
- `Subject` — reference material for a subject.
- `Lesson` — the lesson's PDF attachment is also surfaced here as `lesson_attachment` type.

#### 4.6.2 Library Access Rules

- `government_book` items: accessible to all authenticated users regardless of subscription.
- `study_notes` items: accessible if the student has an active subscription covering the
  item's classifiable node (same resolution algorithm as content access).
- `lesson_attachment` items: accessible if the student has access to that lesson (subscription
  + progression check).
- Signed temporary URLs for all file downloads (15-minute TTL).

---

### 4.7 Communication Module

**Purpose:** Lesson-scoped one-to-one communication channels between students and teachers.

#### 4.7.1 ConversationChannel Requirements

- `lesson_id` (FK → Lesson).
- `student_id` (FK → students).
- `teacher_id` (FK → teachers) — resolved from the lesson's `TeacherAssignment` at channel creation.
- `created_at` (timestamp).
- **Unique constraint:** `(lesson_id, student_id)` — one channel per student per lesson.
- A channel is created automatically when the student sends their first message on a lesson.
- Teachers cannot initiate channels; they can only respond to existing ones.

#### 4.7.2 Message Requirements

| Field | Type | Description |
|---|---|---|
| `channel_id` | FK → ConversationChannel | |
| `sender_id` | FK → users | Can be student or teacher |
| `sender_type` | enum | `student` \| `teacher` |
| `message_type` | enum | `text` \| `voice` \| `image` \| `video` |
| `body` | text, nullable | Text content or caption |
| `attachment_path` | string, nullable | Storage path for media file |
| `attachment_mime_type` | string, nullable | |
| `attachment_size_bytes` | unsigned bigint, nullable | |
| `sent_at` | timestamp | |
| `read_at` | timestamp, nullable | Set when receiver opens the message |

#### 4.7.3 Message Type Validation Rules

| Type | `body` | `attachment_path` |
|---|---|---|
| `text` | Required | Must be NULL |
| `voice` | Must be NULL | Required (audio/* mime) |
| `image` | Optional (caption) | Required (image/* mime) |
| `video` | Optional (caption) | Required (video/* mime) |

#### 4.7.4 Channel Authorization Rules

- A teacher may only read/write messages in channels where `channel.teacher_id = auth()->id()`.
- A student may only read/write messages in channels where `channel.student_id = auth()->id()`.
- A teacher may not access conversation channels on lessons they are not assigned to,
  even if the lesson belongs to a subject they teach.
- Authorization is enforced at the Policy layer (not just middleware).

---

### 4.8 CMS Module

**Purpose:** Admin-managed static informational pages surfaced on the Website client.

#### 4.8.1 StaticPage Requirements

| Field | Type | Description |
|---|---|---|
| `slug` | string, unique | URL identifier, e.g., `about-us`, `contact` |
| `title` | string | Page heading |
| `content` | longtext | Rich text / HTML body |
| `is_published` | boolean | |
| `meta_title` | string, nullable | SEO title |
| `meta_description` | string, nullable | SEO description |
| `sort_order` | integer | Menu ordering |

- Default pages seeded: `about-us`, `about-center`, `contact-us`.
- Public endpoint — no authentication required to read published pages.

---

## 5. Entity Specifications

### 5.1 User System

The system uses a **single `users` table** with role discrimination via a `role` enum,
plus two detail tables (`students`, `teachers`) that extend `users` with role-specific fields.

#### users

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `name` | string | Full display name |
| `phone` | string, unique | Primary identifier for login |
| `email` | string, nullable, unique | Optional |
| `password` | string | Bcrypt hashed |
| `role` | enum | `admin` \| `teacher` \| `student` |
| `status` | enum | `active` \| `suspended` |
| `last_login_at` | timestamp, nullable | |
| `created_at` | timestamp | |
| `updated_at` | timestamp | |
| `deleted_at` | timestamp, nullable | Soft delete |

#### students (extends users)

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `user_id` | FK → users, unique | |
| `date_of_birth` | date, nullable | |
| `guardian_phone` | string, nullable | |
| `address` | string, nullable | |
| `registration_number` | string, unique, nullable | Center-assigned ID |

#### teachers (extends users)

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `user_id` | FK → users, unique | |
| `bio` | text, nullable | Displayed on lesson cards |
| `profile_photo_path` | string, nullable | |
| `specialization` | string, nullable | e.g., "Mathematics" |

### 5.2 Hierarchy Entities

#### educational_stages

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `name` | string | e.g., "Secondary Education" |
| `description` | text, nullable | |
| `sort_order` | unsigned smallint | |
| `is_active` | boolean, default true | |
| `created_at` / `updated_at` | timestamps | |

#### educational_sub_stages

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `stage_id` | FK → educational_stages | |
| `name` | string | e.g., "Scientific Track" |
| `sort_order` | unsigned smallint | |
| `is_active` | boolean | |

#### course_types

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `sub_stage_id` | FK → educational_sub_stages | |
| `name` | string | e.g., "Winter Course 2026" |
| `academic_year` | string, nullable | e.g., "2025-2026" |
| `sort_order` | unsigned smallint | |
| `is_active` | boolean | |

### 5.3 Catalog Entities

#### subjects

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `course_type_id` | FK → course_types | |
| `name` | string | e.g., "Mathematics" |
| `description` | text, nullable | |
| `cover_image_path` | string, nullable | |
| `sort_order` | unsigned smallint | |
| `is_active` | boolean | |

#### subject_categories

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `subject_id` | FK → subjects | |
| `name` | string | e.g., "Algebra" |
| `sort_order` | unsigned smallint | |
| `is_active` | boolean | |

### 5.4 Content Entities

#### lessons

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `subject_category_id` | FK → subject_categories | |
| `teacher_id` | FK → teachers | Denormalized from assignment for query speed |
| `title` | string | |
| `description` | text, nullable | |
| `unit_tag` | string | e.g., "unit_1", "unit_2" |
| `sort_order` | unsigned smallint | Within the category |
| `is_published` | boolean, default false | |
| `created_at` / `updated_at` | timestamps | |
| `deleted_at` | timestamp, nullable | Soft delete |

> `teacher_id` is denormalized on `lessons` for join performance. The authoritative
> assignment record is also stored in `lesson_teacher_assignments` for audit trail.

#### lesson_teacher_assignments

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `lesson_id` | FK → lessons, unique | One teacher per lesson |
| `teacher_id` | FK → teachers | |
| `assigned_at` | timestamp | |
| `assigned_by` | FK → users | Admin who assigned |

#### video_files

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `lesson_id` | FK → lessons | |
| `quality` | enum | `low` \| `medium` \| `high` |
| `storage_path` | string | |
| `mime_type` | string | |
| `file_size_bytes` | unsigned bigint | |
| `duration_seconds` | unsigned int | |
| Unique | `(lesson_id, quality)` | One file per quality per lesson |

#### lesson_attachments

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `lesson_id` | FK → lessons, unique | One PDF per lesson |
| `storage_path` | string | |
| `original_filename` | string | |
| `file_size_bytes` | unsigned bigint | |

### 5.5 Subscription Entity

#### subscriptions

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `student_id` | FK → students | |
| `subscribable_type` | string | Morph type |
| `subscribable_id` | unsigned bigint | Morph ID |
| `status` | enum | `pending` \| `active` \| `expired` \| `cancelled` |
| `activated_at` | timestamp, nullable | |
| `expires_at` | timestamp, nullable | NULL = perpetual |
| `activated_by` | FK → users, nullable | Admin reference |
| `notes` | text, nullable | |
| `created_at` / `updated_at` | timestamps | |

**Indexes required:**
- `(student_id, status)` — for access check queries.
- `(subscribable_type, subscribable_id)` — polymorphic join index.
- `(student_id, subscribable_type, subscribable_id)` — uniqueness check.

### 5.6 Assessment Entities

#### question_bank

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `subject_id` | FK → subjects | |
| `lesson_id` | FK → lessons, nullable | Optional lesson scope |
| `unit_tag` | string, nullable | Optional unit scope |
| `stem` | text | Question text |
| `question_type` | enum | `single_choice` |
| `difficulty` | enum | `easy` \| `medium` \| `hard` |
| `is_active` | boolean | |
| `created_by` | FK → users | |

#### question_options

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `question_id` | FK → question_bank | |
| `body` | string | |
| `sort_order` | unsigned tinyint | |

#### questions.correct_option_id

> Stored on `question_bank` as `correct_option_id` FK → `question_options.id`.
> **Never included in API responses to students.**

#### exams

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `title` | string | |
| `subject_id` | FK → subjects | |
| `question_count` | unsigned smallint | |
| `passing_score_percent` | unsigned tinyint | 0–100 |
| `time_limit_minutes` | unsigned smallint, nullable | |
| `unit_tags_filter` | JSON, nullable | e.g., `["unit_1","unit_2"]` |
| `lesson_ids_filter` | JSON, nullable | |
| `generation_strategy` | enum | `random` |
| `created_by` | FK → users | |

#### exam_triggers

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `exam_id` | FK → exams | |
| `lesson_id` | FK → lessons, unique | Gate appears after this lesson |
| `blocks_next_lesson` | boolean, default true | |

#### exam_attempts

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `exam_id` | FK → exams | |
| `student_id` | FK → students | |
| `started_at` | timestamp | |
| `submitted_at` | timestamp, nullable | |
| `score_percent` | decimal(5,2), nullable | |
| `status` | enum | `in_progress` \| `passed` \| `failed` \| `timed_out` |

#### exam_attempt_answers

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `attempt_id` | FK → exam_attempts | |
| `question_id` | FK → question_bank | |
| `selected_option_id` | FK → question_options, nullable | |
| `is_correct` | boolean, nullable | Populated on submission |

### 5.7 Library Entity

#### library_items

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `title` | string | |
| `item_type` | enum | `government_book` \| `study_notes` \| `lesson_attachment` |
| `storage_path` | string | |
| `file_size_bytes` | unsigned bigint | |
| `mime_type` | string | |
| `classifiable_type` | string | Morph |
| `classifiable_id` | unsigned bigint | Morph |
| `is_downloadable` | boolean | |
| `sort_order` | unsigned smallint | |
| `is_active` | boolean | |

### 5.8 Communication Entities

#### conversation_channels

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `lesson_id` | FK → lessons | |
| `student_id` | FK → students | |
| `teacher_id` | FK → teachers | Copied from lesson assignment at creation time |
| `created_at` | timestamp | |
| Unique | `(lesson_id, student_id)` | One channel per student per lesson |

#### messages

| Column | Type | Notes |
|---|---|---|
| `id` | unsigned bigint PK | |
| `channel_id` | FK → conversation_channels | |
| `sender_id` | FK → users | |
| `sender_type` | enum | `student` \| `teacher` |
| `message_type` | enum | `text` \| `voice` \| `image` \| `video` |
| `body` | text, nullable | |
| `attachment_path` | string, nullable | |
| `attachment_mime_type` | string, nullable | |
| `attachment_size_bytes` | unsigned bigint, nullable | |
| `sent_at` | timestamp | |
| `read_at` | timestamp, nullable | |

---

## 6. Business Rules & Validation Constraints

### BR-001: One Teacher Per Lesson
A lesson must have exactly one teacher assignment. Assigning a second teacher to the same
lesson must be rejected with a `422` response. To reassign, the existing assignment must
be removed first.

### BR-002: Teacher Scope Isolation
A teacher's read/write access is strictly bounded to lessons in `lesson_teacher_assignments`
where `teacher_id = auth()->id()`. This is enforced at the Policy layer on every request,
not just at the route middleware level.

### BR-003: Subscription Required for Content
Any attempt to fetch a `VideoFile` signed URL or a `LessonAttachment` signed URL must first
pass the subscription resolution check (§4.4.2). A `403 SUBSCRIPTION_REQUIRED` response is
returned with the subscribable hierarchy path in `error.details` so the client can display
what the student needs to subscribe to.

### BR-004: Progression Gate is Server-Enforced
The progression gate check (§4.4.3) is evaluated server-side on every `GET /lessons/{id}`
request for a student. Client-side locked states are UI hints only. The server is the
authoritative gate-keeper.

### BR-005: Exam Questions Are Randomized Per Attempt
A new `ExamAttempt` always generates a fresh random selection from the question bank.
Two attempts by the same student on the same exam will typically receive different question
sets (subject to pool size).

### BR-006: Correct Answer Never Exposed
`correct_option_id` from `question_bank` must never appear in any API response to a
`student` role. It is only used server-side during attempt scoring. PHPStan and code review
must enforce this.

### BR-007: Channel Teacher Must Match Lesson Assignment
When a student sends a message on a lesson, the system resolves the `teacher_id` from
`lesson_teacher_assignments`. If the lesson has no teacher assignment, the channel cannot
be created and a `422 LESSON_HAS_NO_TEACHER` error is returned.

### BR-008: Message Type Attachment Constraints
Validated by a dedicated `MessageTypeRule` custom validation rule applied in all message
request classes:

```
type = text  → body required, attachment_path MUST be null
type = voice → body MUST be null, attachment_path required, mime MUST match audio/*
type = image → body optional, attachment_path required, mime MUST match image/*
type = video → body optional, attachment_path required, mime MUST match video/*
```

### BR-009: Video Quality Uniqueness Per Lesson
Only one `VideoFile` per `(lesson_id, quality)` combination. Uploading a `high` quality
video when one already exists must trigger a replacement flow (soft-delete old, insert new),
not a duplicate insert.

### BR-010: Subscription Activation is Admin-Only
The `status` field on `Subscription` may only transition to `active` via an authenticated
admin user. Students and teachers have no endpoint that modifies subscription status.

### BR-011: Inactive Hierarchy Nodes Hidden From Clients
`is_active = false` on any hierarchy node (`EducationalStage`, `EducationalSubStage`,
`CourseType`, `Subject`, `SubjectCategory`) causes that node and all its descendants to be
excluded from all client API responses. Filament panel always shows all nodes regardless.

### BR-012: Lesson Sort Order Governs Progression
Progression gates are evaluated based on `lessons.sort_order` within `subject_category_id`.
Sort order must be unique per category. Gaps are allowed but the next lesson is always the
one with the next highest `sort_order`.

---

## 7. API Surface Overview

All endpoints are prefixed with `/api/v1/`. Authentication via `Authorization: Bearer {token}`.
Client identity is inferred from the authenticated token's role; client-specific route files
provide additional middleware grouping.

### 7.1 Auth Endpoints (Common)

| Method | Endpoint | Description |
|---|---|---|
| POST | `/auth/login` | Login with phone + password. Returns token. |
| POST | `/auth/logout` | Revoke current token. |
| GET | `/auth/me` | Return authenticated user profile. |

### 7.2 Hierarchy Endpoints (Common — read, Admin — write)

| Method | Endpoint | Access |
|---|---|---|
| GET | `/stages` | All roles |
| GET | `/stages/{id}/sub-stages` | All roles |
| GET | `/sub-stages/{id}/course-types` | All roles |
| POST/PUT/DELETE | `/stages`, `/sub-stages`, `/course-types` | Admin only |

### 7.3 Catalog Endpoints

| Method | Endpoint | Access |
|---|---|---|
| GET | `/subjects` | All roles (filtered by sub-stage or course-type) |
| GET | `/subjects/{id}/categories` | All roles |
| POST/PUT/DELETE | `/subjects`, `/subject-categories` | Admin only |

### 7.4 Content Endpoints

| Method | Endpoint | Client | Notes |
|---|---|---|---|
| GET | `/lessons` | StudentApp, StudentDesktop, Website | Returns locked status per lesson |
| GET | `/lessons/{id}` | StudentApp, StudentDesktop, Website | Subscription + progression check |
| GET | `/lessons/{id}/video-url` | StudentApp, StudentDesktop, Website | Returns signed URL for selected quality |
| GET | `/lessons/{id}/attachment-url` | StudentApp, StudentDesktop, Website | Returns signed PDF URL |
| GET | `/teacher/lessons` | TeacherApp | Own assigned lessons only |
| GET | `/teacher/lessons/{id}` | TeacherApp | Own lesson detail |
| POST/PUT | `/admin/lessons` | AdminPanel (Filament) | Via Filament resource |

### 7.5 Subscription Endpoints

| Method | Endpoint | Access |
|---|---|---|
| GET | `/student/subscriptions` | Student — own subscriptions |
| POST | `/admin/subscriptions` | Admin — create + activate |
| PATCH | `/admin/subscriptions/{id}/activate` | Admin |
| PATCH | `/admin/subscriptions/{id}/cancel` | Admin |

### 7.6 Assessment Endpoints

| Method | Endpoint | Access |
|---|---|---|
| GET | `/lessons/{id}/exam` | Student — get pending exam for lesson |
| POST | `/exams/{id}/start` | Student — create attempt + get questions |
| POST | `/exam-attempts/{id}/submit` | Student — submit answers, get score |
| GET | `/teacher/lessons/{id}/exam-results` | Teacher — view attempt results |
| POST/PUT | `/admin/question-bank` | Admin |
| POST/PUT | `/admin/exams` | Admin |

### 7.7 Library Endpoints

| Method | Endpoint | Access |
|---|---|---|
| GET | `/library` | All roles (filtered by subscription) |
| GET | `/library/{id}/download-url` | All roles (subscription check) |
| POST/PUT/DELETE | `/admin/library` | Admin only |

### 7.8 Communication Endpoints

| Method | Endpoint | Access |
|---|---|---|
| GET | `/lessons/{id}/channel` | Student — get or create own channel |
| GET | `/lessons/{id}/channel/messages` | Student + Teacher |
| POST | `/lessons/{id}/channel/messages` | Student (initiate) + Teacher (reply) |
| GET | `/teacher/channels` | Teacher — all channels for assigned lessons |
| PATCH | `/messages/{id}/read` | Mark message as read |

---

## 8. Non-Functional Requirements

### 8.1 Performance

| Metric | Target |
|---|---|
| API response time (p95) | < 300ms for read endpoints |
| Signed URL generation | < 100ms |
| Exam generation (100 questions pool) | < 500ms |
| Concurrent users (v1) | 200 simultaneous |

### 8.2 Security

- All API traffic over HTTPS (TLS 1.2+).
- Sanctum tokens stored hashed in `personal_access_tokens`.
- Token expiry: 30 days (configurable per environment).
- Signed video/PDF URLs: 15-minute TTL, non-renewable without re-authentication.
- Rate limiting: 60 req/min general, 10 req/min on `/auth/login`.
- All file uploads validated for MIME type server-side (not just extension).
- SQL injection prevented by exclusive use of Eloquent query builder.
- `X-Content-Type-Options`, `X-Frame-Options`, `Referrer-Policy` headers via middleware.

### 8.3 Reliability

- Queue workers for file processing (video upload confirmation, signed URL cache warm-up).
- Failed queue jobs retry 3 times with exponential backoff.
- Database connection pooling via PgBouncer or MySQL ProxySQL in production.

### 8.4 Scalability

- Storage layer abstracted via Laravel Filesystem — swap local → S3 via `.env` only.
- Redis for cache (`subscription_access:{student_id}:{lesson_id}`, TTL 5 min).
- Horizontal scaling ready (stateless API, sessions only for Filament).

---

## 9. Data Integrity & Database Contracts

- Foreign keys enforced at the database level (InnoDB).
- Cascade deletes:
  - `educational_stages` → `educational_sub_stages` → `course_types` (cascade delete).
  - `lessons` → `video_files`, `lesson_attachments`, `lesson_teacher_assignments` (cascade delete).
  - `exam_attempts` → `exam_attempt_answers` (cascade delete).
  - `conversation_channels` → `messages` (cascade delete).
- Soft deletes on `users`, `lessons`, `subjects`, `subscriptions` — no hard deletes in production.
- All schema changes via versioned migrations. Migration file naming: `YYYY_MM_DD_HHMMSS_{description}`.
- `question_bank.correct_option_id` is a deferred FK (checked after options are inserted).

---

## 10. Out of Scope

The following are **explicitly excluded** from v1 delivery:

| Feature | Notes |
|---|---|
| Live streaming | No real-time broadcast. VoD only. |
| Online payment / payment gateway | Manual center payment only. |
| Student self-registration | Admin creates student accounts. |
| Parent portal | No guardian-facing interface. |
| Push notifications | Future scope. |
| Multi-language UI | Arabic content, single locale in v1. |
| Course completion certificates | Future scope. |
| Discussion forums (group) | Only 1-to-1 lesson channels in v1. |
| Video transcoding pipeline | Videos uploaded pre-transcoded by admin. |
| Analytics / reporting dashboard | Future scope. |
| Mobile app store deployment | Infrastructure; outside code delivery scope. |

---

*SRD-LMS-003 | EduCore LMS | Version 1.0.0 | 2026-05-23 | Confidential*
*Next: `docs/MODULE_STRUCTURE.md` — per-module file and class scaffolding guide.*

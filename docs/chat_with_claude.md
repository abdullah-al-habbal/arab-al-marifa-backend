I'll build this file by file, starting with `CLAUDE.md` — the master context file that bootstraps development for any AI or developer picking up this codebase.

---**`CLAUDE.md` is complete.** Here's what it covers and why each section matters:

**Sections breakdown:**

Section 1–3 give any developer or AI session immediate orientation: what the system is, who the clients are, and what was decided (Platinum package = Flutter everywhere).

Section 4 is the locked tech stack — no ambiguity allowed mid-development.

Section 5 is the most critical: the **Action → Handler → Resolver** pattern with its exact rules. The three laws (no Eloquent in Handlers, no logic in Resolvers, no HTTP in Handlers) prevent architectural drift in a long project.

Section 6 lists all domain modules with their priority order, so any session knows what depends on what.

Sections 7–10 cover the four hardest domain problems: the educational hierarchy tree, the polymorphic subscription access resolution algorithm, the exam generation from a tagged question bank, and the lesson-scoped chat channels with their type constraints.

Section 11 documents the DRM implementation per platform — critical for the Platinum package promise.

Sections 12–19 are the engineering contracts: API envelope format, HTTP status codes, security rules, DB conventions, code style, and the non-negotiable architectural constraints written as laws, not suggestions.

**Next file to build:** `docs/SRD.md` — the full Software Requirements Document with all entities, constraints, and validation rules. Ready when you are.

**`docs/SRD.md` is complete.** Here's a breakdown of what each section resolves and why it was structured this way:

**Sections 1–2** anchor the document — the system diagram as ASCII art makes the client boundary immediately obvious to any developer without needing an external tool.

**Section 3** (Permission Matrix) is a binary table — no ambiguity, no prose interpretation. Every role × action combination has a definitive answer.

**Section 4** (Domain Modules) is the core. Each of the 8 modules has its own subsection with fields, constraints, and the exact algorithm for complex logic. Notable decisions worth calling out:

- **Unit as tagging** (§4.3.1) — instead of a rigid `units` FK chain, lessons carry a `unit_tag` string. This is the key to the polymorphic question bank filtering and avoids a 7-level join on every lesson query.
- **Subscription access resolution** (§4.4.2) is written as pseudocode that maps directly to a single Eloquent `orWhere` query — a developer can implement it literally from the spec.
- **Exam generation** (§4.5.7) is a numbered procedure — removes all ambiguity about when the random draw happens and what fields control it.
- **Message type constraint table** (§4.7.3) maps directly to the `MessageTypeRule` custom rule class mentioned in BR-008.

**Section 6** (12 Business Rules) are numbered `BR-XXX` so they can be referenced in PR reviews, test cases, and bug reports with no ambiguity.

**Section 10** (Out of Scope) is as important as everything above it — it closes the door on scope creep before it starts.

**Next files to build:**
- `docs/MODULE_STRUCTURE.md` — per-module scaffold with all class names and file paths
- `docs/API_CONTRACTS.md` — full request/response shapes per endpoint
- `composer.json` patch for the `Modules\` namespace

**`docs/MODULE_STRUCTURE.md` is complete.** Here's a breakdown of what makes each section actionable rather than just descriptive:

**Section 1** gives the exact `composer.json` patch and the resulting project root layout — a developer can clone the repo and know exactly where every file lives before writing a single line of code.

**Section 2** defines the canonical internal module layout as a template applied identically to all 9 modules. The namespace pattern `Modules\{Module}\{Layer}\{Client}\{Class}` is the single rule that governs every file path in the project.

**Section 3** ships the actual base class implementations — `BaseAction`, `BaseHandler`, `BaseResolver`, `BaseData` — with real PHP code. These are the contracts every layer class extends, and they enforce the separation rules structurally rather than by convention.

**Sections 4–12** cover all 9 modules in implementation priority order. Each module section contains the complete file tree down to individual class names, endpoint comments on every Action file, and resolver method signatures where the logic is non-trivial. Notably:

- The **Subscription** module documents `ResolveStudentAccessHandler` as a shared cross-module dependency and marks it as the single authority for access resolution — it cannot be duplicated.
- The **Assessment** module includes the actual Eloquent select exclusion snippet for `correct_option_id` — the security requirement that must survive a code review.
- The **Communication** module shows `MessageTypeRule` as a custom rule class in its own `Rules/` folder, separate from Requests.

**Section 13** shows the full `routes/api.php` router — middleware grouping per client, prefix strategy, and module route file import order — so route conflicts are impossible.

**Section 15** is the code review reference: the anti-pattern table is what a reviewer checks before approving any PR in this project.

**Next files in the sequence:**
- `docs/API_CONTRACTS.md` — full request/response payload shapes per endpoint
- `docs/DATABASE_SCHEMA.md` — migration order, index strategy, and FK diagram

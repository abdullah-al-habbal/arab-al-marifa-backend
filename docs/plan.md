# Filament Resource Refactoring Plan

## Goal
Refactor all 23 Filament Resource files to follow the standardized pattern with:
- `getNavigationIcon()`, `getNavigationGroup()`, `getNavigationBadge()`, `getNavigationBadgeColor()`
- `getNavigationLabel()`, `getModelLabel()`, `getPluralModelLabel()`
- Delegated `form()`, `infolist()`, `table()` to external Schemas/Tables classes
- `getRelations()`, `getPages()` with View pages
- All labels translated via `__('app.{key}')` and `__('filament.navigation.groups.{group}')`

## Modules (23 total)

| Module | Icon | Group | Sort | Record Field |
|--------|------|-------|------|--------------|
| User | users | people | 1 | name |
| Student | academic-cap | people | 2 | name |
| Teacher | presentation-chart-bar | people | 3 | name |
| EducationalStage | building-library | hierarchy | 1 | name |
| EducationalSubStage | adjustments-vertical | hierarchy | 2 | name |
| CourseType | rectangle-stack | hierarchy | 3 | name |
| Subject | book-open | catalog | 1 | name |
| SubjectCategory | tag | catalog | 2 | name |
| Unit | cube | catalog | 3 | name |
| Lesson | play-circle | content | 1 | title |
| VideoFile | video-camera | content | 2 | quality |
| LessonAttachment | paper-clip | content | 3 | original_filename |
| Subscription | credit-card | subscription | 1 | id |
| QuestionBank | question-mark-circle | assessment | 1 | stem |
| Question | question-mark-circle | assessment | 2 | body |
| QuestionOption | list-bullet | assessment | 3 | body |
| Exam | document-text | assessment | 4 | title |
| ExamAttempt | clipboard-document-list | assessment | 5 | id |
| LibraryItem | bookmark | library | 1 | title |
| ConversationChannel | chat-bubble-left-right | communication | 1 | id |
| Message | envelope | communication | 2 | body |
| MessageAttachment | paper-clip | communication | 3 | id |
| StaticPage | document | cms | 1 | title |

## File Structure Per Module

```
modules/{Module}/Filament/Panel/
├── {Module}Resource.php              ← Rewritten: delegates to Schemas, Tables, Pages
├── Pages/
│   ├── List{Plural}.php              ← Existing (no change needed)
│   ├── Create{Model}.php             ← Existing (no change needed)
│   ├── View{Model}.php               ← NEW
│   └── Edit{Model}.php               ← Existing (no change needed)
├── Schemas/
│   ├── {Model}Form.php               ← NEW
│   └── {Model}Infolist.php           ← NEW
└── Tables/
    └── {Model}Table.php              ← NEW
```

## Files Created/Modified

| Category | New | Modified |
|----------|-----|----------|
| docs/plan.md | 1 | 0 |
| lang/en/app.php | 1 | 0 |
| lang/ar/app.php | 1 | 0 |
| lang/en/filament.php | 1 | 0 |
| config/app.php | 0 | 1 |
| Schemas/{Model}Form.php | 23 | 0 |
| Schemas/{Model}Infolist.php | 23 | 0 |
| Tables/{Model}Table.php | 23 | 0 |
| Pages/View{Model}.php | 23 | 0 |
| {Module}Resource.php | 0 | 23 |
| **Total** | **96 new** | **24 modified** |

## Pattern: New Resource File

```php
<?php
declare(strict_types=1);

namespace Modules\{Module}\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\{Module}\Models\{Module};
use Modules\{Module}\Filament\Panel\Pages\List{Plural};
use Modules\{Module}\Filament\Panel\Pages\Create{Module};
use Modules\{Module}\Filament\Panel\Pages\View{Module};
use Modules\{Module}\Filament\Panel\Pages\Edit{Module};
use Modules\{Module}\Filament\Panel\Schemas\{Module}Form;
use Modules\{Module}\Filament\Panel\Schemas\{Module}Infolist;
use Modules\{Module}\Filament\Panel\Tables\{Module}Table;

class {Module}Resource extends Resource
{
    protected static ?string $model = {Module}::class;
    protected static ?int $navigationSort = {n};
    protected static ?string $recordTitleAttribute = '{field}';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-{icon}';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.{group}');
    }

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'primary';
    }

    public static function getNavigationLabel(): string
    {
        return __('app.{plural_slug}');
    }

    public static function getModelLabel(): string
    {
        return __('app.{singular_slug}');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.{plural_slug}');
    }

    public static function form(Schema $schema): Schema
    {
        return {Module}Form::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return {Module}Infolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return {Module}Table::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => List{Plural}::route('/'),
            'create' => Create{Module}::route('/create'),
            'view' => View{Module}::route('/{record}'),
            'edit' => Edit{Module}::route('/{record}/edit'),
        ];
    }
}
```

## Pattern: Schemas/{Model}Form.php

```php
<?php
declare(strict_types=1);

namespace Modules\{Module}\Filament\Panel\Schemas;

use Filament\Schemas\Schema;

class {Module}Form
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            // All form components with ->label(__('app.{field}'))
        ]);
    }
}
```

## Pattern: Schemas/{Model}Infolist.php

```php
<?php
declare(strict_types=1);

namespace Modules\{Module}\Filament\Panel\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class {Module}Infolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            TextEntry::make('{field}')->label(__('app.{field}')),
            // ...
        ])->columns(2);
    }
}
```

## Pattern: Tables/{Model}Table.php

```php
<?php
declare(strict_types=1);

namespace Modules\{Module}\Filament\Panel\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class {Module}Table
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('{field}')->label(__('app.{field}'))->searchable()->sortable(),
                // ...
            ])
            ->filters([])
            ->recordActions([])
            ->toolbarActions([]);
    }
}
```

## Pattern: Pages/View{Model}.php

```php
<?php
declare(strict_types=1);

namespace Modules\{Module}\Filament\Panel\Pages;

use Filament\Resources\Pages\ViewRecord;
use Modules\{Module}\Filament\Panel\{Module}Resource;

class View{Module} extends ViewRecord
{
    protected static string $resource = {Module}Resource::class;
}
```

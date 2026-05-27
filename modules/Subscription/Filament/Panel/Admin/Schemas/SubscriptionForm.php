<?php
declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Admin\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('student_id')
                ->label(__('app.student_id'))
                ->relationship('student', 'id')
                ->required(),
            Select::make('subscribable_type')
                ->label(__('app.subscribable_type'))
                ->options([
                    'Modules\EducationalStage\Models\EducationalStage' => __('app.educational_stage'),
                    'Modules\EducationalSubStage\Models\EducationalSubStage' => __('app.educational_sub_stage'),
                    'Modules\Subject\Models\Subject' => __('app.subject'),
                    'Modules\SubjectCategory\Models\SubjectCategory' => __('app.subject_category'),
                ])
                ->required(),
            TextInput::make('subscribable_id')
                ->label(__('app.subscribable_id'))
                ->numeric()
                ->required(),
            Select::make('status')
                ->label(__('app.status'))
                ->options([
                    'pending' => __('app.pending'),
                    'active' => __('app.active'),
                    'expired' => __('app.expired'),
                    'cancelled' => __('app.cancelled'),
                ])
                ->default('pending')
                ->required(),
            DateTimePicker::make('activated_at')
                ->label(__('app.activated_at')),
            DateTimePicker::make('expires_at')
                ->label(__('app.expires_at')),
            Select::make('activated_by')
                ->label(__('app.activated_by'))
                ->relationship('activatedBy', 'name'),
            RichEditor::make('notes')
                ->label(__('app.notes')),
        ]);
    }
}

<?php

declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Modules\Subscription\Models\Subscription;

final class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Select::make('student_id')
                    ->relationship('student', 'id')
                    ->required(),
                Select::make('subscribable_type')
                    ->options([
                        'Modules\EducationalStage\Models\EducationalStage' => 'Educational Stage',
                        'Modules\EducationalSubStage\Models\EducationalSubStage' => 'Educational Sub Stage',
                        'Modules\Subject\Models\Subject' => 'Subject',
                        'Modules\SubjectCategory\Models\SubjectCategory' => 'Subject Category',
                    ])
                    ->required(),
                TextInput::make('subscribable_id')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->required(),
                DateTimePicker::make('activated_at'),
                DateTimePicker::make('expires_at'),
                Select::make('activated_by')
                    ->relationship('activatedBy', 'name'),
                RichEditor::make('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.id')
                    ->label('Student ID'),
                TextColumn::make('subscribable_type'),
                TextColumn::make('subscribable_id'),
                TextColumn::make('status'),
                TextColumn::make('activated_at')
                    ->dateTime(),
                TextColumn::make('expires_at')
                    ->dateTime(),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptions::route('/'),
            'create' => CreateSubscription::route('/create'),
            'edit' => EditSubscription::route('/{record}/edit'),
        ];
    }

    public static function getRelations(): array
    {
        return [];
    }
}

final class ListSubscriptions extends \Filament\Resources\Pages\ListRecords
{
    protected static string $resource = SubscriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

final class CreateSubscription extends \Filament\Resources\Pages\CreateRecord
{
    protected static string $resource = SubscriptionResource::class;
}

final class EditSubscription extends \Filament\Resources\Pages\EditRecord
{
    protected static string $resource = SubscriptionResource::class;
}

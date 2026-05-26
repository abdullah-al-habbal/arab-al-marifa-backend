<?php
declare(strict_types=1);

namespace Modules\VideoFile\Filament\Panel;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\VideoFile\Models\VideoFile;
use Modules\VideoFile\Filament\Panel\Pages\ListVideoFiles;
use Modules\VideoFile\Filament\Panel\Pages\CreateVideoFile;
use Modules\VideoFile\Filament\Panel\Pages\ViewVideoFile;
use Modules\VideoFile\Filament\Panel\Pages\EditVideoFile;
use Modules\VideoFile\Filament\Panel\Schemas\VideoFileForm;
use Modules\VideoFile\Filament\Panel\Schemas\VideoFileInfolist;
use Modules\VideoFile\Filament\Panel\Tables\VideoFilesTable;

class VideoFileResource extends Resource
{
    protected static ?string $model = VideoFile::class;

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'quality';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-video-camera';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.content');
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
        return __('app.video_files');
    }

    public static function getModelLabel(): string
    {
        return __('app.video_file');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.video_files');
    }

    public static function form(Schema $schema): Schema
    {
        return VideoFileForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VideoFileInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VideoFilesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVideoFiles::route('/'),
            'create' => CreateVideoFile::route('/create'),
            'view' => ViewVideoFile::route('/{record}'),
            'edit' => EditVideoFile::route('/{record}/edit'),
        ];
    }
}

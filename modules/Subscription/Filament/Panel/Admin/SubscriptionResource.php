<?php
declare(strict_types=1);

namespace Modules\Subscription\Filament\Panel\Admin;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Modules\Subscription\Models\Subscription;
use Modules\Subscription\Filament\Panel\Admin\Pages\ListSubscriptions;
use Modules\Subscription\Filament\Panel\Admin\Pages\CreateSubscription;
use Modules\Subscription\Filament\Panel\Admin\Pages\ViewSubscription;
use Modules\Subscription\Filament\Panel\Admin\Pages\EditSubscription;
use Modules\Subscription\Filament\Panel\Admin\Schemas\SubscriptionForm;
use Modules\Subscription\Filament\Panel\Admin\Schemas\SubscriptionInfolist;
use Modules\Subscription\Filament\Panel\Admin\Tables\SubscriptionsTable;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'id';

    public static function getNavigationIcon(): string|BackedEnum|null
    {
        return 'heroicon-o-credit-card';
    }

    public static function getNavigationGroup(): ?string
    {
        return __('filament.navigation.groups.subscription');
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
        return __('app.subscriptions');
    }

    public static function getModelLabel(): string
    {
        return __('app.subscription');
    }

    public static function getPluralModelLabel(): string
    {
        return __('app.subscriptions');
    }

    public static function form(Schema $schema): Schema
    {
        return SubscriptionForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SubscriptionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubscriptionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSubscriptions::route('/'),
            'create' => CreateSubscription::route('/create'),
            'view' => ViewSubscription::route('/{record}'),
            'edit' => EditSubscription::route('/{record}/edit'),
        ];
    }
}

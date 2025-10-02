<?php

namespace App\Filament\Resources\PostTypes;

use App\Filament\Resources\PostTypes\Pages\CreatePostType;
use App\Filament\Resources\PostTypes\Pages\EditPostType;
use App\Filament\Resources\PostTypes\Pages\ListPostTypes;
use App\Filament\Resources\PostTypes\Schemas\PostTypeForm;
use App\Filament\Resources\PostTypes\Tables\PostTypesTable;
use App\Models\PostType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PostTypeResource extends Resource
{
    protected static ?string $model = PostType::class;
    protected static string| UnitEnum|null $navigationGroup = 'Blog Article';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Square2Stack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return PostTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPostTypes::route('/'),
            'create' => CreatePostType::route('/create'),
            'edit' => EditPostType::route('/{record}/edit'),
        ];
    }
}

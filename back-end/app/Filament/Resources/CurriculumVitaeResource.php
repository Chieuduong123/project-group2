<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurriculumVitaeResource\Pages;
use App\Filament\Resources\CurriculumVitaeResource\RelationManagers;
use App\Models\CurriculumVitae;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CurriculumVitaeResource extends Resource
{
    protected static ?string $model = CurriculumVitae::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('seeker_id')
                    ->required(),
                Forms\Components\TextInput::make('personal_detail_id')
                    ->required(),
                Forms\Components\TextInput::make('social_id')
                    ->required(),
                Forms\Components\Textarea::make('soft')
                    ->required(),
                Forms\Components\Textarea::make('tech')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('seeker_id'),
                Tables\Columns\TextColumn::make('personalDetail.last_name'),
                Tables\Columns\TextColumn::make('social_id'),
                Tables\Columns\TextColumn::make('soft'),
                Tables\Columns\TextColumn::make('tech'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
            'index' => Pages\ListCurriculumVitaes::route('/'),
            'create' => Pages\CreateCurriculumVitae::route('/create'),
            'edit' => Pages\EditCurriculumVitae::route('/{record}/edit'),
        ];
    }
}

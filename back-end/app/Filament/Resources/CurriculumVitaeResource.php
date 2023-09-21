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

    protected static ?string $navigationGroup = 'Management Jobs and others';
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('personalDetail.job_title')->label('Position')
                    ->required(),
                Forms\Components\Textarea::make('educations.location')->label('Education')
                    ->required(),
                Forms\Components\Textarea::make('soft')
                    ->required(),
                Forms\Components\Textarea::make('tech')
                    ->required(),
                Forms\Components\TextInput::make('social.github')->label('GitHub')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('seeker.name')->label('Name Seeker')->size('lg')->color('success')->weight('bold'),
                Tables\Columns\TextColumn::make('personalDetail.job_title')->label('Position'),
                Tables\Columns\TextColumn::make('educations.location')->label('Education'),
                Tables\Columns\TextColumn::make('soft')->size('sm'),
                Tables\Columns\TextColumn::make('tech')->size('sm'),
                Tables\Columns\TextColumn::make('social.github')->label('GitHub'),
                Tables\Columns\TextColumn::make('created_at')->size('sm')
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
            ])
            ->contentGrid([
                'md' => 4,
                'xl' => 2,
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

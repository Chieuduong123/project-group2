<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FavoriteResource\Pages;
use App\Filament\Resources\FavoriteResource\RelationManagers;
use App\Models\Favorite;
use App\Models\Job;
use App\Models\Seeker;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FavoriteResource extends Resource
{
    protected static ?string $model = Favorite::class;

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

                Select::make('seeker_id')
                    ->label('Seeker')
                    ->options(Seeker::all()->pluck('name', 'id')->toArray())
                    ->reactive(),
                Select::make('job_id')
                    ->label('Business')
                    ->options(Job::with('business')->get()->pluck('business.name')->toArray())
                    ->reactive()
                    ->searchable(),
                Select::make('job_id')
                    ->label('Job')
                    ->options(Job::first()->pluck('position')->toArray())
                    ->reactive()
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('seeker.name'),
                Tables\Columns\TextColumn::make('job.position'),
                Tables\Columns\TextColumn::make('job.business.name')->weight('bold')->searchable(),


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
            'index' => Pages\ListFavorites::route('/'),
            'create' => Pages\CreateFavorite::route('/create'),
            'edit' => Pages\EditFavorite::route('/{record}/edit'),
        ];
    }
}

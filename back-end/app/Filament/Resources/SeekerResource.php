<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeekerResource\Pages;
use App\Filament\Resources\SeekerResource\Pages\CreateSeeker;
use App\Filament\Resources\SeekerResource\Pages\EditSeeker;
use App\Filament\Resources\SeekerResource\RelationManagers;
use App\Models\Seeker;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class SeekerResource extends Resource
{
    protected static ?string $model = Seeker::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Management User';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('avatar')
                    ->disk('public')
                    ->path('avatars'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->maxLength(255)
                    ->dehydrateStateUsing(
                        static fn (null|string $state): null|string =>
                        filled($state) ? Hash::make($state) : null,
                    )->required(
                        static fn (Page $livewire): string =>
                        $livewire instanceof CreateSeeker,
                    )->dehydrated(
                        static fn (null|string $state): bool =>
                        filled($state),
                    )->label(
                        static fn (Page $livewire): string => ($livewire instanceof EditSeeker) ? 'New Password' : 'Password'
                    ),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birthday'),
                Forms\Components\TextInput::make('address')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('avatar'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('birthday')
                    ->date(),
                Tables\Columns\TextColumn::make('address'),
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
            'index' => Pages\ListSeekers::route('/'),
            'create' => Pages\CreateSeeker::route('/create'),
            'edit' => Pages\EditSeeker::route('/{record}/edit'),
        ];
    }
}

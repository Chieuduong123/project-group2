<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeekerResource\Pages;
use App\Models\Seeker;
use Filament\Forms;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Livewire\TemporaryUploadedFile;

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
                    ->preserveFilenames()
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return (string) str($file->getClientOriginalName())->prepend(now()->timestamp);
                    }),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('password')
                //     ->password()
                //     ->maxLength(255)
                //     ->dehydrateStateUsing(
                //         static fn (null|string $state): null|string =>
                //         filled($state) ? Hash::make($state) : null,
                //     )->required(
                //         static fn (Page $livewire): string =>
                //         $livewire instanceof CreateSeeker,
                //     )->dehydrated(
                //         static fn (null|string $state): bool =>
                //         filled($state),
                //     )->label(
                //         static fn (Page $livewire): string => ($livewire instanceof EditSeeker) ? 'New Password' : 'Password'
                //     ),
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
        $seeker = new Seeker();
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                // ImageColumn::make('avatar')
                //     ->defaultImageUrl(fn (Seeker $record) => asset('avatars' . '/' . $record->avatar)),
                Tables\Columns\ImageColumn::make('avatar')->url(fn ($record) => asset('avatars' . '/' . $record->avatar)),
                Tables\Columns\TextColumn::make('email')->icon('heroicon-s-mail')->size('sm'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('birthday')
                    ->date(),
                Tables\Columns\TextColumn::make('address'),
                Tables\Columns\TextColumn::make('created_at')
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

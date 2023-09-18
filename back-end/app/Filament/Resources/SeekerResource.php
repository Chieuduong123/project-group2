<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SeekerResource\Pages;
use App\Filament\Resources\SeekerResource\Pages\CreateSeeker;
use App\Filament\Resources\SeekerResource\Pages\EditSeeker;
use App\Models\Seeker;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Support\Facades\Hash;
use Livewire\TemporaryUploadedFile;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


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
                    ->getUploadedFileNameForStorageUsing(function (UploadedFile $file): string {
                        $filename = now()->timestamp . '_' . Str::random(8) . '.' . $file->getClientOriginalExtension();
                        return 'avatars/' . $filename;
                    }),
                // SpatieMediaLibraryFileUpload::make('avatar'),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state) {
                        $component->state('');
                    })
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
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
                Tables\Columns\ImageColumn::make('avatar')
                    ->disk('avatars')
                    ->visibility('private')
                    ->url(fn ($record) => asset('storage' . '/' . $record->avatar)),
                // Tables\Columns\ImageColumn::make('avatar')->url(function ($record) {
                //     return Storage::disk('avatars')->url('/' . $record->avatar);
                // }),
                // Tables\Columns\ImageColumn::make('avatar')
                //     ->label('Imagen')
                //     ->size(80)
                //     ->getValueUsing(
                //         fn ($record) => Storage::disk('products')->url($record->id . '/' . $record->file_name)
                //     ),
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

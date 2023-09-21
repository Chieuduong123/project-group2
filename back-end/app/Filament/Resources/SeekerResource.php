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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class SeekerResource extends Resource
{
    protected static ?string $model = Seeker::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Management User';
    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('avatar')
                    ->disk('avatars')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        return  time() . '.' . $file->getClientOriginalExtension();
                    }),
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
                Tables\Columns\TextColumn::make('name')->searchable(),
                // Tables\Columns\ImageColumn::make('avatar')
                //     ->disk('avatars')
                //     ->url(fn ($record) => asset('/' . $record->avatar)),
                Tables\Columns\ImageColumn::make('')
                    ->defaultImageUrl(function ($record) {
                        $avatar = $record->avatar ?? 'avatar.png';
                        return asset('/avatars' . '/' . $avatar);
                    })
                    ->url(fn ($record) => asset('/avatars' . '/' . $record->avatar)),
                Tables\Columns\TextColumn::make('email')->icon('heroicon-s-mail')->size('sm'),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('birthday')
                    ->date(),
                Tables\Columns\TextColumn::make('address')->searchable(),
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
                ExportBulkAction::make(),
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

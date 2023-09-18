<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessResource\Pages;
use App\Filament\Resources\BusinessResource\Pages\CreateBusiness;
use App\Filament\Resources\BusinessResource\Pages\EditBusiness;
use App\Filament\Resources\BusinessResource\RelationManagers;
use App\Filament\Resources\BusinessResource\Widgets\BusinessChart;
use App\Filament\Widgets\JobChart;
use App\Http\Services\SendEmailService;
use App\Models\Business;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Livewire\TemporaryUploadedFile;

class BusinessResource extends Resource
{
    protected static ?string $model = Business::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Management User';

    protected $emailService;

    public function __construct(SendEmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function update($record, array $data)
    {
        if ($data['status'] ?? false) {
            $emailService = app(SendEmailService::class);
            $emailService->sendVerificationEmail($record->email);
        }

        parent::update($record, $data);
    }

    public static function form(Form $form, ?int $id = null): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
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
                Forms\Components\FileUpload::make('avatar')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file): string {
                        $fileName = $file->getClientOriginalExtension();
                        $name = explode('.', $fileName);
                        return (string) str('avatars/' . $name[0] . '.png');
                    }),
                Forms\Components\TextInput::make('location')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('website')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('career')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('size')
                    ->required(),
                Forms\Components\Toggle::make('status')->label('Approve')
                    ->required()
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('name')->weight('bold')->searchable(),
                Tables\Columns\ImageColumn::make('avatar')
                    ->disk('public')
                    ->url(fn ($record) => asset('/' . $record->avatar)),
                Tables\Columns\TextColumn::make('email')->icon('heroicon-s-mail')->size('sm'),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('location'),
                Tables\Columns\TextColumn::make('website'),
                Tables\Columns\TextColumn::make('career'),
                Tables\Columns\TextColumn::make('size'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                Filter::make('approved')->query(fn (Builder $query): Builder => $query->where('status', true)),
                Filter::make('unapproved')->query(fn (Builder $query): Builder => $query->where('status', false)),
                SelectFilter::make('location')
                    ->multiple()
                    ->options(Business::pluck('location', 'location')->unique()->toArray())
                    ->attribute('location'),
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

    public static function getWidgets(): array
    {
        return [
            BusinessChart::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBusinesses::route('/'),
            'create' => Pages\CreateBusiness::route('/create'),
            'edit' => Pages\EditBusiness::route('/{record}/edit'),
        ];
    }
}

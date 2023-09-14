<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BusinessResource\Pages;
use App\Filament\Resources\BusinessResource\Pages\CreateBusiness;
use App\Filament\Resources\BusinessResource\Pages\EditBusiness;
use App\Filament\Resources\BusinessResource\RelationManagers;
use App\Filament\Resources\BusinessResource\Widgets\BusinessOverview;
use App\Http\Services\SendEmailService;
use App\Models\Business;
use Filament\Forms;
use Filament\Pages\Page;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

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
                // Forms\Components\TextInput::make('password')
                //     ->password()
                //     ->maxLength(255)
                //     ->dehydrateStateUsing(
                //         static fn (null|string $state): null|string =>
                //         filled($state) ? Hash::make($state) : null,
                //     )->required(
                //         static fn (Page $livewire): string =>
                //         $livewire instanceof CreateBusiness,
                //     )->dehydrated(
                //         static fn (null|string $state): bool =>
                //         filled($state),
                //     )->label(
                //         static fn (Page $livewire): string => ($livewire instanceof EditBusiness) ? 'New Password' : 'Password'
                //     ),
                Forms\Components\FileUpload::make('logo'),
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
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('avatar'),
                Tables\Columns\TextColumn::make('email'),
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
            BusinessOverview::class,
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

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicationResource\Pages;
use App\Models\Application;
use App\Models\Job;
use App\Models\Seeker;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ApplicationResource extends Resource
{
    protected static ?string $model = Application::class;

    protected static ?string $navigationIcon = 'heroicon-s-document-text';
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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('resume_path')
                    ->label('Resume')
                    ->required(),
                Forms\Components\Textarea::make('cover_letter')
                    ->required()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->size('lg')->color('success')->weight('bold'),
                Tables\Columns\TextColumn::make('job.position'),
                Tables\Columns\TextColumn::make('job.business.name')->weight('bold')->searchable(),
                Tables\Columns\TextColumn::make('phone'),
                Tables\Columns\TextColumn::make('resume_path')
                    ->label('Resume')
                    ->url(fn ($record) => asset('cv' . '/' . $record->resume_path))
                    ->searchable(),
                Tables\Columns\TextColumn::make('cover_letter'),
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
            'index' => Pages\ListApplications::route('/'),
            'create' => Pages\CreateApplication::route('/create'),
            'edit' => Pages\EditApplication::route('/{record}/edit'),
        ];
    }
}

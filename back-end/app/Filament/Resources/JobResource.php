<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Http\Services\SendEmailService;
use App\Models\Job;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Management Jobs and others';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('level')
                    ->required(),
                Forms\Components\Textarea::make('type')
                    ->required(),
                Forms\Components\TextInput::make('salary'),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Textarea::make('skill')
                    ->required(),
                Forms\Components\TextInput::make('requirement')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required(),
                Forms\Components\TextInput::make('benefits')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_day')
                    ->required(),
                Forms\Components\DatePicker::make('end_day')
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
                Tables\Columns\TextColumn::make('business.id')->sortable(),
                Tables\Columns\TextColumn::make('business.name'),
                Tables\Columns\TextColumn::make('position'),
                Tables\Columns\TextColumn::make('level'),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('salary'),
                Tables\Columns\TextColumn::make('content')->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('skill'),
                Tables\Columns\TextColumn::make('requirement')->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('benefits')->limit(30)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getLimit()) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('start_day')
                    ->date(),
                Tables\Columns\TextColumn::make('end_day')
                    ->date(),
                Tables\Columns\TextColumn::make('view_count')->label('Viewer')->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}

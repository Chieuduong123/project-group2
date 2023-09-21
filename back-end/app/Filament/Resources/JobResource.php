<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JobResource\Pages;
use App\Filament\Resources\JobResource\RelationManagers;
use App\Http\Services\SendEmailService;
use App\Models\Business;
use App\Models\Job;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\Layout;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class JobResource extends Resource
{
    protected static ?string $model = Job::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';
    protected static ?string $navigationGroup = 'Management Jobs and others';
    protected $selectedSkills;

    public function __construct(array $selectedSkills = [])
    {
        $this->selectedSkills = $selectedSkills;
    }

    protected static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('business_id')
                    ->label('Business')
                    ->options(Business::first()->pluck('name')->toArray())
                    ->reactive()
                    ->searchable(),
                Forms\Components\TextInput::make('position')
                    ->required()
                    ->maxLength(255),
                Select::make('level')
                    ->multiple()
                    ->options([
                        'Intern' => 'Intern',
                        'Fresher' => 'Fresher',
                        'Junior' => 'Junior',
                        'Middle' => 'Middle',
                        'Senior' => 'Senior',
                    ])
                    ->required(),
                Select::make('type')
                    ->multiple()
                    ->options([
                        'Full time' => 'Full time',
                        'Part time' => 'Part time',
                        'Remote' => 'Remote',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('salary'),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->maxLength(65535),
                Select::make('skill')
                    ->multiple()
                    ->options([
                        "ReactJS" => "ReactJS",
                        "Angular" => "Angular",
                        "Vue.js" => "Vue.js",
                        "HTML",
                        "CSS",
                        "JavaScript",
                        "TypeScript",
                        "Java",
                        "Python",
                        "C++",
                        "C#",
                        "PHP",
                        "Ruby",
                        "Swift",
                        "Kotlin",
                        "Node.js",
                        "Express.js",
                        "Django",
                        "Flask",
                        "Ruby on Rails",
                        "MySQL",
                        "PostgreSQL",
                        "MongoDB",
                        "Firebase",
                        "SQLite",
                        "Git",
                        "Docker",
                        "Kubernetes",
                        "AWS",
                        "Azure",
                        "Google Cloud",
                        "RESTful API",
                        "GraphQL",
                        "Responsive Web Design",
                        "UI/UX Design",
                        "Agile Development",
                        "Scrum",
                        "DevOps",
                        "Machine Learning",
                        "Artificial Intelligence",
                        "Data Science",
                        "Cybersecurity",
                        "Blockchain",
                        "AR/VR Development",
                        "Game Development",
                        "Big Data",
                        "Microservices",
                        "Serverless Architecture",
                        "Linux Administration",
                    ])
                    ->required(),
                Forms\Components\Textarea::make('requirement')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->required(),
                Forms\Components\Textarea::make('benefits')
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
                Tables\Columns\TextColumn::make('business.name')->weight('bold')->searchable(),
                Tables\Columns\TextColumn::make('position')->searchable(),
                Tables\Columns\TextColumn::make('level')->enum(Job::sourceOptions())->searchable(),
                Tables\Columns\TextColumn::make('type')->searchable(),
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
                SelectFilter::make('position')
                    ->options(Job::pluck('position', 'position')
                        ->unique()
                        ->toArray()),
                Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
    protected function shouldPersistTableFiltersInSession(): bool
    {
        return true;
    }
    protected function getTableFiltersLayout(): ?string
    {
        return Layout::AboveContent;
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

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmployeeResource\Pages;
use App\Models\Employee;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $modelLabel = 'Ажилтан бүртгэл';
    protected static ?string $navigationGroup = 'Бүртгэл';
    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Ажилтан бүртгэл';
    protected static ?string $pluralModelLabel = 'Ажилтан бүртгэл';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
Section::make('Үндсэн мэдээлэл')
    ->schema([
    TextInput::make('last_name')
        ->label('Овог')
        ->required(),
    TextInput::make('first_name')
        ->label('Нэр')
        ->required(),
    DatePicker::make('dob')
        ->label('Төрсөн он сар өдөр')
        ->default(Carbon::now()->format('Y-m-d')), 
    TextInput::make('address')
        ->label('Гэрийн хаяг')
        ->required(),
    TextInput::make('phone')
        ->label('Утас')
        ->numeric()
        ->required(), 
    TextInput::make('email')
        ->label('И-мэйл'),
    Textarea::make('person_additional')
        ->label('Нэмэлт мэдээлэл')
        ->columnSpanFull(),
Section::make('Ажилын байрны мэдээлэл')
    ->schema([
    Select::make('deployment_id')
        ->relationship(name: 'deployment', titleAttribute: 'name')
        ->required()
        ->label('Хэлтэс'),
    Select::make('job_type')
        ->options(config('status.employee'))
        ->required()
        ->label('Ажил байрны төрөл'),
    TextInput::make('position')
        ->label('Албан тушаал')
        ->required(), 
    DatePicker::make('hire_date')
        ->label('Ажилд орсон өдөр')
        ->default(Carbon::now()->format('Y-m-d')), 
    TextInput::make('salary')
        ->label('Үндсэн цалин')
        ->numeric()
        ->required(),
    Textarea::make('job_additional')
        ->label('Нэмэлт мэдээлэл')
        ->columnSpanFull()
        ->placeholder('Ажилын байрны өөрчлөлт шилжилт хөдөлгөөн тэмдэглэх') 
    ])->columns(2),
    ])->columns(2),
Section::make('Ажилаас гарах мэдээлэл')
    ->schema([
    DatePicker::make('resignation_date')
        ->label('Ажилаас гарсан өдөр')
        ->default(Carbon::now()->format('Y-m-d')), 
    TextInput::make('resignation_reason')
        ->label('Ажилаас гарсан шалтгаан')    
        ])
        ->collapsed()
        ->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
             TextColumn::make('first_name')
             ->label('Нэр')
             ->sortable()
             ->searchable(),
             TextColumn::make('deployment.name')
             ->label('Хэлтэс')
             ->sortable()
             ->searchable(),
             TextColumn::make('position')
             ->label('Албан тушаал')
             ->sortable()
             ->searchable(),
             TextColumn::make('hire_date')
             ->label('Ажил орсон огноо')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
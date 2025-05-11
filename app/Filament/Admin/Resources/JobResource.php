<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JobResource\Pages;
use App\Filament\Admin\Resources\JobResource\RelationManagers;
use App\Models\Job;
use App\Models\Joblist;
use Filament\Forms;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\Layout\Split;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Panel;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobResource extends Resource
{
    protected static ?string $model = Joblist::class;
    protected static ?string $modelLabel = 'Ажилд авах';
    protected static ?string $navigationLabel = 'Ажилд авах';
    protected static ?string $navigationIcon = 'heroicon-m-megaphone';
    protected static ?string $pluralModelLabel = 'Ажилд авах';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->label('Ажилын байрны нэр'),
                TextInput::make('salary')
                ->label('Цалин')
                ->numeric(),
                Select::make('type')
                ->label('Төрөл')
                ->options(config('status.job_status'))
                ->default('Staff')
                ->required(),   
                TextInput::make('number')
                ->label('Хүний тоо')
                ->numeric(),
                TextInput::make('phone')
                ->label('Утасны дугаар')
                ->numeric(),   
                RichEditor::make('detail')
                ->columnSpanFull(),
            ])->columns('2');
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Split::make([
                Stack::make([
                    TextColumn::make('name')
                        ->icon('heroicon-c-user'),
                    TextColumn::make('type')
                        ->icon('heroicon-o-identification'),
                ]),
                Stack::make([
                    TextColumn::make('salary')
                        ->icon('heroicon-s-banknotes')
                        ->numeric(decimalPlaces: 0),
                        TextColumn::make('number')
                        ->icon('heroicon-c-users'),
                 

                    ]),
                Stack::make([
                    TextColumn::make('phone')
                        ->icon('heroicon-m-phone'),
                ]),
            ]),
   
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
            'index' => Pages\ListJobs::route('/'),
            'create' => Pages\CreateJob::route('/create'),
            'edit' => Pages\EditJob::route('/{record}/edit'),
        ];
    }
}
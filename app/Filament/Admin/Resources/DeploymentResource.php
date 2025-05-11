<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DeploymentResource\Pages;
use App\Filament\Admin\Resources\DeploymentResource\RelationManagers;
use App\Models\Deployment;
use Carbon\Carbon;
use DateTime;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Date;
use Symfony\Contracts\Service\Attribute\Required;

class DeploymentResource extends Resource
{
    protected static ?string $model = Deployment::class;

    protected static ?string $modelLabel = 'Хэлтэс бүртгэл';
    protected static ?string $navigationGroup = 'Бүртгэл';
    protected static ?string $navigationIcon = 'heroicon-s-swatch';
    protected static ?string $navigationLabel = 'Хэлтэс бүртгэл';
    protected static ?string $pluralModelLabel = 'Хэлтэс бүртгэл';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               TextInput::make('name')
               ->label('Хэлтэсийн нэр')
               ->required(),
               DatePicker::make('deployment_date')
               ->label('Байгуулагдсан хугцаа')
                ->default(Carbon::now()->format('Y-m-d')), 
               Select::make('status')
               ->default('active')
               ->options(config('status.deployment'))            
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                ->label('Хэлтэсийн нэр')
                ->searchable()
                ->sortable(),
                TextColumn::make('deployment_date')
                ->label('Байгуулагдсан огноо')
                ->searchable()
                ->sortable(),
                TextColumn::make('status')
                ->label('Статус')
                ->searchable()
                ->sortable()
                ->badge()
                ->getStateUsing(function ($record) {
                    if ($record->status == 'active') {
                        return 'Идэвхтэй';
                    } elseif ($record->status == 'inactive') {
                        return 'Идэхгүй';
                    }
                    return $record->status;
                })
                ->badge() 
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
            'index' => Pages\ListDeployments::route('/'),
            'create' => Pages\CreateDeployment::route('/create'),
            'edit' => Pages\EditDeployment::route('/{record}/edit'),
        ];
    }
}
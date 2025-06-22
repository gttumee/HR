<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JoblistResource\Pages;
use Filament\Tables\Columns\Layout\Panel;
use App\Models\Joblist;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Redirect;


class JoblistResource extends Resource
{
    protected static ?string $model = Joblist::class;

    protected static ?string $modelLabel = 'Ажилын байр';
    protected static ?string $navigationIcon = 'heroicon-s-user-group';
    protected static ?string $navigationLabel = 'Ажилын байр';
    protected static ?string $pluralModelLabel = 'Ажилын байр';

    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name'),
                TextInput::make('salary'),
                TextInput::make('type'),
                TextInput::make('language_level'),
                TextInput::make('detail'),
                TextInput::make('number'),
                TextInput::make('company_name'),
                TextInput::make('phone'),
                TextInput::make('mail'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Split::make([
                Stack::make([
                    TextColumn::make('name')
                        ->icon('heroicon-c-user')
                        ->weight(FontWeight::Bold),
                     Stack::make([
                     TextColumn::make('type')
                        ->icon('heroicon-o-identification'),
                    ]),
                ]),
                Stack::make([
                    TextColumn::make('salary')
                         ->icon('heroicon-s-banknotes')
                        ->numeric(decimalPlaces: 0),
                     TextColumn::make('created_at')
                     ->date()
                        ->icon('heroicon-s-calendar'), 
                    ]),
            ]),
   
       
            ])
         
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('share')
                ->label('FB share')
                ->color('info')
                ->button()
                ->action(function ($record) {
                    $name = $record->name;
                    $type = $record->type;
                    $salary = $record->salary;
                    $facebookShareUrl = 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode('https://example.com/record/' . $record->id) . '&quote=' . urlencode("Name: $name, Type: $type, Salary: $salary");
                    return Redirect::away($facebookShareUrl);
                }),
                Tables\Actions\Action::make('Бүртгүүлэх')
                ->button()
                  ->steps([
                    Step::make('Хувийн мэдээлэл ашиглах')
                        ->schema([
                            Checkbox::make('ok')
                            ->required()
                            ->label(
                            'Хувийн мэдээлэл: Хувийн мэдээлэл гэдэг нь тухайн хувь хүнийг танихад ашиглагддаг мэдээлэл бөгөөд нэр, төрсөн огноо, хаяг, утас, эрүүл мэндийн мэдээлэл гэх мэт орно.' .
                            'Мэдээлэл цуглуулах: Хэрэглэгчид бүртгэл, үйлчилгээ авах үед хувийн мэдээллийг асууж, түншүүдээс мэдээлэл цуглуулж болно.' .
                            'Ашиглах зорилго: Бид хувийн мэдээллийг үйлчилгээний бүртгэл, шинэчлэлт, төлбөрийн хэрэгсэл болон хэрэглэгчийн асуултад хариу өгөх зорилгоор ашиглана.' .
                            'Мэдээллийг гуравдагч талд шилжүүлэх: Хэрэглэгчийн зөвшөөрөлгүйгээр гуравдагч талд мэдээллийг шилжүүлэхгүй, зөвхөн хууль ёсны шаардлагаар шилжүүлнэ.' .
                            'Мэдээллийг засварлах болон устгах: Хэрэглэгчид өөрийн мэдээллийг засварлах, устгах хүсэлт гаргаж болно')
                            ->columnSpanFull()
                            ->inline(false)
                            ->accepted()
                            ->validationMessages([
                                'accepted' => 'Зөвшөөрөл зөлөнө үү.',
                            ])
                        ])
                      
                        ->columns(2),
                    Step::make('Хувийн мэдээлэл оруулах')
                        ->schema([
                            TextInput::make('last_name')
                            ->label('Овог')
                            ->required(),
                            TextInput::make('first_name')
                            ->label('Нэр')
                            ->required(),
                            TextInput::make('age')
                            ->label('Нас')
                            ->required(),
                            TextInput::make('phone')
                            ->label('Утас')
                            ->required(),
                            TextInput::make('email')
                            ->label('И-мэйл')
                            ->required(),
                            Textarea::make('address')
                            ->label('Нэмэлт мэдээл')
                        ]),
                ])
            ]);
    }
    
    public function render()
    {
        $items = Joblist::all();
        return view('facebook', compact('items')); 
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
            'index' => Pages\ListJoblists::route('/'),
            'create' => Pages\CreateJoblist::route('/create'),
            'edit' => Pages\EditJoblist::route('/{record}/edit'),
        ];
    }

    
}
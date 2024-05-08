<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Company;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\CompanyResource\Pages;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;
use App\Filament\Admin\Resources\CompanyResource\RelationManagers;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Wizard\Step::make('company')
                        ->label('Company')
                        ->icon('heroicon-m-user')
                        ->description('Company general information')
                        ->schema([
                            Select::make('legal_status')
                                ->label('Legal Status')
                                ->options([
                                    'EURL' => 'EURL',
                                    'SARL' => 'SARL',
                                    'SPA' => 'SPA',
                                ]),

                            TextInput::make('name')
                                ->label('Company name')
                                ->required(),

                            TextInput::make('email')
                                ->label('Company Email')
                                ->unique(table: Company::class),

                            TextInput::make('phone_number')
                                ->label('Company phone number'),
                        ]),
                    Wizard\Step::make('companies')
                        ->label('Main contact')
                        ->description('Company main contact information')
                        ->icon('heroicon-m-shopping-bag')
                        ->schema([
                            Grid::make()
                                ->relationship('mainContact')
                                ->schema([
                                    TextInput::make('name')
                                        ->label('Main contact name')
                                        ->required(),

                                    TextInput::make('email')
                                        ->label('Main contact email')
                                        ->unique(table: User::class),

                                    TextInput::make('phone')
                                        ->label('Main contact phone'),

                                    TextInput::make('password')
                                        ->suffixAction(
                                            CopyAction::make()
                                        )
                                        ->hintAction(
                                            Action::make('ClickToGenerate')
                                                ->icon('heroicon-m-clipboard')
                                                ->action(function (Set $set, $state) {
                                                    $length = 16;
                                                    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()";
                                                    $password = "";

                                                    for ($i = 0; $i < $length; $i++) {
                                                        $password .= $chars[random_int(0, strlen($chars) - 1)];
                                                    }

                                                    $set('password', $password);
                                                })
                                        )->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                                ])

                        ]),
                ])
                    ->columnSpan(['sm' => '1', 'xl' => '2']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('legal_status'),
                TextColumn::make('name'),
                TextColumn::make('created_at'),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}

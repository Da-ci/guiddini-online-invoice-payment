<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Fieldset;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Forms\Components\PasswordGeneratorField;
use App\Filament\Resources\UserResource\RelationManagers;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $label = 'Admins';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([

                    Section::make('Informations')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('name'),
                                    TextInput::make('email'),
                                ]),

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
                                ),
                        ]),

                    Section::make('Configuration')
                        ->schema([
                            Toggle::make('is_admin')
                                ->default(true),
                            Toggle::make('is_active')
                                ->default(true),
                        ])->grow(false)->columns(2),

                ])->columnSpan(['sm' => '1', 'xl' => '2'])


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }


}

<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\Actions\Action;
use App\Filament\Company\Resources\UserResource;
use Webbingbrasil\FilamentCopyActions\Forms\Actions\CopyAction;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function form(Form $form): Form
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
                                ->label('New password')
                                ->suffixAction(
                                    CopyAction::make()
                                )
                                ->hintAction(
                                    Action::make('ClickToGenerateNewPassword')
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
                                )->dehydrateStateUsing(fn($state) => $state ? Hash::make($state) : null)
                                ->helperText(str('Your **full name** here, including any middle names.')->inlineMarkdown()->toHtmlString())

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

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $record->update($data);

        return $record;
    }
}

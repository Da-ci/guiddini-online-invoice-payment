<?php

namespace App\Filament\Company\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Company\Resources\ProductResource\Pages;
use App\Filament\Company\Resources\ProductResource\RelationManagers;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('regular_price')
                            ->required()
                            ->label('Price')
                            ->suffix('DA')
                            ->minValue(1)
                            ->maxValue(100),
                        MarkdownEditor::make('description')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'heading',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'table',
                                'undo',
                            ]),
                            TagsInput::make('tags')

                    ]),
                    Grid::make(2)
                        ->schema([
                            Section::make([
                                Checkbox::make('sale_flag')
                                    ->label('Sale ?')
                                    ->inline()
                                    ->default(false)
                                    ->live(onBlur: true),
                                DatePicker::make('sale_starts')
                                    ->label('Sale start the')
                                    ->disabled(fn(Get $get): bool => !$get('sale_flag'))
                                    ->required(fn(Get $get): bool => $get('sale_flag')),
                                DatePicker::make('sale_ends')
                                    ->label('Sale ends the')
                                    ->disabled(fn(Get $get): bool => !$get('sale_flag'))
                                    ->required(fn(Get $get): bool => $get('sale_flag')),
                            ]),
                            Section::make([
                                FileUpload::make('image_path')
                                    ->image()
                                    ->imageEditor()
                            ])
                        ]),
                ])->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $title = 'Абоненты';

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\Fieldset::make('Passport')
                    ->relationship('passport')
                    ->schema([
                        Forms\Components\TextInput::make('series')->required(),
                        Forms\Components\TextInput::make('number')->required(),
                        Forms\Components\DatePicker::make('date_of_issue')->required(),
                        Forms\Components\FileUpload::make('documents')
                            ->multiple()
                            ->disk('public')
                            ->directory('documents/passports'),
                    ]),
                Forms\Components\Fieldset::make('Agreement')
                    ->relationship('agreement')
                    ->schema([
                        Forms\Components\TextInput::make('number')->required(),
                        Forms\Components\DatePicker::make('agreement_date')->required(),
                        Forms\Components\FileUpload::make('documents')
                            ->multiple()
                            ->disk('public')
                            ->directory('documents/agreements'),
                    ]),
                Forms\Components\FileUpload::make('documents')
                    ->multiple()
                    ->disk('public')
                    ->directory('documents'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('unique_id'),
                Tables\Columns\TextColumn::make('documents_count'),

            ])
            ->filters([
                Tables\Filters\Filter::make('customers')
                    ->form([
                        Forms\Components\TextInput::make('name'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when(
                                $data['name'],
                                fn(Builder $query, $name): Builder => $query->where('name', $name)
                            );
                    }),
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
            'index'  => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}

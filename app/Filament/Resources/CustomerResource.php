<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use App\Tables\Columns\AgreementColumn;
use App\Tables\Columns\PassportColumn;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

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
                Tables\Columns\TextColumn::make('name')->label('Имя')->searchable(),
                Tables\Columns\TextColumn::make('unique_id')->label('Уникальный номер')->searchable(),
                PassportColumn::make('passport')->label('Паспорт'),
                Tables\Columns\TextColumn::make('documents_count')->label('Число документов'),
                AgreementColumn::make('agreement')->label('Договор')->view('tables.columns.agreement-column'),
            ])
            ->filters(
                [
                    Tables\Filters\Filter::make('customers')
                        ->form([
                            Forms\Components\TextInput::make('name')->label(__('general.name')),
                            Forms\Components\TextInput::make('agreementNumber')->label(__('general.agreement-number')),
                            Forms\Components\TextInput::make('unique_id')->label(__('general.customer-unique-id')),
                            Forms\Components\TextInput::make('passportNumber')->label(__('general.passport-number')),
                            Forms\Components\DatePicker::make('agreementDate')->label(__('general.agreement-date')),
                        ])
                        ->columns(3)
                        ->query(function (Builder $query, array $data) {
                            return $query
                                ->when(
                                    $data['name'],
                                    fn(Builder $query, $name): Builder => $query->where('name', 'LIKE',
                                        '%' . $name . '%')
                                )
                                ->when(
                                    $data['agreementNumber'],
                                    fn(Builder $query, $agreementNumber): Builder => $query->whereHas('agreement',
                                        function (Builder $query) use ($agreementNumber): Builder {
                                            return $query->where('number', 'LIKE', '%' . $agreementNumber . '%');
                                        })
                                )
                                ->when(
                                    $data['unique_id'],
                                    fn(Builder $query, $uniqueId): Builder => $query->where('unique_id', 'LIKE',
                                        '%' . $uniqueId . '%')
                                )
                                ->when(
                                    $data['passportNumber'],
                                    fn(Builder $query, $passportNumber): Builder => $query->whereHas('passport',
                                        function (Builder $query) use ($passportNumber): Builder {
                                            return $query->where('number', 'LIKE', '%' . $passportNumber . '%');
                                        })
                                )
                                ->when(
                                    $data['agreementDate'],
                                    fn(Builder $query, $agreementDate): Builder => $query->whereHas('agreement',
                                        function (Builder $query) use ($agreementDate): Builder {
                                            return $query->whereDate('agreement_date', $agreementDate);
                                        })
                                );
                        }),
                ],
                Tables\Filters\Layout::AboveContentCollapsible
            )
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'view'   => Pages\ViewCustomer::route('/{record}'),
            'edit'   => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('resources.customer'); // TODO: Change the autogenerated stub
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.customers'); // TODO: Change the autogenerated stub
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }

    public static function getGlobalSearchResultDetails(Model $record): array
    {
        return [
            'Name' => $record->name,
        ];
    }
}

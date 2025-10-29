<?php

namespace App\Filament\Resources\Pets\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('name')
                    ->required(),
                Select::make('species')
                    ->options([
            'dog' => 'Dog',
            'cat' => 'Cat',
            'bird' => 'Bird',
            'reptile' => 'Reptile',
            'rodent' => 'Rodent',
            'fish' => 'Fish',
            'amphibian' => 'Amphibian',
            'other' => 'Other',
        ])
                    ->default('dog')
                    ->required(),
                TextInput::make('breed')
                    ->default(null),
                Select::make('sex')
                    ->options(['male' => 'Male', 'female' => 'Female'])
                    ->required(),
                DatePicker::make('birthdate'),
                TextInput::make('photo')
                    ->default(null),
            ]);
    }
}

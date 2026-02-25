<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SliderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                ImageEntry::make('image_path')
                    ->disk('public'),
                IconEntry::make('status')
                    ->boolean(),
                IconEntry::make('first_button_visibility')
                    ->boolean(),
                IconEntry::make('second_button_visibility')
                    ->boolean(),
                TextEntry::make('first_button_text')
                    ->placeholder('-'),
                TextEntry::make('second_button_text')
                    ->placeholder('-'),
                TextEntry::make('first_button_link')
                    ->placeholder('-'),
                TextEntry::make('second_button_link')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

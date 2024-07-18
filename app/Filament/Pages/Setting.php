<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Setting extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament.pages.setting';

    protected static ?int $navigationSort = 6;
    
}

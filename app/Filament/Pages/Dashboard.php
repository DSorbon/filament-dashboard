<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{

    protected static string $view = 'filament.pages.dashboard';

    protected function getWidgets(): array
    {
        return parent::getWidgets(); // TODO: Change the autogenerated stub
    }
}
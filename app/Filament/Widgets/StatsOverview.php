<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Product;
use App\Models\Testimonial;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products' , Product::count())->color('success'),
            Stat::make('Total Posts', Post::count())->color('primary'),
            Stat::make('Product Views' , Product::select('views')->sum('views'))->color('danger'),
            Stat::make('Total Testimonials' , Testimonial::count())->color('info')
        ];
    }
}

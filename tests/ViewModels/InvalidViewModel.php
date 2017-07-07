<?php

namespace Rareloop\ViewModels\Tests\ViewModels;

use Illuminate\Support\Collection;
use Rareloop\ViewModels\ParameterBag;
use Rareloop\ViewModels\ViewModel;

class InvalidViewModel extends ViewModel
{
    public static function make(ParameterBag $params): array
    {
        return static::compose('nope');
    }
}

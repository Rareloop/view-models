<?php

namespace Rareloop\ViewModels\Tests\ViewModels;

use Rareloop\ViewModels\ParameterBag;
use Rareloop\ViewModels\ViewModel;

class ArrayViewModel extends ViewModel
{
    public static function make(ParameterBag $params): array
    {
        $data = array_map(function ($item) {
            return [
                'id' => $item['ID'],
                'title' => $item['post_title'],
            ];
        }, $params->data);

        return static::compose($data);
    }
}

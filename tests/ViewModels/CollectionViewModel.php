<?php

namespace Rareloop\ViewModels\Tests\ViewModels;

use Rareloop\ViewModels\ParameterBag;
use Rareloop\ViewModels\ViewModel;

class CollectionViewModel extends ViewModel
{
    public static function make(ParameterBag $params): array
    {
        $data = $params->get('data')->map(function ($item) {
            return [
                'id' => $item['ID'],
                'title' => $item['post_title'],
            ];
        });

        return static::compose($data);
    }
}

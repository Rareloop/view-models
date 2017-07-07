<?php

namespace Rareloop\ViewModels\Tests\ViewModels;

use Illuminate\Support\Collection;
use Rareloop\ViewModels\ParameterBag;
use Rareloop\ViewModels\ViewModel;
use StdClass;

class ObjectViewModel extends ViewModel
{
    public static function make(ParameterBag $params): array
    {
        $data = $params->get('data');

        $object = new StdClass();
        $object->id = $data['ID'];
        $object->title = $data['post_title'];

        return static::compose($object);
    }
}

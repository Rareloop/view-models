<?php

namespace Rareloop\ViewModels;

use Illuminate\Support\Collection;
use Rareloop\ViewModels\CannotComposeViewModelException;
use Rareloop\ViewModels\ParameterBag;

abstract class ViewModel
{
    abstract public static function make(ParameterBag $params): array;

    /**
     * Makes sure the data is always an array
     * @param  mixed $data The data to compose
     * @return array
     */
    protected static function compose($data): array
    {
        if (is_array($data)) {
            return $data;
        }

        if ($data instanceof Collection) {
            return $data->toArray();
        }

        if (is_object($data)) {
            return (array) $data;
        }

        throw new CannotComposeViewModelException;
    }
}

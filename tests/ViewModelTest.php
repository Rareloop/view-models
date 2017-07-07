<?php

namespace Rareloop\ViewModels\Tests;

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Rareloop\ViewModels\ParameterBag;
use Rareloop\ViewModels\Tests\ViewModels\ArrayViewModel;
use Rareloop\ViewModels\Tests\ViewModels\CollectionViewModel;
use Rareloop\ViewModels\Tests\ViewModels\InvalidViewModel;
use Rareloop\ViewModels\Tests\ViewModels\ObjectViewModel;

class ViewModelTest extends TestCase
{
    private function makeParams($data)
    {
        return new ParameterBag([
            'data' => $data,
        ]);
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_compose_an_array()
    {
        $data = $this->makeParams([
            [
                'ID' => 1,
                'post_title' => 'Hello world',
            ],
        ]);

        $viewModelData = ArrayViewModel::make($data);

        $this->assertInternalType('array', $viewModelData);
        $this->assertSame([
            [
                'id' => 1,
                'title' => 'Hello world',
            ],
        ], $viewModelData);
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_compose_a_collection()
    {
        $data = $this->makeParams(new Collection([
            [
                'ID' => 1,
                'post_title' => 'Hello world',
            ],
        ]));

        $viewModelData = CollectionViewModel::make($data);

        $this->assertInternalType('array', $viewModelData);
        $this->assertSame([
            [
                'id' => 1,
                'title' => 'Hello world',
            ],
        ], $viewModelData);
    }

    /**
     * @test
     * @expectedException Rareloop\ViewModels\CannotComposeViewModelException
     * @codingStandardsIgnoreLine */
    function cannot_compose_an_invalid_type()
    {
        $data = $this->makeParams([]);

        $viewModelData = InvalidViewModel::make($data);
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_compose_an_object()
    {
        $data = $this->makeParams([
            'ID' => 1,
            'post_title' => 'Hello world',
        ]);

        $viewModelData = ObjectViewModel::make($data);

        $this->assertInternalType('array', $viewModelData);
        $this->assertSame([
            'id' => 1,
            'title' => 'Hello world',
        ], $viewModelData);
    }
}

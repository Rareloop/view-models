<?php

namespace Rareloop\ViewModels\Tests;

use PHPUnit\Framework\TestCase;
use Rareloop\ViewModels\ParameterBag;

class ParameterBagTest extends TestCase
{
    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_get_a_param()
    {
        $params = new ParameterBag([
            'example' => 123,
        ]);

        $this->assertSame(123, $params->get('example'));
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function get_default_value_when_param_does_not_exist()
    {
        $params = new ParameterBag();

        $this->assertNull($params->get('example'));

        $params = new ParameterBag();

        $this->assertFalse($params->get('example', false));
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_check_if_param_exists()
    {
        $params = new ParameterBag();

        $this->assertFalse($params->has('example'));

        $params = new ParameterBag([
            'example' => 123,
        ]);

        $this->assertTrue($params->has('example'));
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_get_all_parameters()
    {
        $params = new ParameterBag([
            'numbers' => 123,
            'letters' => 'abc'
        ]);

        $this->assertSame([
           'numbers' => 123,
           'letters' => 'abc'
        ], $params->all());
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_get_parameter_by_property()
    {
        $params = new ParameterBag([
            'numbers' => 123,
            'letters' => 'abc'
        ]);

        $this->assertSame(123, $params->numbers);
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_check_if_parameter_exists_with_isset()
    {
        $params = new ParameterBag();

        $this->assertFalse(isset($params->example));

        $params = new ParameterBag([
            'example' => 123,
        ]);

        $this->assertTrue(isset($params->example));
    }

    /**
     * @test
     * @expectedException LogicException
     * @codingStandardsIgnoreLine */
    function cannot_update_params_by_property()
    {
        $params = new ParameterBag();
        $params->test = 123;
    }

    /**
     * @test
     * @expectedException LogicException
     * @codingStandardsIgnoreLine */
    function cannot_delete_param()
    {
        $params = new ParameterBag([
            'example' => 123,
        ]);

        unset($params->example);
    }

    /**
     * @test
     * @codingStandardsIgnoreLine */
    function can_iterate_through_params()
    {
        $params = new ParameterBag([
            1,
            2,
        ]);

        foreach ($params as $index => $param) {
            $this->assertSame(($index + 1), $param);
        }
    }
}

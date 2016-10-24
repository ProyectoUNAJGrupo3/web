<?php
namespace spec\PlasmaConduit\option;
use PHPSpec2\ObjectBehavior;
use PlasmaConduit\option\Some as Real;

class Some extends ObjectBehavior {

    const VALUE       = 'value';
    const ALTERNATIVE = 'alternative';

    function let() {
        $this->beConstructedWith(self::VALUE);
    }

    function it_should_be_initializable() {
        $this->shouldHaveType('PlasmaConduit\option\Some');
    }

    function it_should_return_false_for_isEmpty() {
        $this->isEmpty()->shouldReturn(false);
    }

    function it_should_return_true_for_nonEmpty() {
        $this->nonEmpty()->shouldReturn(true);
    }

    function it_should_return_the_value_for_get() {
        $this->get()->shouldReturn(self::VALUE);
    }

    function it_should_return_the_value_for_getOrElse() {
        $this->getOrElse(self::ALTERNATIVE)->shouldReturn(self::VALUE);
    }

    function it_should_return_the_value_for_getOrElse_with_callable() {
        $this->getOrElse(function() {
            return None::ALTERNATIVE;
        })->shouldReturn(self::VALUE);
    }

    function it_should_return_this_for_orElse() {
        $this->orElse(new Real(self::ALTERNATIVE))->shouldReturn($this);
    }

    function it_should_return_this_for_orElse_with_callable() {
        $this->orElse(function() {
            return new Real(None::ALTERNATIVE);
        })->get()->shouldReturn(self::VALUE);
    }

    function it_should_return_a_left_projection_for_toLeft() {
        $this->toLeft(self::ALTERNATIVE)
             ->shouldHaveType('PlasmaConduit\either\Left');
    }

    function it_should_return_a_evaluated_left_projection_for_toLeft() {
        $this->toLeft(function() { return None::ALTERNATIVE; })
             ->shouldHaveType('PlasmaConduit\either\Left');
    }

    function it_should_return_a_right_projection_for_toRight() {
        $this->toRight(self::ALTERNATIVE)
             ->shouldHaveType('PlasmaConduit\either\Right');
    }

    function it_should_return_a_evaluated_right_projection_for_toRight() {
        $this->toRight(function() { return None::ALTERNATIVE; })
             ->shouldHaveType('PlasmaConduit\either\Right');
    }

    function it_should_return_null_for_orNull() {
        $this->orNull()->shouldReturn(self::VALUE);
    }

    function it_should_run_the_callable_for_map() {
        $this->map(function($value) {
            return 'mapped';
        })->get()->shouldReturn('mapped');
    }

    function it_should_throw_when_map_is_called_with_number() {
        $this->shouldThrow()->duringMap(123);
    }

    function it_should_run_the_callable_for_flatMap() {
        $this->flatMap(function($value) {
            return new Real('flatMapped');
        })->get()->shouldReturn('flatMapped');
    }

    function it_should_throw_when_flatMap_is_called_with_number() {
        $this->shouldThrow()->duringFlatMap(123);
    }

    function it_should_throw_when_flatMap_returns_non_option() {
        $this->shouldThrow()->duringFlatMap(function(){
            return 'boom';
        });
    }

    function it_should_return_Some_when_filter_passes() {
        $this->filter(function($value) {
            return true;
        })->shouldHaveType('PlasmaConduit\option\Some');
    }

    function it_should_return_None_when_filter_fails() {
        $this->filter(function($value) {
            return false;
        })->shouldHaveType('PlasmaConduit\option\None');
    }

    function it_should_throw_when_filter_is_called_with_number() {
        $this->shouldThrow()->duringFilter(123);
    }

}

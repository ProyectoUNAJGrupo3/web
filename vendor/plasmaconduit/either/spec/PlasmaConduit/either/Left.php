<?php
namespace spec\PlasmaConduit\either;
use PHPSpec2\ObjectBehavior;

class Left extends ObjectBehavior {

    const VALUE = "value";
    const LEFT  = "left";
    const RIGHT = "right";

    function let() {
        $this->beConstructedWith(self::VALUE);
    }

    function it_should_be_initializable() {
        $this->shouldHaveType('PlasmaConduit\either\Left');
    }

    function it_should_return_true_for_left() {
        $this->isLeft()->shouldReturn(true);
    }

    function it_should_return_false_for_right() {
        $this->isRight()->shouldReturn(false);
    }

    function it_should_run_the_left_case_for_fold() {
        $this->fold(
            function($value) {
                return Left::LEFT;
            },
            function($value) {
                return Left::RIGHT;
            }
        )->shouldReturn(self::LEFT);
    }

    function it_should_ignore_maper_for_map() {
        $this->map(function($value) {
            return "boom";
        })->shouldHaveType('PlasmaConduit\either\Left');
    }

    function it_should_return_this_for_flatMap() {
        $this->flatMap(function($successValue) {
            return "boom";
        })->shouldHaveType('PlasmaConduit\either\Left');
    }

    function it_should_return_Some_for_left() {
        $this->left()->shouldHaveType('PlasmaConduit\option\Some');
    }

    function it_should_return_None_for_right() {
        $this->right()->shouldHaveType('PlasmaConduit\option\None');
    }

    function it_should_return_Right_for_swap() {
        $this->swap()->shouldHaveType('PlasmaConduit\either\Right');
    }

}

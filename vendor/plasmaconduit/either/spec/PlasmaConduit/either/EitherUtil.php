<?php
namespace spec\PlasmaConduit\either;
use PHPSpec2\ObjectBehavior;
use PlasmaConduit\Map;
use PlasmaConduit\either\Left as RLeft;
use PlasmaConduit\either\Right as RRight;

class EitherUtil extends ObjectBehavior {

    function it_should_filter_lefts_on_array_for_lefts() {
        $eithers = [new RLeft(""), new RRight(""), new RLeft("")];
        self::lefts($eithers)->length()->shouldReturn(2);
    }

    function it_should_filter_lefts_on_map_for_lefts() {
        $eithers = new Map([new RLeft(""), new RRight(""), new RLeft("")]);
        self::lefts($eithers)->length()->shouldReturn(2);
    }

    function it_should_throw_when_lefts_is_called_with_number() {
        $this->shouldThrow()->duringRLefts(123);
    }

    function it_should_filter_rights_on_array_for_rights() {
        $eithers = [new RLeft(""), new RRight(""), new RLeft("")];
        self::rights($eithers)->length()->shouldReturn(1);
    }

    function it_should_filter_rights_on_map_for_rights() {
        $eithers = new Map([new RLeft(""), new RRight(""), new RLeft("")]);
        self::rights($eithers)->length()->shouldReturn(1);
    }

    function it_should_throw_when_rights_is_called_with_number() {
        $this->shouldThrow()->duringRRights(123);
    }

    function it_should_partition_for_on_array_partition() {
        $eithers     = [new RLeft(""), new RRight(""), new RLeft("")];
        $partitioned = self::partition($eithers);
        $partitioned->get(0)->get()->length()->shouldReturn(2);
    }

    function it_should_partition_for_on_map_partition() {
        $eithers = new Map([new RLeft(""), new RRight(""), new RLeft("")]);
        $partitioned = self::partition($eithers);
        $partitioned->get(1)->get()->length()->shouldReturn(1);
    }

    function it_should_throw_when_number_is_called_with_number() {
        $this->shouldThrow()->duringPartition(123);
    }

}

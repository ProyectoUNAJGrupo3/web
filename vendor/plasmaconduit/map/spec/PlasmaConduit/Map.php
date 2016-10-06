<?php
namespace spec\PlasmaConduit;
use PHPSpec2\ObjectBehavior;
use PlasmaConduit\Map as RealMap;
use Exception;

class Map extends ObjectBehavior {

    public function let() {
        $this->beConstructedWith(array(
            "key1" => "value1",
            "key2" => "value2"
        ));
    }

    public function it_should_be_initializable() {
        $this->shouldHaveType('PlasmaConduit\Map');
    }

    public function it_should_return_None_on_get_when_key_dont_exist() {
        $this->get("boom")->shouldHaveType('PlasmaConduit\option\None');
    }

    public function it_should_return_Some_on_get_when_the_key_exists() {
        $this->get("key1")->shouldHaveType('PlasmaConduit\option\Some');
    }

    public function it_should_return_Some_with__value_on_get_with_valid_key() {
        $this->get("key1")->get()->shouldReturn("value1");
    }

    public function it_should_return_the_value_for_a_valid_key_for_getOrElse() {
        $this->getOrElse("key1", "alternative")->shouldReturn("value1");
    }

    public function it_should_return_the_alt_for_invalid_for_getOrElse() {
        $this->getOrElse("invalid", "alternative")->shouldReturn("alternative");
    }

    public function it_should_evaluate_alt_for_invalid_for_getOrElse() {
        $this->getOrElse("invalid", function() {
            return "alternative";
        })->shouldReturn("alternative");
    }

    public function it_should_set_a_new_val_for_set() {
        $this->set("new1", "new1");
        $this->get("new1")->get()->shouldReturn("new1");
    }

    public function it_should_remove_val_for_remove() {
        $this->set("new1", "new1");
        $this->remove("new1");
        $this->getOrElse("new1", "alternative")->shouldReturn("alternative");
    }

    public function it_should_return_true_for_valid_key_for_exists() {
        $this->exists("key1")->shouldReturn(true);
    }

    public function it_should_return_false_for_invalid_key_for_exists() {
        $this->exists("invalid")->shouldReturn(false);
    }

    public function it_should_add_a_new_element_for_push() {
        $this->push("new");
        $this->toArray()->shouldReturn(array(
            "key1" => "value1",
            "key2" => "value2",
            "new"
        ));
    }

    public function it_should_return_the_last_element_for_pop() {
        $this->pop()->shouldReturn("value2");
    }

    public function it_should_remove_the_last_element_for_pop() {
        $this->pop();
        $this->toArray()->shouldReturn(array("key1" => "value1"));
    }

    public function it_should_return_the_correct_lenght_for_length() {
        $this->length()->shouldReturn(2);
    }

    public function it_should_return_the_correct_keys_for_keys() {
        $this->keys()->shouldReturn(array("key1", "key2"));
    }

    public function it_should_return_the_correct_values_for_values() {
        $this->values()->shouldReturn(array("value1", "value2"));
    }

    public function it_should_return_Some_on_predicate_match_for_findValue() {
        $this->findValue(function($value, $key) {
            return $value == "value1";
        })->shouldHaveType('PlasmaConduit\option\Some');
    }

    public function it_should_return_value_on_predicate_match_for_findValue() {
        $this->findValue(function($value, $key) {
            return $value = "value1";
        })->get()->shouldReturn("value1");
    }

    public function it_should_return_None_on_predicate_miss_for_findValue() {
        $this->findValue(function($value, $key) {
            return $value == "invalid";
        })->shouldHaveType('PlasmaConduit\option\None');
    }

    public function it_should_return_Some_on_predicate_match_for_findKey() {
        $this->findKey(function($value, $key) {
            return $key == "key1";
        })->shouldHaveType('PlasmaConduit\option\Some');
    }

    public function it_should_return_key_on_predicate_match_for_findKey() {
        $this->findKey(function($value, $key) {
            return $key == "key1";
        })->get()->shouldReturn("key1");
    }

    public function it_should_return_None_on_predicate_miss_for_findKey() {
        $this->findKey(function($value, $key) {
            return $key == "invalid";
        })->shouldHaveType('PlasmaConduit\option\None');
    }

    public function it_should_return_the_correct_array_for_toArray() {
        $this->toArray()->shouldReturn(array(
            "key1" => "value1",
            "key2" => "value2"
        ));
    }

    public function it_should_run_the_mapper_for_map() {
        $this->map(function($value) {
            return substr($value, -1);
        })->toArray()->shouldReturn(array(
            "key1" => "1",
            "key2" => "2"
        ));
    }

    public function it_should_throw_when_map_is_called_with_non_callable() {
        $this->shouldThrow()->duringMap("boom");
    }

    public function it_should_run_the_reducer_for_reduce() {
        $this->reduce(array(), function($memo, $value) {
            $memo[] = substr($value, -1);
            return $memo;
        })->shouldReturn(array("1", "2"));
    }

    public function it_should_throw_when_reduce_is_called_with_non_callable() {
        $this->shouldThrow()->duringReduce("boom");
    }

    public function it_should_correctly_filter_for_filter() {
        $this->filter(function($value) {
            return $value == "value1";
        })->toArray()->shouldReturn(array("key1" => "value1"));
    }

    public function it_should_throw_when_filter_is_called_with_non_callable() {
        $this->shouldThrow()->duringFilter("boom");
    }

    public function it_should_partition_correctly_for_partition() {
        $partition = $this->partition(function($value, $key) {
            return $key == "key1";
        });
        $partition->get(0)->get()->toArray()->shouldReturn(array(
            "key1" => "value1"
        ));
        $partition->get(1)->get()->toArray()->shouldReturn(array(
            "key2" => "value2"
        ));
    }

    public function it_should_throw_for_non_callable_for_partition() {
        $this->shouldThrow()->duringPartition("boom");
    }

    public function it_should_group_by_key_for_groupBy() {
        $grouped = $this->groupBy(function($value, $key) {
            return $key;
        });
        $grouped->get("key1")->get()->toArray()->shouldReturn(array(
            "key1" => "value1"
        ));
        $grouped->get("key2")->get()->toArray()->shouldReturn(array(
            "key2" => "value2"
        ));
    }

    public function it_should_throw_for_non_callable_for_groupBy() {
        $this->shouldThrow()->duringGroupBy("boom");
    }

    public function it_should_not_throw_when_each_is_called() {
        $this->each(function($value, $key) {
            return $key . $value;
        });
    }

    public function it_should_throw_when_each_is_called_with_non_callable() {
        $this->shouldThrow()->duringEach("boom");
    }

    public function it_should_return_the_difference_for_differenceKey() {
        $this->differenceKey(new RealMap(array(
            "key2" => "value2"
        )))->toArray()->shouldReturn(array(
            "key1" => "value1"
        ));
    }

    public function it_should_return_the_difference_for_difference() {
        $this->difference(new RealMap(array(
            "key2" => "value2"
        )))->toArray()->shouldReturn(array(
            "key1" => "value1"
        ));
    }

    public function it_should_return_the_intersection_for_intersectionKey() {
        $this->intersectionKey(new RealMap(array(
            "key1" => "value1"
        )))->toArray()->shouldReturn(array(
            "key1" => "value1"
        ));
    }

    public function it_should_return_the_intersection_for_intersection() {
        $this->intersection(new RealMap(array(
            "key1" => "value1"
        )))->toArray()->shouldReturn(array(
            "key1" => "value1"
        ));
    }

    public function it_should_merge_map_for_merge() {
        $this->merge(new RealMap(array(
            "key2" => "alt2",
            "key3" => "value3"
        )))->toArray()->shouldReturn(array(
            "key1" => "value1",
            "key2" => "alt2",
            "key3" => "value3"
        ));
    }

    public function it_should_map_arrays_on_mappify() {
        self::mappify([
            "test" => [
                "test" => "test"
            ]
        ])->get("test")->get()->shouldHaveType('PlasmaConduit\Map');
    }

}
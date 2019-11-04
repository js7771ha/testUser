<?php

abstract class AOne
{
    const TEST = "test1";
    abstract public function test();
}

class OneStatic extends AOne
{
    public function test()
    {
        return static::TEST;
    }
}

class TwoStatic extends OneStatic
{
    const TEST = "test2";
}

class OneSelf extends AOne
{
    public function test()
    {
        return self::TEST;
    }
}

class TwoSelf extends OneSelf
{
    const TEST = "test2";
}

class OneThis extends AOne
{
    public function test()
    {
        return $this::TEST;
    }
}

class TwoThis extends OneThis
{
    const TEST = "test2";
}


class OneClass extends AOne
{
    public function test()
    {
        return TwoClass::TEST;
    }
}

class TwoClass extends OneClass
{
    const TEST = "test2";
}

$objects = array(
    'one, static::'     => new OneStatic(),
    'two, static::'     => new TwoStatic(),
    'one,   self::'     => new OneSelf(),
    'two,   self::'     => new TwoSelf(),
    'one,  $this::'     => new OneThis(),
    'two,  $this::'     => new TwoThis(),
    'one,  class::'     => new OneClass(),
    'two,  class::'     => new TwoClass(),
);

$results = array();
foreach ($objects as $name=>$object)
    $results[$name] = $object->test();

dd($results);

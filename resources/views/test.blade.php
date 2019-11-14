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

class OneStatic1 extends AOne
{
    const TEST = "test2";
    public function test()
    {
        return parent::TEST;
    }
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
    'one, parent::'     => new OneStatic1(),
);

$results = array();
foreach ($objects as $name=>$object)
    $results[$name] = $object->test();

//dd($results);




class StaticParent {
    static    $parent_only;
    static    $both_distinct;

    function __construct() {
        static::$parent_only = 'fromparent';
        static::$both_distinct = 'fromparent';
    }
}

class StaticChild extends staticparent {
    static    $child_only;
    static    $both_distinct;

    function __construct() {
        static::$parent_only = 'fromchild';
        static::$both_distinct = 'fromchild';
        static::$child_only = 'fromchild';
    }
}

$a = new StaticChild;

$results[0] = array(
    'Parent: parent_only    = ' => StaticParent::$parent_only,          // fromchild
    'Parent: both_distinct  = ' => StaticParent::$both_distinct,        // fromparent
    'Child : parent_only    = ' => StaticChild::$parent_only,           // fromchild
    'Child : both_distinct  = ' => StaticChild::$both_distinct,         // fromchild
    'Child : child_only     = ' => StaticChild::$child_only,            // fromchild
);

$a = new StaticParent;

$results[1] = array(
    'Parent: parent_only    = ' => StaticParent::$parent_only,          // fromchild
    'Parent: both_distinct  = ' => StaticParent::$both_distinct,        // fromparent
    'Child : parent_only    = ' => StaticChild::$parent_only,           // fromchild
    'Child : both_distinct  = ' => StaticChild::$both_distinct,         // fromchild
    'Child : child_only     = ' => StaticChild::$child_only,            // fromchild
);

//dd($results);


class Aclass {
    const MY_CONST = 1;
    static $my_static = 'a';
    public function my_const_self() {
        return self::MY_CONST;
    }
    public function my_const_static() {
        return static::MY_CONST;
    }
    public function my_static_self() {
        return self::$my_static;
    }
    public function my_static_static() {
        return static::$my_static;
    }
}

class Bclass extends Aclass {
    const MY_CONST = 2;
    static $my_static = 'b';
}

$b = new Bclass();
//echo $b->my_const_self();           // 1
//echo $b->my_const_static();         // 2
//echo $b->my_static_self();          // a
//echo $b->my_static_static();        // b

preg_match('@^(?:http://)?([^/]+)@i', "http://www.php.net/index.html", $matches1);



preg_match('/(\w+): \d+/', 'foobar: 2008 yes or no', $matches2);

//dd($matches1, $matches2);



$a = 1;
$b = 2;
$d = 3;
// $c 변수에 $b 변수를 복사(참조)한다.
// 그래서 $c 변수와 $b 변수는 각각 2를 가지게 된다.
$c = &$b;
// $c 변수와 $d 변수에 5를 대입합니다.
$c = $d = 5;
echo "c : ".$c; // 결과: 5
echo "<br />";
echo "b : ".$b; // 결과: 5
echo "<br />";
echo "d : ".$d; // 결과: 5
echo "<br />";

// $c 참조 변수에 8을 대입합니다.
$c = 8;
echo "c : ".$c; // 결과: 8
echo "<br />";
// $c의 참조가 $b 이므로 동일 값을 가지게 된다.
echo "b : ".$b; // 결과: 8
echo "<br />";
// $d 변수는 단순히 5를 대입한 것이므로 참조가 아니다.
echo "d : ".$d; // 결과: 5



//$a = 1;
//$b = $a;
//$c = &$a;
//echo $b; // 결과: 1
//echo $c; // 결과: 1
//// 참조 변수에 5를 대입
//$a = 5;
//echo $b; // 결과: 1
//echo $c; // 결과: 5

$a = 1;
$b = &$a;
unset($a);  // $a 변수의 삭제
echo $b;    // 결과: 1
// unset 으로 $a와 $b 사이의 연결만을 끊습니다.
// $a 에 대입한 것이므로 결과물은 참조하지 않습니다.
$a = 5;
echo $b;    // 결과: 1


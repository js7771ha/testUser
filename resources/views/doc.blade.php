<?php

$hasher = new Illuminate\Hashing\BcryptHasher();
$a = $hasher->make("1234");
$b = $hasher->make("1234");
$c = $hasher->make("1234");
dump($a,$b,$c);
dump($hasher->check("1234",$a));
dump($hasher->check("1234",$b));
dump($hasher->check("1234",$c));
dd($hasher->check("1234",$hasher->make("1234")));

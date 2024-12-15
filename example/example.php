<?php

require_once '../src/Main.php';

use Wydesu\IndonesiaNumtoword\numToWord;

$number = 1992987;
$result = (new numToWord())->getSentences($number);

var_dump(number_format($number));
echo "<br>";
var_dump($result);
die;

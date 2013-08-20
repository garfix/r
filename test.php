<?php

require_once __DIR__ . '/R.php';

function test($expected, $got)
{
	if ($expected != $got) {
		echo "Expected: " . $expected . " got: " . $got . "\n";
	}
}

require_once __DIR__ . '/tests/expressions.php';
require_once __DIR__ . '/tests/modifiers.php';
require_once __DIR__ . '/tests/quantifiers.php';
require_once __DIR__ . '/tests/groups.php';
require_once __DIR__ . '/tests/characters.php';
require_once __DIR__ . '/tests/lookbehind.php';
require_once __DIR__ . '/tests/special.php';
require_once __DIR__ . '/tests/escaping.php';

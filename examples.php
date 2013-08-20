<?php

require_once __DIR__ . '/R.php';

// Full string match
//
// /^Paradise Lost$/
//
echo R::expression()
	->startOfString()
	->text('Paradise Lost')
	->endOfString() . "\n";

// Alternate texts
//
// /The (dog|cat)?basket fell off the roof/
//
echo R::expression()
	->text('The ')
	->group(
		R::group()->optional()->oneOfThese()->text('dog')->text('cat')
	)
	->text('basket fell off the roof') . "\n";

// Characters
//
// /the [bc]?old man and the [^c]ee.*/
//
echo R::expression()
	->text('the ')
	->inChars(R::chars('bc')->optional())
	->text('old man and the ')
	->notInChars(R::chars('c'))
	->text('ee')
	->char(R::anyChar()->zeroOrMore()) . "\n";

// Nested groups
//
// /(<a href='([^']*)'>)/
echo R::expression()
	->group(
		R::group()
			->text("<a href='")
			->group(
				R::group()
					->notInChars(R::chars("'")->zeroOrMore())
			)
			->text("'>")
	) . "\n";

// Assertions
//
// /\bkettle\b/
//
echo R::expression()
	->wordBoundary()
	->text('kettle')
	->wordBoundary() . "\n";

// Quantifiers: Dutch postal code
//
// /[\d]{4}[a-z]{2}/
//
echo R::expression()
	->char(R::chars()->digit()->times(4))
	->char(R::chars()->letter()->times(2)) . "\n";

// Named blocks
// Automatically adjusting delimiters (#)
//
// #(?P<protocol>http[s]?)://(?P<url>.*)#
//
echo R::expression()
	->group(
		R::group('protocol')
			->text('http')
			->char(R::chars('s')->optional())
	)
	->text('://')
	->group(
		R::group('url')
			->char(R::anyChar()->zeroOrMore())
	) . "\n";

// Multiline expressions
//
// /^start\s+(^the)\s+show$/m
//
echo R::multiLineExpression()
	->startOfStringOrLine()
	->text('start')
	->whitespace()
	->group(
		R::group()->startOfLine()->text('the')
	)
	->whitespace()
	->text('show')
	->endOfStringOrLine() . "\n";

// Look ahead, look behind
//
// /(?<=Lord )(Byron)/
//
echo R::expression()
	->lookBehind(
		R::lookBehind()->text('Lord ')
	)
	->group(
		R::group()->text('Byron')
	) . "\n";

// Include raw expressions
//
// #(?P<protocol>https?)://(?P<url>.*)#
//
echo R::expression()
	->group(
		R::group('protocol')->raw('https?')
	)
	->text('://')
	->group(
		R::group('url')->raw('.*')
	);
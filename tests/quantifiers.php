<?php

// optional
test('/(very)?/',
	R::expression()->group(
		R::group()->text('very')->optional()
	)
);

// oneOrMore
test('/(very)+/',
	R::expression()->group(
		R::group()->text('very')->oneOrMore()
	)
);

// zeroOrMore
test('/(very)*/',
	R::expression()->group(
		R::group()->text('very')->zeroOrMore()
	)
);

// atLeast
test('/(very){5,}/',
	R::expression()->group(
		R::group()->text('very')->atLeast(5)
	)
);

// atMost
test('/(very){0,5}/',
	R::expression()->group(
		R::group()->text('very')->atMost(5)
	)
);

// times
test('/(very){3}/',
	R::expression()->group(
		R::group()->text('very')->times(3)
	)
);

// interval
test('/(very){1,3}/',
	R::expression()->group(
		R::group()->text('very')->interval(1, 3)
	)
);

// zeroOrMore
test('/(very)*/',
	R::expression()->group(
		R::group()->text('very')->zeroOrMore()
	)
);

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

// {1,1}, possessive, is meaningless
test('/(very)/',
	R::expression()->group(
		R::group()->text('very')->possessive()
	)
);
// {0,1}, possessive
test('/(very)?+/',
	R::expression()->group(
		R::group()->text('very')->optional()->possessive()
	)
);
// {0,}, possessive
test('/(very)*+/',
	R::expression()->group(
		R::group()->text('very')->zeroOrMore()->possessive()
	)
);
// {1,}, possessive
test('/(very)++/',
	R::expression()->group(
		R::group()->text('very')->oneOrMore()->possessive()
	)
);
// {1,3}, possessive
test('/(very){1,3}+/',
	R::expression()->group(
		R::group()->text('very')->interval(1, 3)->possessive()
	)
);
// {5,}, possessive
test('/(very){5,}+/',
	R::expression()->group(
		R::group()->text('very')->atLeast(5)->possessive()
	)
);
// {0,5}, possessive
test('/(very){0,5}+/',
	R::expression()->group(
		R::group()->text('very')->atMost(5)->possessive()
	)
);


// {1,1}, lazy, is meaningless
test('/(very)/',
	R::expression()->group(
		R::group()->text('very')->lazy()
	)
);
// {0,1}, lazy
test('/(very)??/',
	R::expression()->group(
		R::group()->text('very')->optional()->lazy()
	)
);
// {0,}, lazy
test('/(very)*?/',
	R::expression()->group(
		R::group()->text('very')->zeroOrMore()->lazy()
	)
);
// {1,}, lazy
test('/(very)+?/',
	R::expression()->group(
		R::group()->text('very')->oneOrMore()->lazy()
	)
);
// {1,3}, lazy
test('/(very){1,3}?/',
	R::expression()->group(
		R::group()->text('very')->interval(1, 3)->lazy()
	)
);
// {5,}, lazy
test('/(very){5,}?/',
	R::expression()->group(
		R::group()->text('very')->atLeast(5)->lazy()
	)
);
// {5,0}, lazy
test('/(very){0,5}?/',
	R::expression()->group(
		R::group()->text('very')->atMost(5)->lazy()
	)
);
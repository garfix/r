<?php

// empty group
test('/()/',
	R::expression()->group(R::group())
);

// named group
test('/(?P<protocol>)/',
	R::expression()->group(R::group('protocol'))
);

// some quantifier: one or more
test('/(very)+/',
	R::expression()->group(
		R::group()->oneOrMore()->text('very')
	)
);

// dot
test('/(.)/',
	R::expression()->group(R::group()->char(R::anyChar()))
);

// or
test('/(master|maestro|mister)/',
	R::expression()->group(R::group()->oneOfThese()->text('master')->text('maestro')->text('mister'))
);
test('/(master|maestro|mister)/',
	R::expression()->text('(master|maestro|mister)')
);

// quantifier: optional
test('/(nom)?/',
	R::expression()->group(R::group()->optional()->text('nom'))
);

// wordBoundary
test ('/(\b)/',
	R::expression()->group(R::group()->wordBoundary())
);

// anythingButWordBoundary
test ('/(\B)/',
	R::expression()->group(R::group()->anythingButWordBoundary())
);

// dontCapture
test ('/(?:abc)/',
	R::expression()->group(R::group()->dontCapture()->text('abc'))
);

// startOfLine
test('/(^)/',
	R::expression()->group(R::group()->startOfLine())
);

// endOfLine
test('/($)/',
	R::expression()->group(R::group()->endOfLine())
);

// backReference
test('/(abc) \1/',
	R::expression()
		->group(R::group()->text('abc'))
		->text(' ')
		->backReference(1)
);
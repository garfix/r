<?php

// empty
test('//', R::expression());

// startOfString
test('/^/',
	R::expression()->startOfString()
);

// endOfString
test('/$/',
	R::expression()->endOfString()
);

// text
test('/Lady Lovelace/',
	R::expression()->text('Lady Lovelace')
);

// or
test('/master|maestro|mister/',
	R::expression()->oneOfThese()->text('master')->text('maestro')->text('mister')
);

// delimiters
test('#/#',
	R::expression()->text('/')
);
test('%/#%',
	R::expression()->text('/#')
);

// wordBoundary
test('/\b/',
	R::expression()->wordBoundary()
);

// anythingButWordBoundary
test('/\B/',
	R::expression()->anythingButWordBoundary()
);

// startOfStringOrLine
test('/^/m',
	R::multiLineExpression()->startOfStringOrLine()
);

// endOfStringOrLine
test('/$/m',
	R::multiLineExpression()->endOfStringOrLine()
);

// startOfString
test('/\A/m',
	R::multiLineExpression()->startOfString()
);

// endOfString
test('/\Z/m',
	R::multiLineExpression()->endOfString()
);

// endOfStringOrNewlineAtEnd
test('/\z/m',
	R::multiLineExpression()->endOfStringOrNewlineAtEnd()
);

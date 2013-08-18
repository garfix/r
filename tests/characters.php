<?php

// single character
test('/[abc]/',
	R::expression()->inChars(R::chars('abc'))
);

// some quantifier: optional
test('/[abc]?/',
	R::expression()->inChars(R::chars('abc')->optional())
);

// negation
test('/[^abc]/',
	R::expression()->notInChars(R::chars('abc'))
);

// dot
test('/./',
	R::expression()->char(R::anyChar())
);

// dot with modifier
test('/.+/',
	R::expression()->char(R::anyChar()->oneOrMore())
);

// specific characters
test('/[a]/',
	R::expression()->inChars(R::chars()->char('a'))
);

// whitespace
test('/[\s]/',
	R::expression()->inChars(R::chars()->whitespace())
);

// anythingButWhitespace
test('/[\S]/',
	R::expression()->inChars(R::chars()->anythingButWhitespace())
);

// letter
test('/[A-Za-z]/',
	R::expression()->inChars(R::chars()->letter())
);

// digit
test('/[\d]/',
	R::expression()->inChars(R::chars()->digit())
);

// anything but digit
test('/[\D]/',
	R::expression()->inChars(R::chars()->anythingButDigit())
);

// wordCharacter
test('/[\w]/',
	R::expression()->inChars(R::chars()->wordCharacter())
);

// anythingButWordCharacter
test('/[\W]/',
	R::expression()->inChars(R::chars()->anythingButWordCharacter())
);

// characters that should be escaped
test('/[\]\\\\]/',
	R::expression()->inChars(R::chars(']\\'))
);
// \b should not be escaped
test('/[a\]\\bc]/',
	R::expression()->inChars(R::chars('a]\\bc'))
);

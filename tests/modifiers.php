<?php

// caseInsensitive
test('//i',
	R::expression()->modifyCaseInsensitive()
);

// dotAll
test('//s',
	R::expression()->modifyAnyCharAcceptsNewlines()
);

// unicode
test('//u',
	R::expression()->modifyTreatAsUnicode()
);

// combinations
test('//iu',
	R::expression()->modifyCaseInsensitive()->modifyTreatAsUnicode()
);


// modifier by letter
test('//J',
	R::expression()->modify('J')
);

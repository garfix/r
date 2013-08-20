<?php

// characters that match delimiters
test('#a/b#',
	R::expression()->text('a/b')
);

// text with meta characters
test('/\\\\\\^\\$\\.\\[\\]\\|\\(\\)\\?\\*\\+\\{\\}/',
	R::expression()->text('\\^$.[]|()?*+{}')
);
test('/(\\\\\\^\\$\\.\\[\\]\\|\\(\\)\\?\\*\\+\\{\\})/',
	R::expression()->group(R::group()->text('\\^$.[]|()?*+{}'))
);

// characters with meta characters
test('/[\\\\^$.[\\]|()?*+{}]/',
	R::expression()->inChars(R::chars('\\^$.[]|()?*+{}'))
);
test('/[\\\\^$.[\\]|()?*+{}]/',
	R::expression()->inChars(R::chars()->char('\\^$.[]|()?*+{}'))
);

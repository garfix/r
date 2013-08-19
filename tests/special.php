<?php

// whitespace
test('/\s+/',
	R::expression()->whitespace()
);
test('/(\s+)/',
	R::expression()->group(
		R::group()->whitespace()
	)
);

// optionalWhitespace
test('/\s*/',
	R::expression()->optionalWhitespace()
);
test('/(\s*)/',
	R::expression()->group(
		R::group()->optionalWhitespace()
	)
);
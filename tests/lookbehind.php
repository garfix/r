<?php

// lookAhead positive
test('/(?=monkey)/',
	R::expression()->lookAhead(R::lookAhead()->text('monkey'))
);

// lookBehind negative
test('/(?!monkey)/',
	R::expression()->lookAhead(R::lookAhead()->negative()->text('monkey'))
);

// lookBehind positive
test('/(?<=monkey)/',
	R::expression()->lookBehind(R::lookBehind()->text('monkey'))
);

// lookBehind negative
test('/(?<!monkey)/',
	R::expression()->lookBehind(R::lookBehind()->negative()->text('monkey'))
);

// look ahead in groups
test('/((?=monkey))/',
	R::expression()->group(R::group()->lookAhead(R::lookAhead()->text('monkey')))
);

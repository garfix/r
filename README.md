# r - Regular Expression Builder (PHP)

r Is a PHP library to build regular expressions.

It is written for PHP 5 and it handles PCRE patterns in a fairly advanced level, but it does not cover the complete specification.

## Examples

These examples can also be found in the file 'examples.php'.

### Full string match

` /^Paradise Lost$/ `

	R::expression()
		->startOfString()
		->text('Paradise Lost')
		->endOfString()

### Alternate texts

` /The (dog|cat)?basket fell off the roof/ `

	R::expression()
		->text('The ')
		->group(
			R::group()->optional()->oneOfThese()->text('dog')->text('cat')
		)
		->text('basket fell off the roof')

### Characters

` /the [bc]?old man and the [^c]ee.*/ `

	R::expression()
		->text('the ')
		->inChars(R::chars('bc')->optional())
		->text('old man and the ')
		->notInChars(R::chars('c'))
		->text('ee')
		->char(R::anyChar()->zeroOrMore())

### Nested groups

` /(<a href='([^']*)'>)/ `

	R::expression()
		->group(
			R::group()
				->text("<a href='")
				->group(
					R::group()
						->notInChars(R::chars("'")->zeroOrMore())
				)
				->text("'>")
		)

### Assertions

` /\bkettle\b/ `

	R::expression()
		->wordBoundary()
		->text('kettle')
		->wordBoundary()

### Quantifiers: Dutch postal code

` /[\d]{4}[a-z]{2}/ `

	R::expression()
		->char(R::chars()->digit()->times(4))
		->char(R::chars()->letter()->times(2))

### Named blocks, alternate delimiters (#)

` #(?P<protocol>http[s]?)://(?P<url>.*)# `

	R::expression()
		->group(
			R::group('protocol')
				->text('http')
				->char(R::chars('s')->optional())
		)
		->text('://')
		->group(
			R::group('url')
				->char(R::anyChar()->zeroOrMore())
		)

### Multiline expression

` /^start\s+(^the)\s+show$/m `

	R::multiLineExpression()
		->startOfStringOrLine()
		->text('start')
		->whitespace()
		->group(
			R::group()->startOfLine()->text('the')
		)
		->whitespace()
		->text('show')
		->endOfStringOrLine()

### Look behind, look ahead

` /(?<=Lord )(Byron)/ `

	R::expression()
	    ->lookBehind(
	        R::lookBehind()->text('Lord ')
	    )
	    ->group(
	        R::group()->text('Byron')
	    )


Credits
=======
The credits for the idea of creating a regular expression builder go to [VerbalExpressions](https://github.com/VerbalExpressions/JSVerbalExpressions).
It is a fascinating idea and I wanted to see how far it could go. I chose a different type of implementation base on nested fluid interface calls.

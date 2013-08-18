# r -- Regular Expression Builder (PHP)

r Is a PHP library to build regular expressions.

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
		) . "\n";

Credits
=======
The credits for the idea of creating a regular expression builder go to [VerbalExpressions](https://github.com/VerbalExpressions/JSVerbalExpressions).
It is a fascinating idea and I wanted to see how far it could go. So I set out to create a more powerful version.

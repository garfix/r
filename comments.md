# R

The idea
// http://thechangelog.com/stop-writing-regular-expressions-express-them-with-verbal-expressions/

## Goal

The goal is not to be complete, but to provide a broad set of features. Advanced use, but not expert level.


// modifiers via fluent interfaces
// sequences via arguments

//'#' .
//'(?P<url>' .							// the entire url
//	'(?P<pre>' .						// _before_ the id
//		'((?P<protocol>https?)://)?' .	// optional protocol (absolute / relative link?)
//		'(?P<domain>[\w\.]+)?' .		// optional domain
//		'([^?\'"]+?)' .					// uridata
//		'/library/download/' .			// download link signature
//	')' .
//	'(?P<document_id>[^/?\'"]+)' . 		// an id (public or private)
//	'(/(?P<filename>[^?\'"]+))?' .		// an optional filename
//	'(\?(?P<parameters>[^\'"]+))?' .	// an optional ? and parameters
//')' .
//'#i';

original
	#(?P<url>(?P<pre>((?P<protocol>http[s]?)://)?(?P<domain>[\w\.]+)?([^?'"]+?)/library/download/)(?P<document_id>[^/?'"]+)(/(?P<filename>[^?'"]+))?(\?(?P<parameters>[^'"]+))?)#i

produced
	#(?P<url>(?P<pre>((?P<protocol>http[s]?)://)?(?P<domain>[\w.]+)?([^?'"]+?)/library/download/)(?P<document_id>[^/?'"]+)(/(?P<filename>[^/?'"]+))?(\?(?P<parameters>[^'"]+))?)#i

specials:
=========

R::url()

voorbeeld


	$RegExp = R::expression()
		->add(R::namedSequence('url')
			->add(R::namedSequence('pre')
				->add(R::sequence()
					->add(R::namedSequence('protocol')
						->add(R::text('http'))
						->add(R::char('s')->optional()))

					->add(R::text('://'))
					->optional())

				->add(R::namedSequence('domain')
					->add(R::char(R::CHAR_WORD_OR_UNDERSCORE, '.')->oneOrMore())
					->optional())

				->add(R::sequence()
					->add(R::notChar('?', "'", '"')->oneOrMore()->asFewAsPossible()))

				->add(R::text('/library/download/')))

			->add(R::namedSequence('document_id')
				->add(R::notChar('/', '?', "'", '"')->oneOrMore()))

			->add(R::sequence()
				->add(R::text('/'))
				->add(R::namedSequence('filename')
					->add(R::notChar('/', '?', "'", '"')->oneOrMore()))
				->optional())

			->add(R::sequence()
				->add(R::text('?'))
				->add(R::namedSequence('parameters')
					->add(R::notChar("'", '"')->oneOrMore()))
				->optional())

		)
		->caseInsensitive();

	$RegExp = R::expression()->caseInsensitive()
		->group(R::group('url')
			->group(R::group('pre')
				->group(R::group()->optional()
					->group(R::group('protocol')
						->text('http')
						->inChars(R::chars('s')->optional()))
					->text('://'))
				->group(R::group('domain')->optional()
					->inChars(R::chars('.')->letterOrDigitOrUnderscore()->oneOrMore()))
				->group(R::group()
					->notInChars(R::chars('?\'"')->oneOrMore()->asFewAsPossible()))
				->text('/library/download/'))
			->group(R::group('document_id')
				->notInChars(R::chars('/?\'"')->oneOrMore()))
			->group(R::group()->optional()
				->text('/')
				->group(R::group('filename')
					->notInChars(R::chars('/?\'"')->oneOrMore())))
			->group(R::group()->optional()
				->text('?')
				->group(R::group('parameters')
					->notInChars(R::chars('\'""')->oneOrMore())))
		);
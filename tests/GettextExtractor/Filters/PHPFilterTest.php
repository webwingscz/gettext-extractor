<?php

require_once dirname(__FILE__).'/FilterTest.php';

/**
 * Test class for PHPFilter.
 * Generated by PHPUnit on 2010-12-15 at 21:59:45.
 */
class GettextExtractor_Filters_PHPFilterTest extends GettextExtractor_Filters_FilterTest {

	protected function setUp() {
		error_reporting(-1);
		$this->object = new GettextExtractor_Filters_PHPFilter();
		$this->object->addFunction('addRule', 2);
		$this->file = dirname(__FILE__) . '/../../data/default.php';
	}

	public function testFunctionCallWithVariables() {
		$messages = $this->object->extract($this->file);

		$this->assertNotContains(array(
			GettextExtractor_Extractor::LINE => 7
		),$messages);

		$this->assertNotContains(array(
			GettextExtractor_Extractor::LINE => 8,
			GettextExtractor_Extractor::CONTEXT => 'context'
		),$messages);

		$this->assertNotContains(array(
			GettextExtractor_Extractor::LINE => 9,
			GettextExtractor_Extractor::SINGULAR => 'I see %d little indian!',
			GettextExtractor_Extractor::PLURAL => 'I see %d little indians!'
		),$messages);
	}

	public function testNestedFunctions() {
		$messages = $this->object->extract($this->file);

		$this->assertNotContains(array(
			GettextExtractor_Extractor::LINE => 11,
			GettextExtractor_Extractor::SINGULAR => 'Some string.'
		),$messages);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 12,
			GettextExtractor_Extractor::SINGULAR => 'Nested function.'
		),$messages);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 13,
			GettextExtractor_Extractor::SINGULAR => 'Nested function 2.',
			GettextExtractor_Extractor::CONTEXT => 'context'
		),$messages);
		$this->assertNotContains(array(
			GettextExtractor_Extractor::LINE => 13,
			GettextExtractor_Extractor::SINGULAR => 'context'
		),$messages);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 14,
			GettextExtractor_Extractor::SINGULAR => "%d meeting wasn't imported.",
			GettextExtractor_Extractor::PLURAL => "%d meetings weren't importeded."
		),$messages);
		$this->assertNotContains(array(
			GettextExtractor_Extractor::LINE => 14,
			GettextExtractor_Extractor::SINGULAR => "%d meeting wasn't imported."
		),$messages);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 17,
			GettextExtractor_Extractor::SINGULAR => "Please provide a text 2."
		),$messages);
		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 18,
			GettextExtractor_Extractor::SINGULAR => "Please provide a text 3."
		),$messages);
	}

	public function testConstantAsParameter() {
		$messages = $this->object->extract($this->file);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 16,
			GettextExtractor_Extractor::SINGULAR => "Please provide a text."
		),$messages);
	}

	public function testMessageWithNewlines() {
		$messages = $this->object->extract($this->file);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 22,
			GettextExtractor_Extractor::SINGULAR => "A\nmessage!"
		),$messages);
	}

	public function testArrayAsParameter() {
		$this->object->addFunction('addConfirmer', 3);
		$messages = $this->object->extract($this->file);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 25,
			GettextExtractor_Extractor::SINGULAR => "Really delete?"
		),$messages);
	}

	/**
	 * @group bug5
	 */
	public function testArrayWithTranslationsAsParameter() {
		$this->object->addFunction('addSelect', 3);
		$messages = $this->object->extract($this->file);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 26,
			GettextExtractor_Extractor::SINGULAR => "item 1"
		),$messages);
		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 26,
			GettextExtractor_Extractor::SINGULAR => "item 2"
		),$messages);
	}

	/**
	 * @group bug3
	 */
	public function testMultipleMessagesFromSingleFunction() {
		$this->object->addFunction('bar', 1);
		$this->object->addFunction('bar', 2);
		$messages = $this->object->extract($this->file);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 30,
			GettextExtractor_Extractor::SINGULAR => "Value A"
		),$messages);
		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 30,
			GettextExtractor_Extractor::SINGULAR => "Value B"
		),$messages);
	}

	public function testCallable() {
		$this->object->extract(dirname(__FILE__) . '/../../data/callable.php');
	}

	public function testStaticFunctions() {
		$messages = $this->object->extract($this->file);

		$this->assertContains(array(
			GettextExtractor_Extractor::LINE => 31,
			GettextExtractor_Extractor::SINGULAR => "Static function"
		),$messages);
	}
}

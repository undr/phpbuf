<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class Message_ExampleRepeat extends Message_Abstract {
	public function __construct() {
		$this->setField("messages", Type::MESSAGE, Rule::REPEATED, 1, "Message_Example");
		$this->setField("name", Type::STRING, Rule::REPEATED , 2);
	}
}
?>
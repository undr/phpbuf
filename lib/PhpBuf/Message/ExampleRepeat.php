<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://github.com/undr/phpbuf
 *
 */
class PhpBuf_Message_ExampleRepeat extends PhpBuf_Message_Abstract {
	public function __construct() {
		$this->setField("messages", PhpBuf_Type::MESSAGE, PhpBuf_Rule::REPEATED, 1, "PhpBuf_Message_Example");
		$this->setField("name", PhpBuf_Type::STRING, PhpBuf_Rule::REPEATED , 2);
	}
}
?>
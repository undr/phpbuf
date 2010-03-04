<?php
class PhpBuf_Message_Example_Test2 extends PhpBuf_Message_Abstract {
	public function __construct() {
		$this->setField("b", PhpBuf_Type::STRING, PhpBuf_Rule::REQUIRED, 2);
	}
}
?>
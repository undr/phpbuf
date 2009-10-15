<?php
class PhpBuf_Message_Example_Test1 extends PhpBuf_Message_Abstract {
	public function __construct() {
		$this->setField("a", PhpBuf_Type::INT, PhpBuf_Rule::REQUIRED, 1);
	}
}
?>
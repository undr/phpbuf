<?php
class PhpBuf_Message_Example_Test3 extends PhpBuf_Message_Abstract {
	public function __construct() {
		$this->setField("c", PhpBuf_Type::MESSAGE, PhpBuf_Rule::REQUIRED, 3, "PhpBuf_Message_Example_Test1");
	}
}
?>
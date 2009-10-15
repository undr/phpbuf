<?php
class Message_Example_Test3 extends Message_Abstract {
	public function __construct() {
		$this->setField("c", Type::MESSAGE, Rule::REQUIRED, 3, "Message_Example_Test1");
	}
}
?>
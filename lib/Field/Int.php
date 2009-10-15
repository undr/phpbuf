<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class Field_Int extends Field_Abstract {
	protected $wireType = Field_Abstract::WIRETYPE_VARINT;
	protected function  readImpl(IO_Reader_Interface $reader) {
		return $this->readWireTypeData($reader);
	}
	protected function writeImpl(IO_Writer_Interface $writer, $value) {
		$this->writeWireTypeData($writer, $value);
	}
	protected function checkTypeOfValueImpl($value) {
		return is_integer($value);
	}
}
?>
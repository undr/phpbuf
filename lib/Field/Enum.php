<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class Field_Enum extends Field_Abstract {
	protected $wireType = Field_Abstract::WIRETYPE_VARINT;
	protected function readImpl(IO_Reader_Interface $reader) {
		return $this->getEnumNameById($this->readWireTypeData($reader));
		if($this->value === false) { throw new Field_Exception("Unknow value in enum"); }
	}
	protected function writeImpl(IO_Writer_Interface $writer, $value) {
		$value = $this->getEnumIdByName($value);
		if($value === false) { throw new Field_Exception("Unknow value in enum"); }
		$this->writeWireTypeData($writer, $value);
	}
	protected function getEnumNameById($id) {
		if(isset($this->extra[$id])) {
			return $this->extra[$id];
		}
		return false;
	}
	protected function getEnumIdByName($name) {
		$enums = array_flip($this->extra);
		if(isset($enums[$name])) {
			return  $enums[$name];
		}
		return false;
	}
	protected function checkTypeOfValueImpl($value) {
		return (boolean)$this->getEnumIdByName($value);
	}
}
?>
<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class WireType_Varint implements WireType_Interface {
	private function __construct() {}
	public static function read(IO_Reader_Interface $reader) {
		return Base128::decodeFromReader($reader);
	}
	public static function write(IO_Writer_Interface $writer, $value) {
		Base128::encodeToWriter($writer, $value);
	}
}
?>
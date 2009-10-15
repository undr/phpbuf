<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class WireType_LenghtDelimited implements WireType_Interface {
	private function __construct() {}
	public static function read(IO_Reader_Interface $reader) {
		$lenght = Base128::decodeFromReader($reader);
		return $reader->getBytes($lenght);
	}
	public static function write(IO_Writer_Interface $writer, $value) {
		Base128::encodeToWriter($writer, strlen($value));
		$writer->writeBytes($value);
	}
}
?>
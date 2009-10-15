<?php
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
class WireType_Fixed32 implements WireType_Interface {
	private function __construct() {}
	public static function read(IO_Reader_Interface $reader) {
		throw new NotImplemented_Exception("reader for WireType_Fixed32 not implemented");
	}
	public static function write(IO_Writer_Interface $writer, $data) {
		throw new NotImplemented_Exception("writer for WireType_Fixed32 not implemented");
	}
}
?>
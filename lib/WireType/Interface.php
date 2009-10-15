<?php 
/**
 * @author Andrey Lepeshkin (lilipoper@gmail.com)
 * @link http://code.google.com/p/php-protobuf/
 *
 */
interface  WireType_Interface {
	public static function read(IO_Reader_Interface $reader);
	public static function write(IO_Writer_Interface $writer, $value);
}
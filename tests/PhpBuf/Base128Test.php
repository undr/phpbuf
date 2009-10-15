<?php
class PhpBuf_Base128Test extends PHPUnit_Framework_TestCase {

    public function testEncodeAndDecodeValueLessThan128() {
    	$result = PhpBuf_Base128::decodeFromReader(new PhpBuf_IO_Reader(PhpBuf_Base128::encode(120)));
        $this->assertEquals(120, $result);
    }
    public function testEncodeAndDecodeValueMoreThan128() {
    	$result = PhpBuf_Base128::decodeFromReader(new PhpBuf_IO_Reader(pack("n", 44034)));
    	$this->assertEquals(300, $result, "Decode failure");
    	$result = PhpBuf_Base128::encode(300);
    	$result = unpack("n", $result);
    	$this->assertEquals(44034, $result[1], "Encode failure");
    }
    public function testEncodeAndDecodeValueMoreThan128_V2() {
    	$encode = PhpBuf_Base128::encode(300);
		$result = PhpBuf_Base128::decodeFromReader(new PhpBuf_IO_Reader($encode));
		$this->assertEquals(300, $result);
    }
    public function testEncodeAndDecodeBigValues() {
    	$encode = PhpBuf_Base128::encode(123456789);
		$result = PhpBuf_Base128::decodeFromReader(new PhpBuf_IO_Reader($encode));
		$this->assertEquals(123456789, $result);
    }
    
}

?>
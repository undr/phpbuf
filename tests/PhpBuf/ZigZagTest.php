<?php
class PhpBuf_ZigZagTest extends PHPUnit_Framework_TestCase {

    public function testDecodeEncodeZero() {
        $this->assertEquals(0, ZigZag::encode(0), "Encode failure");
        $this->assertEquals(0, ZigZag::decode(0), "Decode failure");
    }
    public function testEncode() {
    	$this->assertEquals(2, ZigZag::encode(1), "Encode 1 failure");
    	$this->assertEquals(1, ZigZag::encode(-1), "Encode -1 failure");
    	$this->assertEquals(246913578, ZigZag::encode(123456789), "Encode 123456789 failure");
    	$this->assertEquals(246913577, ZigZag::encode(-123456789), "Encode -123456789 failure");
    }
    public function testDecode() {
    	$this->assertEquals(1, ZigZag::decode(2), "Encode 1 failure");
    	$this->assertEquals(-1, ZigZag::decode(1), "Encode -1 failure");
    	$this->assertEquals(123456789, ZigZag::decode(246913578), "Encode 123456789 failure");
    	$this->assertEquals(-123456789, ZigZag::decode(246913577), "Encode -123456789 failure");
    } 
    public function testDecodeNegativeValue() {
    	$this->setExpectedException('ZigZag_Exception');
    	ZigZag::decode(-1);
    }
}
?>
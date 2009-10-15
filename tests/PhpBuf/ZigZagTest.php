<?php
class PhpBuf_ZigZagTest extends PHPUnit_Framework_TestCase {

    public function testDecodeEncodeZero() {
        $this->assertEquals(0, PhpBuf_ZigZag::encode(0), "Encode failure");
        $this->assertEquals(0, PhpBuf_ZigZag::decode(0), "Decode failure");
    }
    public function testEncode() {
    	$this->assertEquals(2, PhpBuf_ZigZag::encode(1), "Encode 1 failure");
    	$this->assertEquals(1, PhpBuf_ZigZag::encode(-1), "Encode -1 failure");
    	$this->assertEquals(246913578, PhpBuf_ZigZag::encode(123456789), "Encode 123456789 failure");
    	$this->assertEquals(246913577, PhpBuf_ZigZag::encode(-123456789), "Encode -123456789 failure");
    }
    public function testDecode() {
    	$this->assertEquals(1, PhpBuf_ZigZag::decode(2), "Encode 1 failure");
    	$this->assertEquals(-1, PhpBuf_ZigZag::decode(1), "Encode -1 failure");
    	$this->assertEquals(123456789, PhpBuf_ZigZag::decode(246913578), "Encode 123456789 failure");
    	$this->assertEquals(-123456789, PhpBuf_ZigZag::decode(246913577), "Encode -123456789 failure");
    } 
    public function testDecodeNegativeValue() {
    	$this->setExpectedException('PhpBuf_ZigZag_Exception');
    	PhpBuf_ZigZag::decode(-1);
    }
}
?>
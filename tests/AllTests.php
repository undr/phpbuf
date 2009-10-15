<?php
define("ROOT", dirname(dirname(__FILE__)));
require_once 'PHPUnit/Framework.php';
require_once(ROOT . '/lib/PhpBuf.php');
require_once ROOT . '/tests/PhpBuf/Base128Test.php';
require_once ROOT . '/tests/PhpBuf/ZigZagTest.php';
require_once ROOT . '/tests/PhpBuf/ReaderWriterTest.php';
require_once ROOT . '/tests/PhpBuf/MessageTest.php';
require_once ROOT . '/tests/PhpBuf/RepeatedMessageTest.php';

class AllTests {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('PhpBuf'); 
        $suite->addTestSuite('PhpBuf_Base128Test');
        $suite->addTestSuite('PhpBuf_ZigZagTest');
        $suite->addTestSuite('PhpBuf_ReaderWriterTest');
        $suite->addTestSuite('PhpBuf_MessageTest');
        $suite->addTestSuite('PhpBuf_RepeatedMessageTest');
        return $suite;
    }
}
?>
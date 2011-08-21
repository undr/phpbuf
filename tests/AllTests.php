<?php
define("ROOT", dirname(dirname(__FILE__)));
require_once 'PHPUnit/Framework.php';
require_once(ROOT . '/lib/PhpBuf.php');
require_once(ROOT . "/tests/Example.php");
require_once(ROOT . "/tests/ExampleRepeat.php");
require_once(ROOT . "/tests/Example/Test1.php");
require_once(ROOT . "/tests/Example/Test2.php");
require_once(ROOT . "/tests/Example/Test3.php");
require_once(ROOT . "/tests/Example/Compatible/OldAPI.php");
require_once(ROOT . "/tests/Example/Compatible/NewAPI.php");
require_once ROOT . '/tests/PhpBuf/Base128Test.php';
require_once ROOT . '/tests/PhpBuf/ZigZagTest.php';
require_once ROOT . '/tests/PhpBuf/ReaderWriterTest.php';
require_once ROOT . '/tests/PhpBuf/MessageTest.php';
require_once ROOT . '/tests/PhpBuf/RepeatedMessageTest.php';
require_once ROOT . '/tests/PhpBuf/BackwardCompatibilityTest.php';

class AllTests {
    public static function suite() {
        $suite = new PHPUnit_Framework_TestSuite('PhpBuf'); 
        $suite->addTestSuite('PhpBuf_Base128Test');
        $suite->addTestSuite('PhpBuf_ZigZagTest');
        $suite->addTestSuite('PhpBuf_ReaderWriterTest');
        $suite->addTestSuite('PhpBuf_MessageTest');
        $suite->addTestSuite('PhpBuf_RepeatedMessageTest');
        $suite->addTestSuite('PhpBuf_BackwardCompatibilityTest');
        return $suite;
    }
}
?>

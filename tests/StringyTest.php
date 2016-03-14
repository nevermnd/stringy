<?php

namespace String\Test;

use PHPUnit_Framework_TestCase;
use String\Stringy;

class StringyTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->assertEquals('foo', $this->assertStr(str('foo')));
        $this->assertEquals('0', $this->assertStr(str(0)));
    }

    public function testEqualsCast()
    {
        $this->assertTrue('abc' == str('abc'));
    }

    public function testEquals()
    {
        $this->assertTrue($this->assertStr(str('FooBar'))->equals('FooBar'));
        $this->assertTrue($this->assertStr(str('FooBar'))->equals(str('FooBar')));
    }

    public function testToUpper()
    {
        $this->assertEquals('FOOBAR', $this->assertStr(str('foobar'))->toUpper());
        $this->assertEquals(str('FOOBAR'), $this->assertStr(str('foobar'))->toUpper());
    }

    public function testToLower()
    {
        $this->assertEquals('foobar', $this->assertStr(str('FOOBAR'))->toLower());
        $this->assertEquals(str('foobar'), $this->assertStr(str('FOOBAR'))->toLower());
    }

    public function testContains()
    {
        $this->assertTrue($this->assertStr(str('foobarqux'))->contains('bar'));
        $this->assertTrue($this->assertStr(str('foobarqux'))->contains(str('bar')));
    }

    public function testCharAt()
    {
        $this->assertEquals('r', $this->assertStr(str('foobarqux'))->charAt(5));
        $this->assertEquals(str('r'), $this->assertStr(str('foobarqux'))->charAt(5));
    }

    public function testSlice()
    {
        $this->assertEquals('bar', $this->assertStr(str('foobarqux'))->slice(3, 3));
        $this->assertEquals(str('bar'), $this->assertStr(str('foobarqux'))->slice(3, 3));
    }

    public function testOffsetSetThrowException()
    {
        $this->setExpectedException('RuntimeException');
        str('abc')[0] = '1';
    }

    public function testOffsetUnsetThrowException()
    {
        $this->setExpectedException('RuntimeException');
        unset(str('abc')[0]);
    }

    public function testOffsetExist()
    {
        $this->assertTrue(isset(str('foo')[2]));
    }

    public function testConcat()
    {
        $this->assertEquals('foobar', $this->assertStr(str('foo'))->concat('bar'));
        $this->assertEquals('foobar', $this->assertStr(str('foo'))->concat(str('bar')));
        $this->assertEquals(str('foobarquxbaz'), $this->assertStr(str('foo'))->concat(str('bar'), 'qux', 'baz'));
    }

    public function testTrim()
    {
        $this->assertEquals('foobar', $this->assertStr(str('  foobar  '))->trim());
        $this->assertEquals(str('foobar'), $this->assertStr(str('  foobar  '))->trim());
    }

    public function testLeftTrim()
    {
        $this->assertEquals('foobar  ', $this->assertStr(str('  foobar  '))->leftTrim());
        $this->assertEquals(str('foobar  '), $this->assertStr(str('  foobar  '))->leftTrim());
    }

    public function testRightTrim()
    {
        $this->assertEquals('  foobar', $this->assertStr(str('  foobar  '))->rightTrim());
        $this->assertEquals(str('  foobar'), $this->assertStr(str('  foobar  '))->rightTrim());
    }

    public function testReplace()
    {
        $this->assertEquals('FooBazQux', $this->assertStr(str('FooBarQux'))->replace('Bar', 'Baz'));
        $this->assertEquals(str('FooBazQux'), $this->assertStr(str('FooBarQux'))->replace('Bar', 'Baz'));
    }

    public function testLength()
    {
        $this->assertEquals(6, $this->assertStr(str('FooBar'))->length());
    }

    public function testEncode()
    {
        $this->assertEquals('&amp;', $this->assertStr(str('&'))->encode());
        $this->assertEquals(str('&amp;'), $this->assertStr(str('&'))->encode());
    }

    public function testInvoke()
    {
        $str = str('FooBar');

        $this->assertEquals($str, $str());
    }

    public function testUcFirst()
    {
        $this->assertEquals('Foobar', $this->assertStr(str('foobar'))->ucFirst());
        $this->assertEquals(str('Foobar'), $this->assertStr(str('foobar'))->ucFirst());
    }

    public function testFormat()
    {

    }

    private function assertStr(Stringy $str)
    {
        $this->assertInstanceOf('String\Stringy', $str);

        return $str;
    }
}
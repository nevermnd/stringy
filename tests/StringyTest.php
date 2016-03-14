<?php

namespace String\Test;

use PHPUnit_Framework_TestCase;
use String\Stringy;

class StringyTest extends PHPUnit_Framework_TestCase
{
    public function testBase64()
    {
        $this->assertEquals('Rm9vQmFyUXV4QmF6', $this->assertStr(str('FooBarQuxBaz'))->toBase64());
        $this->assertEquals(str('Rm9vQmFyUXV4QmF6'), $this->assertStr(str('FooBarQuxBaz'))->toBase64());

        $this->assertEquals('FooBarQuxBaz', $this->assertStr(str('Rm9vQmFyUXV4QmF6'))->fromBase64());
        $this->assertEquals(str('FooBarQuxBaz'), $this->assertStr(str('Rm9vQmFyUXV4QmF6'))->fromBase64());
    }

    public function testCharAt()
    {
        $this->assertEquals('r', $this->assertStr(str('foobarqux'))->charAt(5));
        $this->assertEquals(str('r'), $this->assertStr(str('foobarqux'))->charAt(5));
    }

    public function testConcat()
    {
        $this->assertEquals('foobar', $this->assertStr(str('foo'))->concat('bar'));
        $this->assertEquals('foobar', $this->assertStr(str('foo'))->concat(str('bar')));
        $this->assertEquals(str('foobarquxbaz'), $this->assertStr(str('foo'))->concat(str('bar'), 'qux', 'baz'));
    }

    public function testConstructor()
    {
        $this->assertEquals('foo', $this->assertStr(str('foo')));
        $this->assertEquals('0', $this->assertStr(str(0)));
    }

    public function testContains()
    {
        $this->assertTrue($this->assertStr(str('foobarqux'))->contains('bar'));
        $this->assertTrue($this->assertStr(str('foobarqux'))->contains(str('bar')));
    }

    public function testEncodeHtml()
    {
        $this->assertEquals('&amp;', $this->assertStr(str('&'))->htmlEncode());
        $this->assertEquals(str('&amp;'), $this->assertStr(str('&'))->htmlEncode());
    }

    public function testEquals()
    {
        $this->assertTrue($this->assertStr(str('FooBar'))->equals('FooBar'));
        $this->assertTrue($this->assertStr(str('FooBar'))->equals(str('FooBar')));
    }

    public function testEqualsCast()
    {
        $this->assertTrue('abc' == str('abc'));
    }

    public function testExplode()
    {
        $expected = [str('Foo'), str('Bar'), str('Qux')];

        $this->assertEquals($expected, $this->assertStr(str('Foo|Bar|Qux'))->explode('|'));
    }

    public function testFormat()
    {
        $phrase = 'The %s brown %s jumps over the lazy dog %d times';

        $this->assertEquals(
            'The quick brown fox jumps over the lazy dog 2 times',
            $this->assertStr(str($phrase))->format('quick', 'fox', 2)
        );
        $this->assertEquals(
            str('The quick brown fox jumps over the lazy dog 2 times'),
            $this->assertStr(str($phrase))->format('quick', 'fox', 2)
        );
    }

    public function testHash()
    {
        $this->assertEquals('84813c2587a9b7f57c275a420ebdd702', $this->assertStr(str('FooBarQux'))->hash());
        $this->assertEquals(str('84813c2587a9b7f57c275a420ebdd702'), $this->assertStr(str('FooBarQux'))->hash());
    }

    public function testInvoke()
    {
        $str = str('FooBar');

        $this->assertEquals($str, $str());
    }

    public function testIterate()
    {
        $string = str('foobar');

        $charAt = 0;
        foreach ($string as $item) {
            $this->assertEquals($string->charAt($charAt), $item);
            $charAt++;
        }

        $this->assertSame(6, $charAt);
    }

    public function testLeftTrim()
    {
        $this->assertEquals('foobar  ', $this->assertStr(str('  foobar  '))->leftTrim());
        $this->assertEquals(str('foobar  '), $this->assertStr(str('  foobar  '))->leftTrim());
    }

    public function testLength()
    {
        $this->assertEquals(6, $this->assertStr(str('FooBar'))->length());
        $this->assertEquals(6, $this->assertStr(str('FooBar'))->count());
    }

    public function testOffsetExist()
    {
        $this->assertTrue(str('foo')->offsetExists(2));
    }

    public function testOffsetGet()
    {
        $this->assertEquals('f', $this->assertStr(str('foo'))->offsetGet(0));
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

    public function testReplace()
    {
        $this->assertEquals('FooBazQux', $this->assertStr(str('FooBarQux'))->replace('Bar', 'Baz'));
        $this->assertEquals(str('FooBazQux'), $this->assertStr(str('FooBarQux'))->replace('Bar', 'Baz'));
    }

    public function testRightTrim()
    {
        $this->assertEquals('  foobar', $this->assertStr(str('  foobar  '))->rightTrim());
        $this->assertEquals(str('  foobar'), $this->assertStr(str('  foobar  '))->rightTrim());
    }

    public function testSlice()
    {
        $this->assertEquals('bar', $this->assertStr(str('foobarqux'))->slice(3, 3));
        $this->assertEquals(str('bar'), $this->assertStr(str('foobarqux'))->slice(3, 3));
    }

    public function testSplit()
    {
        $expected = [str('f'), str('o'), str('o')];

        $this->assertEquals($expected, $this->assertStr(str('foo'))->split());
    }

    public function testToLower()
    {
        $this->assertEquals('foobar', $this->assertStr(str('FOOBAR'))->toLower());
        $this->assertEquals(str('foobar'), $this->assertStr(str('FOOBAR'))->toLower());
    }

    public function testToString()
    {
        $this->assertSame('foo', $this->assertStr(str('foo'))->toString());
    }

    public function testToUpper()
    {
        $this->assertEquals('FOOBAR', $this->assertStr(str('foobar'))->toUpper());
        $this->assertEquals(str('FOOBAR'), $this->assertStr(str('foobar'))->toUpper());
    }

    public function testTrim()
    {
        $this->assertEquals('foobar', $this->assertStr(str('  foobar  '))->trim());
        $this->assertEquals(str('foobar'), $this->assertStr(str('  foobar  '))->trim());
    }

    public function testUcFirst()
    {
        $this->assertEquals('Foobar', $this->assertStr(str('foobar'))->ucFirst());
        $this->assertEquals(str('Foobar'), $this->assertStr(str('foobar'))->ucFirst());
    }

    public function testDecodeHtml()
    {
        $this->assertEquals('<b>bold</b>', $this->assertStr(str('&lt;b&gt;bold&lt;/b&gt;'))->htmlDecode());
        $this->assertEquals(str('<b>bold</b>'), $this->assertStr(str('&lt;b&gt;bold&lt;/b&gt;'))->htmlDecode());
    }

    private function assertStr(Stringy $str)
    {
        $this->assertInstanceOf('String\Stringy', $str);

        return $str;
    }
}
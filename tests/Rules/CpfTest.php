<?php

namespace geekcom\ValidatorDocs\Tests\Rules;

use geekcom\ValidatorDocs\Rules\Cpf;
use geekcom\ValidatorDocs\Tests\ValidatorTestCase;

final class CpfTest extends ValidatorTestCase
{
    /**
     * @dataProvider cpfProvider
     */
    public function testHandleReturnsInt($cpf, $position, $expected): void 
    {
        $instance = new Cpf();
        $actual = $instance->cpfHandle($position, $cpf);

        $this->assertSame($expected, $actual);
    }

    /**
     * @dataProvider cpfVerifier
     */
    public function testVerificationReturnsInt($cpf, $position, $expected) :void
    {
        $instance = new Cpf();
        $actual = $instance->cpfVerification($position, $cpf);

        $this->assertSame($expected, $actual);
    }

    public function cpfProvider(): array
    {
        return [
            [
                "cpf" => "54743316065",
                "position" => 10,
                "expected" => 225,
            ],
            [
                "cpf" => "54743316065",
                "position" => 11,
                "expected" => 270,
            ],
        ];
    }

    public function cpfVerifier(): array
    {
        return [
            [
                "cpf" => "54743316065",
                "position" => 9,
                "expected" => 6,
            ],
            [
                "cpf" => "54743316065",
                "position" => 10,
                "expected" => 5,
            ],
        ];
    }
}

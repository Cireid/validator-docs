<?php

declare(strict_types=1);

namespace geekcom\ValidatorDocs\Rules;

use function preg_match;
use function mb_strlen;

final class Cpf extends Sanitization
{
    private const LAST_VALUE = 10;

    private const MAIN_CPF_NUMBER = 8;

    public function validateCpf($attribute, $value): bool
    {
        $cpf = str_split($value);
        $items = [$cpf[9], $cpf[10]];
        $result = [];

        for($i = self::LAST_VALUE; $i > self::MAIN_CPF_NUMBER; $i--) {
            $total = $this->cpfHandle(self::LAST_VALUE, $value);
            $result[] = $this->cpfVerification($total);
        }

        return $items === $result;
    }

    public function cpfHandle(int $position, string $cpf): int 
    {

        $decrement = 2;
        $cpf = substr($cpf, 0, $position - $decrement);
        $total = 0;
        dd(count(str_split($cpf)));
        foreach(str_split($cpf) as $item) {

            $total += (int)$item * $position;
            $position--;
        }

        $decrement--;

        return $total;
    }

    public function cpfVerification(int $total): int
    {
        // dd($total);
        if($total % 11 < 2) {
            return 0;
        }

        return 11 - ($total % 11);
    }
}

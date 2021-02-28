<?php

namespace AlexGrizzled;

class ConvertPhone
{
    private string $original;
    private ?string $number = null;
    private ?string $readable = null;
    private bool $incorrect = false;

    public function __construct(string $phone)
    {
        $this->original = $phone;
    }

    public function getNumber(): string
    {
        return $this->number == null ? $this->parseNumber() : $this->number;
    }

    public function getReadable(): string
    {
        return $this->readable == null ? $this->parseReadable() : $this->readable;
    }

    public function parseNumber(): string
    {
        $this->number = '';
        foreach (str_split($this->original) as $i) {
            if (preg_match('/[0-9]+/', $i)) {
                $this->number .= $i;
            }
        }
        if(strlen($this->number) === 11 && substr($this->number,0,1) === '8') {
            $this->number = '7' . substr($this->number,1);
        }
        if (strlen($this->number) !== 11) {
            $this->incorrect = true;
        }
        return $this->number;
    }

    public function parseReadable(): string
    {
        if ($this->number == null) {
            $this->parseNumber();
        }
        if ($this->isIncorrect()) {
            return '';
        }
        return ($this->readable = '+7 (' .
            substr($this->number, 1, 3) . ') ' .
            substr($this->number, 4, 3) . '-' .
            substr($this->number, 7, 2) . '-' .
            substr($this->number, 9));
    }

    public function isIncorrect(): bool
    {
        return $this->incorrect;
    }
}
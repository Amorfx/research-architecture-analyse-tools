<?php

declare(strict_types=1);

namespace Clementdecou\PhpParsing\Dto;

class UserProfileFormDto
{
    public function __construct(
        public $lastName,
        public string $firstName,
        public int $age
    )
    {
    }
}

<?php

declare(strict_types=1);

namespace Clementdecou\Phpat\Dto;

class UserProfileFormDto
{
    public function __construct(
        public string $lastName,
        public string $firstName,
        public int $age
    )
    {
    }
}

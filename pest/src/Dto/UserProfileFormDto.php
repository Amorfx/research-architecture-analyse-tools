<?php

declare(strict_types=1);

namespace Clementdecou\Pest\Dto;

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

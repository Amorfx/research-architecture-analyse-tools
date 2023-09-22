<?php

declare(strict_types=1);

namespace Clementdecou\ToolsPhpStan\Dto;

use function Clementdecou\ToolsPhpStan\app;

final class UserProfileFormDto
{
    public function __construct(
        public string $lastName,
        public string $firstName,
        public int $age
    )
    {
    }

    public function toTest(): bool
    {
        return app()->environment() === 'test';
    }
}

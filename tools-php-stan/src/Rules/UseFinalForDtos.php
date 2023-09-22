<?php

namespace Clementdecou\ToolsPhpStan\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;

class UseFinalForDtos implements Rule
{
    public function getNodeType(): string
    {
        return Node\Stmt\Class_::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var Node\Stmt\Class_ $node */
        // Check if in namespace that have DTO or has DTO in classname
        if ($this->isClassDto($node, $scope)) {
            // Verify has final in classname
            if ($node->flags !== Node\Stmt\Class_::MODIFIER_FINAL) {
                return [
                    sprintf('The DTO class : %s at line %s has no final.', $node->name->name, $node->getLine())
                ];
            }
        }

        return [];
    }

    private function isClassDto(Node\Stmt\Class_ $class, Scope $scope): bool
    {
        return str_contains(strtolower($scope->getNamespace()), 'dto') || str_contains(strtolower($class->name->name), 'dto');
    }
}

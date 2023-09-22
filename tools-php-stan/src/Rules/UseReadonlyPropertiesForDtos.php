<?php

namespace Clementdecou\ToolsPhpStan\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\InClassNode;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class UseReadonlyPropertiesForDtos implements Rule
{
    public function getNodeType(): string
    {
        return InClassNode::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var InClassNode $node */
        if (!$this->isClassDto($node->getOriginalNode(), $scope)) {
            return [];
        }

        $allProperties = $node->getClassReflection()->getNativeReflection()->getProperties();
        if (sizeof($allProperties) === 0) {
            return [];
        }

        $errors = [];
        foreach ($allProperties as $property) {
            if (!$property->isPublic()) {
                $errors[] = RuleErrorBuilder::message(
                    sprintf('The property: %s is not public.',
                        $property->getName()
                    )
                )->build();
            }
        }

        return $errors;
    }

    private function isClassDto(Node\Stmt\Class_ $class, Scope $scope): bool
    {
        return str_contains(strtolower($scope->getNamespace()), 'dto') || str_contains(strtolower($class->name->name), 'dto');
    }
}

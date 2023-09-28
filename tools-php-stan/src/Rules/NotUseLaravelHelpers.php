<?php

namespace Clementdecou\ToolsPhpStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Node\InFunctionNode;
use PHPStan\Rules\Rule;

class NotUseLaravelHelpers implements Rule
{
    private array $bannedFunctions = [
        'Clementdecou\ToolsPhpStan\app'
    ];
    public function getNodeType(): string
    {
        return Node::class;
    }

    /**
     * {@inheritdoc}
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if ($node instanceof FuncCall) {
            if (!$node->name instanceof Name) {
                return [];
            }

            $function = $node->name->toString();

            if (\in_array($function, $this->bannedFunctions)) {
                return [sprintf('Should not use function "%s", please change the code.', $function)];
            }
        }
        return [];
    }
}

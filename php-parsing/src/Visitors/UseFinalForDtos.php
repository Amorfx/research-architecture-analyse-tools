<?php

namespace Clementdecou\PhpParsing\Visitors;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class UseFinalForDtos extends NodeVisitorAbstract
{
    private array $dtoStringNamespace = [
        'Dto',
        'dto',
        'DTO'
    ];
    public function leaveNode(Node $node)
    {
        if ($node instanceof Node\Stmt\Namespace_) {
            if ($this->checkHasDto($node->name->getParts())) {
                // Verify has final in classname
                $classNode = $this->getClassNode($node);
                if ($classNode) {
                    if ($classNode->flags !== Node\Stmt\Class_::MODIFIER_FINAL) {
                        throw new \Exception('The DTO class : ' . $classNode->name->name . ' at line ' . $classNode->getLine() . ' has no final.');
                    }
                }
            }
        }
    }

    private function getClassNode(Node\Stmt\Namespace_ $node): ?Node\Stmt\Class_
    {
        foreach ($node->stmts as $stmt) {
            if ($stmt instanceof Node\Stmt\Class_) {
                return $stmt;
            }
        }

        return null;
    }

    private function checkHasDto(array $namespaceParts): bool
    {
        foreach ($namespaceParts as $part) {
            if (in_array($part, $this->dtoStringNamespace)) {
                return true;
            }
        }

        return false;
    }
}

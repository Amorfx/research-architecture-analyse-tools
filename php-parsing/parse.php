<?php

use Clementdecou\PhpParsing\Visitors\UseFinalForDtos;
use PhpParser\NodeTraverser;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;

require_once __DIR__ . '/vendor/autoload.php';

$parser        = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
$traverser     = new NodeTraverser();
$prettyPrinter = new Standard();

// add your visitor
$traverser->addVisitor(new UseFinalForDtos());

try {
    $code = file_get_contents(__DIR__ . '/src/Dto/UserProfileFormDto.php');

    // parse
    $stmts = $parser->parse($code);

    // traverse
    $stmts = $traverser->traverse($stmts);

    // pretty print
    $code = $prettyPrinter->prettyPrintFile($stmts);

    echo $code;
} catch (PhpParser\Error $e) {
    echo 'Parse Error: ', $e->getMessage();
}

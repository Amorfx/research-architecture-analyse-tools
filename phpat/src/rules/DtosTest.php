<?php

namespace Clementdecou\Phpat\Rules;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

class DtosTest
{
    public function test_dtos_use_final(): Rule
    {
        return PHPat::rule()
            ->classes(Selector::namespace('Clementdecou\Phpat\Dto'))
            ->shouldBeFinal();
    }
}

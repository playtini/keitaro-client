<?php

namespace Playtini\KeitaroClient\Tests\AdminApi\Model;

use Playtini\KeitaroClient\AdminApi\Model\Error;
use PHPUnit\Framework\TestCase;

class ErrorTest extends TestCase
{
    public function test__construct(): void
    {
        $error = new Error('test');

        self::assertSame('test', $error->error);
    }
}

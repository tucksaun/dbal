<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Tests\Types;

use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;
use PHPUnit\Framework\TestCase;

class ParameterizedTypeTest extends TestCase
{
    public function testTypeCanRedefineConstructor(): void
    {
        $type = new class ('foo') extends StringType {
            public function __construct(private string $name)
            {
            }
        };

        self::assertInstanceOf(Type::class, $type);
    }
}

<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Event;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Schema\ColumnDiff;
use Doctrine\DBAL\Schema\TableDiff;

use function array_merge;
use function array_values;

/**
 * Event Arguments used when SQL queries for changing table columns are generated inside {@see AbstractPlatform}.
 */
class SchemaAlterTableChangeColumnEventArgs extends SchemaEventArgs
{
    /** @var array<int, string> */
    private array $sql = [];

    public function __construct(
        private readonly ColumnDiff $columnDiff,
        private readonly TableDiff $tableDiff,
        private readonly AbstractPlatform $platform,
    ) {
    }

    public function getColumnDiff(): ColumnDiff
    {
        return $this->columnDiff;
    }

    public function getTableDiff(): TableDiff
    {
        return $this->tableDiff;
    }

    public function getPlatform(): AbstractPlatform
    {
        return $this->platform;
    }

    /** @return $this */
    public function addSql(string ...$sql): self
    {
        $this->sql = array_merge($this->sql, array_values($sql));

        return $this;
    }

    /** @return array<int, string> */
    public function getSql(): array
    {
        return $this->sql;
    }
}

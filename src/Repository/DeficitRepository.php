<?php

declare(strict_types=1);

namespace App\Repository;

use \Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;

class DeficitRepository
{
    /**
     * @var Connection $connection
     */
    protected $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     * @throws DBALException
     */
    public function findAll(): array
    {
        $deficitInventoryData = $this->connection->prepare('SELECT * FROM excluded_deficit_inventory');
        $deficitInventoryData->execute();
        $result = $deficitInventoryData->fetchAll();

        return array_column($result, null,'product_id');
    }
}

<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class CurrencyQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Currency',
            'fields' => [
                'currencyCode' => [
                    'type' => Type::string(),
                    'description' => 'Currency Code',
                ],
                'currencyName' => [
                    'type' => Type::string(),
                    'description' => 'Currency Name',
                ],
            ],
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'currency';

    public function getById($id)
    {
        return $this->getBy('id', $id);
    }
}

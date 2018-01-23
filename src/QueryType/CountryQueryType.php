<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class CountryQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Country',
            'fields' => [
                'countryCode' => [
                    'type' => Type::string(),
                    'description' => 'Country Code',
                ],
                'countryName' => [
                    'type' => Type::string(),
                    'description' => 'Country Name',
                ],
            ],
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'country';

    public function getById($id)
    {
        return $this->getBy('id', $id);
    }
}

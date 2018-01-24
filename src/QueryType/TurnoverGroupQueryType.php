<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class TurnoverGroupQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'TurnoverGroup',
            'fields' => [
                'code' => [
                    'type' => Type::string(),
                    'description' => 'Turnover Group Code',
                ],
                'name' => [
                    'type' => Type::string(),
                    'description' => 'Turnover Group Name',
                ],
                'segmentBy' => [
                    'type' => Type::string(),
                    'description' => 'Segment By',
                ],
                'createdAt' => [
                    'type' => Type::string(),
                    'convert' => 'dateTimeToIsoDateTime',
                    'description' => 'Created at',
                ],
            ],
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'turnover_group';

    public function getById($id)
    {
        return $this->getBy('id', $id);
    }

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

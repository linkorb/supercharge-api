<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class BatchQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Batch',
            'fields' => function () use ($types) {
                return [
                    'xuid' => [
                        'type' => Type::string(),
                        'description' => 'Xuid',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'contact' => [
                        'type' => $types->get(ContactQueryType::class),
                        'alias' => 'contactId',
                        'link' => 'getById',
                        'description' => 'Batch contact detail',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'batch';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }

    public function getById($id)
    {
        return $this->getBy('id', $id);
    }
}

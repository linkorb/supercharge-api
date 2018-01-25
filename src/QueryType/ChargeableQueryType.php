<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class ChargeableQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Chargeable',
            'fields' => function () use ($types) {
                return [
                    'code' => [
                        'type' => Type::string(),
                        'description' => 'Chargeable Code',
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Chargeable Name',
                    ],
                    'description' => [
                        'type' => type::string(),
                        'description' => 'Description',
                        'resolve' => function ($value) {
                            return nl2br($value['description']);
                        },
                    ],
                    'price' => [
                        'type' => Type::float(),
                        'description' => 'Chargeable Price',
                    ],
                    'turnoverGroup' => [
                        'type' => $types->get(TurnoverGroupQueryType::class),
                        'alias' => 'turnoverGroupId',
                        'link' => 'getById',
                        'description' => 'Turnover Group',
                    ],
                    'vat' => [
                        'type' => $types->get(VatQueryType::class),
                        'alias' => 'vatId',
                        'link' => 'getById',
                        'description' => 'VAT',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'chargeable';

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

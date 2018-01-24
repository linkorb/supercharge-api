<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class TurnoverGroupAccountQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'TurnoverGroupAccount',
            'fields' => function () use ($types) {
                return [
                    'turnoverGroup' => [
                        'type' => $types->get(TurnoverGroupQueryType::class),
                        'alias' => 'turnoverGroupId',
                        'link' => 'getById',
                        'description' => 'Turnover Group',
                    ],
                    'value' => [
                        'type' => Type::string(),
                        'description' => 'Value',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'ledgerAccount' => [
                        'type' => $types->get(LedgerAccountQueryType::class),
                        'alias' => 'ledgerAccountId',
                        'link' => 'getById',
                        'description' => 'Turnover Group',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'turnover_group_account';

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

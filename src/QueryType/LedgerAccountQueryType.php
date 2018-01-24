<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class LedgerAccountQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'LedgerAccount',
            'fields' => function () use ($types) {
                return [
                    'code' => [
                        'type' => Type::string(),
                        'description' => 'Ledger Account Code',
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Name',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'category' => [
                        'type' => $types->get(LedgerCategoryQueryType::class),
                        'alias' => 'ledgerCategoryId',
                        'link' => 'getById',
                        'description' => 'Category',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'ledger_account';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

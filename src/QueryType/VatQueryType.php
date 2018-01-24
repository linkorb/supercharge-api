<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class VatQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Vat',
            'fields' => function () use ($types) {
                return [
                    'code' => [
                        'type' => Type::string(),
                        'description' => 'VAT Code',
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'VAT Name',
                    ],
                    'amount' => [
                        'type' => Type::string(),
                        'description' => 'VAT Amount',
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
                        'description' => 'Ledger Account',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'vat';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

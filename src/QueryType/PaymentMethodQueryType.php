<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class PaymentMethodQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'PaymentMethod',
            'fields' => function () use ($types) {
                return [
                    'code' => [
                        'type' => Type::string(),
                        'description' => 'Payment method code',
                    ],
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Payment method name',
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

    protected $tableName = 'payment_method';

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

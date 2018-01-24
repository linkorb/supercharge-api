<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class AdministrationQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Administration',
            'fields' => function () use ($types) {
                return [
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Administration Name',
                    ],
                    'accountName' => [
                        'type' => Type::string(),
                        'description' => 'Account Name',
                    ],
                    'currency' => [
                        'type' => $types->get(CurrencyQueryType::class),
                        'alias' => 'currencyId',
                        'link' => 'getById',
                        'description' => 'Currency',
                    ],
                    'description' => [
                        'type' => type::string(),
                        'description' => 'Description',
                        'resolve' => function ($value) {
                            return nl2br($value['description']);
                        },
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'deletedAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Deleted at',
                    ],
                    'stripeKey' => [
                        'type' => Type::string(),
                        'description' => 'Strip Key',
                    ],
                    'stripeSyncType' => [
                        'type' => Type::string(),
                        'description' => 'Strip Sync Type',
                    ],
                    'TurnoverGroups' => [
                        'type' => Type::listOf($types->get(TurnoverGroupQueryType::class)),
                        'alias' => 'id',
                        'list' => 'getAllByAdministrationId',
                        'description' => 'Returns list of Turnover Group',
                    ],
                ];
            },
        ];
        parent::__construct($pdo, $config);
    }

    protected $tableName = 'administration';
}

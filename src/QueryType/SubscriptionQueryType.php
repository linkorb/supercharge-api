<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class SubscriptionQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Subscription',
            'fields' => function () use ($types) {
                return [
                    'xuid' => [
                        'type' => Type::string(),
                        'description' => 'Xuid',
                    ],
                    'quantity' => [
                        'type' => Type::int(),
                        'description' => 'Quantity',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'startAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Start at',
                    ],
                    'endAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'end at',
                    ],
                    'plan' => [
                        'type' => $types->get(SubscriptionPlanQueryType::class),
                        'alias' => 'planId',
                        'link' => 'getById',
                        'description' => 'Subscription Plan',
                    ],
                    'contact' => [
                        'type' => $types->get(ContactQueryType::class),
                        'alias' => 'contactId',
                        'link' => 'getById',
                        'description' => 'Subscription Contact',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'subscription';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

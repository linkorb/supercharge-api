<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class SubscriptionPlanQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'SubscriptionPlan',
            'fields' => function () use ($types) {
                return [
                    'code' => [
                        'type' => Type::string(),
                        'description' => 'Plan Code',
                    ],
                    'displayName' => [
                        'type' => Type::string(),
                        'description' => 'Plan Name',
                    ],
                    'description' => [
                        'type' => type::string(),
                        'description' => 'Description',
                        'resolve' => function ($value) {
                            return nl2br($value['description']);
                        },
                    ],
                    'setupFee' => [
                        'type' => Type::string(),
                        'description' => 'Setup Fee',
                    ],
                    'recurringFee' => [
                        'type' => Type::string(),
                        'description' => 'Recurring Fee',
                    ],
                    'intervalLength' => [
                        'type' => Type::string(),
                        'description' => 'Interval Length',
                    ],
                    'intervalUnit' => [
                        'type' => Type::string(),
                        'description' => 'Interval Unit',
                    ],
                    'maxCycles' => [
                        'type' => Type::string(),
                        'description' => 'Max Cycles',
                    ],
                    'trialDays' => [
                        'type' => Type::string(),
                        'description' => 'Trial Days',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'turnoverGroup' => [
                        'type' => $types->get(TurnoverGroupQueryType::class),
                        'alias' => 'turnoverGroupId',
                        'link' => 'getById',
                        'description' => 'Turnover Group',
                    ],
                    // 'vat' => [
                    //     'type' => $types->get(VatQueryType::class),
                    //     'alias' => 'VatId',
                    //     'link' => 'getById',
                    //     'description' => 'VAT',
                    // ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'plan';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

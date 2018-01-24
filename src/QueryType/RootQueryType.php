<?php

namespace SuperCharge\Api\QueryType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class RootQueryType extends ObjectType
{
    public function __construct(
        AdministrationQueryType $administrationQueryType,
        CurrencyQueryType  $currencyQueryType
    ) {
        $config = [
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => Type::string(),
                    'args' => [
                        'message' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($value, $args, $context, $info) {
                        return  $args['message'].', ';
                    },
                ],
                'Administration' => [
                    'type' => Type::listOf($administrationQueryType),
                    'description' => 'Returns list of Administration',
                    'resolve' => function ($root, $args) use ($administrationQueryType) {
                        return $administrationQueryType->getAll();
                    },
                ],
                'Currency' => [
                    'type' => Type::listOf($currencyQueryType),
                    'description' => 'Returns list of Currency',
                    'resolve' => function ($root, $args) use ($currencyQueryType) {
                        return $currencyQueryType->getAll();
                    },
                ],
            ],
        ];
        parent::__construct($config);
    }
}

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
                'administrations' => [
                    'type' => Type::listOf($administrationQueryType),
                    'description' => 'Returns list of Administration',
                    'resolve' => function ($root, $args) use ($administrationQueryType) {
                        return $administrationQueryType->getAll();
                    },
                ],
                'administration' => [
                    'type' => $administrationQueryType,
                    'description' => 'Returns administration by name',
                    'args' => [
                        'name' => Type::nonNull(Type::string()),
                    ],
                    'resolve' => function ($root, $args) use ($administrationQueryType) {
                        if (isset($args['name'])) {
                            $item = $administrationQueryType->getByName($args['name']);

                            return $item;
                        }

                        return [];
                    },
                ],
                'currency' => [
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

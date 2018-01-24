<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class LedgerCategoryQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'LedgerCategory',
            'fields' => function () use ($types) {
                return [
                    'name' => [
                        'type' => Type::string(),
                        'description' => 'Category Name',
                    ],
                    'parent' => [
                        'type' => $types->get(LedgerCategoryQueryType::class),
                        'alias' => 'parentId',
                        'link' => 'getById',
                        'description' => 'Parent Category',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'ledger_category';

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

<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class InvoiceQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Invoice',
            'fields' => function () use ($types) {
                return [
                    'reference' => [
                        'type' => Type::int(),
                        'description' => 'Reference',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'notes' => [
                        'type' => type::string(),
                        'description' => 'Notes',
                        'resolve' => function ($value) {
                            return nl2br($value['notes']);
                        },
                    ],
                    'contact' => [
                        'type' => $types->get(ContactQueryType::class),
                        'alias' => 'contactId',
                        'link' => 'getById',
                        'description' => 'Invoice contact detail',
                    ],
                    'batchRecipient' => [
                        'type' => $types->get(ContactQueryType::class),
                        'alias' => 'batchRecipient',
                        'link' => 'getById',
                        'description' => 'Batch Recipient details',
                    ],
                    'batch' => [
                        'type' => $types->get(BatchQueryType::class),
                        'alias' => 'batchId',
                        'link' => 'getById',
                        'description' => 'Batch Recipient details',
                    ],
                    'pspId' => [
                        'type' => Type::int(),
                        'description' => 'Psp Id',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'invoice';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

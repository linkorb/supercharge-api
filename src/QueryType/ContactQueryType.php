<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class ContactQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Contact',
            'fields' => function () use ($types) {
                return [
                    'code' => [
                        'type' => Type::string(),
                        'description' => 'Contact Code',
                    ],
                    'firstname' => [
                        'type' => Type::string(),
                        'description' => 'Firstname',
                    ],
                    'lastname' => [
                        'type' => Type::string(),
                        'description' => 'lastname',
                    ],
                    'organization' => [
                        'type' => Type::string(),
                        'description' => 'Organization',
                    ],
                    'email' => [
                        'type' => Type::string(),
                        'description' => 'Email Address',
                    ],
                    'vatnr' => [
                        'type' => Type::string(),
                        'description' => 'VAT  Number',
                    ],
                    'addressline1' => [
                        'type' => Type::string(),
                        'description' => 'Address line 1',
                    ],
                    'addressline2' => [
                       'type' => Type::string(),
                       'description' => 'Address line 2',
                    ],
                    'city' => Type::string(),
                    'stateprovince' => [
                        'type' => Type::string(),
                        'description' => 'state Province',
                    ],
                    'postalcode' => [
                       'type' => Type::string(),
                       'description' => 'postalcode',
                    ],
                    'country' => [
                       'type' => $types->get(CountryQueryType::class),
                       'alias' => 'countryId',
                       'link' => 'getById',
                       'description' => 'Contry details',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'cocNumber' => [
                        'type' => Type::string(),
                        'description' => 'Coc Number',
                    ],
                    'bankNumber' => [
                        'type' => Type::string(),
                        'description' => 'Bank Number',
                    ],
                    'phone' => [
                        'type' => Type::string(),
                        'description' => 'Phone',
                    ],
                    'isBatchRecipient' => [
                        'type' => Type::string(),
                        'description' => 'is batch recipient Y/N',
                    ],
                    'psp_id' => [
                        'type' => Type::string(),
                        'description' => 'PSP Id',
                    ],
                ];
            },
        ];

        parent::__construct($pdo, $config);
    }

    protected $tableName = 'contact';

    public function getAllByAdministrationId($administrationId)
    {
        $data = $this->getAllBy('administration_id', $administrationId);

        return $data;
    }
}

<?php

namespace SuperCharge\Api\QueryType;

use Graphael\AbstractPdoObjectType;
use GraphQL\Type\Definition\Type;
use Graphael\TypeRegistry;
use PDO;

class TransactionQueryType extends AbstractPdoObjectType
{
    public function __construct(PDO $pdo, TypeRegistry $types)
    {
        $config = [
            'name' => 'Transaction',
            'fields' => function () use ($types) {
                return [
                    'xuid' => [
                        'type' => Type::string(),
                        'description' => 'Xuid',
                    ],
                    'contact' => [
                        'type' => $types->get(ContactQueryType::class),
                        'alias' => 'contactId',
                        'link' => 'getById',
                        'description' => 'Contact detail',
                    ],
                    'invoice' => [
                        'type' => $types->get(InvoiceQueryType::class),
                        'alias' => 'invoiceId',
                        'link' => 'getById',
                        'description' => 'Invoice detail',
                    ],
                    'paymentMethod' => [
                        'type' => $types->get(PaymentMethodQueryType::class),
                        'alias' => 'paymentMethodId',
                        'link' => 'getById',
                        'description' => 'Payment method detail',
                    ],
                    'ledgerAccount' => [
                        'type' => $types->get(LedgerAccountQueryType::class),
                        'alias' => 'ledgerAccountId',
                        'link' => 'getById',
                        'description' => 'Ledger Account detail',
                    ],
                    'turnoverGroup' => [
                        'type' => $types->get(TurnoverGroupQueryType::class),
                        'alias' => 'turnoverGroupId',
                        'link' => 'getById',
                        'description' => 'Turnover group detail',
                    ],
                    'chargeable' => [
                        'type' => $types->get(ChargeableQueryType::class),
                        'alias' => 'chargeableId',
                        'link' => 'getById',
                        'description' => 'Chargeable detail',
                    ],
                    'transactionType' => [
                        'type' => Type::string(),
                        'description' => 'Transaction type',
                    ],
                    'createdAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Created at',
                    ],
                    'effectAt' => [
                        'type' => Type::string(),
                        'convert' => 'dateTimeToIsoDateTime',
                        'description' => 'Effect at',
                    ],
                    'sourceType' => [
                        'type' => Type::string(),
                        'description' => 'Source type',
                    ],
                    'sourceId' => [
                        'type' => Type::string(),
                        'description' => 'Source Id',
                    ],
                    'vat' => [
                        'type' => $types->get(VatQueryType::class),
                        'alias' => 'vatId',
                        'link' => 'getById',
                        'description' => 'VAT detail',
                    ],
                    'price' => [
                        'type' => Type::float(),
                        'description' => 'Price',
                    ],
                    'quantity' => [
                        'type' => Type::int(),
                        'description' => 'Quantity',
                    ],
                    'description' => [
                        'type' => type::string(),
                        'description' => 'Description',
                        'resolve' => function ($value) {
                            return nl2br($value['description']);
                        },
                    ],
                    'notes' => [
                        'type' => type::string(),
                        'description' => 'Notes',
                        'resolve' => function ($value) {
                            return nl2br($value['notes']);
                        },
                    ],
                    'metadata' => [
                        'type' => type::string(),
                        'description' => 'Metadata',
                        'resolve' => function ($value) {
                            return nl2br($value['metadata']);
                        },
                    ],
                    'batch' => [
                        'type' => $types->get(BatchQueryType::class),
                        'alias' => 'batchId',
                        'link' => 'getById',
                        'description' => 'Batch detail',
                    ],
                    'pledge' => [
                        'type' => Type::string(),
                        'description' => 'Pledge',
                    ],
                    'journal' => [
                        'type' => $types->get(JournalQueryType::class),
                        'alias' => 'journalId',
                        'link' => 'getById',
                        'description' => 'Journal detail',
                    ],
                    'pspId' => [
                        'type' => Type::string(),
                        'description' => 'Psp Id',
                    ],
                    'parent' => [
                        'type' => $types->get(TransactionQueryType::class),
                        'alias' => 'parentId',
                        'link' => 'getById',
                        'description' => 'Parent detail',
                    ],
                ];
            },
        ];
        parent::__construct($pdo, $config);
    }

    protected $tableName = 'transaction';

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

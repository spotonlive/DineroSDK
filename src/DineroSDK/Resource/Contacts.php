<?php

namespace DineroSDK\Resource;

use DineroSDK\Entity\Contact;
use DineroSDK\Exception\DineroMissingParameterException;
use GeneratedHydrator\Configuration;
use Zend\Hydrator\ClassMethods;
use Zend\Hydrator\ObjectProperty;

class Contacts extends AbstractResource
{
    /**
     * Create a new contact
     *
     * @param Contact $contact
     * @return Contact
     * @throws DineroMissingParameterException
     */
    public function create(Contact $contact)
    {
        $contact = clone $contact;
        $endpoint = sprintf('/%s/contacts', $this->dinero->getOrganizationId());

        if (!$contact->getName()) {
            throw new DineroMissingParameterException('Create Contact requires a \'Name\'');
        }

        if (!$contact->getIsPerson()) {
            throw new DineroMissingParameterException('Create Contact requires a \'IsPerson\'');
        }

        if (!$contact->getCountryKey()) {
            throw new DineroMissingParameterException('Create Contact requires a \'CountryKey\'');
        }

        $hydrator = new ObjectProperty();
        $data = $hydrator->extract($contact);

        $result = $this->dinero->send($endpoint, 'post', json_encode($data));

        return $contact->withContactGuid($result->getBody()['ContactGuid']);
    }

    /**
     * Find a contact
     *
     * @param array $filterValues
     * @return array
     */
    public function find(array $filterValues = [])
    {
        $path = sprintf('/%s/contacts', $this->dinero->getOrganizationId());

        $options = [];

        if (count($filterValues)) {
            if (isset($filterValues['IsPerson'])) {
                $filterValues['IsPerson'] = ($filterValues['IsPerson']) ? 'true' : 'false';
            }

            $filter = [];

            foreach ($filterValues as $property => $value) {
                $filter[] = $property . " " . "eq" . " " . "'" . $value . "'";
            }

            $filter = implode(";", $filter);

            $options['queryFilter'] = $filter;
        }

        $fields = [
            'Name',
            'ContactGuid',
            'ExternalReference',
            'IsPerson',
            'Street',
            'Zipcode',
            'City',
            'CountryKey',
            'Phone',
            'Email',
            'Webpage',
            'AttPerson',
            'VatNumber',
            'EanNumber',
            'PaymentConditionType',
            'PaymentConditionNumberOfDays',
            'UpdatedAt'
        ];

        $options['fields'] = implode(",", $fields);

        $endpoint = sprintf(
            '%s?%s',
            $path,
            http_build_query($options)
        );

        $result = $this->dinero->send($endpoint, 'get', '');

        $dineroContacts = $result->getBody()['Collection'];

        $contacts = [];

        $hydrator = $this->createHydrator(Contact::class);

        foreach ($dineroContacts as $dineroContact) {
            $contact = new Contact($dineroContact['ContactGuid']);

            $hydrator->hydrate($dineroContact, $contact);

            $contacts[] = $contact;
        }

        return $contacts;
    }
}

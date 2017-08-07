<?php

namespace DineroSDK\Resource;

use DineroSDK\Entity\Organization;

class Organizations extends AbstractResource
{
    /**
     * Find a organization
     *
     * @param array $filterValues
     * @param array $options
     * @return array|Organization[]
     */
    public function find(array $filterValues = [], $options = [])
    {
        $path = '/organizations';

        if (count($filterValues)) {
            $filter = [];

            foreach ($filterValues as $property => $value) {
                $filter[] = sprintf('%s eq \'%s\'', $property, $value);
            }

            $filter = implode(";", $filter);

            $options['queryFilter'] = $filter;
        }

        $fields = [
            'Name',
            'Id,',
            'IsPro',
            'IsPayingPro',
        ];

        $options['fields'] = implode(",", $fields);

        $endpoint = sprintf(
            '%s?%s',
            $path,
            http_build_query($options)
        );

        $result = $this->dinero->send($endpoint, 'get', '');

        $dineroOrganizations = $result->getBody();

        $organizations = [];

        $hydrator = $this->createHydrator(Organization::class);

        foreach ($dineroOrganizations as $dineroOrganization) {
            $organization = new Organization($dineroOrganization['Id']);

            $hydrator->hydrate($dineroOrganization, $organization);

            $organizations[] = $organization;
        }

        return $organizations;
    }
}

<?php

namespace iPresso\Service;

use iPresso\Model\Agreement;

class AgreementService
{
    /**
     * @var Service
     */
    private $service;

    /**
     * AgreementService constructor.
     * @param Service $service
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Add new agreements
     * @param Agreement $agreement
     * @return bool|Response
     * @throws \Exception
     */
    public function add(Agreement $agreement)
    {
        return $this
            ->service
            ->setRequestPath('agreement')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($agreement->getAgreement())
            ->request();
    }

    /**
     * Get all available agreements
     * @return bool|Response
     */
    public function get()
    {
        return $this
            ->service
            ->setRequestPath('agreement')
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Edit agreement
     * @param integer $idAgreement
     * @param Agreement $agreement
     * @return bool|Response
     * @throws \Exception
     */
    public function edit($idAgreement, Agreement $agreement)
    {
        return $this
            ->service
            ->setRequestPath('agreement/' . $idAgreement)
            ->setRequestType(Service::REQUEST_METHOD_PUT)
            ->setPostData(['agreement' => $agreement->getAgreement()])
            ->request();
    }

    /**
     * Delete agreement
     * @param integer $idAgreement
     * @return bool|Response
     */
    public function delete($idAgreement)
    {
        return $this
            ->service
            ->setRequestPath('agreement/' . $idAgreement)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }

    /**
     * Add contacts to agreement
     * @param integer $idAgreement
     * @param array $contactIds
     * @return bool|Response
     * @throws \Exception
     */
    public function addContact($idAgreement, $contactIds)
    {
        if (!is_array($contactIds) || empty($contactIds))
            throw new \Exception('Set idContacts array first.');

        $data['contact'] = $contactIds;
        return $this
            ->service
            ->setRequestPath('agreement/' . $idAgreement . '/contact')
            ->setRequestType(Service::REQUEST_METHOD_POST)
            ->setPostData($data)
            ->request();
    }

    /**
     * Get contacts assigned to an agreement
     * @param integer $idAgreement
     * @param integer|bool $page
     * @return bool|Response
     */
    public function getContact($idAgreement, $page = false)
    {
        if ($page && is_numeric($page))
            $page = '?page=' . $page;

        return $this
            ->service
            ->setRequestPath('agreement/' . $idAgreement . '/contact' . $page)
            ->setRequestType(Service::REQUEST_METHOD_GET)
            ->request();
    }

    /**
     * Delete contact’s agreement
     * @param integer $idAgreement
     * @param integer $idContact
     * @return bool|Response
     */
    public function deleteContact($idAgreement, $idContact)
    {
        return $this
            ->service
            ->setRequestPath('agreement/' . $idAgreement . '/contact/' . $idContact)
            ->setRequestType(Service::REQUEST_METHOD_DELETE)
            ->request();
    }
}
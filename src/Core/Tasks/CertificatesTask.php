<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\CertManagementApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Certificate;
use Upsun\Model\CertificateCreateInput;
use Upsun\Model\CertificatePatch;
use Upsun\Model\CertificateProvisioner;
use Upsun\Model\CertificateProvisionerPatch;
use Upsun\UpsunClient;

/**
 * CertificatesTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class CertificatesTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly CertManagementApi $api,
    ) {
        parent::__construct($client);
    }

    /**
     * Add an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function add(
        string $projectId,
        string $certificate,
        string $key,
        ?array $chain = null,
        ?bool $isInvalid = null,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);

        if (empty($certificate) || empty($key)) {
            throw new InvalidArgumentException("Certificate and key are required");
        }

        return $this->api->createProjectsCertificates(
            $projectId,
            certificateCreateInput: new CertificateCreateInput(
                $certificate,
                $key,
                $chain,
                $isInvalid
            )
        );
    }

    /**
     * Delete an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function delete(string $projectId, string $certificateId): AcceptedResponse
    {
        $this->checkProjectId($projectId);
        $this->checkCertificateId($certificateId);

        return $this->api->deleteProjectsCertificates(
            $projectId,
            $certificateId
        );
    }

    /**
     * Get an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function get(string $projectId, string $certificateId): Certificate
    {
        $this->checkProjectId($projectId);
        $this->checkCertificateId($certificateId);

        return $this->api->getProjectsCertificates(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * Get list of SSL certificates
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return Certificate[]
     */
    public function list(string $projectId): array
    {
        $this->checkProjectId($projectId);

        return $this->api->listProjectsCertificates(projectId: $projectId);
    }

    /**
     * Update an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function update(
        string $projectId,
        string $certificateId,
        ?array $chain = [],
        ?bool $isInvalid = null,
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        $this->checkCertificateId($certificateId);

        return $this->api->updateProjectsCertificates(
            $projectId,
            $certificateId,
            new CertificatePatch(
                $chain,
                $isInvalid
            )
        );
    }

    // Certificate Provisioner Methods

    /**
     * Get a certificate provisioner configuration
     * This method retrieves the configuration of a certificate provisioner, which is used to automatically manage
     * and renew SSL/TLS certificates for your project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function getProvisioner(
        string $projectId,
        string $certificateProvisionerDocumentId
    ): CertificateProvisioner {
        $this->checkProjectId($projectId);
        if (empty($certificateProvisionerDocumentId)) {
            throw new InvalidArgumentException('Certificate provisioner document ID cannot be empty');
        }

        return $this->api->getProjectsProvisioners(
            projectId: $projectId,
            certificateProvisionerDocumentId: $certificateProvisionerDocumentId
        );
    }

    /**
     * List all certificate provisioners for a project
     * This method retrieves a list of all certificate provisioners configured for the project.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     * @return CertificateProvisioner[]
     */
    public function listProvisioners(string $projectId): array
    {
        $this->checkProjectId($projectId);

        return $this->api->listProjectsProvisioners(projectId: $projectId);
    }

    /**
     * Update a certificate provisioner configuration
     * This method allows you to modify the configuration of a certificate provisioner.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if required parameters are missing or invalid
     */
    public function updateProvisioner(
        string $projectId,
        string $certificateProvisionerDocumentId,
        ?CertificateProvisionerPatch $certificateProvisionerPatch = null
    ): AcceptedResponse {
        $this->checkProjectId($projectId);
        if (empty($certificateProvisionerDocumentId)) {
            throw new InvalidArgumentException('Certificate provisioner document ID cannot be empty');
        }

        return $this->api->updateProjectsProvisioners(
            projectId: $projectId,
            certificateProvisionerDocumentId: $certificateProvisionerDocumentId,
            certificateProvisionerPatch: $certificateProvisionerPatch
        );
    }
}

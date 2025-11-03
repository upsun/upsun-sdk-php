<?php

namespace Upsun\Core\Tasks;

use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\CertManagementApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Certificate;
use Upsun\Model\CertificateCreateInput;
use Upsun\Model\CertificatePatch;
use Upsun\UpsunClient;

/**
 * CertificateTask class.
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
     * Adds an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(
        string $projectId,
        string $certificate,
        string $key,
        ?array $chain = null,
        ?bool $isInvalid = null,
    ): AcceptedResponse {
        $certificateCreateInput = new CertificateCreateInput(
            certificate: $certificate,
            key: $key,
            chain: $chain,
            isInvalid: $isInvalid
        );
        return $this->api->createProjectsCertificates($projectId, $certificateCreateInput);
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function delete(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->api->deleteProjectsCertificates(
            projectId: $projectId,
            certificateId: $certificateId
        );
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $certificateId): Certificate
    {
        return $this->api->getProjectsCertificates(projectId: $projectId, certificateId: $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     *
     * @throws ClientExceptionInterface
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @return Certificate[]
     */
    public function list(string $projectId): array
    {
        return $this->api->listProjectsCertificates(projectId: $projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(
        string $projectId,
        string $certificateId,
        ?array $chain = null,
        ?bool $isInvalid = null,
    ): AcceptedResponse {
        $certificatePatch = new CertificatePatch(
            chain: $chain,
            isInvalid: $isInvalid
        );
        return $this->api->updateProjectsCertificates(
            projectId: $projectId,
            certificateId: $certificateId,
            certificatePatch: $certificatePatch
        );
    }
}

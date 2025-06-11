<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\CertManagementApi;
use OpenAPI\Client\Model\AcceptedResponse;
use OpenAPI\Client\Model\Certificate;
use OpenAPI\Client\Model\CertificateCreateInput;
use OpenAPI\Client\Model\CertificatePatch;
use Upsun\UpsunClient;

class CertificateTask extends TaskBase
{

    public function __construct(
        public readonly UpsunClient        $client,
        private readonly CertManagementApi $api,
    )
    {
        parent::__construct($this->client);
    }

    /**
     * Adds an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(string $projectId, array $certificateCreateInput): AcceptedResponse
    {
        $this->refreshToken();
        $certificateCreateInput = new CertificateCreateInput($certificateCreateInput);
        return $this->api->createProjectsCertificates($projectId, $certificateCreateInput);
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $certificateId): AcceptedResponse
    {
        $this->refreshToken();
        return $this->api->deleteProjectsCertificates($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $certificateId): Certificate
    {
        $this->refreshToken();
        return $this->api->getProjectsCertificates($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId): array
    {
        $this->refreshToken();
        return $this->api->listProjectsCertificates($projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $projectId, string $certificateId, array $certificatePatch): AcceptedResponse
    {
        $this->refreshToken();
        $certificatePatch = new CertificatePatch($certificatePatch);
        return $this->api->updateProjectsCertificates($projectId, $certificateId, $certificatePatch);
    }
}

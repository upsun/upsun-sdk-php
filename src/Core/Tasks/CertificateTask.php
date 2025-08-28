<?php

namespace Upsun\Core\Tasks;

use Exception;
use Upsun\ApiException;
use Upsun\Api\CertManagementApi;
use Upsun\Model\AcceptedResponse;
use Upsun\Model\Certificate;
use Upsun\Model\CertificateCreateInput;
use Upsun\Model\CertificatePatch;
use Upsun\UpsunClient;

/**
 * CertificateTask class.
 *
 * @author    Upsun SDK Team
 * @license   Apache-2.0
 * @see       https://docs.upsun.com
 */
class CertificateTask extends TaskBase
{
    public function __construct(
        public UpsunClient $client,
        private readonly CertManagementApi $api,
    ) {
        parent::__construct($this->client);
    }

    /**
     * Adds an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function create(string $projectId, array $certificateCreateInput): AcceptedResponse
    {
        $certificateCreateInput = new CertificateCreateInput($certificateCreateInput);
        return $this->api->createProjectsCertificates($projectId, $certificateCreateInput);
    }

    /**
     * Deletes an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $projectId, string $certificateId): AcceptedResponse
    {
        return $this->api->deleteProjectsCertificates($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $projectId, string $certificateId): Certificate
    {
        return $this->api->getProjectsCertificates($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $projectId): array
    {
        return $this->api->listProjectsCertificates($projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @throws ApiException|Exception on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $projectId, string $certificateId, array $certificatePatch): AcceptedResponse
    {
        $certificatePatch = new CertificatePatch($certificatePatch);
        return $this->api->updateProjectsCertificates($projectId, $certificateId, $certificatePatch);
    }
}

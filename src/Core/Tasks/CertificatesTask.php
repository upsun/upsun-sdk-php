<?php

namespace Upsun\Core\Tasks;

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
     * @param array{
     *     certificate: string,
     *     key: string,
     *     chain?: array,
     *     isInvalid?: bool
     * } $options Configuration options
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function create(string $projectId, array $options = []): AcceptedResponse
    {
        $certificateCreateInput = new CertificateCreateInput(...$options);
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
        return $this->api->deleteProjectsCertificates($projectId, $certificateId);
    }

    /**
     * Gets an SSL certificate
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function get(string $projectId, string $certificateId): Certificate
    {
        return $this->api->getProjectsCertificates($projectId, $certificateId);
    }

    /**
     * Gets list of SSL certificates
     *
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @return Certificate[]
     */
    public function list(string $projectId): array
    {
        return $this->api->listProjectsCertificates($projectId);
    }

    /**
     * Updates an SSL certificate
     *
     * @param array{
     *     chain?: array,
     *     isInvalid?: bool,
     * } $data
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     */
    public function update(string $projectId, string $certificateId, array $data): AcceptedResponse
    {
        $certificatePatch = new CertificatePatch(...$data);
        return $this->api->updateProjectsCertificates($projectId, $certificateId, $certificatePatch);
    }
}

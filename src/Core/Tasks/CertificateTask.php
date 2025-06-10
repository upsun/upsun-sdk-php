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
    private readonly CertManagementApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    ) {
        $this->api = new CertManagementApi($this->client->apiClient, $this->client->apiConfig);
    }

    /************** **************************/
    /********* Getter ************************/
    /************** **************************/

    public function getApi(): CertManagementApi
    {
        return $this->api;
    }
    
    /************** *****************************/
    /********* CertManagementApi ****************/
    /************** *****************************/

    /**
     * Operation createProjectsCertificates
     *
     * Add an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param array $certificate_create_input (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function create(string $project_id, array $certificate_create_input): AcceptedResponse
    {
        $this->refreshToken();
        $certificate_create_input = new CertificateCreateInput($certificate_create_input);
        return $this->getApi()->createProjectsCertificates($project_id, $certificate_create_input);
    }

    /**
     * Operation deleteProjectsCertificates
     *
     * Delete an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param string $certificate_id certificate_id (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function delete(string $project_id, string $certificate_id): AcceptedResponse
    {
        $this->refreshToken();
        return $this->getApi()->deleteProjectsCertificates($project_id, $certificate_id);
    }

    /**
     * Operation getProjectsCertificates
     *
     * Get an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param string $certificate_id certificate_id (required)
     * @return Certificate
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function get(string $project_id, string $certificate_id): Certificate
    {
        $this->refreshToken();
        return $this->getApi()->getProjectsCertificates($project_id, $certificate_id);
    }

    /**
     * Operation listProjectsCertificates
     *
     * Get list of SSL certificates
     *
     * @param string $project_id project_id (required)
     * @return Certificate[]
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function list(string $project_id): array
    {
        $this->refreshToken();
        return $this->getApi()->listProjectsCertificates($project_id);
    }

    /**
     * Operation updateProjectsCertificates
     *
     * Update an SSL certificate
     *
     * @param string $project_id project_id (required)
     * @param string $certificate_id certificate_id (required)
     * @param array $certificate_patch (required)
     * @return AcceptedResponse
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     */
    public function update(string $project_id, string $certificate_id, array $certificate_patch): AcceptedResponse
    {
        $this->refreshToken();
        $certificate_patch = new CertificatePatch($certificate_patch);
        return $this->getApi()->updateProjectsCertificates($project_id, $certificate_id, $certificate_patch);
    }
}

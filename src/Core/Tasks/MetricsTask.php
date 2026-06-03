<?php

namespace Upsun\Core\Tasks;

use InvalidArgumentException;
use Psr\Http\Client\ClientExceptionInterface;
use Upsun\Api\ApiException;
use Upsun\Api\BlackfireMonitoringApi;
use Upsun\Api\ContinuousProfilingApi;
use Upsun\Api\HttpTrafficApi;
use Upsun\UpsunClient;

/**
 * MetricsTask class.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class MetricsTask extends TaskBase
{
    public function __construct(
        UpsunClient $client,
        private readonly HttpTrafficApi $httpTrafficApi,
        private readonly BlackfireMonitoringApi $blackfireMonitoringApi,
        private readonly ContinuousProfilingApi $continuousProfilingApi,
    ) {
        parent::__construct($client);
    }

    // HTTP Traffic Metrics Methods

    /**
     * Get HTTP metrics timeline grouped by IP addresses
     * This method retrieves HTTP traffic metrics over a timeline, broken down by IP addresses accessing the application.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function httpMetricsTimelineIps(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        ?int $limit = null,
        ?int $topHitsCount = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $methods = null,
        ?string $methodsMode = null,
        ?array $domains = null,
        ?string $domainsMode = null,
        ?array $codeSlots = null,
        ?string $codeSlotsMode = null,
        ?array $codes = null,
        ?string $codesMode = null,
        ?array $requestDurationSlots = null,
        ?string $requestDurationSlotsMode = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->httpTrafficApi->httpMetricsTimelineIps(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            limit: $limit,
            topHitsCount: $topHitsCount,
            applications: $applications,
            applicationsMode: $applicationsMode,
            methods: $methods,
            methodsMode: $methodsMode,
            domains: $domains,
            domainsMode: $domainsMode,
            codeSlots: $codeSlots,
            codeSlotsMode: $codeSlotsMode,
            codes: $codes,
            codesMode: $codesMode,
            requestDurationSlots: $requestDurationSlots,
            requestDurationSlotsMode: $requestDurationSlotsMode
        );
    }

    /**
     * Get HTTP metrics timeline grouped by URLs
     * This method retrieves HTTP traffic metrics over a timeline, broken down by the URLs being accessed.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function httpMetricsTimelineUrls(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        ?int $limit = null,
        ?int $topHitsCount = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $methods = null,
        ?string $methodsMode = null,
        ?array $domains = null,
        ?string $domainsMode = null,
        ?array $codeSlots = null,
        ?string $codeSlotsMode = null,
        ?array $codes = null,
        ?string $codesMode = null,
        ?array $requestDurationSlots = null,
        ?string $requestDurationSlotsMode = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->httpTrafficApi->httpMetricsTimelineUrls(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            limit: $limit,
            topHitsCount: $topHitsCount,
            applications: $applications,
            applicationsMode: $applicationsMode,
            methods: $methods,
            methodsMode: $methodsMode,
            domains: $domains,
            domainsMode: $domainsMode,
            codeSlots: $codeSlots,
            codeSlotsMode: $codeSlotsMode,
            codes: $codes,
            codesMode: $codesMode,
            requestDurationSlots: $requestDurationSlots,
            requestDurationSlotsMode: $requestDurationSlotsMode
        );
    }

    /**
     * Get HTTP metrics timeline grouped by User Agents
     * This method retrieves HTTP traffic metrics over a timeline, broken down by the user agents making the requests.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function httpMetricsTimelineUserAgents(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        ?int $limit = null,
        ?int $topHitsCount = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $methods = null,
        ?string $methodsMode = null,
        ?array $domains = null,
        ?string $domainsMode = null,
        ?array $codeSlots = null,
        ?string $codeSlotsMode = null,
        ?array $codes = null,
        ?string $codesMode = null,
        ?array $requestDurationSlots = null,
        ?string $requestDurationSlotsMode = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->httpTrafficApi->httpMetricsTimelineUserAgents(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            limit: $limit,
            topHitsCount: $topHitsCount,
            applications: $applications,
            applicationsMode: $applicationsMode,
            methods: $methods,
            methodsMode: $methodsMode,
            domains: $domains,
            domainsMode: $domainsMode,
            codeSlots: $codeSlots,
            codeSlotsMode: $codeSlotsMode,
            codes: $codes,
            codesMode: $codesMode,
            requestDurationSlots: $requestDurationSlots,
            requestDurationSlotsMode: $requestDurationSlotsMode
        );
    }

    // Blackfire Monitoring Methods

    /**
     * Get Blackfire PHP server cache metrics
     * This method retrieves PHP cache metrics from the Blackfire monitoring service for the specified time range.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function blackfirePhpServerCaches(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        ?int $grain = null,
        ?array $contexts = null,
        ?string $contextsMode = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $instances = null,
        ?string $instancesMode = null,
        ?string $distributionCost = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->blackfireMonitoringApi->blackfirePhpServerCaches(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            grain: $grain,
            contexts: $contexts,
            contextsMode: $contextsMode,
            applications: $applications,
            applicationsMode: $applicationsMode,
            instances: $instances,
            instancesMode: $instancesMode,
            distributionCost: $distributionCost
        );
    }

    /**
     * Get global Blackfire server metrics
     * This method retrieves global metrics from the Blackfire server for the specified keys and time range.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, environmentId, or keys array is invalid or empty
     */
    public function blackfireServerGlobal(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        array $keys,
        ?int $grain = null,
        ?array $contexts = null,
        ?string $contextsMode = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $instances = null,
        ?string $instancesMode = null,
        ?string $distributionCost = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        if (empty($keys)) {
            throw new InvalidArgumentException('Keys array cannot be empty');
        }

        return $this->blackfireMonitoringApi->blackfireServerGlobal(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            keys: $keys,
            grain: $grain,
            contexts: $contexts,
            contextsMode: $contextsMode,
            applications: $applications,
            applicationsMode: $applicationsMode,
            instances: $instances,
            instancesMode: $instancesMode,
            distributionCost: $distributionCost
        );
    }

    /**
     * Get top spans from Blackfire server
     * This method retrieves the top time-consuming spans from the Blackfire server for performance analysis.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function blackfireServerTopSpans(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        ?int $grain = null,
        ?string $sort = null,
        ?array $contexts = null,
        ?string $contextsMode = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $instances = null,
        ?string $instancesMode = null,
        ?array $transactions = null,
        ?string $transactionsMode = null,
        ?array $wtSlots = null,
        ?string $wtSlotsMode = null,
        ?array $pmuSlots = null,
        ?string $pmuSlotsMode = null,
        ?array $httpStatusCodes = null,
        ?string $httpStatusCodesMode = null,
        ?array $httpHosts = null,
        ?string $httpHostsMode = null,
        ?array $hosts = null,
        ?string $hostsMode = null,
        ?array $frameworks = null,
        ?string $frameworksMode = null,
        ?array $languages = null,
        ?string $languagesMode = null,
        ?array $methods = null,
        ?string $methodsMode = null,
        ?array $runtimes = null,
        ?string $runtimesMode = null,
        ?array $oss = null,
        ?string $ossMode = null,
        ?string $distributionCost = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->blackfireMonitoringApi->blackfireServerTopSpans(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            grain: $grain,
            sort: $sort,
            contexts: $contexts,
            contextsMode: $contextsMode,
            applications: $applications,
            applicationsMode: $applicationsMode,
            instances: $instances,
            instancesMode: $instancesMode,
            transactions: $transactions,
            transactionsMode: $transactionsMode,
            wtSlots: $wtSlots,
            wtSlotsMode: $wtSlotsMode,
            pmuSlots: $pmuSlots,
            pmuSlotsMode: $pmuSlotsMode,
            httpStatusCodes: $httpStatusCodes,
            httpStatusCodesMode: $httpStatusCodesMode,
            httpHosts: $httpHosts,
            httpHostsMode: $httpHostsMode,
            hosts: $hosts,
            hostsMode: $hostsMode,
            frameworks: $frameworks,
            frameworksMode: $frameworksMode,
            languages: $languages,
            languagesMode: $languagesMode,
            methods: $methods,
            methodsMode: $methodsMode,
            runtimes: $runtimes,
            runtimesMode: $runtimesMode,
            oss: $oss,
            ossMode: $ossMode,
            distributionCost: $distributionCost
        );
    }

    /**
     * Get transaction breakdown from Blackfire server
     * This method retrieves a breakdown of transactions from the Blackfire server, grouped by the specified dimension.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function blackfireServerTransactionsBreakdown(
        string $projectId,
        string $environmentId,
        int $from,
        int $to,
        ?int $grain = null,
        ?string $breakdownDimension = null,
        ?string $sort = null,
        ?int $breakdownLimit = null,
        ?array $contexts = null,
        ?string $contextsMode = null,
        ?array $applications = null,
        ?string $applicationsMode = null,
        ?array $instances = null,
        ?string $instancesMode = null,
        ?array $transactions = null,
        ?string $transactionsMode = null,
        ?array $wtSlots = null,
        ?string $wtSlotsMode = null,
        ?array $pmuSlots = null,
        ?string $pmuSlotsMode = null,
        ?array $httpStatusCodes = null,
        ?string $httpStatusCodesMode = null,
        ?array $httpHosts = null,
        ?string $httpHostsMode = null,
        ?array $hosts = null,
        ?string $hostsMode = null,
        ?array $frameworks = null,
        ?string $frameworksMode = null,
        ?array $languages = null,
        ?string $languagesMode = null,
        ?array $methods = null,
        ?string $methodsMode = null,
        ?array $runtimes = null,
        ?string $runtimesMode = null,
        ?array $oss = null,
        ?string $ossMode = null,
        ?string $distributionCost = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->blackfireMonitoringApi->blackfireServerTransactionsBreakdown(
            projectId: $projectId,
            environmentId: $environmentId,
            from: $from,
            to: $to,
            grain: $grain,
            breakdownDimension: $breakdownDimension,
            sort: $sort,
            breakdownLimit: $breakdownLimit,
            contexts: $contexts,
            contextsMode: $contextsMode,
            applications: $applications,
            applicationsMode: $applicationsMode,
            instances: $instances,
            instancesMode: $instancesMode,
            transactions: $transactions,
            transactionsMode: $transactionsMode,
            wtSlots: $wtSlots,
            wtSlotsMode: $wtSlotsMode,
            pmuSlots: $pmuSlots,
            pmuSlotsMode: $pmuSlotsMode,
            httpStatusCodes: $httpStatusCodes,
            httpStatusCodesMode: $httpStatusCodesMode,
            httpHosts: $httpHosts,
            httpHostsMode: $httpHostsMode,
            hosts: $hosts,
            hostsMode: $hostsMode,
            frameworks: $frameworks,
            frameworksMode: $frameworksMode,
            languages: $languages,
            languagesMode: $languagesMode,
            methods: $methods,
            methodsMode: $methodsMode,
            runtimes: $runtimes,
            runtimesMode: $runtimesMode,
            oss: $oss,
            ossMode: $ossMode,
            distributionCost: $distributionCost
        );
    }

    // Continuous Profiling Methods

    /**
     * List continuous profiling applications
     * This method retrieves a list of applications available for continuous profiling in the environment.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId or environmentId is invalid
     */
    public function listContinuousProfilingApplications(
        string $projectId,
        string $environmentId,
        ?int $from = null,
        ?int $to = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);

        return $this->continuousProfilingApi->listApplications(
            projectId: $projectId,
            envId: $environmentId,
            from: $from,
            to: $to
        );
    }

    /**
     * Get continuous profiling application filter data
     * This method retrieves filter information for profiling data of a specific application.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, environmentId, or application name is invalid
     */
    public function getContinuousProfilingApplicationFilter(
        string $projectId,
        string $environmentId,
        string $applicationName,
        ?int $from = null,
        ?int $to = null,
        ?string $profileType = null,
        ?int $runtimeMode = null,
        ?array $runtime = null,
        ?int $runtimeVersionMode = null,
        ?array $runtimeVersion = null,
        ?int $runtimeArchMode = null,
        ?array $runtimeArch = null,
        ?int $runtimeOsMode = null,
        ?array $runtimeOs = null,
        ?int $probeVersionMode = null,
        ?array $probeVersion = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        if (empty($applicationName)) {
            throw new InvalidArgumentException('Application name cannot be empty');
        }

        return $this->continuousProfilingApi->getApplicationFilter(
            projectId: $projectId,
            envId: $environmentId,
            app: $applicationName,
            from: $from,
            to: $to,
            profileType: $profileType,
            runtimeMode: $runtimeMode,
            runtime: $runtime,
            runtimeVersionMode: $runtimeVersionMode,
            runtimeVersion: $runtimeVersion,
            runtimeArchMode: $runtimeArchMode,
            runtimeArch: $runtimeArch,
            runtimeOsMode: $runtimeOsMode,
            runtimeOs: $runtimeOs,
            probeVersionMode: $probeVersionMode,
            probeVersion: $probeVersion
        );
    }

    /**
     * Get merged continuous profiling data for an application
     * This method retrieves merged profiling data for an application, combining multiple profiles into a single view.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, environmentId, or application name is invalid
     */
    public function getContinuousProfilingApplicationMerge(
        string $projectId,
        string $environmentId,
        string $applicationName,
        ?int $from = null,
        ?int $to = null,
        ?string $profileType = null,
        ?string $out = null,
        ?int $runtimeMode = null,
        ?array $runtime = null,
        ?int $runtimeVersionMode = null,
        ?array $runtimeVersion = null,
        ?int $runtimeArchMode = null,
        ?array $runtimeArch = null,
        ?int $runtimeOsMode = null,
        ?array $runtimeOs = null,
        ?int $probeVersionMode = null,
        ?array $probeVersion = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        if (empty($applicationName)) {
            throw new InvalidArgumentException('Application name cannot be empty');
        }

        return $this->continuousProfilingApi->getApplicationMerge(
            projectId: $projectId,
            envId: $environmentId,
            app: $applicationName,
            from: $from,
            to: $to,
            profileType: $profileType,
            out: $out,
            runtimeMode: $runtimeMode,
            runtime: $runtime,
            runtimeVersionMode: $runtimeVersionMode,
            runtimeVersion: $runtimeVersion,
            runtimeArchMode: $runtimeArchMode,
            runtimeArch: $runtimeArch,
            runtimeOsMode: $runtimeOsMode,
            runtimeOs: $runtimeOs,
            probeVersionMode: $probeVersionMode,
            probeVersion: $probeVersion
        );
    }

    /**
     * Get continuous profiling application timeline
     * This method retrieves a timeline of profiling data for an application over the specified period.
     *
     * @throws ApiException on non-2xx response or if the response body is not in the expected format
     * @throws ClientExceptionInterface
     * @throws InvalidArgumentException if the projectId, environmentId, or application name is invalid
     */
    public function getContinuousProfilingApplicationTimeline(
        string $projectId,
        string $environmentId,
        string $applicationName,
        ?int $from = null,
        ?int $to = null,
        ?string $profileType = null,
        ?int $runtimeMode = null,
        ?array $runtime = null,
        ?int $runtimeVersionMode = null,
        ?array $runtimeVersion = null,
        ?int $runtimeArchMode = null,
        ?array $runtimeArch = null,
        ?int $runtimeOsMode = null,
        ?array $runtimeOs = null,
        ?int $probeVersionMode = null,
        ?array $probeVersion = null
    ): mixed {
        $this->checkProjectId($projectId);
        $this->checkEnvironmentId($environmentId);
        if (empty($applicationName)) {
            throw new InvalidArgumentException('Application name cannot be empty');
        }

        return $this->continuousProfilingApi->getApplicationTimeline(
            projectId: $projectId,
            envId: $environmentId,
            app: $applicationName,
            from: $from,
            to: $to,
            profileType: $profileType,
            runtimeMode: $runtimeMode,
            runtime: $runtime,
            runtimeVersionMode: $runtimeVersionMode,
            runtimeVersion: $runtimeVersion,
            runtimeArchMode: $runtimeArchMode,
            runtimeArch: $runtimeArch,
            runtimeOsMode: $runtimeOsMode,
            runtimeOs: $runtimeOs,
            probeVersionMode: $probeVersionMode,
            probeVersion: $probeVersion
        );
    }
}

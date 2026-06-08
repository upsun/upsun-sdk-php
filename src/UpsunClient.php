<?php

namespace Upsun;

use Http\Discovery\Exception\DiscoveryFailedException;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use RuntimeException;
use Upsun\Api\AddOnsApi;
use Upsun\Api\AlertsApi;
use Upsun\Api\ApiConfiguration;
use Upsun\Api\ApiTokensApi;
use Upsun\Api\AutoscalingApi;
use Upsun\Api\BlackfireMonitoringApi;
use Upsun\Api\BlackfireProfilingApi;
use Upsun\Api\CertManagementApi;
use Upsun\Api\ConnectionsApi;
use Upsun\Api\ContinuousProfilingApi;
use Upsun\Api\DefaultApi;
use Upsun\Api\DeploymentApi;
use Upsun\Api\DeploymentTargetApi;
use Upsun\Api\DiffApi;
use Upsun\Api\DiscountsApi;
use Upsun\Api\DomainClaimApi;
use Upsun\Api\DomainManagementApi;
use Upsun\Api\EntrypointApi;
use Upsun\Api\EnvironmentActivityApi;
use Upsun\Api\EnvironmentApi;
use Upsun\Api\EnvironmentBackupsApi;
use Upsun\Api\EnvironmentTypeApi;
use Upsun\Api\EnvironmentVariablesApi;
use Upsun\Api\GrantsApi;
use Upsun\Api\HttpTrafficApi;
use Upsun\Api\InvoicesApi;
use Upsun\Api\MfaApi;
use Upsun\Api\OrdersApi;
use Upsun\Api\OrganizationInvitationsApi;
use Upsun\Api\OrganizationManagementApi;
use Upsun\Api\OrganizationMembersApi;
use Upsun\Api\OrganizationProjectsApi;
use Upsun\Api\OrganizationsApi;
use Upsun\Api\PhoneNumberApi;
use Upsun\Api\ProfilesApi;
use Upsun\Api\ProjectActivityApi;
use Upsun\Api\ProjectApi;
use Upsun\Api\ProjectInvitationsApi;
use Upsun\Api\ProjectsApi;
use Upsun\Api\ProjectSettingsApi;
use Upsun\Api\ProjectVariablesApi;
use Upsun\Api\RecordsApi;
use Upsun\Api\ReferencesApi;
use Upsun\Api\RegionsApi;
use Upsun\Api\RegistryCredentialApi;
use Upsun\Api\RepositoryApi;
use Upsun\Api\ResourcesApi;
use Upsun\Api\RoutingApi;
use Upsun\Api\RuntimeOperationsApi;
use Upsun\Api\SbomApi;
use Upsun\Api\SourceOperationsApi;
use Upsun\Api\SshKeysApi;
use Upsun\Api\SubscriptionsApi;
use Upsun\Api\SupportApi;
use Upsun\Api\SystemInformationApi;
use Upsun\Api\TaskApi;
use Upsun\Api\TeamAccessApi;
use Upsun\Api\TeamsApi;
use Upsun\Api\ThirdPartyIntegrationsApi;
use Upsun\Api\UserAccessApi;
use Upsun\Api\UserProfilesApi;
use Upsun\Api\UsersApi;
use Upsun\Api\VouchersApi;
use Upsun\Core\OAuthProvider;
use Upsun\Core\Tasks\ActivitiesTask;
use Upsun\Core\Tasks\ApplicationsTask;
use Upsun\Core\Tasks\BackupsTask;
use Upsun\Core\Tasks\CertificatesTask;
use Upsun\Core\Tasks\DomainsTask;
use Upsun\Core\Tasks\EnvironmentsTask;
use Upsun\Core\Tasks\IntegrationsTask;
use Upsun\Core\Tasks\MetricsTask;
use Upsun\Core\Tasks\MountsTask;
use Upsun\Core\Tasks\OperationsTask;
use Upsun\Core\Tasks\OrganizationsTask;
use Upsun\Core\Tasks\ProjectsTask;
use Upsun\Core\Tasks\RegionsTask;
use Upsun\Core\Tasks\RepositoriesTask;
use Upsun\Core\Tasks\ResourcesTask;
use Upsun\Core\Tasks\RoutesTask;
use Upsun\Core\Tasks\ServicesTask;
use Upsun\Core\Tasks\SourceOperationsTask;
use Upsun\Core\Tasks\SshTask;
use Upsun\Core\Tasks\SupportTicketsTask;
use Upsun\Core\Tasks\TaskContainersTask;
use Upsun\Core\Tasks\TeamsTask;
use Upsun\Core\Tasks\UsersInvitationsTask;
use Upsun\Core\Tasks\UsersTask;
use Upsun\Core\Tasks\VariablesTask;
use Upsun\Core\Tasks\WorkersTask;
use Upsun\Core\TokenProvider;

/**
 * Upsun Client to interact with the API.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 */
class UpsunClient
{
    public ClientInterface $apiClient;

    public ApiConfiguration $apiConfig;

    public ?OAuthProvider $auth = null;

    private ?string $bearerToken = null;

    public ?string $userId = null;

    public ActivitiesTask $activities;

    public ApplicationsTask $applications;

    public BackupsTask $backups;

    public CertificatesTask $certificates;

    public DomainsTask $domains;

    public EnvironmentsTask $environments;

    public IntegrationsTask $integrations;

    public UsersInvitationsTask $invitations;

    public MetricsTask $metrics;

    public MountsTask $mounts;

    public OperationsTask $operations;

    public OrganizationsTask $organizations;

    public ProjectsTask $projects;

    public RegionsTask $regions;

    public RepositoriesTask $repositories;

    public ResourcesTask $resources;

    public RoutesTask $routes;

    public ServicesTask $services;

    public SourceOperationsTask $sourceOperations;

    public SshTask $sshTask;

    public TaskContainersTask $taskContainers;

    public TeamsTask $teams;

    public SupportTicketsTask $supportTickets;

    public UsersTask $users;

    public VariablesTask $variables;

    public WorkersTask $workers;

    public function __construct(protected UpsunConfig $upsunConfig, ?ClientInterface $apiClient = null)
    {
        $this->apiConfig = ApiConfiguration::getDefaultConfiguration()
        ->setHost(host: $this->upsunConfig->base_url);

        $this->apiClient = $apiClient ?? $this->discoverHttpClient();

        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();

        if ($upsunConfig->apiToken !== '') {
            $this->auth = new OAuthProvider(
                httpClient: $this->apiClient,
                requestFactory: $requestFactory,
                tokenEndpoint: $this->upsunConfig->auth_url . '/' . $this->upsunConfig->token_endpoint,
                clientId: $this->upsunConfig->clientId,
                clientSecret: $this->upsunConfig->apiToken,
                refreshEndpoint: $this->upsunConfig->auth_url . '/' . $this->upsunConfig->refresh_endpoint,
            );
        }

        $tokenProvider = new class ($this) implements TokenProvider {
            public function __construct(private readonly UpsunClient $client)
            {
            }

            public function __invoke(bool $force = false): string
            {
                if ($force && $this->client->auth !== null) {
                    $this->client->auth->forceRefresh();
                }
                return $this->client->getToken();
            }
        };

        $taskParams = [
            $tokenProvider,
            $this->apiClient,
            $requestFactory,
            $this->apiConfig,
        ];

        // Init used API classes
        $addOnsApi = new AddOnsApi(...$taskParams);
        $apiTokensApi = new ApiTokensApi(...$taskParams);
        $alertsApi = new AlertsApi(...$taskParams);
        $autoscalingApi = new AutoscalingApi(...$taskParams);
        $certManagementApi = new CertManagementApi(...$taskParams);
        $connectionsApi = new ConnectionsApi(...$taskParams);
        $defaultApi = new DefaultApi(...$taskParams);
        $deploymentApi = new DeploymentApi(...$taskParams);
        $deploymentTargetApi = new DeploymentTargetApi(...$taskParams);
        $diffApi = new DiffApi(...$taskParams);
        $discountsApi = new DiscountsApi(...$taskParams);
        $domainClaimApi = new DomainClaimApi(...$taskParams);
        $domainManagementApi = new DomainManagementApi(...$taskParams);
        $environmentActivityApi = new EnvironmentActivityApi(...$taskParams);
        $environmentApi = new EnvironmentApi(...$taskParams);
        $environmentBackupsApi = new EnvironmentBackupsApi(...$taskParams);
        $environmentTypeApi = new EnvironmentTypeApi(...$taskParams);
        $environmentVariablesApi = new EnvironmentVariablesApi(...$taskParams);
        $grantsApi = new GrantsApi(...$taskParams);
        $httpTrafficApi = new HttpTrafficApi(...$taskParams);
        $invoicesApi = new InvoicesApi(...$taskParams);
        $mfaApi = new MfaApi(...$taskParams);
        $ordersApi = new OrdersApi(...$taskParams);
        $organizationApi = new OrganizationsApi(...$taskParams);
        $organizationInvitationsApi = new OrganizationInvitationsApi(...$taskParams);
        $organizationManagementApi = new OrganizationManagementApi(...$taskParams);
        $organizationMembersApi = new OrganizationMembersApi(...$taskParams);
        $organizationProjectsApi = new OrganizationProjectsApi(...$taskParams);
        $phoneNumberApi = new PhoneNumberApi(...$taskParams);
        $profilesApi = new ProfilesApi(...$taskParams);
        $blackfireMonitoringApi = new BlackfireMonitoringApi(...$taskParams);
        $blackfireProfilingApi = new BlackfireProfilingApi(...$taskParams);
        $projectActivityApi = new ProjectActivityApi(...$taskParams);
        $projectApi = new ProjectApi(...$taskParams);
        $projectInvitationsApi = new ProjectInvitationsApi(...$taskParams);
        $projectSettingsApi = new ProjectSettingsApi(...$taskParams);
        $projectVariablesApi = new ProjectVariablesApi(...$taskParams);
        $continuousProfilingApi = new ContinuousProfilingApi(...$taskParams);
        $entrypointApi = new EntrypointApi(...$taskParams);
        $referencesApi = new ReferencesApi(...$taskParams);
        $recordsApi = new RecordsApi(...$taskParams);
        $regionsApi = new RegionsApi(...$taskParams);
        $repositoryApi = new RepositoryApi(...$taskParams);
        $routingApi = new RoutingApi(...$taskParams);
        $runtimeOperationsApi = new RuntimeOperationsApi(...$taskParams);
        $registryCredentialApi = new RegistryCredentialApi(...$taskParams);
        $resourcesApi = new ResourcesApi(...$taskParams);
        $sbomApi = new SbomApi(...$taskParams);
        $sourceOperationsApi = new SourceOperationsApi(...$taskParams);
        $subscriptionsApi = new SubscriptionsApi(...$taskParams);
        $projectsApi = new ProjectsApi(...$taskParams);
        $supportApi = new SupportApi(...$taskParams);
        $systemInformationApi = new SystemInformationApi(...$taskParams);
        $sshKeysApi = new SshKeysApi(...$taskParams);
        $taskApi = new TaskApi(...$taskParams);
        $teamAccessApi = new TeamAccessApi(...$taskParams);
        $teamsApi = new TeamsApi(...$taskParams);
        $thirdPartyIntegrationsApi = new ThirdPartyIntegrationsApi(...$taskParams);
        $userAccessApi = new UserAccessApi(...$taskParams);
        $userProfilesApi = new UserProfilesApi(...$taskParams);
        $usersApi = new UsersApi(...$taskParams);
        $vouchersApi = new VouchersApi(...$taskParams);

        // Initialize the command tasks.
        $this->activities = new ActivitiesTask(
            $this,
            $projectActivityApi,
            $environmentActivityApi
        );
        $this->applications = new ApplicationsTask(
            $this,
        );
        $this->backups = new BackupsTask(
            $this,
            $environmentBackupsApi
        );
        $this->certificates = new CertificatesTask(
            $this,
            $certManagementApi
        );
        $this->domains = new DomainsTask(
            $this,
            $domainManagementApi
        );
        $this->environments = new EnvironmentsTask(
            $this,
            $environmentApi,
            $environmentTypeApi,
            $deploymentApi,
        );
        $this->integrations = new IntegrationsTask(
            $this,
            $thirdPartyIntegrationsApi
        );
        $this->invitations = new UsersInvitationsTask(
            $this,
            $organizationInvitationsApi,
            $projectInvitationsApi,
        );
        $this->metrics = new MetricsTask(
            $this,
            $httpTrafficApi,
            $blackfireMonitoringApi,
            $continuousProfilingApi,
            $blackfireProfilingApi,
            $entrypointApi,
        );
        $this->mounts = new MountsTask($this);
        $this->operations = new OperationsTask(
            $this,
            $runtimeOperationsApi
        );
        $this->organizations = new OrganizationsTask(
            $this,
            $organizationApi,
            $organizationProjectsApi,
            $organizationMembersApi,
            $subscriptionsApi,
            $invoicesApi,
            $mfaApi,
            $ordersApi,
            $profilesApi,
            $recordsApi,
            $vouchersApi,
            $addOnsApi,
            $discountsApi,
            $organizationManagementApi,
            $referencesApi,
            $defaultApi,
        );
        $this->projects = new ProjectsTask(
            $this,
            $projectApi,
            $organizationProjectsApi,
            $projectSettingsApi,
            $subscriptionsApi,
            $deploymentTargetApi,
            $alertsApi,
            $domainClaimApi,
            $projectsApi,
            $sbomApi,
            $registryCredentialApi,
        );
        $this->regions = new RegionsTask(
            $this,
            $regionsApi,
            $referencesApi,
        );

        $this->repositories = new RepositoriesTask(
            $this,
            $repositoryApi,
            $systemInformationApi,
            $diffApi,
        );
        $this->resources = new ResourcesTask(
            $this,
            $deploymentApi,
            $autoscalingApi,
            $resourcesApi,
        );
        $this->routes = new RoutesTask(
            $this,
            $routingApi
        );
        $this->services = new ServicesTask(
            $this,
        );
        $this->sourceOperations = new SourceOperationsTask(
            $this,
            $sourceOperationsApi
        );
        $this->taskContainers = new TaskContainersTask(
            $this,
            $taskApi,
        );
        $this->teams = new TeamsTask(
            $this,
            $teamsApi,
            $teamAccessApi,
            $referencesApi,
        );
        $this->supportTickets = new SupportTicketsTask(
            $this,
            $defaultApi,
            $supportApi
        );
        $this->sshTask = new SshTask(
            $this,
            $sshKeysApi
        );
        $this->users = new UsersTask(
            $this,
            $usersApi,
            $userProfilesApi,
            $userAccessApi,
            $apiTokensApi,
            $connectionsApi,
            $grantsApi,
            $mfaApi,
            $phoneNumberApi,
            $referencesApi,
        );
        $this->variables = new VariablesTask(
            $this,
            $projectVariablesApi,
            $environmentVariablesApi,
        );
        $this->workers = new WorkersTask(
            $this,
        );
    }

    private function discoverHttpClient(): ClientInterface
    {
        $symfonyPsr18Client = '\\Symfony\\Component\\HttpClient\\Psr18Client';
        if (class_exists($symfonyPsr18Client)) {
            /** @var ClientInterface $client */
            $client = new $symfonyPsr18Client();

            return $client;
        }

        try {
            return Psr18ClientDiscovery::find();
        } catch (DiscoveryFailedException $e) {
            throw new RuntimeException(
                'No PSR-18 HTTP client implementation available. Install one such as symfony/http-client or provide a ClientInterface instance to UpsunClient.',
                0,
                $e
            );
        }
    }

    public function setBearerToken(string $token): void
    {
        $this->bearerToken = $token;
    }

    public function getToken(): string
    {
        if ($this->auth !== null) {
            return $this->auth->getAuthorization();
        }
        if ($this->bearerToken !== null) {
            return 'Bearer ' . $this->bearerToken;
        }
        throw new RuntimeException(
            'No authentication method available. Provide an API key via UpsunConfig or call setBearerToken().'
        );
    }
}

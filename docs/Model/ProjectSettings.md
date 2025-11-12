# # ProjectSettings

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**initialize** | **object** |  |
**productName** | **string** | The name of the product. |
**productCode** | **string** | The lowercase ASCII code of the product. |
**uiUriTemplate** | **string** | The template of the project UI uri |
**variablesPrefix** | **string** | The prefix of the generated environment variables. |
**botEmail** | **string** | The email of the bot. |
**applicationConfigFile** | **string** | The name of the application-specific configuration file. |
**projectConfigDir** | **string** | The name of the project configuration directory. |
**useDrupalDefaults** | **bool** | Whether to use the default Drupal-centric configuration files when missing from the repository. |
**useLegacySubdomains** | **bool** | Whether to use legacy subdomain scheme, that replaces &#x60;.&#x60; by &#x60;---&#x60; in development subdomains. |
**developmentServiceSize** | **string** | The size of development services. |
**developmentApplicationSize** | **string** | The size of development applications. |
**enableCertificateProvisioning** | **bool** | Enable automatic certificate provisioning. |
**certificateStyle** | **string** |  |
**certificateRenewalActivity** | **bool** | Create an activity for certificate renewal |
**developmentDomainTemplate** | **string** | The template of the development domain, can include {project} and {environment} placeholders. |
**enableStateApiDeployments** | **bool** | Enable the State API-driven deployments on regions that support them. |
**temporaryDiskSize** | **int** | Set the size of the temporary disk (/tmp, in MB). |
**localDiskSize** | **int** | Set the size of the instance disk (in MB). |
**cronMinimumInterval** | **int** | Minimum interval between cron runs (in minutes) |
**cronMaximumJitter** | **int** | Maximum jitter inserted in cron runs (in minutes) |
**cronProductionExpiryInterval** | **int** | The interval (in days) for which cron activity and logs are kept around |
**cronNonProductionExpiryInterval** | **int** | The interval (in days) for which cron activity and logs are kept around |
**concurrencyLimits** | **array<string,int>** | The concurrency limits applied to different kind of activities |
**flexibleBuildCache** | **bool** | Enable the flexible build cache implementation |
**strictConfiguration** | **bool** | Strict configuration validation. |
**hasSleepyCrons** | **bool** |  |
**cronsInGit** | **bool** |  |
**customErrorTemplate** | **string** | Custom error template for the router. |
**appErrorPageTemplate** | **string** | Custom error template for the application. |
**environmentNameStrategy** | **string** | The strategy used to generate environment machine names |
**dataRetention** | [**array<string,\Upsun\Model\DataRetentionConfigurationValue>**](DataRetentionConfigurationValue.md) | Data retention configuration |
**enableCodesourceIntegrationPush** | **bool** | Enable pushing commits to codesource integration. |
**enforceMfa** | **bool** | Enforce multi-factor authentication. |
**systemd** | **bool** | Use systemd images. |
**routerGen2** | **bool** | Use the router v2 image. |
**buildResources** | [**\Upsun\Model\BuildResources1**](BuildResources1.md) |  |
**outboundRestrictionsDefaultPolicy** | **string** | The default policy for firewall outbound restrictions |
**selfUpgrade** | **bool** | Whether self-upgrades are enabled |
**selfUpgradeLatestMajor** | **bool** |  |
**additionalHosts** | **array<string,string>** | A mapping of hostname to ip address to be added to the container&#39;s hosts file |
**maxAllowedRoutes** | **int** | Maximum number of routes allowed |
**maxAllowedRedirectsPaths** | **int** | Maximum number of redirect paths allowed |
**enableIncrementalBackups** | **bool** | Enable incremental backups on regions that support them. |
**sizingApiEnabled** | **bool** | Enable sizing api. |
**enableCacheGracePeriod** | **bool** | Enable cache grace period. |
**enableZeroDowntimeDeployments** | **bool** | Enable zero-downtime deployments for resource-only changes. |
**enableAdminAgent** | **bool** |  |
**certifierUrl** | **string** | The certifier url |
**centralizedPermissions** | **bool** | Whether centralized permissions are enabled |
**glueServerMaxRequestSize** | **int** | Maximum size of request to glue-server (in MB) |
**persistentEndpointsSsh** | **bool** | Enable SSH access update with persistent endpoint |
**persistentEndpointsSslCertificates** | **bool** | Enable SSL certificate update with persistent endpoint |
**enableDiskHealthMonitoring** | **bool** |  |
**enablePausedEnvironments** | **bool** |  |
**enableUnifiedConfiguration** | **bool** |  |
**enableRoutesTracing** | **bool** | Enable tracing support in routes |
**imageDeploymentValidation** | **bool** | Enable extended deployment validation by images |
**supportGenericImages** | **bool** |  |
**enableGithubAppTokenExchange** | **bool** | Enable fetching the GitHub App token from SIA. |
**continuousProfiling** | [**\Upsun\Model\ContinuousProfilingConfiguration**](ContinuousProfilingConfiguration.md) |  |
**disableAgentErrorReporter** | **bool** |  |
**requiresDomainOwnership** | **bool** | Require ownership proof before domains are added to environments. |
**enableGuaranteedResources** | **bool** | Enable guaranteed resources feature |
**gitServer** | [**\Upsun\Model\GitServerConfiguration**](GitServerConfiguration.md) |  |
**activityLogsMaxSize** | **int** | The maximum size of activity logs in bytes. This limit is applied on the pre-compressed log size. |
**allowManualDeployments** | **bool** | If deployments can be manual, i.e. explicitly triggered by user. |
**allowRollingDeployments** | **bool** | If the project can use rolling deployments. |
**allowBurst** | **bool** |  |
**routerResources** | [**\Upsun\Model\RouterResources**](RouterResources.md) |  |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

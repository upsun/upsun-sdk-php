# ProjectSettings

Low level ProjectSettings (auto-generated)

***

* Full name: `\Upsun\Model\ProjectSettings`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### initialize

```php
private object $initialize
```

***

### productName

```php
private string $productName
```

***

### productCode

```php
private string $productCode
```

***

### uiUriTemplate

```php
private string $uiUriTemplate
```

***

### variablesPrefix

```php
private string $variablesPrefix
```

***

### botEmail

```php
private string $botEmail
```

***

### applicationConfigFile

```php
private string $applicationConfigFile
```

***

### projectConfigDir

```php
private string $projectConfigDir
```

***

### useDrupalDefaults

```php
private bool $useDrupalDefaults
```

***

### useLegacySubdomains

```php
private bool $useLegacySubdomains
```

***

### developmentServiceSize

```php
private string $developmentServiceSize
```

***

### developmentApplicationSize

```php
private string $developmentApplicationSize
```

***

### enableCertificateProvisioning

```php
private bool $enableCertificateProvisioning
```

***

### certificateStyle

```php
private string $certificateStyle
```

***

### certificateRenewalActivity

```php
private bool $certificateRenewalActivity
```

***

### enableStateApiDeployments

```php
private bool $enableStateApiDeployments
```

***

### cronMinimumInterval

```php
private int $cronMinimumInterval
```

***

### cronMaximumJitter

```php
private int $cronMaximumJitter
```

***

### cronProductionExpiryInterval

```php
private int $cronProductionExpiryInterval
```

***

### cronNonProductionExpiryInterval

```php
private int $cronNonProductionExpiryInterval
```

***

### concurrencyLimits

```php
private array $concurrencyLimits
```

***

### flexibleBuildCache

```php
private bool $flexibleBuildCache
```

***

### strictConfiguration

```php
private bool $strictConfiguration
```

***

### hasSleepyCrons

```php
private bool $hasSleepyCrons
```

***

### cronsInGit

```php
private bool $cronsInGit
```

***

### environmentNameStrategy

```php
private string $environmentNameStrategy
```

***

### enableCodesourceIntegrationPush

```php
private bool $enableCodesourceIntegrationPush
```

***

### enforceMfa

```php
private bool $enforceMfa
```

***

### systemd

```php
private bool $systemd
```

***

### routerGen2

```php
private bool $routerGen2
```

***

### buildResources

```php
private \Upsun\Model\BuildResources1 $buildResources
```

***

### outboundRestrictionsDefaultPolicy

```php
private string $outboundRestrictionsDefaultPolicy
```

***

### selfUpgrade

```php
private bool $selfUpgrade
```

***

### selfUpgradeLatestMajor

```php
private bool $selfUpgradeLatestMajor
```

***

### additionalHosts

```php
private array $additionalHosts
```

***

### maxAllowedRoutes

```php
private int $maxAllowedRoutes
```

***

### maxAllowedRedirectsPaths

```php
private int $maxAllowedRedirectsPaths
```

***

### enableIncrementalBackups

```php
private bool $enableIncrementalBackups
```

***

### sizingApiEnabled

```php
private bool $sizingApiEnabled
```

***

### enableCacheGracePeriod

```php
private bool $enableCacheGracePeriod
```

***

### enableZeroDowntimeDeployments

```php
private bool $enableZeroDowntimeDeployments
```

***

### enableAdminAgent

```php
private bool $enableAdminAgent
```

***

### certifierUrl

```php
private string $certifierUrl
```

***

### centralizedPermissions

```php
private bool $centralizedPermissions
```

***

### glueServerMaxRequestSize

```php
private int $glueServerMaxRequestSize
```

***

### persistentEndpointsSsh

```php
private bool $persistentEndpointsSsh
```

***

### persistentEndpointsSslCertificates

```php
private bool $persistentEndpointsSslCertificates
```

***

### enableDiskHealthMonitoring

```php
private bool $enableDiskHealthMonitoring
```

***

### enablePausedEnvironments

```php
private bool $enablePausedEnvironments
```

***

### enableUnifiedConfiguration

```php
private bool $enableUnifiedConfiguration
```

***

### enableRoutesTracing

```php
private bool $enableRoutesTracing
```

***

### imageDeploymentValidation

```php
private bool $imageDeploymentValidation
```

***

### supportGenericImages

```php
private bool $supportGenericImages
```

***

### enableGithubAppTokenExchange

```php
private bool $enableGithubAppTokenExchange
```

***

### continuousProfiling

```php
private \Upsun\Model\ContinuousProfilingConfiguration $continuousProfiling
```

***

### disableAgentErrorReporter

```php
private bool $disableAgentErrorReporter
```

***

### requiresDomainOwnership

```php
private bool $requiresDomainOwnership
```

***

### enableGuaranteedResources

```php
private bool $enableGuaranteedResources
```

***

### gitServer

```php
private \Upsun\Model\GitServerConfiguration $gitServer
```

***

### activityLogsMaxSize

```php
private int $activityLogsMaxSize
```

***

### allowManualDeployments

```php
private bool $allowManualDeployments
```

***

### allowRollingDeployments

```php
private bool $allowRollingDeployments
```

***

### allowBurst

```php
private bool $allowBurst
```

***

### routerResources

```php
private \Upsun\Model\RouterResources $routerResources
```

***

### developmentDomainTemplate

```php
private ?string $developmentDomainTemplate
```

***

### temporaryDiskSize

```php
private ?int $temporaryDiskSize
```

***

### localDiskSize

```php
private ?int $localDiskSize
```

***

### customErrorTemplate

```php
private ?string $customErrorTemplate
```

***

### appErrorPageTemplate

```php
private ?string $appErrorPageTemplate
```

***

### dataRetention

```php
private ?array $dataRetention
```

***

## Methods

### __construct

```php
public __construct(object $initialize, string $productName, string $productCode, string $uiUriTemplate, string $variablesPrefix, string $botEmail, string $applicationConfigFile, string $projectConfigDir, bool $useDrupalDefaults, bool $useLegacySubdomains, string $developmentServiceSize, string $developmentApplicationSize, bool $enableCertificateProvisioning, string $certificateStyle, bool $certificateRenewalActivity, bool $enableStateApiDeployments, int $cronMinimumInterval, int $cronMaximumJitter, int $cronProductionExpiryInterval, int $cronNonProductionExpiryInterval, array $concurrencyLimits, bool $flexibleBuildCache, bool $strictConfiguration, bool $hasSleepyCrons, bool $cronsInGit, string $environmentNameStrategy, bool $enableCodesourceIntegrationPush, bool $enforceMfa, bool $systemd, bool $routerGen2, \Upsun\Model\BuildResources1 $buildResources, string $outboundRestrictionsDefaultPolicy, bool $selfUpgrade, bool $selfUpgradeLatestMajor, array $additionalHosts, int $maxAllowedRoutes, int $maxAllowedRedirectsPaths, bool $enableIncrementalBackups, bool $sizingApiEnabled, bool $enableCacheGracePeriod, bool $enableZeroDowntimeDeployments, bool $enableAdminAgent, string $certifierUrl, bool $centralizedPermissions, int $glueServerMaxRequestSize, bool $persistentEndpointsSsh, bool $persistentEndpointsSslCertificates, bool $enableDiskHealthMonitoring, bool $enablePausedEnvironments, bool $enableUnifiedConfiguration, bool $enableRoutesTracing, bool $imageDeploymentValidation, bool $supportGenericImages, bool $enableGithubAppTokenExchange, \Upsun\Model\ContinuousProfilingConfiguration $continuousProfiling, bool $disableAgentErrorReporter, bool $requiresDomainOwnership, bool $enableGuaranteedResources, \Upsun\Model\GitServerConfiguration $gitServer, int $activityLogsMaxSize, bool $allowManualDeployments, bool $allowRollingDeployments, bool $allowBurst, \Upsun\Model\RouterResources $routerResources, ?string $developmentDomainTemplate, ?int $temporaryDiskSize, ?int $localDiskSize, ?string $customErrorTemplate, ?string $appErrorPageTemplate, ?array $dataRetention): mixed
```

**Parameters:**

| Parameter                             | Type                                              | Description |
|---------------------------------------|---------------------------------------------------|-------------|
| `$initialize`                         | **object**                                        |             |
| `$productName`                        | **string**                                        |             |
| `$productCode`                        | **string**                                        |             |
| `$uiUriTemplate`                      | **string**                                        |             |
| `$variablesPrefix`                    | **string**                                        |             |
| `$botEmail`                           | **string**                                        |             |
| `$applicationConfigFile`              | **string**                                        |             |
| `$projectConfigDir`                   | **string**                                        |             |
| `$useDrupalDefaults`                  | **bool**                                          |             |
| `$useLegacySubdomains`                | **bool**                                          |             |
| `$developmentServiceSize`             | **string**                                        |             |
| `$developmentApplicationSize`         | **string**                                        |             |
| `$enableCertificateProvisioning`      | **bool**                                          |             |
| `$certificateStyle`                   | **string**                                        |             |
| `$certificateRenewalActivity`         | **bool**                                          |             |
| `$enableStateApiDeployments`          | **bool**                                          |             |
| `$cronMinimumInterval`                | **int**                                           |             |
| `$cronMaximumJitter`                  | **int**                                           |             |
| `$cronProductionExpiryInterval`       | **int**                                           |             |
| `$cronNonProductionExpiryInterval`    | **int**                                           |             |
| `$concurrencyLimits`                  | **array**                                         |             |
| `$flexibleBuildCache`                 | **bool**                                          |             |
| `$strictConfiguration`                | **bool**                                          |             |
| `$hasSleepyCrons`                     | **bool**                                          |             |
| `$cronsInGit`                         | **bool**                                          |             |
| `$environmentNameStrategy`            | **string**                                        |             |
| `$enableCodesourceIntegrationPush`    | **bool**                                          |             |
| `$enforceMfa`                         | **bool**                                          |             |
| `$systemd`                            | **bool**                                          |             |
| `$routerGen2`                         | **bool**                                          |             |
| `$buildResources`                     | **\Upsun\Model\BuildResources1**                  |             |
| `$outboundRestrictionsDefaultPolicy`  | **string**                                        |             |
| `$selfUpgrade`                        | **bool**                                          |             |
| `$selfUpgradeLatestMajor`             | **bool**                                          |             |
| `$additionalHosts`                    | **array**                                         |             |
| `$maxAllowedRoutes`                   | **int**                                           |             |
| `$maxAllowedRedirectsPaths`           | **int**                                           |             |
| `$enableIncrementalBackups`           | **bool**                                          |             |
| `$sizingApiEnabled`                   | **bool**                                          |             |
| `$enableCacheGracePeriod`             | **bool**                                          |             |
| `$enableZeroDowntimeDeployments`      | **bool**                                          |             |
| `$enableAdminAgent`                   | **bool**                                          |             |
| `$certifierUrl`                       | **string**                                        |             |
| `$centralizedPermissions`             | **bool**                                          |             |
| `$glueServerMaxRequestSize`           | **int**                                           |             |
| `$persistentEndpointsSsh`             | **bool**                                          |             |
| `$persistentEndpointsSslCertificates` | **bool**                                          |             |
| `$enableDiskHealthMonitoring`         | **bool**                                          |             |
| `$enablePausedEnvironments`           | **bool**                                          |             |
| `$enableUnifiedConfiguration`         | **bool**                                          |             |
| `$enableRoutesTracing`                | **bool**                                          |             |
| `$imageDeploymentValidation`          | **bool**                                          |             |
| `$supportGenericImages`               | **bool**                                          |             |
| `$enableGithubAppTokenExchange`       | **bool**                                          |             |
| `$continuousProfiling`                | **\Upsun\Model\ContinuousProfilingConfiguration** |             |
| `$disableAgentErrorReporter`          | **bool**                                          |             |
| `$requiresDomainOwnership`            | **bool**                                          |             |
| `$enableGuaranteedResources`          | **bool**                                          |             |
| `$gitServer`                          | **\Upsun\Model\GitServerConfiguration**           |             |
| `$activityLogsMaxSize`                | **int**                                           |             |
| `$allowManualDeployments`             | **bool**                                          |             |
| `$allowRollingDeployments`            | **bool**                                          |             |
| `$allowBurst`                         | **bool**                                          |             |
| `$routerResources`                    | **\Upsun\Model\RouterResources**                  |             |
| `$developmentDomainTemplate`          | **?string**                                       |             |
| `$temporaryDiskSize`                  | **?int**                                          |             |
| `$localDiskSize`                      | **?int**                                          |             |
| `$customErrorTemplate`                | **?string**                                       |             |
| `$appErrorPageTemplate`               | **?string**                                       |             |
| `$dataRetention`                      | **?array**                                        |             |

***

### getModelName

The original name of the model.

```php
public getModelName(): string
```

***

### jsonSerialize

```php
public jsonSerialize(): array
```

***

### __toString

```php
public __toString(): string
```

***

### getInitialize

```php
public getInitialize(): object
```

***

### getProductName

The name of the product.

```php
public getProductName(): string
```

***

### getProductCode

The lowercase ASCII code of the product.

```php
public getProductCode(): string
```

***

### getUiUriTemplate

The template of the project UI uri

```php
public getUiUriTemplate(): string
```

***

### getVariablesPrefix

The prefix of the generated environment variables.

```php
public getVariablesPrefix(): string
```

***

### getBotEmail

The email of the bot.

```php
public getBotEmail(): string
```

***

### getApplicationConfigFile

The name of the application-specific configuration file.

```php
public getApplicationConfigFile(): string
```

***

### getProjectConfigDir

The name of the project configuration directory.

```php
public getProjectConfigDir(): string
```

***

### getUseDrupalDefaults

Whether to use the default Drupal-centric configuration files when missing from the repository.

```php
public getUseDrupalDefaults(): bool
```

***

### getUseLegacySubdomains

Whether to use legacy subdomain scheme, that replaces `.` by `---` in development subdomains.

```php
public getUseLegacySubdomains(): bool
```

***

### getDevelopmentServiceSize

The size of development services.

```php
public getDevelopmentServiceSize(): string
```

***

### getDevelopmentApplicationSize

The size of development applications.

```php
public getDevelopmentApplicationSize(): string
```

***

### getEnableCertificateProvisioning

Enable automatic certificate provisioning.

```php
public getEnableCertificateProvisioning(): bool
```

***

### getCertificateStyle

```php
public getCertificateStyle(): string
```

***

### getCertificateRenewalActivity

Create an activity for certificate renewal

```php
public getCertificateRenewalActivity(): bool
```

***

### getDevelopmentDomainTemplate

The template of the development domain, can include {project} and {environment} placeholders.

```php
public getDevelopmentDomainTemplate(): ?string
```

***

### getEnableStateApiDeployments

Enable the State API-driven deployments on regions that support them.

```php
public getEnableStateApiDeployments(): bool
```

***

### getTemporaryDiskSize

Set the size of the temporary disk (/tmp, in MB).

```php
public getTemporaryDiskSize(): ?int
```

***

### getLocalDiskSize

Set the size of the instance disk (in MB).

```php
public getLocalDiskSize(): ?int
```

***

### getCronMinimumInterval

Minimum interval between cron runs (in minutes)

```php
public getCronMinimumInterval(): int
```

***

### getCronMaximumJitter

Maximum jitter inserted in cron runs (in minutes)

```php
public getCronMaximumJitter(): int
```

***

### getCronProductionExpiryInterval

The interval (in days) for which cron activity and logs are kept around

```php
public getCronProductionExpiryInterval(): int
```

***

### getCronNonProductionExpiryInterval

The interval (in days) for which cron activity and logs are kept around

```php
public getCronNonProductionExpiryInterval(): int
```

***

### getConcurrencyLimits

```php
public getConcurrencyLimits(): array
```

***

### getFlexibleBuildCache

Enable the flexible build cache implementation

```php
public getFlexibleBuildCache(): bool
```

***

### getStrictConfiguration

Strict configuration validation.

```php
public getStrictConfiguration(): bool
```

***

### getHasSleepyCrons

```php
public getHasSleepyCrons(): bool
```

***

### getCronsInGit

```php
public getCronsInGit(): bool
```

***

### getCustomErrorTemplate

Custom error template for the router.

```php
public getCustomErrorTemplate(): ?string
```

***

### getAppErrorPageTemplate

Custom error template for the application.

```php
public getAppErrorPageTemplate(): ?string
```

***

### getEnvironmentNameStrategy

The strategy used to generate environment machine names

```php
public getEnvironmentNameStrategy(): string
```

***

### getDataRetention

Data retention configuration

```php
public getDataRetention(): \Upsun\Model\DataRetentionConfigurationValue[]|null
```

***

### getEnableCodesourceIntegrationPush

Enable pushing commits to codesource integration.

```php
public getEnableCodesourceIntegrationPush(): bool
```

***

### getEnforceMfa

Enforce multi-factor authentication.

```php
public getEnforceMfa(): bool
```

***

### getSystemd

Use systemd images.

```php
public getSystemd(): bool
```

***

### getRouterGen2

Use the router v2 image.

```php
public getRouterGen2(): bool
```

***

### getBuildResources

```php
public getBuildResources(): \Upsun\Model\BuildResources1
```

***

### getOutboundRestrictionsDefaultPolicy

The default policy for firewall outbound restrictions

```php
public getOutboundRestrictionsDefaultPolicy(): string
```

***

### getSelfUpgrade

Whether self-upgrades are enabled

```php
public getSelfUpgrade(): bool
```

***

### getSelfUpgradeLatestMajor

```php
public getSelfUpgradeLatestMajor(): bool
```

***

### getAdditionalHosts

```php
public getAdditionalHosts(): array
```

***

### getMaxAllowedRoutes

Maximum number of routes allowed

```php
public getMaxAllowedRoutes(): int
```

***

### getMaxAllowedRedirectsPaths

Maximum number of redirect paths allowed

```php
public getMaxAllowedRedirectsPaths(): int
```

***

### getEnableIncrementalBackups

Enable incremental backups on regions that support them.

```php
public getEnableIncrementalBackups(): bool
```

***

### getSizingApiEnabled

Enable sizing api.

```php
public getSizingApiEnabled(): bool
```

***

### getEnableCacheGracePeriod

Enable cache grace period.

```php
public getEnableCacheGracePeriod(): bool
```

***

### getEnableZeroDowntimeDeployments

Enable zero-downtime deployments for resource-only changes.

```php
public getEnableZeroDowntimeDeployments(): bool
```

***

### getEnableAdminAgent

```php
public getEnableAdminAgent(): bool
```

***

### getCertifierUrl

The certifier url

```php
public getCertifierUrl(): string
```

***

### getCentralizedPermissions

Whether centralized permissions are enabled

```php
public getCentralizedPermissions(): bool
```

***

### getGlueServerMaxRequestSize

Maximum size of request to glue-server (in MB)

```php
public getGlueServerMaxRequestSize(): int
```

***

### getPersistentEndpointsSsh

Enable SSH access update with persistent endpoint

```php
public getPersistentEndpointsSsh(): bool
```

***

### getPersistentEndpointsSslCertificates

Enable SSL certificate update with persistent endpoint

```php
public getPersistentEndpointsSslCertificates(): bool
```

***

### getEnableDiskHealthMonitoring

```php
public getEnableDiskHealthMonitoring(): bool
```

***

### getEnablePausedEnvironments

```php
public getEnablePausedEnvironments(): bool
```

***

### getEnableUnifiedConfiguration

```php
public getEnableUnifiedConfiguration(): bool
```

***

### getEnableRoutesTracing

Enable tracing support in routes

```php
public getEnableRoutesTracing(): bool
```

***

### getImageDeploymentValidation

Enable extended deployment validation by images

```php
public getImageDeploymentValidation(): bool
```

***

### getSupportGenericImages

```php
public getSupportGenericImages(): bool
```

***

### getEnableGithubAppTokenExchange

Enable fetching the GitHub App token from SIA.

```php
public getEnableGithubAppTokenExchange(): bool
```

***

### getContinuousProfiling

The continuous profiling configuration

```php
public getContinuousProfiling(): \Upsun\Model\ContinuousProfilingConfiguration
```

***

### getDisableAgentErrorReporter

```php
public getDisableAgentErrorReporter(): bool
```

***

### getRequiresDomainOwnership

Require ownership proof before domains are added to environments.

```php
public getRequiresDomainOwnership(): bool
```

***

### getEnableGuaranteedResources

Enable guaranteed resources feature

```php
public getEnableGuaranteedResources(): bool
```

***

### getGitServer

```php
public getGitServer(): \Upsun\Model\GitServerConfiguration
```

***

### getActivityLogsMaxSize

The maximum size of activity logs in bytes. This limit is applied on the pre-compressed log size.

```php
public getActivityLogsMaxSize(): int
```

***

### getAllowManualDeployments

If deployments can be manual, i.e. explicitly triggered by user.

```php
public getAllowManualDeployments(): bool
```

***

### getAllowRollingDeployments

If the project can use rolling deployments.

```php
public getAllowRollingDeployments(): bool
```

***

### getAllowBurst

```php
public getAllowBurst(): bool
```

***

### getRouterResources

Router resource settings for flex plan

```php
public getRouterResources(): \Upsun\Model\RouterResources
```

***

<?php

namespace Upsun\Api\Serializer;

use Upsun\Model\AcceptedResponse;
use Upsun\Model\AccessControlInner;
use Upsun\Model\Activity;
use Upsun\Model\AddonCredential;
use Upsun\Model\AddonCredential1;
use Upsun\Model\Address;
use Upsun\Model\AddressGrantsInner;
use Upsun\Model\AddressMetadata;
use Upsun\Model\AddressMetadataMetadata;
use Upsun\Model\Alert;
use Upsun\Model\ApiToken;
use Upsun\Model\ApplyOrgVoucherRequest;
use Upsun\Model\ArrayFilter;
use Upsun\Model\Author;
use Upsun\Model\AutoscalerCondition;
use Upsun\Model\AutoscalerCPUPressureTrigger;
use Upsun\Model\AutoscalerCPUResources;
use Upsun\Model\AutoscalerCPUTrigger;
use Upsun\Model\AutoscalerDuration;
use Upsun\Model\AutoscalerInstances;
use Upsun\Model\AutoscalerMemoryPressureTrigger;
use Upsun\Model\AutoscalerMemoryResources;
use Upsun\Model\AutoscalerMemoryTrigger;
use Upsun\Model\AutoscalerResources;
use Upsun\Model\AutoscalerScalingCooldown;
use Upsun\Model\AutoscalerScalingFactor;
use Upsun\Model\AutoscalerServiceSettings;
use Upsun\Model\AutoscalerSettings;
use Upsun\Model\AutoscalerTriggers;
use Upsun\Model\Autoscaling;
use Upsun\Model\Backup;
use Upsun\Model\Bitbucket;
use Upsun\Model\BitbucketIntegration;
use Upsun\Model\BitbucketIntegrationCreateInput;
use Upsun\Model\BitbucketIntegrationPatch;
use Upsun\Model\BitbucketServer;
use Upsun\Model\BitbucketServerIntegration;
use Upsun\Model\BitbucketServerIntegrationCreateInput;
use Upsun\Model\BitbucketServerIntegrationPatch;
use Upsun\Model\Blackfire;
use Upsun\Model\BlackfireIntegration;
use Upsun\Model\BlackfireIntegrationCreateInput;
use Upsun\Model\BlackfireIntegrationPatch;
use Upsun\Model\Blob;
use Upsun\Model\BuildCachesValue;
use Upsun\Model\BuildConfiguration;
use Upsun\Model\BuildResources;
use Upsun\Model\BuildResources1;
use Upsun\Model\BuildResources2;
use Upsun\Model\CacheConfiguration;
use Upsun\Model\CanCreateNewOrgSubscription200Response;
use Upsun\Model\CanCreateNewOrgSubscription200ResponseRequiredAction;
use Upsun\Model\CanUpdateSubscription200Response;
use Upsun\Model\Certificate;
use Upsun\Model\CertificateCreateInput;
use Upsun\Model\CertificatePatch;
use Upsun\Model\CertificateProvisioner;
use Upsun\Model\CertificateProvisionerPatch;
use Upsun\Model\Commands;
use Upsun\Model\Commands1;
use Upsun\Model\Commands2;
use Upsun\Model\CommandsInner;
use Upsun\Model\Commit;
use Upsun\Model\Committer;
use Upsun\Model\Components;
use Upsun\Model\Config;
use Upsun\Model\ConfirmPhoneNumberRequest;
use Upsun\Model\ConfirmTotpEnrollment200Response;
use Upsun\Model\ConfirmTotpEnrollmentRequest;
use Upsun\Model\Connection;
use Upsun\Model\ContainerProfilesValueValue;
use Upsun\Model\ContinuousProfilingConfiguration;
use Upsun\Model\CreateApiTokenRequest;
use Upsun\Model\CreateAuthorizationCredentials200Response;
use Upsun\Model\CreateAuthorizationCredentials200ResponseRedirectToUrl;
use Upsun\Model\CreateOrgInviteRequest;
use Upsun\Model\CreateOrgMemberRequest;
use Upsun\Model\CreateOrgProjectRequest;
use Upsun\Model\CreateOrgRequest;
use Upsun\Model\CreateOrgSubscriptionRequest;
use Upsun\Model\CreateProfilePicture200Response;
use Upsun\Model\CreateProjectInviteRequest;
use Upsun\Model\CreateProjectInviteRequestEnvironmentsInner;
use Upsun\Model\CreateProjectInviteRequestPermissionsInner;
use Upsun\Model\CreateSshKeyRequest;
use Upsun\Model\CreateTeamMemberRequest;
use Upsun\Model\CreateTeamRequest;
use Upsun\Model\CreateTicketRequest;
use Upsun\Model\CreateTicketRequestAttachmentsInner;
use Upsun\Model\CronsDeploymentState;
use Upsun\Model\CronsValue;
use Upsun\Model\CurrencyAmount;
use Upsun\Model\CurrencyAmountNullable;
use Upsun\Model\CurrentUser;
use Upsun\Model\CurrentUserCurrentTrialInner;
use Upsun\Model\CurrentUserProjectsInner;
use Upsun\Model\CustomDomains;
use Upsun\Model\DataRetention;
use Upsun\Model\DataRetentionConfigurationValue;
use Upsun\Model\DataRetentionConfigurationValue1;
use Upsun\Model\DateTimeFilter;
use Upsun\Model\DedicatedDeploymentTarget;
use Upsun\Model\DedicatedDeploymentTargetCreateInput;
use Upsun\Model\DedicatedDeploymentTargetPatch;
use Upsun\Model\DefaultConfig;
use Upsun\Model\DefaultConfig1;
use Upsun\Model\DefaultResources;
use Upsun\Model\Deployment;
use Upsun\Model\DeploymentHostsInner;
use Upsun\Model\DeploymentState;
use Upsun\Model\DeploymentTarget;
use Upsun\Model\DeploymentTargetCreateInput;
use Upsun\Model\DeploymentTargetPatch;
use Upsun\Model\DevelopmentResources;
use Upsun\Model\Discount;
use Upsun\Model\DiscountCommitment;
use Upsun\Model\DiscountCommitmentAmount;
use Upsun\Model\DiscountCommitmentNet;
use Upsun\Model\DiscountDiscount;
use Upsun\Model\DiskResources;
use Upsun\Model\DocrootsValue;
use Upsun\Model\Domain;
use Upsun\Model\DomainCreateInput;
use Upsun\Model\DomainPatch;
use Upsun\Model\EmailIntegration;
use Upsun\Model\EmailIntegrationCreateInput;
use Upsun\Model\EmailIntegrationPatch;
use Upsun\Model\EnterpriseDeploymentTarget;
use Upsun\Model\EnterpriseDeploymentTargetCreateInput;
use Upsun\Model\EnterpriseDeploymentTargetPatch;
use Upsun\Model\Environment;
use Upsun\Model\EnvironmentActivateInput;
use Upsun\Model\EnvironmentBackupInput;
use Upsun\Model\EnvironmentBranchInput;
use Upsun\Model\EnvironmentDeployInput;
use Upsun\Model\EnvironmentInfo;
use Upsun\Model\EnvironmentInitializeInput;
use Upsun\Model\EnvironmentMergeInput;
use Upsun\Model\EnvironmentOperationInput;
use Upsun\Model\EnvironmentPatch;
use Upsun\Model\EnvironmentRestoreInput;
use Upsun\Model\EnvironmentsCredentialsValue;
use Upsun\Model\EnvironmentSourceOperation;
use Upsun\Model\EnvironmentSourceOperationInput;
use Upsun\Model\EnvironmentSynchronizeInput;
use Upsun\Model\EnvironmentType;
use Upsun\Model\EnvironmentVariable;
use Upsun\Model\EnvironmentVariableCreateInput;
use Upsun\Model\EnvironmentVariablePatch;
use Upsun\Model\EnvironmentVariablesInner;
use Upsun\Model\Error;
use Upsun\Model\EstimationObject;
use Upsun\Model\FastlyCDN;
use Upsun\Model\FastlyIntegration;
use Upsun\Model\FastlyIntegrationCreateInput;
use Upsun\Model\FastlyIntegrationPatch;
use Upsun\Model\FilesInner;
use Upsun\Model\Firewall;
use Upsun\Model\FoundationDeploymentTarget;
use Upsun\Model\FoundationDeploymentTargetCreateInput;
use Upsun\Model\FoundationDeploymentTargetPatch;
use Upsun\Model\GetAddress200Response;
use Upsun\Model\GetCurrentUserVerificationStatus200Response;
use Upsun\Model\GetCurrentUserVerificationStatusFull200Response;
use Upsun\Model\GetOrgPrepaymentInfo200Response;
use Upsun\Model\GetOrgPrepaymentInfo200ResponseLinks;
use Upsun\Model\GetOrgPrepaymentInfo200ResponseLinksSelf;
use Upsun\Model\GetOrgPrepaymentInfo200ResponseLinksTransactions;
use Upsun\Model\GetSubscriptionUsageAlerts200Response;
use Upsun\Model\GetTotpEnrollment200Response;
use Upsun\Model\GetTypeAllowance200Response;
use Upsun\Model\GetTypeAllowance200ResponseCurrencies;
use Upsun\Model\GetTypeAllowance200ResponseCurrenciesAUD;
use Upsun\Model\GetTypeAllowance200ResponseCurrenciesCAD;
use Upsun\Model\GetTypeAllowance200ResponseCurrenciesEUR;
use Upsun\Model\GetTypeAllowance200ResponseCurrenciesGBP;
use Upsun\Model\GetTypeAllowance200ResponseCurrenciesUSD;
use Upsun\Model\GetUsageAlerts200Response;
use Upsun\Model\GitHub;
use Upsun\Model\GithubIntegration;
use Upsun\Model\GithubIntegrationCreateInput;
use Upsun\Model\GithubIntegrationPatch;
use Upsun\Model\GitLab;
use Upsun\Model\GitLabIntegration;
use Upsun\Model\GitLabIntegrationCreateInput;
use Upsun\Model\GitLabIntegrationPatch;
use Upsun\Model\GitServerConfiguration;
use Upsun\Model\GoogleSSOConfig;
use Upsun\Model\GrantProjectTeamAccessRequestInner;
use Upsun\Model\GrantProjectUserAccessRequestInner;
use Upsun\Model\GrantTeamProjectAccessRequestInner;
use Upsun\Model\GrantUserProjectAccessRequestInner;
use Upsun\Model\GuaranteedResources;
use Upsun\Model\HalLinks;
use Upsun\Model\HalLinksNext;
use Upsun\Model\HalLinksPrevious;
use Upsun\Model\HalLinksSelf;
use Upsun\Model\HealthEmail;
use Upsun\Model\HealthPagerDuty;
use Upsun\Model\HealthSlack;
use Upsun\Model\HealthWebHook;
use Upsun\Model\HealthWebHookIntegration;
use Upsun\Model\HealthWebHookIntegrationCreateInput;
use Upsun\Model\HealthWebHookIntegrationPatch;
use Upsun\Model\Hooks;
use Upsun\Model\HostsInner;
use Upsun\Model\HttpAccessPermissions;
use Upsun\Model\HttpAccessPermissions1;
use Upsun\Model\HttpAccessPermissions2;
use Upsun\Model\HTTPLogForwarding;
use Upsun\Model\HttpLogIntegration;
use Upsun\Model\HttpLogIntegrationCreateInput;
use Upsun\Model\HttpLogIntegrationPatch;
use Upsun\Model\ImagesValueValue;
use Upsun\Model\ImageTypeRestrictions;
use Upsun\Model\Integration;
use Upsun\Model\IntegrationCreateInput;
use Upsun\Model\IntegrationPatch;
use Upsun\Model\Integrations;
use Upsun\Model\Invoice;
use Upsun\Model\InvoicePDF;
use Upsun\Model\IssuerInner;
use Upsun\Model\LineItem;
use Upsun\Model\LineItemComponent;
use Upsun\Model\Link;
use Upsun\Model\ListLinks;
use Upsun\Model\ListOrgDiscounts200Response;
use Upsun\Model\ListOrgInvoices200Response;
use Upsun\Model\ListOrgMembers200Response;
use Upsun\Model\ListOrgOrders200Response;
use Upsun\Model\ListOrgPlanRecords200Response;
use Upsun\Model\ListOrgPrepaymentTransactions200Response;
use Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinks;
use Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinksNext;
use Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinksPrepayment;
use Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinksPrevious;
use Upsun\Model\ListOrgPrepaymentTransactions200ResponseLinksSelf;
use Upsun\Model\ListOrgProjects200Response;
use Upsun\Model\ListOrgs200Response;
use Upsun\Model\ListOrgSubscriptions200Response;
use Upsun\Model\ListOrgUsageRecords200Response;
use Upsun\Model\ListProfiles200Response;
use Upsun\Model\ListProjectTeamAccess200Response;
use Upsun\Model\ListProjectUserAccess200Response;
use Upsun\Model\ListRegions200Response;
use Upsun\Model\ListTeamMembers200Response;
use Upsun\Model\ListTeams200Response;
use Upsun\Model\ListTicketCategories200ResponseInner;
use Upsun\Model\ListTicketPriorities200ResponseInner;
use Upsun\Model\ListTickets200Response;
use Upsun\Model\ListUserExtendedAccess200Response;
use Upsun\Model\ListUserExtendedAccess200ResponseItemsInner;
use Upsun\Model\ListUserOrgs200Response;
use Upsun\Model\LogsForwarding;
use Upsun\Model\MergeInfo;
use Upsun\Model\Metrics;
use Upsun\Model\MetricsMetadata;
use Upsun\Model\MetricsValue;
use Upsun\Model\MinimumResources;
use Upsun\Model\MountsValue;
use Upsun\Model\NewRelic;
use Upsun\Model\NewRelicIntegration;
use Upsun\Model\NewRelicIntegrationCreateInput;
use Upsun\Model\NewRelicIntegrationPatch;
use Upsun\Model\OAuth2Consumer;
use Upsun\Model\OAuth2Consumer1;
use Upsun\Model\OpenTelemetry;
use Upsun\Model\OperationsValue;
use Upsun\Model\Order;
use Upsun\Model\OrderBillingPeriodLabel;
use Upsun\Model\OrderLinks;
use Upsun\Model\OrderLinksInvoices;
use Upsun\Model\Organization;
use Upsun\Model\OrganizationAddonsObject;
use Upsun\Model\OrganizationAddonsObjectAvailable;
use Upsun\Model\OrganizationAddonsObjectCurrent;
use Upsun\Model\OrganizationAddonsObjectUpgradesAvailable;
use Upsun\Model\OrganizationAlertConfig;
use Upsun\Model\OrganizationAlertConfigConfig;
use Upsun\Model\OrganizationAlertConfigConfigThreshold;
use Upsun\Model\OrganizationCarbon;
use Upsun\Model\OrganizationEstimationObject;
use Upsun\Model\OrganizationEstimationObjectSubscriptions;
use Upsun\Model\OrganizationEstimationObjectSubscriptionsListInner;
use Upsun\Model\OrganizationEstimationObjectSubscriptionsListInnerUsage;
use Upsun\Model\OrganizationEstimationObjectUserLicenses;
use Upsun\Model\OrganizationEstimationObjectUserLicensesBase;
use Upsun\Model\OrganizationEstimationObjectUserLicensesBaseList;
use Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListAdminUser;
use Upsun\Model\OrganizationEstimationObjectUserLicensesBaseListViewerUser;
use Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagement;
use Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementList;
use Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListAdvancedManagementUser;
use Upsun\Model\OrganizationEstimationObjectUserLicensesUserManagementListStandardManagementUser;
use Upsun\Model\OrganizationInvitation;
use Upsun\Model\OrganizationInvitationOwner;
use Upsun\Model\OrganizationLinks;
use Upsun\Model\OrganizationLinksAddress;
use Upsun\Model\OrganizationLinksApplyVoucher;
use Upsun\Model\OrganizationLinksCreateMember;
use Upsun\Model\OrganizationLinksCreateSubscription;
use Upsun\Model\OrganizationLinksDelete;
use Upsun\Model\OrganizationLinksEstimateSubscription;
use Upsun\Model\OrganizationLinksMembers;
use Upsun\Model\OrganizationLinksMfaEnforcement;
use Upsun\Model\OrganizationLinksOrders;
use Upsun\Model\OrganizationLinksPaymentSource;
use Upsun\Model\OrganizationLinksProfile;
use Upsun\Model\OrganizationLinksSelf;
use Upsun\Model\OrganizationLinksSubscriptions;
use Upsun\Model\OrganizationLinksUpdate;
use Upsun\Model\OrganizationLinksVouchers;
use Upsun\Model\OrganizationMember;
use Upsun\Model\OrganizationMemberLinks;
use Upsun\Model\OrganizationMemberLinksDelete;
use Upsun\Model\OrganizationMemberLinksSelf;
use Upsun\Model\OrganizationMemberLinksUpdate;
use Upsun\Model\OrganizationMfaEnforcement;
use Upsun\Model\OrganizationProject;
use Upsun\Model\OrganizationProjectCarbon;
use Upsun\Model\OrganizationProjectLinks;
use Upsun\Model\OrganizationProjectLinksActivities;
use Upsun\Model\OrganizationProjectLinksAddons;
use Upsun\Model\OrganizationProjectLinksDelete;
use Upsun\Model\OrganizationProjectLinksSelf;
use Upsun\Model\OrganizationProjectLinksUpdate;
use Upsun\Model\OrganizationReference;
use Upsun\Model\OrganizationSSOConfig;
use Upsun\Model\OutboundFirewall;
use Upsun\Model\OutboundFirewallRestrictionsInner;
use Upsun\Model\OwnerInfo;
use Upsun\Model\PagerDutyIntegration;
use Upsun\Model\PagerDutyIntegrationCreateInput;
use Upsun\Model\PagerDutyIntegrationPatch;
use Upsun\Model\PathValue;
use Upsun\Model\PlanRecords;
use Upsun\Model\PreflightChecks;
use Upsun\Model\PrepaymentObject;
use Upsun\Model\PrepaymentObjectPrepayment;
use Upsun\Model\PrepaymentObjectPrepaymentBalance;
use Upsun\Model\PrepaymentTransactionObject;
use Upsun\Model\PrepaymentTransactionObjectAmount;
use Upsun\Model\PreServiceResourcesOverridesValue;
use Upsun\Model\ProdDomainStorage;
use Upsun\Model\ProdDomainStorageCreateInput;
use Upsun\Model\ProdDomainStoragePatch;
use Upsun\Model\ProductionResources;
use Upsun\Model\Profile;
use Upsun\Model\ProfileCurrentTrial;
use Upsun\Model\ProfileCurrentTrialCurrent;
use Upsun\Model\ProfileCurrentTrialProjects;
use Upsun\Model\ProfileCurrentTrialProjectsTotal;
use Upsun\Model\ProfileCurrentTrialSpend;
use Upsun\Model\ProfileCurrentTrialSpendRemaining;
use Upsun\Model\Project;
use Upsun\Model\ProjectAddon;
use Upsun\Model\ProjectAddonBase;
use Upsun\Model\ProjectAddonBaseLinks;
use Upsun\Model\ProjectAddonBaseLinksDelete;
use Upsun\Model\ProjectAddonBaseLinksSelf;
use Upsun\Model\ProjectAddonBaseLinksUpdate;
use Upsun\Model\ProjectAddonWithQuantityFields;
use Upsun\Model\ProjectAddonWithSkuFields;
use Upsun\Model\ProjectCapabilities;
use Upsun\Model\ProjectCarbon;
use Upsun\Model\ProjectInfo;
use Upsun\Model\ProjectInvitation;
use Upsun\Model\ProjectInvitationEnvironmentsInner;
use Upsun\Model\ProjectOptions;
use Upsun\Model\ProjectOptionsDefaults;
use Upsun\Model\ProjectOptionsEnforced;
use Upsun\Model\ProjectPatch;
use Upsun\Model\ProjectReference;
use Upsun\Model\ProjectSettings;
use Upsun\Model\ProjectSettingsPatch;
use Upsun\Model\ProjectStatus;
use Upsun\Model\ProjectType;
use Upsun\Model\ProjectVariable;
use Upsun\Model\ProjectVariableCreateInput;
use Upsun\Model\ProjectVariablePatch;
use Upsun\Model\ProxyRoute;
use Upsun\Model\RedirectConfiguration;
use Upsun\Model\RedirectRoute;
use Upsun\Model\Ref;
use Upsun\Model\Region;
use Upsun\Model\RegionDatacenter;
use Upsun\Model\RegionEnvironmentalImpact;
use Upsun\Model\RegionProvider;
use Upsun\Model\RegionReference;
use Upsun\Model\ReplacementDomainStorage;
use Upsun\Model\ReplacementDomainStorageCreateInput;
use Upsun\Model\ReplacementDomainStoragePatch;
use Upsun\Model\RepositoryInformation;
use Upsun\Model\RequestBuffering;
use Upsun\Model\ResetEmailAddressRequest;
use Upsun\Model\ResourceConfig;
use Upsun\Model\Resources;
use Upsun\Model\Resources1;
use Upsun\Model\Resources2;
use Upsun\Model\Resources3;
use Upsun\Model\Resources4;
use Upsun\Model\Resources5;
use Upsun\Model\Resources6;
use Upsun\Model\ResourcesLimits;
use Upsun\Model\ResourcesOverridesValue;
use Upsun\Model\Route;
use Upsun\Model\RouterResources;
use Upsun\Model\RoutesValue;
use Upsun\Model\Routing;
use Upsun\Model\Routing1;
use Upsun\Model\RuntimeOperations;
use Upsun\Model\ScheduleInner;
use Upsun\Model\Script;
use Upsun\Model\ScriptIntegration;
use Upsun\Model\ScriptIntegrationCreateInput;
use Upsun\Model\ScriptIntegrationPatch;
use Upsun\Model\SendOrgMfaReminders200ResponseValue;
use Upsun\Model\SendOrgMfaRemindersRequest;
use Upsun\Model\ServiceRelationshipsValue;
use Upsun\Model\ServicesValue;
use Upsun\Model\ServicesValue1;
use Upsun\Model\Sizing;
use Upsun\Model\SlackIntegration;
use Upsun\Model\SlackIntegrationCreateInput;
use Upsun\Model\SlackIntegrationPatch;
use Upsun\Model\SourceCodeConfiguration;
use Upsun\Model\SourceOperations;
use Upsun\Model\SourceOperationsValue;
use Upsun\Model\SpecificOverridesValue;
use Upsun\Model\Splunk;
use Upsun\Model\SplunkIntegration;
use Upsun\Model\SplunkIntegrationCreateInput;
use Upsun\Model\SplunkIntegrationPatch;
use Upsun\Model\SshKey;
use Upsun\Model\SSIConfiguration;
use Upsun\Model\Status;
use Upsun\Model\StickyConfiguration;
use Upsun\Model\StrictTransportSecurityOptions;
use Upsun\Model\StringFilter;
use Upsun\Model\Subscription;
use Upsun\Model\Subscription1;
use Upsun\Model\SubscriptionAddonsObject;
use Upsun\Model\SubscriptionAddonsObjectAvailable;
use Upsun\Model\SubscriptionAddonsObjectCurrent;
use Upsun\Model\SubscriptionAddonsObjectUpgradesAvailable;
use Upsun\Model\SubscriptionCurrentUsageObject;
use Upsun\Model\SubscriptionInformation;
use Upsun\Model\SumoLogic;
use Upsun\Model\SumologicIntegration;
use Upsun\Model\SumologicIntegrationCreateInput;
use Upsun\Model\SumologicIntegrationPatch;
use Upsun\Model\Syslog;
use Upsun\Model\SyslogIntegration;
use Upsun\Model\SyslogIntegrationCreateInput;
use Upsun\Model\SyslogIntegrationPatch;
use Upsun\Model\SystemInformation;
use Upsun\Model\Team;
use Upsun\Model\TeamCounts;
use Upsun\Model\TeamMember;
use Upsun\Model\TeamProjectAccess;
use Upsun\Model\TeamProjectAccessLinks;
use Upsun\Model\TeamProjectAccessLinksDelete;
use Upsun\Model\TeamProjectAccessLinksSelf;
use Upsun\Model\TeamProjectAccessLinksUpdate;
use Upsun\Model\TeamReference;
use Upsun\Model\Ticket;
use Upsun\Model\TicketJiraInner;
use Upsun\Model\TLSSettings;
use Upsun\Model\Tree;
use Upsun\Model\TreeItemsInner;
use Upsun\Model\UpdateOrgAddonsRequest;
use Upsun\Model\UpdateOrgBillingAlertConfigRequest;
use Upsun\Model\UpdateOrgBillingAlertConfigRequestConfig;
use Upsun\Model\UpdateOrgMemberRequest;
use Upsun\Model\UpdateOrgProfileRequest;
use Upsun\Model\UpdateOrgProjectRequest;
use Upsun\Model\UpdateOrgRequest;
use Upsun\Model\UpdateOrgSubscriptionRequest;
use Upsun\Model\UpdateProfileRequest;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequest;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequestServicesValue;
use Upsun\Model\UpdateProjectsEnvironmentsDeploymentsNextRequestWebappsValue;
use Upsun\Model\UpdateProjectUserAccessRequest;
use Upsun\Model\UpdateSubscriptionUsageAlertsRequest;
use Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInner;
use Upsun\Model\UpdateSubscriptionUsageAlertsRequestAlertsInnerConfig;
use Upsun\Model\UpdateTeamRequest;
use Upsun\Model\UpdateTicketRequest;
use Upsun\Model\UpdateUsageAlertsRequest;
use Upsun\Model\UpdateUserRequest;
use Upsun\Model\UpstreamConfiguration;
use Upsun\Model\UpstreamRoute;
use Upsun\Model\Usage;
use Upsun\Model\UsageAlert;
use Upsun\Model\UsageAlertConfig;
use Upsun\Model\UsageAlertConfigThreshold;
use Upsun\Model\UsageGroupCurrentUsageProperties;
use Upsun\Model\User;
use Upsun\Model\UserProjectAccess;
use Upsun\Model\UserReference;
use Upsun\Model\VerifyPhoneNumber200Response;
use Upsun\Model\VerifyPhoneNumberRequest;
use Upsun\Model\Version;
use Upsun\Model\VersionCreateInput;
use Upsun\Model\VersionPatch;
use Upsun\Model\Vouchers;
use Upsun\Model\VouchersLinks;
use Upsun\Model\VouchersLinksSelf;
use Upsun\Model\VouchersVouchersInner;
use Upsun\Model\VouchersVouchersInnerOrdersInner;
use Upsun\Model\VPNConfiguration;
use Upsun\Model\WebApplicationsValue;
use Upsun\Model\WebConfiguration;
use Upsun\Model\Webhook;
use Upsun\Model\WebHookIntegration;
use Upsun\Model\WebHookIntegrationCreateInput;
use Upsun\Model\WebHookIntegrationPatch;
use Upsun\Model\WebLocationsValue;
use Upsun\Model\WorkerConfiguration;
use Upsun\Model\WorkersValue;

/**
 * Low level  (auto-generated)
 *
 * This model class is utilized by the ObjectSerializer for mapping JSON attribute format
 * to their corresponding model properties during serialization/deserialization.
 *
 * @author    Upsun Advocacy Team
 * @license   MIT
 * @see       https://docs.upsun.com
 * @generated This file was generated by OpenAPI Generator. Do not edit manually. * @internal
 */
final class ApiObjectFormatsMapper
{
    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openApiFormats(string $classname)
    {
        return self::$openApiFormats[$classname];
    }

    protected static $openApiFormats = [

        AcceptedResponse::class => [
            'status' => null,
            'code' => null
        ],

        AccessControlInner::class => [
            'entityId' => null,
            'role' => null
        ],

        Activity::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'parameters' => null,
            'project' => null,
            'state' => null,
            'result' => null,
            'startedAt' => 'date-time',
            'completedAt' => 'date-time',
            'completionPercent' => null,
            'cancelledAt' => 'date-time',
            'timings' => 'float',
            'log' => null,
            'payload' => null,
            'description' => null,
            'text' => null,
            'expiresAt' => 'date-time',
            'commands' => null,
            'integration' => null,
            'environments' => null
        ],

        AddonCredential::class => [
            'addonKey' => null,
            'clientKey' => null
        ],

        AddonCredential1::class => [
            'addonKey' => null,
            'clientKey' => null,
            'sharedSecret' => null
        ],

        Address::class => [
            'country' => 'ISO ALPHA-2',
            'nameLine' => null,
            'premise' => null,
            'subPremise' => null,
            'thoroughfare' => null,
            'administrativeArea' => 'ISO ALPHA-2',
            'subAdministrativeArea' => null,
            'locality' => null,
            'dependentLocality' => null,
            'postalCode' => null
        ],

        AddressGrantsInner::class => [
            'permission' => null,
            'address' => null
        ],

        AddressMetadata::class => [
            'metadata' => null
        ],

        AddressMetadataMetadata::class => [
            'requiredFields' => null,
            'fieldLabels' => null,
            'showVat' => null
        ],

        Alert::class => [
            'id' => null,
            'active' => null,
            'alertsSent' => null,
            'lastAlertAt' => 'date-time',
            'updatedAt' => 'date-time',
            'config' => null
        ],

        ApiToken::class => [
            'id' => 'uuid',
            'name' => null,
            'mfaOnCreation' => null,
            'token' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'lastUsedAt' => 'date-time'
        ],

        ApplyOrgVoucherRequest::class => [
            'code' => null
        ],

        ArrayFilter::class => [
            'eq' => null,
            'ne' => null,
            'in' => null,
            'nin' => null
        ],

        Author::class => [
            'date' => 'date-time',
            'name' => null,
            'email' => null
        ],

        AutoscalerCPUPressureTrigger::class => [
            'enabled' => null,
            'down' => null,
            'up' => null
        ],

        AutoscalerCPUResources::class => [
            'min' => null,
            'max' => null
        ],

        AutoscalerCPUTrigger::class => [
            'enabled' => null,
            'down' => null,
            'up' => null
        ],

        AutoscalerCondition::class => [
            'threshold' => null,
            'duration' => null,
            'enabled' => null
        ],

        AutoscalerDuration::class => [

        ],

        AutoscalerInstances::class => [
            'min' => null,
            'max' => null
        ],

        AutoscalerMemoryPressureTrigger::class => [
            'enabled' => null,
            'down' => null,
            'up' => null
        ],

        AutoscalerMemoryResources::class => [
            'min' => null,
            'max' => null
        ],

        AutoscalerMemoryTrigger::class => [
            'enabled' => null,
            'down' => null,
            'up' => null
        ],

        AutoscalerResources::class => [
            'cpu' => null,
            'memory' => null
        ],

        AutoscalerScalingCooldown::class => [
            'up' => null,
            'down' => null
        ],

        AutoscalerScalingFactor::class => [
            'up' => null,
            'down' => null
        ],

        AutoscalerServiceSettings::class => [
            'triggers' => null,
            'instances' => null,
            'resources' => null,
            'scaleFactor' => null,
            'scaleCooldown' => null
        ],

        AutoscalerSettings::class => [
            'services' => null
        ],

        AutoscalerTriggers::class => [
            'cpu' => null,
            'memory' => null,
            'cpuPressure' => null,
            'memoryPressure' => null
        ],

        Autoscaling::class => [
            'enabled' => null
        ],

        Backup::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'attributes' => null,
            'status' => null,
            'expiresAt' => 'date-time',
            'index' => null,
            'commitId' => null,
            'environment' => null,
            'safe' => null,
            'sizeOfVolumes' => null,
            'sizeUsed' => null,
            'deployment' => null,
            'restorable' => null,
            'automated' => null
        ],

        Bitbucket::class => [
            'enabled' => null,
            'role' => null
        ],

        BitbucketIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'repository' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'resyncPullRequests' => null,
            'id' => null,
            'appCredentials' => null,
            'addonCredentials' => null
        ],

        BitbucketIntegrationCreateInput::class => [
            'type' => null,
            'repository' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'appCredentials' => null,
            'addonCredentials' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'resyncPullRequests' => null
        ],

        BitbucketIntegrationPatch::class => [
            'type' => null,
            'repository' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'appCredentials' => null,
            'addonCredentials' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'resyncPullRequests' => null
        ],

        BitbucketServer::class => [
            'enabled' => null,
            'role' => null
        ],

        BitbucketServerIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'url' => null,
            'username' => null,
            'project' => null,
            'repository' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'id' => null
        ],

        BitbucketServerIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'username' => null,
            'token' => null,
            'project' => null,
            'repository' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null
        ],

        BitbucketServerIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'username' => null,
            'token' => null,
            'project' => null,
            'repository' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null
        ],

        Blackfire::class => [
            'enabled' => null,
            'role' => null
        ],

        BlackfireIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'environmentsCredentials' => null,
            'continuousProfiling' => null,
            'id' => null
        ],

        BlackfireIntegrationCreateInput::class => [
            'type' => null
        ],

        BlackfireIntegrationPatch::class => [
            'type' => null
        ],

        Blob::class => [
            'id' => null,
            'sha' => null,
            'size' => null,
            'encoding' => null,
            'content' => null
        ],

        BuildCachesValue::class => [
            'directory' => null,
            'watch' => null,
            'allowStale' => null,
            'shareBetweenApps' => null
        ],

        BuildConfiguration::class => [
            'flavor' => null,
            'caches' => null
        ],

        BuildResources::class => [
            'enabled' => null,
            'maxCpu' => 'float',
            'maxMemory' => null
        ],

        BuildResources1::class => [
            'cpu' => 'float',
            'memory' => null
        ],

        BuildResources2::class => [
            'cpu' => 'float',
            'memory' => null
        ],

        CacheConfiguration::class => [
            'enabled' => null,
            'defaultTtl' => null,
            'cookies' => null,
            'headers' => null
        ],

        CanCreateNewOrgSubscription200Response::class => [
            'canCreate' => null,
            'message' => null,
            'requiredAction' => null
        ],

        CanCreateNewOrgSubscription200ResponseRequiredAction::class => [
            'action' => null,
            'type' => null
        ],

        CanUpdateSubscription200Response::class => [
            'canUpdate' => null,
            'message' => null,
            'requiredAction' => null
        ],

        Certificate::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'certificate' => null,
            'chain' => null,
            'isProvisioned' => null,
            'isInvalid' => null,
            'isRoot' => null,
            'domains' => null,
            'authType' => null,
            'issuer' => null,
            'expiresAt' => 'date-time'
        ],

        CertificateCreateInput::class => [
            'certificate' => null,
            'key' => null,
            'chain' => null,
            'isInvalid' => null
        ],

        CertificatePatch::class => [
            'chain' => null,
            'isInvalid' => null
        ],

        CertificateProvisioner::class => [
            'id' => null,
            'directoryUrl' => null,
            'email' => null,
            'eabKid' => null,
            'eabHmacKey' => null
        ],

        CertificateProvisionerPatch::class => [
            'directoryUrl' => null,
            'email' => null,
            'eabKid' => null,
            'eabHmacKey' => null
        ],

        Commands::class => [
            'start' => null,
            'stop' => null
        ],

        Commands1::class => [
            'preStart' => null,
            'start' => null,
            'postStart' => null
        ],

        Commands2::class => [
            'start' => null,
            'preStart' => null,
            'postStart' => null
        ],

        CommandsInner::class => [
            'app' => null,
            'type' => null,
            'exitCode' => null
        ],

        Commit::class => [
            'id' => null,
            'sha' => null,
            'author' => null,
            'committer' => null,
            'message' => null,
            'tree' => null,
            'parents' => null
        ],

        Committer::class => [
            'date' => 'date-time',
            'name' => null,
            'email' => null
        ],

        Components::class => [
            'voucherVatBaseprice' => null
        ],

        Config::class => [
            'newrelic' => null,
            'sumologic' => null,
            'splunk' => null,
            'httplog' => null,
            'syslog' => null,
            'webhook' => null,
            'script' => null,
            'github' => null,
            'gitlab' => null,
            'bitbucket' => null,
            'bitbucketServer' => null,
            'healthEmail' => null,
            'healthWebhook' => null,
            'healthPagerduty' => null,
            'healthSlack' => null,
            'cdnFastly' => null,
            'blackfire' => null,
            'otlplog' => null
        ],

        ConfirmPhoneNumberRequest::class => [
            'code' => null
        ],

        ConfirmTotpEnrollment200Response::class => [
            'recoveryCodes' => null
        ],

        ConfirmTotpEnrollmentRequest::class => [
            'secret' => null,
            'passcode' => null
        ],

        Connection::class => [
            'provider' => null,
            'providerType' => null,
            'isMandatory' => null,
            'subject' => null,
            'emailAddress' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        ContainerProfilesValueValue::class => [
            'cpu' => 'float',
            'memory' => null,
            'cpuType' => null
        ],

        ContinuousProfilingConfiguration::class => [
            'supportedRuntimes' => null
        ],

        CreateApiTokenRequest::class => [
            'name' => null
        ],

        CreateAuthorizationCredentials200Response::class => [
            'redirectToUrl' => null,
            'type' => null
        ],

        CreateAuthorizationCredentials200ResponseRedirectToUrl::class => [
            'returnUrl' => null,
            'url' => null
        ],

        CreateOrgInviteRequest::class => [
            'email' => 'email',
            'permissions' => null,
            'force' => null
        ],

        CreateOrgMemberRequest::class => [
            'userId' => 'uuid',
            'permissions' => null
        ],

        CreateOrgProjectRequest::class => [
            'region' => null,
            'organizationId' => null,
            'title' => null,
            'type' => null,
            'plan' => null,
            'defaultBranch' => null,
            'cseNotes' => null,
            'dedicatedTag' => null
        ],

        CreateOrgRequest::class => [
            'label' => null,
            'type' => null,
            'ownerId' => 'uuid',
            'name' => null,
            'country' => null
        ],

        CreateOrgSubscriptionRequest::class => [
            'projectRegion' => null,
            'plan' => null,
            'projectTitle' => null,
            'optionsUrl' => null,
            'defaultBranch' => null,
            'environments' => null,
            'storage' => null
        ],

        CreateProfilePicture200Response::class => [
            'url' => null
        ],

        CreateProjectInviteRequest::class => [
            'email' => 'email',
            'role' => null,
            'permissions' => null,
            'environments' => null,
            'force' => null
        ],

        CreateProjectInviteRequestEnvironmentsInner::class => [
            'id' => null,
            'role' => null
        ],

        CreateProjectInviteRequestPermissionsInner::class => [
            'type' => null,
            'role' => null
        ],

        CreateSshKeyRequest::class => [
            'value' => null,
            'title' => null,
            'uuid' => null
        ],

        CreateTeamMemberRequest::class => [
            'userId' => 'uuid'
        ],

        CreateTeamRequest::class => [
            'organizationId' => 'ulid',
            'label' => null,
            'projectPermissions' => null
        ],

        CreateTicketRequest::class => [
            'subject' => null,
            'description' => null,
            'requesterId' => 'uuid',
            'priority' => null,
            'subscriptionId' => null,
            'organizationId' => null,
            'affectedUrl' => 'url',
            'followupTid' => null,
            'category' => null,
            'attachments' => null,
            'collaboratorIds' => null
        ],

        CreateTicketRequestAttachmentsInner::class => [
            'filename' => null,
            'data' => null
        ],

        CronsDeploymentState::class => [
            'enabled' => null,
            'status' => null
        ],

        CronsValue::class => [
            'spec' => null,
            'commands' => null,
            'timeout' => null,
            'shutdownTimeout' => null,
            'cmd' => null
        ],

        CurrencyAmount::class => [
            'formatted' => null,
            'amount' => 'float',
            'currencyCode' => null,
            'currencySymbol' => null
        ],

        CurrencyAmountNullable::class => [
            'formatted' => null,
            'amount' => 'float',
            'currencyCode' => null,
            'currencySymbol' => null
        ],

        CurrentUser::class => [
            'id' => 'uuid',
            'uuid' => 'uuid',
            'username' => null,
            'displayName' => null,
            'status' => null,
            'mail' => 'email',
            'sshKeys' => null,
            'hasKey' => null,
            'projects' => null,
            'sequence' => null,
            'roles' => null,
            'picture' => 'url',
            'tickets' => null,
            'trial' => null,
            'currentTrial' => null
        ],

        CurrentUserCurrentTrialInner::class => [
            'created' => 'date-time',
            'description' => null,
            'spendRemaining' => null,
            'expiration' => 'date-time'
        ],

        CurrentUserProjectsInner::class => [
            'id' => null,
            'name' => null,
            'title' => null,
            'cluster' => null,
            'clusterLabel' => null,
            'region' => null,
            'regionLabel' => null,
            'uri' => null,
            'endpoint' => null,
            'licenseId' => null,
            'owner' => 'uuid',
            'ownerInfo' => null,
            'plan' => null,
            'subscriptionId' => null,
            'status' => null,
            'vendor' => null,
            'vendorLabel' => null,
            'vendorWebsite' => 'url',
            'vendorResources' => null,
            'createdAt' => 'date-time'
        ],

        CustomDomains::class => [
            'enabled' => null,
            'environmentsWithDomainsLimit' => null
        ],

        DataRetention::class => [
            'enabled' => null
        ],

        DataRetentionConfigurationValue::class => [
            'maxBackups' => null,
            'defaultConfig' => null
        ],

        DataRetentionConfigurationValue1::class => [
            'defaultConfig' => null,
            'maxBackups' => null
        ],

        DateTimeFilter::class => [
            'eq' => null,
            'ne' => null,
            'between' => null,
            'gt' => null,
            'gte' => null,
            'lt' => null,
            'lte' => null
        ],

        DedicatedDeploymentTarget::class => [
            'type' => null,
            'name' => null,
            'deployHost' => null,
            'deployPort' => null,
            'sshHost' => null,
            'hosts' => null,
            'autoMounts' => null,
            'excludedMounts' => null,
            'enforcedMounts' => null,
            'autoCrons' => null,
            'autoNginx' => null,
            'maintenanceMode' => null,
            'guardrailsPhase' => null,
            'id' => null
        ],

        DedicatedDeploymentTargetCreateInput::class => [
            'type' => null,
            'name' => null,
            'enforcedMounts' => null
        ],

        DedicatedDeploymentTargetPatch::class => [
            'type' => null,
            'name' => null,
            'enforcedMounts' => null
        ],

        DefaultConfig::class => [
            'manualCount' => null,
            'schedule' => null
        ],

        DefaultConfig1::class => [
            'manualCount' => null,
            'schedule' => null
        ],

        DefaultResources::class => [
            'cpu' => 'float',
            'memory' => null,
            'cpuType' => null,
            'disk' => null,
            'profileSize' => null
        ],

        Deployment::class => [
            'id' => null,
            'clusterName' => null,
            'projectInfo' => null,
            'environmentInfo' => null,
            'deploymentTarget' => null,
            'vpn' => null,
            'httpAccess' => null,
            'enableSmtp' => null,
            'restrictRobots' => null,
            'variables' => null,
            'access' => null,
            'subscription' => null,
            'services' => null,
            'routes' => null,
            'webapps' => null,
            'workers' => null,
            'containerProfiles' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'fingerprint' => null
        ],

        DeploymentHostsInner::class => [
            'id' => null,
            'type' => null,
            'services' => null
        ],

        DeploymentState::class => [
            'lastDeploymentSuccessful' => null,
            'lastDeploymentAt' => 'date-time',
            'lastAutoscaleUpAt' => 'date-time',
            'lastAutoscaleDownAt' => 'date-time',
            'crons' => null
        ],

        DeploymentTarget::class => [
            'type' => null,
            'name' => null,
            'deployHost' => null,
            'deployPort' => null,
            'sshHost' => null,
            'hosts' => null,
            'autoMounts' => null,
            'excludedMounts' => null,
            'enforcedMounts' => null,
            'autoCrons' => null,
            'autoNginx' => null,
            'maintenanceMode' => null,
            'guardrailsPhase' => null,
            'docroots' => null,
            'siteUrls' => null,
            'sshHosts' => null,
            'useDedicatedGrid' => null,
            'storageType' => null,
            'id' => null,
            'enterpriseEnvironmentsMapping' => null
        ],

        DeploymentTargetCreateInput::class => [
            'type' => null,
            'name' => null,
            'enforcedMounts' => null,
            'siteUrls' => null,
            'sshHosts' => null,
            'enterpriseEnvironmentsMapping' => null,
            'hosts' => null,
            'useDedicatedGrid' => null
        ],

        DeploymentTargetPatch::class => [
            'type' => null,
            'name' => null,
            'enforcedMounts' => null,
            'siteUrls' => null,
            'sshHosts' => null,
            'enterpriseEnvironmentsMapping' => null,
            'hosts' => null,
            'useDedicatedGrid' => null
        ],

        DevelopmentResources::class => [
            'legacyDevelopment' => null,
            'maxCpu' => 'float',
            'maxMemory' => null,
            'maxEnvironments' => null
        ],

        Discount::class => [
            'id' => null,
            'organizationId' => null,
            'type' => null,
            'typeLabel' => null,
            'status' => null,
            'commitment' => null,
            'totalMonths' => null,
            'discount' => null,
            'config' => null,
            'startAt' => 'date-time',
            'endAt' => 'date-time'
        ],

        DiscountCommitment::class => [
            'months' => null,
            'amount' => null,
            'net' => null
        ],

        DiscountCommitmentAmount::class => [
            'monthly' => null,
            'commitmentPeriod' => null,
            'contractTotal' => null
        ],

        DiscountCommitmentNet::class => [
            'monthly' => null,
            'commitmentPeriod' => null,
            'contractTotal' => null
        ],

        DiscountDiscount::class => [
            'monthly' => null,
            'commitmentPeriod' => null,
            'contractTotal' => null
        ],

        DiskResources::class => [
            'temporary' => null,
            'instance' => null,
            'storage' => null
        ],

        DocrootsValue::class => [
            'activeDocroot' => null,
            'docrootVersions' => null
        ],

        Domain::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'name' => null,
            'attributes' => null,
            'id' => null,
            'project' => null,
            'registeredName' => null,
            'isDefault' => null,
            'replacementFor' => null
        ],

        DomainCreateInput::class => [
            'name' => null,
            'attributes' => null,
            'isDefault' => null,
            'replacementFor' => null
        ],

        DomainPatch::class => [
            'attributes' => null,
            'isDefault' => null
        ],

        EmailIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'fromAddress' => null,
            'recipients' => null,
            'id' => null
        ],

        EmailIntegrationCreateInput::class => [
            'type' => null,
            'recipients' => null,
            'fromAddress' => null
        ],

        EmailIntegrationPatch::class => [
            'type' => null,
            'recipients' => null,
            'fromAddress' => null
        ],

        EnterpriseDeploymentTarget::class => [
            'type' => null,
            'name' => null,
            'deployHost' => null,
            'docroots' => null,
            'siteUrls' => null,
            'sshHosts' => null,
            'maintenanceMode' => null,
            'id' => null,
            'enterpriseEnvironmentsMapping' => null
        ],

        EnterpriseDeploymentTargetCreateInput::class => [
            'type' => null,
            'name' => null,
            'siteUrls' => null,
            'sshHosts' => null,
            'enterpriseEnvironmentsMapping' => null
        ],

        EnterpriseDeploymentTargetPatch::class => [
            'type' => null,
            'name' => null,
            'siteUrls' => null,
            'sshHosts' => null,
            'enterpriseEnvironmentsMapping' => null
        ],

        Environment::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'name' => null,
            'machineName' => null,
            'title' => null,
            'attributes' => null,
            'type' => null,
            'parent' => null,
            'defaultDomain' => null,
            'hasDomains' => null,
            'cloneParentOnCreate' => null,
            'deploymentTarget' => null,
            'isPr' => null,
            'hasRemote' => null,
            'status' => null,
            'httpAccess' => null,
            'enableSmtp' => null,
            'restrictRobots' => null,
            'edgeHostname' => null,
            'deploymentState' => null,
            'sizing' => null,
            'resourcesOverrides' => null,
            'maxInstanceCount' => null,
            'lastActiveAt' => 'date-time',
            'lastBackupAt' => 'date-time',
            'project' => null,
            'isMain' => null,
            'isDirty' => null,
            'hasStagedActivities' => null,
            'canRollingDeploy' => null,
            'supportsRollingDeployments' => null,
            'hasCode' => null,
            'headCommit' => null,
            'mergeInfo' => null,
            'hasDeployment' => null,
            'supportsRestrictRobots' => null
        ],

        EnvironmentActivateInput::class => [
            'resources' => null
        ],

        EnvironmentBackupInput::class => [
            'safe' => null
        ],

        EnvironmentBranchInput::class => [
            'title' => null,
            'name' => null,
            'cloneParent' => null,
            'type' => null,
            'resources' => null
        ],

        EnvironmentDeployInput::class => [
            'strategy' => null
        ],

        EnvironmentInfo::class => [
            'name' => null,
            'status' => null,
            'isMain' => null,
            'isProduction' => null,
            'constraints' => null,
            'reference' => null,
            'machineName' => null,
            'environmentType' => null,
            'links' => null
        ],

        EnvironmentInitializeInput::class => [
            'profile' => null,
            'repository' => null,
            'config' => null,
            'files' => null,
            'resources' => null
        ],

        EnvironmentMergeInput::class => [
            'resources' => null
        ],

        EnvironmentOperationInput::class => [
            'service' => null,
            'operation' => null,
            'parameters' => null
        ],

        EnvironmentPatch::class => [
            'name' => null,
            'title' => null,
            'attributes' => null,
            'type' => null,
            'parent' => null,
            'cloneParentOnCreate' => null,
            'httpAccess' => null,
            'enableSmtp' => null,
            'restrictRobots' => null
        ],

        EnvironmentRestoreInput::class => [
            'environmentName' => null,
            'branchFrom' => null,
            'restoreCode' => null,
            'restoreResources' => null,
            'resources' => null
        ],

        EnvironmentSourceOperation::class => [
            'id' => null,
            'app' => null,
            'operation' => null,
            'command' => null
        ],

        EnvironmentSourceOperationInput::class => [
            'operation' => null,
            'variables' => null
        ],

        EnvironmentSynchronizeInput::class => [
            'synchronizeCode' => null,
            'rebase' => null,
            'synchronizeData' => null,
            'synchronizeResources' => null
        ],

        EnvironmentType::class => [
            'id' => null,
            'attributes' => null
        ],

        EnvironmentVariable::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'name' => null,
            'attributes' => null,
            'isJson' => null,
            'isSensitive' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'applicationScope' => null,
            'project' => null,
            'environment' => null,
            'inherited' => null,
            'isEnabled' => null,
            'isInheritable' => null,
            'value' => null
        ],

        EnvironmentVariableCreateInput::class => [
            'name' => null,
            'value' => null,
            'attributes' => null,
            'isJson' => null,
            'isSensitive' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'applicationScope' => null,
            'isEnabled' => null,
            'isInheritable' => null
        ],

        EnvironmentVariablePatch::class => [
            'name' => null,
            'attributes' => null,
            'value' => null,
            'isJson' => null,
            'isSensitive' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'applicationScope' => null,
            'isEnabled' => null,
            'isInheritable' => null
        ],

        EnvironmentVariablesInner::class => [
            'name' => null,
            'isSensitive' => null,
            'isJson' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'value' => null
        ],

        EnvironmentsCredentialsValue::class => [
            'serverUuid' => null,
            'serverToken' => null
        ],

        Error::class => [
            'status' => null,
            'message' => null,
            'code' => null,
            'detail' => null,
            'title' => null
        ],

        EstimationObject::class => [
            'plan' => null,
            'userLicenses' => null,
            'environments' => null,
            'storage' => null,
            'total' => null,
            'options' => null
        ],

        FastlyCDN::class => [
            'enabled' => null,
            'role' => null
        ],

        FastlyIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'serviceId' => null,
            'id' => null
        ],

        FastlyIntegrationCreateInput::class => [
            'type' => null,
            'token' => null,
            'serviceId' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null
        ],

        FastlyIntegrationPatch::class => [
            'type' => null,
            'token' => null,
            'serviceId' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null
        ],

        FilesInner::class => [
            'path' => null,
            'mode' => null,
            'contents' => null
        ],

        Firewall::class => [
            'outbound' => null
        ],

        FoundationDeploymentTarget::class => [
            'type' => null,
            'name' => null,
            'hosts' => null,
            'useDedicatedGrid' => null,
            'storageType' => null,
            'id' => null
        ],

        FoundationDeploymentTargetCreateInput::class => [
            'type' => null,
            'name' => null,
            'hosts' => null,
            'useDedicatedGrid' => null
        ],

        FoundationDeploymentTargetPatch::class => [
            'type' => null,
            'name' => null,
            'hosts' => null,
            'useDedicatedGrid' => null
        ],

        GetAddress200Response::class => [
            'country' => 'ISO ALPHA-2',
            'nameLine' => null,
            'premise' => null,
            'subPremise' => null,
            'thoroughfare' => null,
            'administrativeArea' => 'ISO ALPHA-2',
            'subAdministrativeArea' => null,
            'locality' => null,
            'dependentLocality' => null,
            'postalCode' => null,
            'metadata' => null
        ],

        GetCurrentUserVerificationStatus200Response::class => [
            'verifyPhone' => null
        ],

        GetCurrentUserVerificationStatusFull200Response::class => [
            'state' => null,
            'type' => null
        ],

        GetOrgPrepaymentInfo200Response::class => [
            'prepayment' => null,
            'links' => null
        ],

        GetOrgPrepaymentInfo200ResponseLinks::class => [
            'self' => null,
            'transactions' => null
        ],

        GetOrgPrepaymentInfo200ResponseLinksSelf::class => [
            'href' => null
        ],

        GetOrgPrepaymentInfo200ResponseLinksTransactions::class => [
            'href' => null
        ],

        GetSubscriptionUsageAlerts200Response::class => [
            'current' => null,
            'available' => null
        ],

        GetTotpEnrollment200Response::class => [
            'issuer' => 'uri',
            'accountName' => null,
            'secret' => null,
            'qrCode' => 'byte'
        ],

        GetTypeAllowance200Response::class => [
            'currencies' => null
        ],

        GetTypeAllowance200ResponseCurrencies::class => [
            'eUR' => null,
            'uSD' => null,
            'gBP' => null,
            'aUD' => null,
            'cAD' => null
        ],

        GetTypeAllowance200ResponseCurrenciesAUD::class => [
            'formatted' => null,
            'amount' => 'float',
            'currency' => null,
            'currencySymbol' => null
        ],

        GetTypeAllowance200ResponseCurrenciesCAD::class => [
            'formatted' => null,
            'amount' => 'float',
            'currency' => null,
            'currencySymbol' => null
        ],

        GetTypeAllowance200ResponseCurrenciesEUR::class => [
            'formatted' => null,
            'amount' => 'float',
            'currency' => null,
            'currencySymbol' => null
        ],

        GetTypeAllowance200ResponseCurrenciesGBP::class => [
            'formatted' => null,
            'amount' => 'float',
            'currency' => null,
            'currencySymbol' => null
        ],

        GetTypeAllowance200ResponseCurrenciesUSD::class => [
            'formatted' => null,
            'amount' => 'float',
            'currency' => null,
            'currencySymbol' => null
        ],

        GetUsageAlerts200Response::class => [
            'available' => null,
            'current' => null
        ],

        GitHub::class => [
            'enabled' => null,
            'role' => null
        ],

        GitLab::class => [
            'enabled' => null,
            'role' => null
        ],

        GitLabIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'tokenExpiresAt' => 'date-time',
            'rotateToken' => null,
            'rotateTokenValidityInWeeks' => null,
            'baseUrl' => null,
            'project' => null,
            'buildMergeRequests' => null,
            'buildWipMergeRequests' => null,
            'mergeRequestsCloneParentData' => null,
            'id' => null
        ],

        GitLabIntegrationCreateInput::class => [
            'type' => null,
            'token' => null,
            'project' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'rotateToken' => null,
            'rotateTokenValidityInWeeks' => null,
            'baseUrl' => null,
            'buildMergeRequests' => null,
            'buildWipMergeRequests' => null,
            'mergeRequestsCloneParentData' => null
        ],

        GitLabIntegrationPatch::class => [
            'type' => null,
            'token' => null,
            'project' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'rotateToken' => null,
            'rotateTokenValidityInWeeks' => null,
            'baseUrl' => null,
            'buildMergeRequests' => null,
            'buildWipMergeRequests' => null,
            'mergeRequestsCloneParentData' => null
        ],

        GitServerConfiguration::class => [
            'pushSizeHardLimit' => null
        ],

        GithubIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'baseUrl' => null,
            'repository' => null,
            'buildPullRequests' => null,
            'buildDraftPullRequests' => null,
            'buildPullRequestsPostMerge' => null,
            'pullRequestsCloneParentData' => null,
            'tokenType' => null,
            'id' => null
        ],

        GithubIntegrationCreateInput::class => [
            'type' => null,
            'token' => null,
            'repository' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'baseUrl' => null,
            'buildPullRequests' => null,
            'buildDraftPullRequests' => null,
            'buildPullRequestsPostMerge' => null,
            'pullRequestsCloneParentData' => null
        ],

        GithubIntegrationPatch::class => [
            'type' => null,
            'token' => null,
            'repository' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'baseUrl' => null,
            'buildPullRequests' => null,
            'buildDraftPullRequests' => null,
            'buildPullRequestsPostMerge' => null,
            'pullRequestsCloneParentData' => null
        ],

        GoogleSSOConfig::class => [
            'providerType' => null,
            'domain' => null
        ],

        GrantProjectTeamAccessRequestInner::class => [
            'teamId' => null
        ],

        GrantProjectUserAccessRequestInner::class => [
            'userId' => null,
            'permissions' => null,
            'autoAddMember' => null
        ],

        GrantTeamProjectAccessRequestInner::class => [
            'projectId' => null
        ],

        GrantUserProjectAccessRequestInner::class => [
            'projectId' => null,
            'permissions' => null
        ],

        GuaranteedResources::class => [
            'enabled' => null,
            'instanceLimit' => null
        ],

        HTTPLogForwarding::class => [
            'enabled' => null,
            'role' => null
        ],

        HalLinks::class => [
            'self' => null,
            'previous' => null,
            'next' => null
        ],

        HalLinksNext::class => [
            'title' => null,
            'href' => null
        ],

        HalLinksPrevious::class => [
            'title' => null,
            'href' => null
        ],

        HalLinksSelf::class => [
            'title' => null,
            'href' => null
        ],

        HealthEmail::class => [
            'enabled' => null,
            'role' => null
        ],

        HealthPagerDuty::class => [
            'enabled' => null,
            'role' => null
        ],

        HealthSlack::class => [
            'enabled' => null,
            'role' => null
        ],

        HealthWebHook::class => [
            'enabled' => null,
            'role' => null
        ],

        HealthWebHookIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'url' => null,
            'id' => null
        ],

        HealthWebHookIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'sharedKey' => null
        ],

        HealthWebHookIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'sharedKey' => null
        ],

        Hooks::class => [
            'build' => null,
            'deploy' => null,
            'postDeploy' => null
        ],

        HostsInner::class => [
            'id' => null,
            'type' => null,
            'services' => null
        ],

        HttpAccessPermissions::class => [
            'isEnabled' => null,
            'addresses' => null,
            'basicAuth' => null
        ],

        HttpAccessPermissions1::class => [
            'isEnabled' => null,
            'addresses' => null,
            'basicAuth' => null
        ],

        HttpAccessPermissions2::class => [
            'isEnabled' => null,
            'addresses' => null,
            'basicAuth' => null
        ],

        HttpLogIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'extra' => null,
            'url' => null,
            'headers' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'id' => null
        ],

        HttpLogIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'extra' => null,
            'headers' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        HttpLogIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'extra' => null,
            'headers' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        ImageTypeRestrictions::class => [
            'only' => null,
            'exclude' => null
        ],

        ImagesValueValue::class => [
            'available' => null
        ],

        Integration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'repository' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'resyncPullRequests' => null,
            'url' => null,
            'username' => null,
            'project' => null,
            'environmentsCredentials' => null,
            'continuousProfiling' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'serviceId' => null,
            'baseUrl' => null,
            'buildDraftPullRequests' => null,
            'buildPullRequestsPostMerge' => null,
            'tokenType' => null,
            'tokenExpiresAt' => 'date-time',
            'rotateToken' => null,
            'rotateTokenValidityInWeeks' => null,
            'buildMergeRequests' => null,
            'buildWipMergeRequests' => null,
            'mergeRequestsCloneParentData' => null,
            'fromAddress' => null,
            'recipients' => null,
            'routingKey' => null,
            'channel' => null,
            'extra' => null,
            'headers' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'script' => null,
            'index' => null,
            'sourcetype' => null,
            'category' => null,
            'host' => null,
            'port' => null,
            'protocol' => null,
            'facility' => null,
            'messageFormat' => null,
            'sharedKey' => null,
            'id' => null,
            'appCredentials' => null,
            'addonCredentials' => null
        ],

        IntegrationCreateInput::class => [
            'type' => null,
            'repository' => null,
            'url' => null,
            'username' => null,
            'token' => null,
            'project' => null,
            'serviceId' => null,
            'recipients' => null,
            'routingKey' => null,
            'channel' => null,
            'licenseKey' => null,
            'script' => null,
            'index' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'appCredentials' => null,
            'addonCredentials' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'resyncPullRequests' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'baseUrl' => null,
            'buildDraftPullRequests' => null,
            'buildPullRequestsPostMerge' => null,
            'rotateToken' => null,
            'rotateTokenValidityInWeeks' => null,
            'buildMergeRequests' => null,
            'buildWipMergeRequests' => null,
            'mergeRequestsCloneParentData' => null,
            'fromAddress' => null,
            'sharedKey' => null,
            'extra' => null,
            'headers' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'sourcetype' => null,
            'category' => null,
            'host' => null,
            'port' => null,
            'protocol' => null,
            'facility' => null,
            'messageFormat' => null,
            'authToken' => null,
            'authMode' => null
        ],

        IntegrationPatch::class => [
            'type' => null,
            'repository' => null,
            'url' => null,
            'username' => null,
            'token' => null,
            'project' => null,
            'serviceId' => null,
            'recipients' => null,
            'routingKey' => null,
            'channel' => null,
            'licenseKey' => null,
            'script' => null,
            'index' => null,
            'fetchBranches' => null,
            'pruneBranches' => null,
            'environmentInitResources' => null,
            'appCredentials' => null,
            'addonCredentials' => null,
            'buildPullRequests' => null,
            'pullRequestsCloneParentData' => null,
            'resyncPullRequests' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'baseUrl' => null,
            'buildDraftPullRequests' => null,
            'buildPullRequestsPostMerge' => null,
            'rotateToken' => null,
            'rotateTokenValidityInWeeks' => null,
            'buildMergeRequests' => null,
            'buildWipMergeRequests' => null,
            'mergeRequestsCloneParentData' => null,
            'fromAddress' => null,
            'sharedKey' => null,
            'extra' => null,
            'headers' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'sourcetype' => null,
            'category' => null,
            'host' => null,
            'port' => null,
            'protocol' => null,
            'facility' => null,
            'messageFormat' => null,
            'authToken' => null,
            'authMode' => null
        ],

        Integrations::class => [
            'enabled' => null,
            'config' => null,
            'allowedIntegrations' => null
        ],

        Invoice::class => [
            'id' => null,
            'invoiceNumber' => null,
            'type' => null,
            'orderId' => null,
            'relatedInvoiceId' => null,
            'status' => null,
            'owner' => 'ulid',
            'invoiceDate' => 'date-time',
            'invoiceDue' => 'date-time',
            'created' => 'date-time',
            'changed' => 'date-time',
            'company' => null,
            'total' => 'double',
            'address' => null,
            'notes' => null,
            'invoicePdf' => null
        ],

        InvoicePDF::class => [
            'url' => null,
            'status' => null
        ],

        IssuerInner::class => [
            'oid' => null,
            'alias' => null,
            'value' => null
        ],

        LineItem::class => [
            'type' => null,
            'licenseId' => null,
            'projectId' => null,
            'product' => null,
            'sku' => null,
            'total' => null,
            'totalFormatted' => null,
            'components' => null,
            'excludeFromInvoice' => null
        ],

        LineItemComponent::class => [
            'amount' => null,
            'amountFormatted' => null,
            'displayTitle' => null,
            'currency' => null
        ],

        Link::class => [
            'href' => null
        ],

        ListLinks::class => [
            'self' => null,
            'previous' => null,
            'next' => null
        ],

        ListOrgDiscounts200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListOrgInvoices200Response::class => [
            'items' => null
        ],

        ListOrgMembers200Response::class => [
            'count' => null,
            'items' => null,
            'links' => null
        ],

        ListOrgOrders200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListOrgPlanRecords200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListOrgPrepaymentTransactions200Response::class => [
            'count' => null,
            'transactions' => null,
            'links' => null
        ],

        ListOrgPrepaymentTransactions200ResponseLinks::class => [
            'self' => null,
            'previous' => null,
            'next' => null,
            'prepayment' => null
        ],

        ListOrgPrepaymentTransactions200ResponseLinksNext::class => [
            'href' => null
        ],

        ListOrgPrepaymentTransactions200ResponseLinksPrepayment::class => [
            'href' => null
        ],

        ListOrgPrepaymentTransactions200ResponseLinksPrevious::class => [
            'href' => null
        ],

        ListOrgPrepaymentTransactions200ResponseLinksSelf::class => [
            'href' => null
        ],

        ListOrgProjects200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListOrgSubscriptions200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListOrgUsageRecords200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListOrgs200Response::class => [
            'count' => null,
            'items' => null,
            'links' => null
        ],

        ListProfiles200Response::class => [
            'count' => null,
            'profiles' => null,
            'links' => null
        ],

        ListProjectTeamAccess200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListProjectUserAccess200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListRegions200Response::class => [
            'regions' => null,
            'links' => null
        ],

        ListTeamMembers200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListTeams200Response::class => [
            'items' => null,
            'count' => null,
            'links' => null
        ],

        ListTicketCategories200ResponseInner::class => [
            'id' => null,
            'label' => null
        ],

        ListTicketPriorities200ResponseInner::class => [
            'id' => null,
            'label' => null,
            'shortDescription' => null,
            'description' => null
        ],

        ListTickets200Response::class => [
            'count' => null,
            'tickets' => null,
            'links' => null
        ],

        ListUserExtendedAccess200Response::class => [
            'items' => null,
            'links' => null
        ],

        ListUserExtendedAccess200ResponseItemsInner::class => [
            'userId' => 'uuid',
            'resourceId' => null,
            'resourceType' => null,
            'organizationId' => null,
            'permissions' => null,
            'grantedAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        ListUserOrgs200Response::class => [
            'items' => null,
            'links' => null
        ],

        LogsForwarding::class => [
            'maxExtraPayloadSize' => null
        ],

        MergeInfo::class => [
            'commitsAhead' => null,
            'commitsBehind' => null,
            'parentRef' => null
        ],

        Metrics::class => [
            'maxRange' => null
        ],

        MetricsMetadata::class => [
            'from' => null,
            'to' => null,
            'interval' => null,
            'units' => null
        ],

        MetricsValue::class => [
            'value' => null,
            'startTime' => null
        ],

        MinimumResources::class => [
            'cpu' => 'float',
            'memory' => null,
            'cpuType' => null,
            'disk' => null,
            'profileSize' => null
        ],

        MountsValue::class => [
            'source' => null,
            'sourcePath' => null,
            'service' => null
        ],

        NewRelic::class => [
            'enabled' => null,
            'role' => null
        ],

        NewRelicIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'extra' => null,
            'url' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'id' => null
        ],

        NewRelicIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'licenseKey' => null,
            'extra' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        NewRelicIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'licenseKey' => null,
            'extra' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        OAuth2Consumer::class => [
            'key' => null
        ],

        OAuth2Consumer1::class => [
            'key' => null,
            'secret' => null
        ],

        \Upsun\Model\Object::class => [
            'type' => null,
            'sha' => null
        ],

        OpenTelemetry::class => [
            'enabled' => null,
            'role' => null
        ],

        OperationsValue::class => [
            'commands' => null,
            'timeout' => null,
            'role' => null
        ],

        Order::class => [
            'id' => null,
            'status' => null,
            'owner' => 'uuid',
            'address' => null,
            'company' => null,
            'vatNumber' => null,
            'billingPeriodStart' => 'date-time',
            'billingPeriodEnd' => 'date-time',
            'billingPeriodLabel' => null,
            'billingPeriodDuration' => null,
            'paidOn' => 'date-time',
            'total' => null,
            'totalFormatted' => null,
            'components' => null,
            'currency' => null,
            'invoiceUrl' => null,
            'lastRefreshed' => 'date-time',
            'invoiced' => null,
            'lineItems' => null,
            'links' => null
        ],

        OrderBillingPeriodLabel::class => [
            'formatted' => null,
            'month' => null,
            'year' => null,
            'nextMonth' => null
        ],

        OrderLinks::class => [
            'invoices' => null
        ],

        OrderLinksInvoices::class => [
            'href' => null
        ],

        Organization::class => [
            'id' => 'ulid',
            'type' => null,
            'ownerId' => 'uuid',
            'namespace' => null,
            'name' => null,
            'label' => null,
            'country' => null,
            'capabilities' => null,
            'vendor' => null,
            'billingAccountId' => null,
            'billingLegacy' => null,
            'status' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        OrganizationAddonsObject::class => [
            'available' => null,
            'current' => null,
            'upgradesAvailable' => null
        ],

        OrganizationAddonsObjectAvailable::class => [
            'userManagement' => null,
            'supportLevel' => null
        ],

        OrganizationAddonsObjectCurrent::class => [
            'userManagement' => null,
            'supportLevel' => null
        ],

        OrganizationAddonsObjectUpgradesAvailable::class => [
            'userManagement' => null,
            'supportLevel' => null
        ],

        OrganizationAlertConfig::class => [
            'id' => null,
            'active' => null,
            'alertsSent' => null,
            'lastAlertAt' => null,
            'updatedAt' => null,
            'config' => null
        ],

        OrganizationAlertConfigConfig::class => [
            'threshold' => null,
            'mode' => null
        ],

        OrganizationAlertConfigConfigThreshold::class => [
            'formatted' => null,
            'amount' => null,
            'currencyCode' => null,
            'currencySymbol' => null
        ],

        OrganizationCarbon::class => [
            'organizationId' => null,
            'meta' => null,
            'projects' => null,
            'total' => null
        ],

        OrganizationEstimationObject::class => [
            'total' => null,
            'subTotal' => null,
            'vouchers' => null,
            'userLicenses' => null,
            'userManagement' => null,
            'supportLevel' => null,
            'subscriptions' => null
        ],

        OrganizationEstimationObjectSubscriptions::class => [
            'total' => null,
            'list' => null
        ],

        OrganizationEstimationObjectSubscriptionsListInner::class => [
            'licenseId' => null,
            'projectTitle' => null,
            'total' => null,
            'usage' => null
        ],

        OrganizationEstimationObjectSubscriptionsListInnerUsage::class => [
            'cpu' => null,
            'memory' => null,
            'storage' => null,
            'environments' => null
        ],

        OrganizationEstimationObjectUserLicenses::class => [
            'base' => null,
            'userManagement' => null
        ],

        OrganizationEstimationObjectUserLicensesBase::class => [
            'count' => null,
            'total' => null,
            'list' => null
        ],

        OrganizationEstimationObjectUserLicensesBaseList::class => [
            'adminUser' => null,
            'viewerUser' => null
        ],

        OrganizationEstimationObjectUserLicensesBaseListAdminUser::class => [
            'count' => null,
            'total' => null
        ],

        OrganizationEstimationObjectUserLicensesBaseListViewerUser::class => [
            'count' => null,
            'total' => null
        ],

        OrganizationEstimationObjectUserLicensesUserManagement::class => [
            'count' => null,
            'total' => null,
            'list' => null
        ],

        OrganizationEstimationObjectUserLicensesUserManagementList::class => [
            'standardManagementUser' => null,
            'advancedManagementUser' => null
        ],

        OrganizationEstimationObjectUserLicensesUserManagementListAdvancedManagementUser::class => [
            'count' => null,
            'total' => null
        ],

        OrganizationEstimationObjectUserLicensesUserManagementListStandardManagementUser::class => [
            'count' => null,
            'total' => null
        ],

        OrganizationInvitation::class => [
            'id' => 'uuid',
            'state' => null,
            'organizationId' => null,
            'email' => 'email',
            'owner' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'finishedAt' => 'date-time',
            'permissions' => null
        ],

        OrganizationInvitationOwner::class => [
            'id' => 'uuid',
            'displayName' => null
        ],

        OrganizationLinks::class => [
            'self' => null,
            'update' => null,
            'delete' => null,
            'members' => null,
            'createMember' => null,
            'address' => null,
            'profile' => null,
            'paymentSource' => null,
            'orders' => null,
            'vouchers' => null,
            'applyVoucher' => null,
            'subscriptions' => null,
            'createSubscription' => null,
            'estimateSubscription' => null,
            'mfaEnforcement' => null
        ],

        OrganizationLinksAddress::class => [
            'href' => null
        ],

        OrganizationLinksApplyVoucher::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationLinksCreateMember::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationLinksCreateSubscription::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationLinksDelete::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationLinksEstimateSubscription::class => [
            'href' => null
        ],

        OrganizationLinksMembers::class => [
            'href' => null
        ],

        OrganizationLinksMfaEnforcement::class => [
            'href' => null
        ],

        OrganizationLinksOrders::class => [
            'href' => null
        ],

        OrganizationLinksPaymentSource::class => [
            'href' => null
        ],

        OrganizationLinksProfile::class => [
            'href' => null
        ],

        OrganizationLinksSelf::class => [
            'href' => null
        ],

        OrganizationLinksSubscriptions::class => [
            'href' => null
        ],

        OrganizationLinksUpdate::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationLinksVouchers::class => [
            'href' => null
        ],

        OrganizationMember::class => [
            'id' => 'uuid',
            'organizationId' => 'ulid',
            'userId' => 'uuid',
            'permissions' => null,
            'level' => null,
            'owner' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        OrganizationMemberLinks::class => [
            'self' => null,
            'update' => null,
            'delete' => null
        ],

        OrganizationMemberLinksDelete::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationMemberLinksSelf::class => [
            'href' => null
        ],

        OrganizationMemberLinksUpdate::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationMfaEnforcement::class => [
            'enforceMfa' => null
        ],

        OrganizationProject::class => [
            'id' => null,
            'organizationId' => null,
            'subscriptionId' => null,
            'vendor' => null,
            'region' => null,
            'title' => null,
            'type' => null,
            'plan' => null,
            'timezone' => null,
            'defaultBranch' => null,
            'status' => null,
            'trialPlan' => null,
            'projectUi' => null,
            'locked' => null,
            'cseNotes' => null,
            'dedicatedTag' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        OrganizationProjectCarbon::class => [
            'projectId' => null,
            'projectTitle' => null,
            'values' => null,
            'total' => null
        ],

        OrganizationProjectLinks::class => [
            'self' => null,
            'update' => null,
            'delete' => null,
            'activities' => null,
            'addons' => null
        ],

        OrganizationProjectLinksActivities::class => [
            'href' => null
        ],

        OrganizationProjectLinksAddons::class => [
            'href' => null
        ],

        OrganizationProjectLinksDelete::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationProjectLinksSelf::class => [
            'href' => null
        ],

        OrganizationProjectLinksUpdate::class => [
            'href' => null,
            'method' => null
        ],

        OrganizationReference::class => [
            'id' => 'ulid',
            'type' => null,
            'ownerId' => 'uuid',
            'name' => null,
            'label' => null,
            'vendor' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        OrganizationSSOConfig::class => [
            'providerType' => null,
            'domain' => null,
            'organizationId' => null,
            'enforced' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        OutboundFirewall::class => [
            'enabled' => null
        ],

        OutboundFirewallRestrictionsInner::class => [
            'protocol' => null,
            'ips' => null,
            'domains' => null,
            'ports' => null
        ],

        OwnerInfo::class => [
            'type' => null,
            'username' => null,
            'displayName' => null
        ],

        PagerDutyIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'routingKey' => null,
            'id' => null
        ],

        PagerDutyIntegrationCreateInput::class => [
            'type' => null,
            'routingKey' => null
        ],

        PagerDutyIntegrationPatch::class => [
            'type' => null,
            'routingKey' => null
        ],

        PathValue::class => [
            'regexp' => null,
            'to' => null,
            'prefix' => null,
            'appendSuffix' => null,
            'code' => null,
            'expires' => null
        ],

        PlanRecords::class => [
            'id' => null,
            'owner' => 'uuid',
            'subscriptionId' => null,
            'sku' => null,
            'plan' => null,
            'options' => null,
            'start' => 'date-time',
            'end' => 'date-time',
            'status' => null
        ],

        PreServiceResourcesOverridesValue::class => [
            'cpu' => 'float',
            'memory' => null,
            'disk' => null
        ],

        PreflightChecks::class => [
            'enabled' => null,
            'ignoredRules' => null
        ],

        PrepaymentObject::class => [
            'prepayment' => null
        ],

        PrepaymentObjectPrepayment::class => [
            'organizationId' => null,
            'balance' => null,
            'lastUpdatedAt' => null,
            'sufficient' => null,
            'fallback' => null
        ],

        PrepaymentObjectPrepaymentBalance::class => [
            'formatted' => null,
            'amount' => null,
            'currencyCode' => null,
            'currencySymbol' => null
        ],

        PrepaymentTransactionObject::class => [
            'orderId' => null,
            'message' => null,
            'status' => null,
            'amount' => null,
            'created' => null,
            'updated' => null,
            'expireDate' => null
        ],

        PrepaymentTransactionObjectAmount::class => [
            'formatted' => null,
            'amount' => null,
            'currencyCode' => null,
            'currencySymbol' => null
        ],

        ProdDomainStorage::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'name' => null,
            'attributes' => null,
            'id' => null,
            'project' => null,
            'registeredName' => null,
            'isDefault' => null
        ],

        ProdDomainStorageCreateInput::class => [
            'name' => null,
            'attributes' => null,
            'isDefault' => null
        ],

        ProdDomainStoragePatch::class => [
            'attributes' => null,
            'isDefault' => null
        ],

        ProductionResources::class => [
            'legacyDevelopment' => null,
            'maxCpu' => 'float',
            'maxMemory' => null,
            'maxEnvironments' => null
        ],

        Profile::class => [
            'id' => 'uuid',
            'displayName' => null,
            'email' => 'email',
            'username' => null,
            'type' => null,
            'picture' => 'url',
            'companyType' => null,
            'companyName' => null,
            'currency' => null,
            'vatNumber' => null,
            'companyRole' => null,
            'websiteUrl' => null,
            'newUi' => null,
            'uiColorscheme' => null,
            'defaultCatalog' => null,
            'projectOptionsUrl' => null,
            'marketing' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'billingContact' => 'email',
            'securityContact' => 'email',
            'currentTrial' => null,
            'invoiced' => null
        ],

        ProfileCurrentTrial::class => [
            'active' => null,
            'created' => 'date-time',
            'description' => null,
            'expiration' => 'date-time',
            'current' => null,
            'spend' => null,
            'spendRemaining' => null,
            'projects' => null,
            'pendingVerification' => null,
            'model' => null,
            'daysRemaining' => null
        ],

        ProfileCurrentTrialCurrent::class => [
            'formatted' => null,
            'amount' => null,
            'currency' => null,
            'currencySymbol' => null
        ],

        ProfileCurrentTrialProjects::class => [
            'id' => null,
            'name' => null,
            'total' => null
        ],

        ProfileCurrentTrialProjectsTotal::class => [
            'amount' => null,
            'currencyCode' => null,
            'currencySymbol' => null,
            'formatted' => null
        ],

        ProfileCurrentTrialSpend::class => [
            'formatted' => null,
            'amount' => null,
            'currency' => null,
            'currencySymbol' => null
        ],

        ProfileCurrentTrialSpendRemaining::class => [
            'formatted' => null,
            'amount' => null,
            'currency' => null,
            'currencySymbol' => null,
            'unlimited' => null
        ],

        Project::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'attributes' => null,
            'title' => null,
            'description' => null,
            'owner' => null,
            'namespace' => null,
            'organization' => null,
            'defaultBranch' => null,
            'status' => null,
            'timezone' => null,
            'region' => null,
            'repository' => null,
            'defaultDomain' => null,
            'subscription' => null
        ],

        ProjectAddon::class => [
            'id' => null,
            'type' => null,
            'sku' => null,
            'quantity' => null,
            'projectId' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        ProjectAddonBase::class => [
            'id' => null,
            'type' => null,
            'projectId' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        ProjectAddonBaseLinks::class => [
            'self' => null,
            'update' => null,
            'delete' => null
        ],

        ProjectAddonBaseLinksDelete::class => [
            'href' => null,
            'method' => null
        ],

        ProjectAddonBaseLinksSelf::class => [
            'href' => null
        ],

        ProjectAddonBaseLinksUpdate::class => [
            'href' => null,
            'method' => null
        ],

        ProjectAddonWithQuantityFields::class => [
            'quantity' => null
        ],

        ProjectAddonWithSkuFields::class => [
            'sku' => null
        ],

        ProjectCapabilities::class => [
            'metrics' => null,
            'logsForwarding' => null,
            'guaranteedResources' => null,
            'images' => null,
            'instanceLimit' => null,
            'buildResources' => null,
            'dataRetention' => null,
            'autoscaling' => null,
            'customDomains' => null,
            'sourceOperations' => null,
            'runtimeOperations' => null,
            'outboundFirewall' => null,
            'integrations' => null
        ],

        ProjectCarbon::class => [
            'projectId' => null,
            'projectTitle' => null,
            'meta' => null,
            'values' => null,
            'total' => null
        ],

        ProjectInfo::class => [
            'title' => null,
            'name' => null,
            'namespace' => null,
            'organization' => null,
            'capabilities' => null,
            'settings' => null
        ],

        ProjectInvitation::class => [
            'id' => 'uuid',
            'state' => null,
            'projectId' => null,
            'role' => null,
            'email' => 'email',
            'owner' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'finishedAt' => 'date-time',
            'environments' => null
        ],

        ProjectInvitationEnvironmentsInner::class => [
            'id' => null,
            'type' => null,
            'role' => null,
            'title' => null
        ],

        ProjectOptions::class => [
            'defaults' => null,
            'enforced' => null,
            'regions' => null,
            'plans' => null,
            'billing' => null
        ],

        ProjectOptionsDefaults::class => [
            'settings' => null,
            'variables' => null,
            'access' => null,
            'capabilities' => null
        ],

        ProjectOptionsEnforced::class => [
            'settings' => null,
            'capabilities' => null
        ],

        ProjectPatch::class => [
            'attributes' => null,
            'title' => null,
            'description' => null,
            'defaultBranch' => null,
            'timezone' => null,
            'region' => null,
            'defaultDomain' => null
        ],

        ProjectReference::class => [
            'id' => null,
            'organizationId' => null,
            'subscriptionId' => null,
            'region' => null,
            'title' => null,
            'type' => null,
            'plan' => null,
            'status' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        ProjectSettings::class => [
            'initialize' => null,
            'productName' => null,
            'productCode' => null,
            'uiUriTemplate' => null,
            'variablesPrefix' => null,
            'botEmail' => null,
            'applicationConfigFile' => null,
            'projectConfigDir' => null,
            'useDrupalDefaults' => null,
            'useLegacySubdomains' => null,
            'developmentServiceSize' => null,
            'developmentApplicationSize' => null,
            'enableCertificateProvisioning' => null,
            'certificateStyle' => null,
            'certificateRenewalActivity' => null,
            'developmentDomainTemplate' => null,
            'enableStateApiDeployments' => null,
            'temporaryDiskSize' => null,
            'localDiskSize' => null,
            'cronMinimumInterval' => null,
            'cronMaximumJitter' => null,
            'cronProductionExpiryInterval' => null,
            'cronNonProductionExpiryInterval' => null,
            'concurrencyLimits' => null,
            'flexibleBuildCache' => null,
            'strictConfiguration' => null,
            'hasSleepyCrons' => null,
            'cronsInGit' => null,
            'customErrorTemplate' => null,
            'appErrorPageTemplate' => null,
            'environmentNameStrategy' => null,
            'dataRetention' => null,
            'enableCodesourceIntegrationPush' => null,
            'enforceMfa' => null,
            'systemd' => null,
            'routerGen2' => null,
            'buildResources' => null,
            'outboundRestrictionsDefaultPolicy' => null,
            'selfUpgrade' => null,
            'selfUpgradeLatestMajor' => null,
            'additionalHosts' => null,
            'maxAllowedRoutes' => null,
            'maxAllowedRedirectsPaths' => null,
            'enableIncrementalBackups' => null,
            'sizingApiEnabled' => null,
            'enableCacheGracePeriod' => null,
            'enableZeroDowntimeDeployments' => null,
            'enableAdminAgent' => null,
            'certifierUrl' => null,
            'centralizedPermissions' => null,
            'glueServerMaxRequestSize' => null,
            'persistentEndpointsSsh' => null,
            'persistentEndpointsSslCertificates' => null,
            'enableDiskHealthMonitoring' => null,
            'enablePausedEnvironments' => null,
            'enableUnifiedConfiguration' => null,
            'enableRoutesTracing' => null,
            'imageDeploymentValidation' => null,
            'supportGenericImages' => null,
            'enableGithubAppTokenExchange' => null,
            'continuousProfiling' => null,
            'disableAgentErrorReporter' => null,
            'requiresDomainOwnership' => null,
            'enableGuaranteedResources' => null,
            'gitServer' => null,
            'activityLogsMaxSize' => null,
            'allowManualDeployments' => null,
            'allowRollingDeployments' => null,
            'allowBurst' => null,
            'routerResources' => null
        ],

        ProjectSettingsPatch::class => [
            'initialize' => null,
            'dataRetention' => null,
            'buildResources' => null
        ],

        ProjectStatus::class => [

        ],

        ProjectType::class => [

        ],

        ProjectVariable::class => [
            'id' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'name' => null,
            'attributes' => null,
            'isJson' => null,
            'isSensitive' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'applicationScope' => null,
            'value' => null
        ],

        ProjectVariableCreateInput::class => [
            'name' => null,
            'value' => null,
            'attributes' => null,
            'isJson' => null,
            'isSensitive' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'applicationScope' => null
        ],

        ProjectVariablePatch::class => [
            'name' => null,
            'attributes' => null,
            'value' => null,
            'isJson' => null,
            'isSensitive' => null,
            'visibleBuild' => null,
            'visibleRuntime' => null,
            'applicationScope' => null
        ],

        ProxyRoute::class => [
            'attributes' => null,
            'type' => null,
            'tls' => null,
            'to' => null,
            'id' => null,
            'primary' => null,
            'productionUrl' => null,
            'redirects' => null,
            'cache' => null,
            'ssi' => null,
            'upstream' => null,
            'sticky' => null
        ],

        RedirectConfiguration::class => [
            'expires' => null,
            'paths' => null
        ],

        RedirectRoute::class => [
            'attributes' => null,
            'type' => null,
            'tls' => null,
            'to' => null,
            'id' => null,
            'primary' => null,
            'productionUrl' => null,
            'redirects' => null,
            'cache' => null,
            'ssi' => null,
            'upstream' => null,
            'sticky' => null
        ],

        Ref::class => [
            'id' => null,
            'ref' => null,
            'object' => null,
            'sha' => null
        ],

        Region::class => [
            'id' => null,
            'label' => null,
            'zone' => null,
            'selectionLabel' => null,
            'projectLabel' => null,
            'timezone' => null,
            'available' => null,
            'private' => null,
            'endpoint' => null,
            'provider' => null,
            'datacenter' => null,
            'environmentalImpact' => null
        ],

        RegionDatacenter::class => [
            'name' => null,
            'label' => null,
            'location' => null
        ],

        RegionEnvironmentalImpact::class => [
            'zone' => null,
            'carbonIntensity' => null,
            'green' => null
        ],

        RegionProvider::class => [
            'name' => null,
            'logo' => null
        ],

        RegionReference::class => [
            'id' => null,
            'label' => null,
            'zone' => null,
            'selectionLabel' => null,
            'projectLabel' => null,
            'timezone' => null,
            'available' => null,
            'endpoint' => null,
            'provider' => null,
            'datacenter' => null,
            'compliance' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'private' => null,
            'code' => null,
            'envimpact' => null
        ],

        ReplacementDomainStorage::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'name' => null,
            'attributes' => null,
            'id' => null,
            'project' => null,
            'registeredName' => null,
            'replacementFor' => null
        ],

        ReplacementDomainStorageCreateInput::class => [
            'name' => null,
            'attributes' => null,
            'replacementFor' => null
        ],

        ReplacementDomainStoragePatch::class => [
            'attributes' => null
        ],

        RepositoryInformation::class => [
            'url' => null,
            'clientSshKey' => null
        ],

        RequestBuffering::class => [
            'enabled' => null,
            'maxRequestSize' => null
        ],

        ResetEmailAddressRequest::class => [
            'emailAddress' => 'email'
        ],

        ResourceConfig::class => [
            'profileSize' => null
        ],

        Resources::class => [
            'baseMemory' => null,
            'memoryRatio' => null,
            'profileSize' => null,
            'minimum' => null,
            'default' => null,
            'disk' => null
        ],

        Resources1::class => [
            'profileSize' => null
        ],

        Resources2::class => [
            'init' => null
        ],

        Resources3::class => [
            'init' => null
        ],

        Resources4::class => [
            'init' => null
        ],

        Resources5::class => [
            'init' => null
        ],

        Resources6::class => [
            'init' => null
        ],

        ResourcesLimits::class => [
            'containerProfiles' => null,
            'production' => null,
            'development' => null
        ],

        ResourcesOverridesValue::class => [
            'services' => null,
            'startsAt' => 'date-time',
            'endsAt' => 'date-time',
            'redeployedStart' => null,
            'redeployedEnd' => null
        ],

        Route::class => [
            'attributes' => null,
            'type' => null,
            'tls' => null,
            'to' => null,
            'id' => null,
            'primary' => null,
            'productionUrl' => null,
            'redirects' => null,
            'cache' => null,
            'ssi' => null,
            'upstream' => null,
            'sticky' => null
        ],

        RouterResources::class => [
            'baselineCpu' => 'float',
            'baselineMemory' => null,
            'maxCpu' => 'float',
            'maxMemory' => null
        ],

        RoutesValue::class => [
            'attributes' => null,
            'type' => null,
            'tls' => null,
            'to' => null,
            'id' => null,
            'primary' => null,
            'productionUrl' => null,
            'redirects' => null,
            'cache' => null,
            'ssi' => null,
            'upstream' => null,
            'sticky' => null
        ],

        Routing::class => [
            'percentage' => null
        ],

        Routing1::class => [
            'percentage' => null
        ],

        RuntimeOperations::class => [
            'enabled' => null
        ],

        SSIConfiguration::class => [
            'enabled' => null
        ],

        ScheduleInner::class => [
            'interval' => null,
            'count' => null
        ],

        Script::class => [
            'enabled' => null,
            'role' => null
        ],

        ScriptIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'script' => null,
            'id' => null
        ],

        ScriptIntegrationCreateInput::class => [
            'type' => null,
            'script' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null
        ],

        ScriptIntegrationPatch::class => [
            'type' => null,
            'script' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null
        ],

        SendOrgMfaReminders200ResponseValue::class => [
            'code' => null,
            'message' => null
        ],

        SendOrgMfaRemindersRequest::class => [
            'userIds' => 'uuid'
        ],

        ServiceRelationshipsValue::class => [
            'service' => null,
            'endpoint' => null
        ],

        ServicesValue::class => [
            'type' => null,
            'size' => null,
            'disk' => null,
            'access' => null,
            'configuration' => null,
            'relationships' => null,
            'firewall' => null,
            'resources' => null,
            'containerProfile' => null,
            'endpoints' => null,
            'instanceCount' => null
        ],

        ServicesValue1::class => [
            'resources' => null,
            'instanceCount' => null,
            'disk' => null
        ],

        Sizing::class => [
            'services' => null,
            'webapps' => null,
            'workers' => null
        ],

        SlackIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'channel' => null,
            'id' => null
        ],

        SlackIntegrationCreateInput::class => [
            'type' => null,
            'token' => null,
            'channel' => null
        ],

        SlackIntegrationPatch::class => [
            'type' => null,
            'token' => null,
            'channel' => null
        ],

        SourceCodeConfiguration::class => [
            'root' => null,
            'operations' => null
        ],

        SourceOperations::class => [
            'enabled' => null
        ],

        SourceOperationsValue::class => [
            'command' => null
        ],

        SpecificOverridesValue::class => [
            'expires' => null,
            'passthru' => null,
            'scripts' => null,
            'allow' => null,
            'headers' => null
        ],

        Splunk::class => [
            'enabled' => null,
            'role' => null
        ],

        SplunkIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'extra' => null,
            'url' => null,
            'index' => null,
            'sourcetype' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'id' => null
        ],

        SplunkIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'index' => null,
            'token' => null,
            'extra' => null,
            'sourcetype' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        SplunkIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'index' => null,
            'token' => null,
            'extra' => null,
            'sourcetype' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        SshKey::class => [
            'keyId' => null,
            'uid' => null,
            'fingerprint' => null,
            'title' => null,
            'value' => null,
            'changed' => null
        ],

        Status::class => [
            'code' => null,
            'message' => null
        ],

        StickyConfiguration::class => [
            'enabled' => null
        ],

        StrictTransportSecurityOptions::class => [
            'enabled' => null,
            'includeSubdomains' => null,
            'preload' => null
        ],

        StringFilter::class => [
            'eq' => null,
            'ne' => null,
            'in' => null,
            'nin' => null,
            'between' => null,
            'contains' => null,
            'starts' => null,
            'ends' => null
        ],

        Subscription::class => [
            'id' => null,
            'status' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'owner' => 'uuid',
            'ownerInfo' => null,
            'vendor' => null,
            'plan' => null,
            'environments' => null,
            'storage' => null,
            'userLicenses' => null,
            'projectId' => null,
            'projectEndpoint' => null,
            'projectTitle' => null,
            'projectRegion' => null,
            'projectRegionLabel' => null,
            'projectUi' => null,
            'projectOptions' => null,
            'agencySite' => null,
            'invoiced' => null,
            'hipaa' => null,
            'isTrialPlan' => null,
            'services' => null,
            'green' => null
        ],

        Subscription1::class => [
            'licenseUri' => null,
            'storage' => null,
            'includedUsers' => null,
            'subscriptionManagementUri' => null,
            'restricted' => null,
            'suspended' => null,
            'userLicenses' => null,
            'plan' => null,
            'environments' => null,
            'resources' => null,
            'resourceValidationUrl' => null,
            'imageTypes' => null
        ],

        SubscriptionAddonsObject::class => [
            'available' => null,
            'current' => null,
            'upgradesAvailable' => null
        ],

        SubscriptionAddonsObjectAvailable::class => [
            'continuousProfiling' => null,
            'projectSupportLevel' => null
        ],

        SubscriptionAddonsObjectCurrent::class => [
            'continuousProfiling' => null,
            'projectSupportLevel' => null
        ],

        SubscriptionAddonsObjectUpgradesAvailable::class => [
            'continuousProfiling' => null,
            'projectSupportLevel' => null
        ],

        SubscriptionCurrentUsageObject::class => [
            'cpuApp' => null,
            'storageAppServices' => null,
            'memoryApp' => null,
            'cpuServices' => null,
            'memoryServices' => null,
            'backupStorage' => null,
            'buildCpu' => null,
            'buildMemory' => null,
            'egressBandwidth' => null,
            'ingressRequests' => null,
            'logsFwdContentSize' => null,
            'fastlyBandwidth' => null,
            'fastlyRequests' => null
        ],

        SubscriptionInformation::class => [
            'licenseUri' => null,
            'storage' => null,
            'includedUsers' => null,
            'subscriptionManagementUri' => null,
            'restricted' => null,
            'suspended' => null,
            'userLicenses' => null,
            'plan' => null,
            'environments' => null,
            'resources' => null,
            'resourceValidationUrl' => null,
            'imageTypes' => null
        ],

        SumoLogic::class => [
            'enabled' => null,
            'role' => null
        ],

        SumologicIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'extra' => null,
            'url' => null,
            'category' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'id' => null
        ],

        SumologicIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'extra' => null,
            'category' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        SumologicIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'extra' => null,
            'category' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        Syslog::class => [
            'enabled' => null,
            'role' => null
        ],

        SyslogIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'extra' => null,
            'host' => null,
            'port' => null,
            'protocol' => null,
            'facility' => null,
            'messageFormat' => null,
            'tlsVerify' => null,
            'excludedServices' => null,
            'id' => null
        ],

        SyslogIntegrationCreateInput::class => [
            'type' => null,
            'extra' => null,
            'host' => null,
            'port' => null,
            'protocol' => null,
            'facility' => null,
            'messageFormat' => null,
            'authToken' => null,
            'authMode' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        SyslogIntegrationPatch::class => [
            'type' => null,
            'extra' => null,
            'host' => null,
            'port' => null,
            'protocol' => null,
            'facility' => null,
            'messageFormat' => null,
            'authToken' => null,
            'authMode' => null,
            'tlsVerify' => null,
            'excludedServices' => null
        ],

        SystemInformation::class => [
            'version' => null,
            'image' => null,
            'startedAt' => 'date-time'
        ],

        TLSSettings::class => [
            'strictTransportSecurity' => null,
            'minVersion' => null,
            'clientAuthentication' => null,
            'clientCertificateAuthorities' => null
        ],

        Team::class => [
            'id' => 'ulid',
            'organizationId' => 'ulid',
            'label' => null,
            'projectPermissions' => null,
            'counts' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        TeamCounts::class => [
            'memberCount' => null,
            'projectCount' => null
        ],

        TeamMember::class => [
            'teamId' => 'ulid',
            'userId' => 'uuid',
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        TeamProjectAccess::class => [
            'teamId' => 'ulid',
            'organizationId' => 'ulid',
            'projectId' => null,
            'projectTitle' => null,
            'grantedAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        TeamProjectAccessLinks::class => [
            'self' => null,
            'update' => null,
            'delete' => null
        ],

        TeamProjectAccessLinksDelete::class => [
            'href' => null,
            'method' => null
        ],

        TeamProjectAccessLinksSelf::class => [
            'href' => null
        ],

        TeamProjectAccessLinksUpdate::class => [
            'href' => null,
            'method' => null
        ],

        TeamReference::class => [
            'id' => 'ulid',
            'organizationId' => 'ulid',
            'label' => null,
            'projectPermissions' => null,
            'counts' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time'
        ],

        Ticket::class => [
            'ticketId' => null,
            'created' => 'date-time',
            'updated' => 'date-time',
            'type' => null,
            'subject' => null,
            'description' => null,
            'priority' => null,
            'followupTid' => null,
            'status' => null,
            'recipient' => null,
            'requesterId' => 'uuid',
            'submitterId' => 'uuid',
            'assigneeId' => 'uuid',
            'organizationId' => null,
            'collaboratorIds' => null,
            'hasIncidents' => null,
            'due' => 'date-time',
            'tags' => null,
            'subscriptionId' => null,
            'ticketGroup' => null,
            'supportPlan' => null,
            'affectedUrl' => 'url',
            'queue' => null,
            'issueType' => null,
            'resolutionTime' => 'date-time',
            'responseTime' => 'date-time',
            'projectUrl' => 'url',
            'region' => null,
            'category' => null,
            'environment' => null,
            'ticketSharingStatus' => null,
            'applicationTicketUrl' => 'url',
            'infrastructureTicketUrl' => 'url',
            'jira' => null,
            'zdTicketUrl' => 'url'
        ],

        TicketJiraInner::class => [
            'id' => null,
            'ticketId' => null,
            'issueId' => null,
            'issueKey' => null,
            'createdAt' => 'float',
            'updatedAt' => 'float'
        ],

        Tree::class => [
            'id' => null,
            'sha' => null,
            'tree' => null
        ],

        TreeItemsInner::class => [
            'path' => null,
            'mode' => null,
            'type' => null,
            'sha' => null
        ],

        UpdateOrgAddonsRequest::class => [
            'userManagement' => null,
            'supportLevel' => null
        ],

        UpdateOrgBillingAlertConfigRequest::class => [
            'active' => null,
            'config' => null
        ],

        UpdateOrgBillingAlertConfigRequestConfig::class => [
            'threshold' => null,
            'mode' => null
        ],

        UpdateOrgMemberRequest::class => [
            'permissions' => null
        ],

        UpdateOrgProfileRequest::class => [
            'defaultCatalog' => null,
            'projectOptionsUrl' => 'uri',
            'securityContact' => 'email',
            'companyName' => null,
            'vatNumber' => null,
            'billingContact' => 'email'
        ],

        UpdateOrgProjectRequest::class => [
            'title' => null,
            'plan' => null,
            'timezone' => null,
            'cseNotes' => null,
            'dedicatedTag' => null
        ],

        UpdateOrgRequest::class => [
            'name' => null,
            'label' => null,
            'country' => null
        ],

        UpdateOrgSubscriptionRequest::class => [
            'projectTitle' => null,
            'plan' => null,
            'timezone' => null,
            'environments' => null,
            'storage' => null,
            'bigDev' => null,
            'bigDevService' => null,
            'backups' => null,
            'observabilitySuite' => null,
            'blackfire' => null,
            'continuousProfiling' => null,
            'projectSupportLevel' => null
        ],

        UpdateProfileRequest::class => [
            'displayName' => null,
            'username' => null,
            'currentPassword' => null,
            'password' => null,
            'companyType' => null,
            'companyName' => null,
            'vatNumber' => null,
            'companyRole' => null,
            'marketing' => null,
            'uiColorscheme' => null,
            'defaultCatalog' => null,
            'projectOptionsUrl' => null,
            'picture' => null
        ],

        UpdateProjectUserAccessRequest::class => [
            'permissions' => null
        ],

        UpdateProjectsEnvironmentsDeploymentsNextRequest::class => [
            'webapps' => null,
            'services' => null,
            'workers' => null
        ],

        UpdateProjectsEnvironmentsDeploymentsNextRequestServicesValue::class => [
            'resources' => null,
            'instanceCount' => null,
            'disk' => null
        ],

        UpdateProjectsEnvironmentsDeploymentsNextRequestWebappsValue::class => [
            'resources' => null,
            'instanceCount' => null,
            'disk' => null
        ],

        UpdateSubscriptionUsageAlertsRequest::class => [
            'alerts' => null
        ],

        UpdateSubscriptionUsageAlertsRequestAlertsInner::class => [
            'id' => null,
            'active' => null,
            'config' => null
        ],

        UpdateSubscriptionUsageAlertsRequestAlertsInnerConfig::class => [
            'threshold' => null
        ],

        UpdateTeamRequest::class => [
            'label' => null,
            'projectPermissions' => null
        ],

        UpdateTicketRequest::class => [
            'status' => null,
            'collaboratorIds' => null,
            'collaboratorsReplace' => null
        ],

        UpdateUsageAlertsRequest::class => [
            'alerts' => null
        ],

        UpdateUserRequest::class => [
            'username' => null,
            'firstName' => null,
            'lastName' => null,
            'picture' => 'uri',
            'company' => null,
            'website' => 'uri',
            'country' => null
        ],

        UpstreamConfiguration::class => [
            'socketFamily' => null,
            'protocol' => null
        ],

        UpstreamRoute::class => [
            'attributes' => null,
            'type' => null,
            'tls' => null,
            'id' => null,
            'primary' => null,
            'productionUrl' => null,
            'cache' => null,
            'ssi' => null,
            'upstream' => null,
            'redirects' => null,
            'sticky' => null,
            'to' => null
        ],

        Usage::class => [
            'id' => null,
            'subscriptionId' => null,
            'usageGroup' => null,
            'quantity' => null,
            'start' => 'date-time'
        ],

        UsageAlert::class => [
            'id' => null,
            'active' => null,
            'alertsSent' => null,
            'lastAlertAt' => null,
            'updatedAt' => null,
            'config' => null
        ],

        UsageAlertConfig::class => [
            'threshold' => null
        ],

        UsageAlertConfigThreshold::class => [
            'formatted' => null,
            'amount' => null,
            'unit' => null
        ],

        UsageGroupCurrentUsageProperties::class => [
            'title' => null,
            'type' => null,
            'currentUsage' => null,
            'currentUsageFormatted' => null,
            'notCharged' => null,
            'freeQuantity' => null,
            'freeQuantityFormatted' => null,
            'dailyAverage' => null,
            'dailyAverageFormatted' => null
        ],

        User::class => [
            'id' => 'uuid',
            'deactivated' => null,
            'namespace' => null,
            'username' => null,
            'email' => 'email',
            'emailVerified' => null,
            'firstName' => null,
            'lastName' => null,
            'picture' => 'uri',
            'company' => null,
            'website' => 'uri',
            'country' => null,
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'consentedAt' => 'date-time',
            'consentMethod' => null
        ],

        UserProjectAccess::class => [
            'userId' => 'uuid',
            'organizationId' => 'ulid',
            'projectId' => null,
            'projectTitle' => null,
            'permissions' => null,
            'grantedAt' => 'date-time',
            'updatedAt' => 'date-time',
            'links' => null
        ],

        UserReference::class => [
            'id' => 'uuid',
            'username' => null,
            'email' => 'email',
            'firstName' => null,
            'lastName' => null,
            'picture' => 'uri',
            'mfaEnabled' => null,
            'ssoEnabled' => null
        ],

        VPNConfiguration::class => [
            'version' => null,
            'aggressive' => null,
            'modeconfig' => null,
            'authentication' => null,
            'gatewayIp' => null,
            'identity' => null,
            'secondIdentity' => null,
            'remoteIdentity' => null,
            'remoteSubnets' => null,
            'ike' => null,
            'esp' => null,
            'ikelifetime' => null,
            'lifetime' => null,
            'margintime' => null
        ],

        VerifyPhoneNumber200Response::class => [
            'sid' => null
        ],

        VerifyPhoneNumberRequest::class => [
            'channel' => null,
            'phoneNumber' => null
        ],

        Version::class => [
            'id' => null,
            'commit' => null,
            'locked' => null,
            'routing' => null
        ],

        VersionCreateInput::class => [
            'routing' => null
        ],

        VersionPatch::class => [
            'routing' => null
        ],

        Vouchers::class => [
            'uuid' => 'uuid',
            'vouchersTotal' => null,
            'vouchersApplied' => null,
            'vouchersRemainingBalance' => null,
            'currency' => null,
            'vouchers' => null,
            'links' => null
        ],

        VouchersLinks::class => [
            'self' => null
        ],

        VouchersLinksSelf::class => [
            'href' => null
        ],

        VouchersVouchersInner::class => [
            'code' => null,
            'amount' => null,
            'currency' => null,
            'orders' => null
        ],

        VouchersVouchersInnerOrdersInner::class => [
            'orderId' => null,
            'status' => null,
            'billingPeriodStart' => null,
            'billingPeriodEnd' => null,
            'orderTotal' => null,
            'orderDiscount' => null,
            'currency' => null
        ],

        WebApplicationsValue::class => [
            'resources' => null,
            'size' => null,
            'disk' => null,
            'access' => null,
            'relationships' => null,
            'additionalHosts' => null,
            'mounts' => null,
            'timezone' => null,
            'variables' => null,
            'firewall' => null,
            'containerProfile' => null,
            'operations' => null,
            'name' => null,
            'type' => null,
            'preflight' => null,
            'treeId' => null,
            'appDir' => null,
            'endpoints' => null,
            'runtime' => null,
            'web' => null,
            'hooks' => null,
            'crons' => null,
            'source' => null,
            'build' => null,
            'dependencies' => null,
            'stack' => null,
            'isAcrossSubmodule' => null,
            'instanceCount' => null,
            'configId' => null,
            'slugId' => null
        ],

        WebConfiguration::class => [
            'locations' => null,
            'moveToRoot' => null,
            'commands' => null,
            'upstream' => null,
            'documentRoot' => null,
            'passthru' => null,
            'indexFiles' => null,
            'whitelist' => null,
            'blacklist' => null,
            'expires' => null
        ],

        WebHookIntegration::class => [
            'createdAt' => 'date-time',
            'updatedAt' => 'date-time',
            'type' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'sharedKey' => null,
            'url' => null,
            'id' => null
        ],

        WebHookIntegrationCreateInput::class => [
            'type' => null,
            'url' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'sharedKey' => null
        ],

        WebHookIntegrationPatch::class => [
            'type' => null,
            'url' => null,
            'events' => null,
            'environments' => null,
            'excludedEnvironments' => null,
            'states' => null,
            'result' => null,
            'sharedKey' => null
        ],

        WebLocationsValue::class => [
            'root' => null,
            'expires' => null,
            'passthru' => null,
            'scripts' => null,
            'allow' => null,
            'headers' => null,
            'rules' => null,
            'index' => null,
            'requestBuffering' => null
        ],

        Webhook::class => [
            'enabled' => null,
            'role' => null
        ],

        WorkerConfiguration::class => [
            'commands' => null,
            'disk' => null
        ],

        WorkersValue::class => [
            'resources' => null,
            'size' => null,
            'disk' => null,
            'access' => null,
            'relationships' => null,
            'additionalHosts' => null,
            'mounts' => null,
            'timezone' => null,
            'variables' => null,
            'firewall' => null,
            'containerProfile' => null,
            'operations' => null,
            'name' => null,
            'type' => null,
            'preflight' => null,
            'treeId' => null,
            'appDir' => null,
            'endpoints' => null,
            'runtime' => null,
            'worker' => null,
            'app' => null,
            'stack' => null,
            'instanceCount' => null,
            'slugId' => null
        ],

    ];
}

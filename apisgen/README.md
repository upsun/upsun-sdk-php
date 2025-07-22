# OpenAPIClient-php

# Introduction

Platform.sh is a container-based Platform-as-a-Service. Our main API
is simply Git. With a single `git push` and a couple of YAML files in
your repository you can deploy an arbitrarily complex cluster.
Every [**Project**](#tag/Project) can have multiple applications (PHP,
Node.js, Python, Ruby, Go, etc.) and managed, automatically
provisioned services (databases, message queues, etc.).

Each project also comes with multiple concurrent
live staging/development [**Environments**](#tag/Environment).
These ephemeral development environments
are automatically created every time you push a new branch or create a
pull request, and each has a full copy of the data of its parent branch,
which is created on-the-fly in seconds.

Our Git implementation supports integrations with third party Git
providers such as GitHub, Bitbucket, or GitLab, allowing you to simply
integrate Platform.sh into your existing workflow.

## Using the REST API

In addition to the Git API, we also offer a REST API that allows you to manage
every aspect of the platform, from managing projects and environments,
to accessing accounts and subscriptions, to creating robust workflows
and integrations with your CI systems and internal services.

These API docs are generated from a standard **OpenAPI (Swagger)** Specification document
which you can find here in [YAML](openapispec-platformsh.yaml) and in [JSON](openapispec-platformsh.json) formats.

This RESTful API consumes and produces HAL-style JSON over HTTPS,
and any REST library can be used to access it. On GitHub, we also host
a few API libraries that you can use to make API access easier, such as our
[PHP API client](https://github.com/platformsh/platformsh-client-php)
and our [JavaScript API client](https://github.com/platformsh/platformsh-client-js).

In order to use the API you will first need to have a Platform.sh
account (we have a [free trial](https://accounts.platform.sh/platform/trial/general/setup)
available) and create an API Token.

# Authentication

## OAuth2

API authentication is done with OAuth2 access tokens.

### API tokens

You can use an API token as one way to get an OAuth2 access token. This
is particularly useful in scripts, e.g. for CI pipelines.

To create an API token, go to the \"API Tokens\" section
of the \"Account Settings\" tab on the [Console](https://console.platform.sh).

To exchange this API token for an access token, a `POST` request
must be made to `https://auth.api.platform.sh/oauth2/token`.

The request will look like this in cURL:

<pre>
curl -u platform-api-user: \\
    -d 'grant_type=api_token&amp;api_token=<em><b>API_TOKEN</b></em>' \\
    https://auth.api.platform.sh/oauth2/token
</pre>

This will return a \"Bearer\" access token that
can be used to authenticate further API requests, for example:

<pre>
{
    \"access_token\": \"<em><b>abcdefghij1234567890</b></em>\",
    \"expires_in\": 900,
    \"token_type\": \"bearer\"
}
</pre>

### Using the Access Token

To authenticate further API requests, include this returned bearer token
in the `Authorization` header. For example, to retrieve a list of
[Projects](#tag/Project)
accessible by the current user, you can make the following request
(substituting the dummy token for your own):

<pre>
curl -H \"Authorization: Bearer <em><b>abcdefghij1234567890</b></em>\" \\
    https://api.platform.sh/projects
</pre>

# HAL Links

Most endpoints in the API return fields which defines a HAL
(Hypertext Application Language) schema for the requested endpoint.
The particular objects returns and their contents can vary by endpoint.
The payload examples we give here for the requests do not show these
elements. These links can allow you to create a fully dynamic API client
that does not need to hardcode any method or schema.

Unless they are used for pagination we do not show the HAL links in the
payload examples in this documentation for brevity and as their content
is contextual (based on the permissions of the user).

## _links Objects

Most endpoints that respond to `GET` requests will include a `_links` object
in their response. The `_links` object contains a key-object pair labelled `self`, which defines
two further key-value pairs:

* `href` - A URL string referring to the fully qualified name of the returned object. For many endpoints, this will be the direct link to the API endpoint on the region gateway, rather than on the general API gateway. This means it may reference a host of, for example, `eu-2.platform.sh` rather than `api.platform.sh`.
* `meta` - An object defining the OpenAPI Specification (OAS) [schema object](https://swagger.io/specification/#schemaObject) of the component returned by the endpoint.

There may be zero or more other fields in the `_links` object resembling fragment identifiers
beginning with a hash mark, e.g. `#edit` or `#delete`. Each of these keys
refers to a JSON object containing two key-value pairs:

* `href` - A URL string referring to the path name of endpoint which can perform the action named in the key.
* `meta` - An object defining the OAS schema of the endpoint. This consists of a key-value pair, with the key defining an HTTP method and the value defining the [operation object](https://swagger.io/specification/#operationObject) of the endpoint.

To use one of these HAL links, you must send a new request to the URL defined
in the `href` field which contains a body defined the schema object in the `meta` field.

For example, if you make a request such as `GET /projects/abcdefghij1234567890`, the `_links`
object in the returned response will include the key `#delete`. That object
will look something like this fragment:

```
\"#delete\": {
    \"href\": \"/api/projects/abcdefghij1234567890\",
    \"meta\": {
        \"delete\": {
            \"responses\": {
                . . . // Response definition omitted for space
            },
            \"parameters\": []
        }
    }
}
```

To use this information to delete a project, you would then send a `DELETE`
request to the endpoint `https://api.platform.sh/api/projects/abcdefghij1234567890`
with no body or parameters to delete the project that was originally requested.

## _embedded Objects

Requests to endpoints which create or modify objects, such as `POST`, `PATCH`, or `DELETE`
requests, will include an `_embedded` key in their response. The object
represented by this key will contain the created or modified object. This
object is identical to what would be returned by a subsequent `GET` request
for the object referred to by the endpoint.


For more information, please visit [https://platform.sh/contact](https://platform.sh/contact).

## Installation & Usage

### Requirements

PHP 7.2 and later.

### Composer

To install the bindings via [Composer](https://getcomposer.org/), add the following to `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/GIT_USER_ID/GIT_REPO_ID.git"
    }
  ],
  "require": {
    "GIT_USER_ID/GIT_REPO_ID": "*@dev"
  }
}
```

Then run `composer install`

Your project is free to choose the http client of your choice
Please require packages that will provide http client functionality:
https://packagist.org/providers/psr/http-client-implementation
https://packagist.org/providers/php-http/async-client-implementation
https://packagist.org/providers/psr/http-factory-implementation

As an example:

```
composer require guzzlehttp/guzzle php-http/guzzle7-adapter http-interop/http-factory-guzzle
```

### Manual Installation

Download the files and include `autoload.php`:

```php
<?php
require_once('/path/to/OpenAPIClient-php/vendor/autoload.php');
```

## Getting Started

Please follow the [installation procedure](#installation--usage) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');



// Configure OAuth2 access token for authorization: OAuth2
$config = OpenAPI\Client\Configuration::getDefaultConfiguration()->setAccessToken('YOUR_ACCESS_TOKEN');


$apiInstance = new OpenAPI\Client\Api\APITokensApi(
    // If you want use custom http client, pass your client which implements `Psr\Http\Client\ClientInterface`.
    // This is optional, `Psr18ClientDiscovery` will be used to find http client. For instance `GuzzleHttp\Client` implements that interface
    new GuzzleHttp\Client(),
    $config
);
$user_id = d81c8ee2-44b3-429f-b944-a33ad7437690; // string | The ID of the user.
$create_api_token_request = new \OpenAPI\Client\Model\CreateApiTokenRequest(); // \OpenAPI\Client\Model\CreateApiTokenRequest

try {
    $result = $apiInstance->createApiToken($user_id, $create_api_token_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling APITokensApi->createApiToken: ', $e->getMessage(), PHP_EOL;
}

```

## API Endpoints

All URIs are relative to *https://api.platform.sh*

Class | Method | HTTP request | Description
------------ | ------------- | ------------- | -------------
*APITokensApi* | [**createApiToken**](docs/Api/APITokensApi.md#createapitoken) | **POST** /users/{user_id}/api-tokens | Create an API token
*APITokensApi* | [**deleteApiToken**](docs/Api/APITokensApi.md#deleteapitoken) | **DELETE** /users/{user_id}/api-tokens/{token_id} | Delete an API token
*APITokensApi* | [**getApiToken**](docs/Api/APITokensApi.md#getapitoken) | **GET** /users/{user_id}/api-tokens/{token_id} | Get an API token
*APITokensApi* | [**listApiTokens**](docs/Api/APITokensApi.md#listapitokens) | **GET** /users/{user_id}/api-tokens | List a user&#39;s API tokens
*AlertsApi* | [**createUsageAlert**](docs/Api/AlertsApi.md#createusagealert) | **POST** /alerts/subscriptions/{subscriptionId}/usage | Create a usage alert.
*AlertsApi* | [**deleteUsageAlert**](docs/Api/AlertsApi.md#deleteusagealert) | **DELETE** /alerts/subscriptions/{subscriptionId}/usage/{usageId} | Delete a usage alert.
*AlertsApi* | [**getUsageAlerts**](docs/Api/AlertsApi.md#getusagealerts) | **GET** /alerts/subscriptions/{subscriptionId}/usage | Get usage alerts for a subscription
*AlertsApi* | [**updateUsageAlert**](docs/Api/AlertsApi.md#updateusagealert) | **PATCH** /alerts/subscriptions/{subscriptionId}/usage/{usageId} | Update a usage alert.
*CertManagementApi* | [**createProjectsCertificates**](docs/Api/CertManagementApi.md#createprojectscertificates) | **POST** /projects/{projectId}/certificates | Add an SSL certificate
*CertManagementApi* | [**deleteProjectsCertificates**](docs/Api/CertManagementApi.md#deleteprojectscertificates) | **DELETE** /projects/{projectId}/certificates/{certificateId} | Delete an SSL certificate
*CertManagementApi* | [**getProjectsCertificates**](docs/Api/CertManagementApi.md#getprojectscertificates) | **GET** /projects/{projectId}/certificates/{certificateId} | Get an SSL certificate
*CertManagementApi* | [**listProjectsCertificates**](docs/Api/CertManagementApi.md#listprojectscertificates) | **GET** /projects/{projectId}/certificates | Get list of SSL certificates
*CertManagementApi* | [**updateProjectsCertificates**](docs/Api/CertManagementApi.md#updateprojectscertificates) | **PATCH** /projects/{projectId}/certificates/{certificateId} | Update an SSL certificate
*ConnectionsApi* | [**deleteLoginConnection**](docs/Api/ConnectionsApi.md#deleteloginconnection) | **DELETE** /users/{user_id}/connections/{provider} | Delete a federated login connection
*ConnectionsApi* | [**getLoginConnection**](docs/Api/ConnectionsApi.md#getloginconnection) | **GET** /users/{user_id}/connections/{provider} | Get a federated login connection
*ConnectionsApi* | [**listLoginConnections**](docs/Api/ConnectionsApi.md#listloginconnections) | **GET** /users/{user_id}/connections | List federated login connections
*DefaultApi* | [**listTickets**](docs/Api/DefaultApi.md#listtickets) | **GET** /tickets | List support tickets
*DeploymentApi* | [**getProjectsEnvironmentsDeployments**](docs/Api/DeploymentApi.md#getprojectsenvironmentsdeployments) | **GET** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId} | Get a single environment deployment
*DeploymentApi* | [**listProjectsEnvironmentsDeployments**](docs/Api/DeploymentApi.md#listprojectsenvironmentsdeployments) | **GET** /projects/{projectId}/environments/{environmentId}/deployments | Get an environment&#39;s deployment information
*DeploymentTargetApi* | [**createProjectsDeployments**](docs/Api/DeploymentTargetApi.md#createprojectsdeployments) | **POST** /projects/{projectId}/deployments | Create a project deployment target
*DeploymentTargetApi* | [**deleteProjectsDeployments**](docs/Api/DeploymentTargetApi.md#deleteprojectsdeployments) | **DELETE** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Delete a single project deployment target
*DeploymentTargetApi* | [**getProjectsDeployments**](docs/Api/DeploymentTargetApi.md#getprojectsdeployments) | **GET** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Get a single project deployment target
*DeploymentTargetApi* | [**listProjectsDeployments**](docs/Api/DeploymentTargetApi.md#listprojectsdeployments) | **GET** /projects/{projectId}/deployments | Get project deployment target info
*DeploymentTargetApi* | [**updateProjectsDeployments**](docs/Api/DeploymentTargetApi.md#updateprojectsdeployments) | **PATCH** /projects/{projectId}/deployments/{deploymentTargetConfigurationId} | Update a project deployment
*DomainManagementApi* | [**createProjectsDomains**](docs/Api/DomainManagementApi.md#createprojectsdomains) | **POST** /projects/{projectId}/domains | Add a project domain
*DomainManagementApi* | [**createProjectsEnvironmentsDomains**](docs/Api/DomainManagementApi.md#createprojectsenvironmentsdomains) | **POST** /projects/{projectId}/environments/{environmentId}/domains | Add an environment domain
*DomainManagementApi* | [**deleteProjectsDomains**](docs/Api/DomainManagementApi.md#deleteprojectsdomains) | **DELETE** /projects/{projectId}/domains/{domainId} | Delete a project domain
*DomainManagementApi* | [**deleteProjectsEnvironmentsDomains**](docs/Api/DomainManagementApi.md#deleteprojectsenvironmentsdomains) | **DELETE** /projects/{projectId}/environments/{environmentId}/domains/{domainId} | Delete an environment domain
*DomainManagementApi* | [**getProjectsDomains**](docs/Api/DomainManagementApi.md#getprojectsdomains) | **GET** /projects/{projectId}/domains/{domainId} | Get a project domain
*DomainManagementApi* | [**getProjectsEnvironmentsDomains**](docs/Api/DomainManagementApi.md#getprojectsenvironmentsdomains) | **GET** /projects/{projectId}/environments/{environmentId}/domains/{domainId} | Get an environment domain
*DomainManagementApi* | [**listProjectsDomains**](docs/Api/DomainManagementApi.md#listprojectsdomains) | **GET** /projects/{projectId}/domains | Get list of project domains
*DomainManagementApi* | [**listProjectsEnvironmentsDomains**](docs/Api/DomainManagementApi.md#listprojectsenvironmentsdomains) | **GET** /projects/{projectId}/environments/{environmentId}/domains | Get a list of environment domains
*DomainManagementApi* | [**updateProjectsDomains**](docs/Api/DomainManagementApi.md#updateprojectsdomains) | **PATCH** /projects/{projectId}/domains/{domainId} | Update a project domain
*DomainManagementApi* | [**updateProjectsEnvironmentsDomains**](docs/Api/DomainManagementApi.md#updateprojectsenvironmentsdomains) | **PATCH** /projects/{projectId}/environments/{environmentId}/domains/{domainId} | Update an environment domain
*EnvironmentApi* | [**activateEnvironment**](docs/Api/EnvironmentApi.md#activateenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/activate | Activate an environment
*EnvironmentApi* | [**branchEnvironment**](docs/Api/EnvironmentApi.md#branchenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/branch | Branch an environment
*EnvironmentApi* | [**createProjectsEnvironmentsVersions**](docs/Api/EnvironmentApi.md#createprojectsenvironmentsversions) | **POST** /projects/{projectId}/environments/{environmentId}/versions | Create versions associated with the environment
*EnvironmentApi* | [**deactivateEnvironment**](docs/Api/EnvironmentApi.md#deactivateenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/deactivate | Deactivate an environment
*EnvironmentApi* | [**deleteEnvironment**](docs/Api/EnvironmentApi.md#deleteenvironment) | **DELETE** /projects/{projectId}/environments/{environmentId} | Delete an environment
*EnvironmentApi* | [**deleteProjectsEnvironmentsVersions**](docs/Api/EnvironmentApi.md#deleteprojectsenvironmentsversions) | **DELETE** /projects/{projectId}/environments/{environmentId}/versions/{versionId} | Delete the version
*EnvironmentApi* | [**getEnvironment**](docs/Api/EnvironmentApi.md#getenvironment) | **GET** /projects/{projectId}/environments/{environmentId} | Get an environment
*EnvironmentApi* | [**getProjectsEnvironmentsVersions**](docs/Api/EnvironmentApi.md#getprojectsenvironmentsversions) | **GET** /projects/{projectId}/environments/{environmentId}/versions/{versionId} | List the version
*EnvironmentApi* | [**initializeEnvironment**](docs/Api/EnvironmentApi.md#initializeenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/initialize | Initialize a new environment
*EnvironmentApi* | [**listProjectsEnvironments**](docs/Api/EnvironmentApi.md#listprojectsenvironments) | **GET** /projects/{projectId}/environments | Get list of project environments
*EnvironmentApi* | [**listProjectsEnvironmentsVersions**](docs/Api/EnvironmentApi.md#listprojectsenvironmentsversions) | **GET** /projects/{projectId}/environments/{environmentId}/versions | List versions associated with the environment
*EnvironmentApi* | [**mergeEnvironment**](docs/Api/EnvironmentApi.md#mergeenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/merge | Merge an environment
*EnvironmentApi* | [**pauseEnvironment**](docs/Api/EnvironmentApi.md#pauseenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/pause | Pause an environment
*EnvironmentApi* | [**redeployEnvironment**](docs/Api/EnvironmentApi.md#redeployenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/redeploy | Redeploy an environment
*EnvironmentApi* | [**resumeEnvironment**](docs/Api/EnvironmentApi.md#resumeenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/resume | Resume a paused environment
*EnvironmentApi* | [**synchronizeEnvironment**](docs/Api/EnvironmentApi.md#synchronizeenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/synchronize | Synchronize a child environment with its parent
*EnvironmentApi* | [**updateEnvironment**](docs/Api/EnvironmentApi.md#updateenvironment) | **PATCH** /projects/{projectId}/environments/{environmentId} | Update an environment
*EnvironmentApi* | [**updateProjectsEnvironmentsVersions**](docs/Api/EnvironmentApi.md#updateprojectsenvironmentsversions) | **PATCH** /projects/{projectId}/environments/{environmentId}/versions/{versionId} | Update the version
*EnvironmentActivityApi* | [**actionProjectsEnvironmentsActivitiesCancel**](docs/Api/EnvironmentActivityApi.md#actionprojectsenvironmentsactivitiescancel) | **POST** /projects/{projectId}/environments/{environmentId}/activities/{activityId}/cancel | Cancel an environment activity
*EnvironmentActivityApi* | [**getProjectsEnvironmentsActivities**](docs/Api/EnvironmentActivityApi.md#getprojectsenvironmentsactivities) | **GET** /projects/{projectId}/environments/{environmentId}/activities/{activityId} | Get an environment activity log entry
*EnvironmentActivityApi* | [**listProjectsEnvironmentsActivities**](docs/Api/EnvironmentActivityApi.md#listprojectsenvironmentsactivities) | **GET** /projects/{projectId}/environments/{environmentId}/activities | Get environment activity log
*EnvironmentBackupsApi* | [**backupEnvironment**](docs/Api/EnvironmentBackupsApi.md#backupenvironment) | **POST** /projects/{projectId}/environments/{environmentId}/backup | Create snapshot of environment
*EnvironmentBackupsApi* | [**deleteProjectsEnvironmentsBackups**](docs/Api/EnvironmentBackupsApi.md#deleteprojectsenvironmentsbackups) | **DELETE** /projects/{projectId}/environments/{environmentId}/backups/{backupId} | Delete an environment snapshot
*EnvironmentBackupsApi* | [**getProjectsEnvironmentsBackups**](docs/Api/EnvironmentBackupsApi.md#getprojectsenvironmentsbackups) | **GET** /projects/{projectId}/environments/{environmentId}/backups/{backupId} | Get an environment snapshot&#39;s info
*EnvironmentBackupsApi* | [**listProjectsEnvironmentsBackups**](docs/Api/EnvironmentBackupsApi.md#listprojectsenvironmentsbackups) | **GET** /projects/{projectId}/environments/{environmentId}/backups | Get an environment&#39;s snapshot list
*EnvironmentBackupsApi* | [**restoreBackup**](docs/Api/EnvironmentBackupsApi.md#restorebackup) | **POST** /projects/{projectId}/environments/{environmentId}/backups/{backupId}/restore | Restore an environment snapshot
*EnvironmentTypeApi* | [**getEnvironmentType**](docs/Api/EnvironmentTypeApi.md#getenvironmenttype) | **GET** /projects/{projectId}/environment-types/{environmentTypeId} | Get environment type links
*EnvironmentTypeApi* | [**listProjectsEnvironmentTypes**](docs/Api/EnvironmentTypeApi.md#listprojectsenvironmenttypes) | **GET** /projects/{projectId}/environment-types | Get environment types
*EnvironmentVariablesApi* | [**createProjectsEnvironmentsVariables**](docs/Api/EnvironmentVariablesApi.md#createprojectsenvironmentsvariables) | **POST** /projects/{projectId}/environments/{environmentId}/variables | Add an environment variable
*EnvironmentVariablesApi* | [**deleteProjectsEnvironmentsVariables**](docs/Api/EnvironmentVariablesApi.md#deleteprojectsenvironmentsvariables) | **DELETE** /projects/{projectId}/environments/{environmentId}/variables/{variableId} | Delete an environment variable
*EnvironmentVariablesApi* | [**getProjectsEnvironmentsVariables**](docs/Api/EnvironmentVariablesApi.md#getprojectsenvironmentsvariables) | **GET** /projects/{projectId}/environments/{environmentId}/variables/{variableId} | Get an environment variable
*EnvironmentVariablesApi* | [**listProjectsEnvironmentsVariables**](docs/Api/EnvironmentVariablesApi.md#listprojectsenvironmentsvariables) | **GET** /projects/{projectId}/environments/{environmentId}/variables | Get list of environment variables
*EnvironmentVariablesApi* | [**updateProjectsEnvironmentsVariables**](docs/Api/EnvironmentVariablesApi.md#updateprojectsenvironmentsvariables) | **PATCH** /projects/{projectId}/environments/{environmentId}/variables/{variableId} | Update an environment variable
*GrantsApi* | [**listUserExtendedAccess**](docs/Api/GrantsApi.md#listuserextendedaccess) | **GET** /users/{user_id}/extended-access | List extended access of a user
*InvoicesApi* | [**getOrgInvoice**](docs/Api/InvoicesApi.md#getorginvoice) | **GET** /organizations/{organization_id}/invoices/{invoice_id} | Get invoice
*InvoicesApi* | [**listOrgInvoices**](docs/Api/InvoicesApi.md#listorginvoices) | **GET** /organizations/{organization_id}/invoices | List invoices
*MFAApi* | [**confirmTotpEnrollment**](docs/Api/MFAApi.md#confirmtotpenrollment) | **POST** /users/{user_id}/totp | Confirm TOTP enrollment
*MFAApi* | [**disableOrgMfaEnforcement**](docs/Api/MFAApi.md#disableorgmfaenforcement) | **POST** /organizations/{organization_id}/mfa-enforcement/disable | Disable organization MFA enforcement
*MFAApi* | [**enableOrgMfaEnforcement**](docs/Api/MFAApi.md#enableorgmfaenforcement) | **POST** /organizations/{organization_id}/mfa-enforcement/enable | Enable organization MFA enforcement
*MFAApi* | [**getOrgMfaEnforcement**](docs/Api/MFAApi.md#getorgmfaenforcement) | **GET** /organizations/{organization_id}/mfa-enforcement | Get organization MFA settings
*MFAApi* | [**getTotpEnrollment**](docs/Api/MFAApi.md#gettotpenrollment) | **GET** /users/{user_id}/totp | Get information about TOTP enrollment
*MFAApi* | [**recreateRecoveryCodes**](docs/Api/MFAApi.md#recreaterecoverycodes) | **POST** /users/{user_id}/codes | Re-create recovery codes
*MFAApi* | [**sendOrgMfaReminders**](docs/Api/MFAApi.md#sendorgmfareminders) | **POST** /organizations/{organization_id}/mfa/remind | Send MFA reminders to organization members
*MFAApi* | [**withdrawTotpEnrollment**](docs/Api/MFAApi.md#withdrawtotpenrollment) | **DELETE** /users/{user_id}/totp | Withdraw TOTP enrollment
*OrdersApi* | [**createAuthorizationCredentials**](docs/Api/OrdersApi.md#createauthorizationcredentials) | **POST** /organizations/{organization_id}/orders/{order_id}/authorize | Create confirmation credentials for for 3D-Secure
*OrdersApi* | [**downloadInvoice**](docs/Api/OrdersApi.md#downloadinvoice) | **GET** /orders/download | Download an invoice.
*OrdersApi* | [**getOrgOrder**](docs/Api/OrdersApi.md#getorgorder) | **GET** /organizations/{organization_id}/orders/{order_id} | Get order
*OrdersApi* | [**listOrgOrders**](docs/Api/OrdersApi.md#listorgorders) | **GET** /organizations/{organization_id}/orders | List orders
*OrganizationInvitationsApi* | [**cancelOrgInvite**](docs/Api/OrganizationInvitationsApi.md#cancelorginvite) | **DELETE** /organizations/{organization_id}/invitations/{invitation_id} | Cancel a pending invitation to an organization
*OrganizationInvitationsApi* | [**createOrgInvite**](docs/Api/OrganizationInvitationsApi.md#createorginvite) | **POST** /organizations/{organization_id}/invitations | Invite user to an organization by email
*OrganizationInvitationsApi* | [**listOrgInvites**](docs/Api/OrganizationInvitationsApi.md#listorginvites) | **GET** /organizations/{organization_id}/invitations | List invitations to an organization
*OrganizationMembersApi* | [**createOrgMember**](docs/Api/OrganizationMembersApi.md#createorgmember) | **POST** /organizations/{organization_id}/members | Create organization member
*OrganizationMembersApi* | [**deleteOrgMember**](docs/Api/OrganizationMembersApi.md#deleteorgmember) | **DELETE** /organizations/{organization_id}/members/{user_id} | Delete organization member
*OrganizationMembersApi* | [**getOrgMember**](docs/Api/OrganizationMembersApi.md#getorgmember) | **GET** /organizations/{organization_id}/members/{user_id} | Get organization member
*OrganizationMembersApi* | [**listOrgMembers**](docs/Api/OrganizationMembersApi.md#listorgmembers) | **GET** /organizations/{organization_id}/members | List organization members
*OrganizationMembersApi* | [**updateOrgMember**](docs/Api/OrganizationMembersApi.md#updateorgmember) | **PATCH** /organizations/{organization_id}/members/{user_id} | Update organization member
*OrganizationProjectsApi* | [**getOrgProject**](docs/Api/OrganizationProjectsApi.md#getorgproject) | **GET** /organizations/{organization_id}/projects/{project_id} | Get project
*OrganizationProjectsApi* | [**listOrgProjects**](docs/Api/OrganizationProjectsApi.md#listorgprojects) | **GET** /organizations/{organization_id}/projects | List projects
*OrganizationsApi* | [**createOrg**](docs/Api/OrganizationsApi.md#createorg) | **POST** /organizations | Create organization
*OrganizationsApi* | [**deleteOrg**](docs/Api/OrganizationsApi.md#deleteorg) | **DELETE** /organizations/{organization_id} | Delete organization
*OrganizationsApi* | [**getOrg**](docs/Api/OrganizationsApi.md#getorg) | **GET** /organizations/{organization_id} | Get organization
*OrganizationsApi* | [**listOrgs**](docs/Api/OrganizationsApi.md#listorgs) | **GET** /organizations | List organizations
*OrganizationsApi* | [**listUserOrgs**](docs/Api/OrganizationsApi.md#listuserorgs) | **GET** /users/{user_id}/organizations | User organizations
*OrganizationsApi* | [**updateOrg**](docs/Api/OrganizationsApi.md#updateorg) | **PATCH** /organizations/{organization_id} | Update organization
*PhoneNumberApi* | [**confirmPhoneNumber**](docs/Api/PhoneNumberApi.md#confirmphonenumber) | **POST** /users/{user_id}/phonenumber/{sid} | Confirm phone number
*PhoneNumberApi* | [**verifyPhoneNumber**](docs/Api/PhoneNumberApi.md#verifyphonenumber) | **POST** /users/{user_id}/phonenumber | Verify phone number
*PlansApi* | [**listPlans**](docs/Api/PlansApi.md#listplans) | **GET** /plans | List available plans
*ProfilesApi* | [**getOrgAddress**](docs/Api/ProfilesApi.md#getorgaddress) | **GET** /organizations/{organization_id}/address | Get address
*ProfilesApi* | [**getOrgProfile**](docs/Api/ProfilesApi.md#getorgprofile) | **GET** /organizations/{organization_id}/profile | Get profile
*ProfilesApi* | [**updateOrgAddress**](docs/Api/ProfilesApi.md#updateorgaddress) | **PATCH** /organizations/{organization_id}/address | Update address
*ProfilesApi* | [**updateOrgProfile**](docs/Api/ProfilesApi.md#updateorgprofile) | **PATCH** /organizations/{organization_id}/profile | Update profile
*ProjectApi* | [**actionProjectsClearBuildCache**](docs/Api/ProjectApi.md#actionprojectsclearbuildcache) | **POST** /projects/{projectId}/clear_build_cache | Clear project build cache
*ProjectApi* | [**deleteProjects**](docs/Api/ProjectApi.md#deleteprojects) | **DELETE** /projects/{projectId} | Delete a project
*ProjectApi* | [**getProjects**](docs/Api/ProjectApi.md#getprojects) | **GET** /projects/{projectId} | Get a project
*ProjectApi* | [**getProjectsCapabilities**](docs/Api/ProjectApi.md#getprojectscapabilities) | **GET** /projects/{projectId}/capabilities | Get a project&#39;s capabilities
*ProjectApi* | [**updateProjects**](docs/Api/ProjectApi.md#updateprojects) | **PATCH** /projects/{projectId} | Update a project
*ProjectActivityApi* | [**actionProjectsActivitiesCancel**](docs/Api/ProjectActivityApi.md#actionprojectsactivitiescancel) | **POST** /projects/{projectId}/activities/{activityId}/cancel | Cancel a project activity
*ProjectActivityApi* | [**getProjectsActivities**](docs/Api/ProjectActivityApi.md#getprojectsactivities) | **GET** /projects/{projectId}/activities/{activityId} | Get a project activity log entry
*ProjectActivityApi* | [**listProjectsActivities**](docs/Api/ProjectActivityApi.md#listprojectsactivities) | **GET** /projects/{projectId}/activities | Get project activity log
*ProjectInvitationsApi* | [**cancelProjectInvite**](docs/Api/ProjectInvitationsApi.md#cancelprojectinvite) | **DELETE** /projects/{project_id}/invitations/{invitation_id} | Cancel a pending invitation to a project
*ProjectInvitationsApi* | [**createProjectInvite**](docs/Api/ProjectInvitationsApi.md#createprojectinvite) | **POST** /projects/{project_id}/invitations | Invite user to a project by email
*ProjectInvitationsApi* | [**listProjectInvites**](docs/Api/ProjectInvitationsApi.md#listprojectinvites) | **GET** /projects/{project_id}/invitations | List invitations to a project
*ProjectSettingsApi* | [**getProjectsSettings**](docs/Api/ProjectSettingsApi.md#getprojectssettings) | **GET** /projects/{projectId}/settings | Get list of project settings
*ProjectSettingsApi* | [**updateProjectsSettings**](docs/Api/ProjectSettingsApi.md#updateprojectssettings) | **PATCH** /projects/{projectId}/settings | Update a project setting
*ProjectVariablesApi* | [**createProjectsVariables**](docs/Api/ProjectVariablesApi.md#createprojectsvariables) | **POST** /projects/{projectId}/variables | Add a project variable
*ProjectVariablesApi* | [**deleteProjectsVariables**](docs/Api/ProjectVariablesApi.md#deleteprojectsvariables) | **DELETE** /projects/{projectId}/variables/{projectVariableId} | Delete a project variable
*ProjectVariablesApi* | [**getProjectsVariables**](docs/Api/ProjectVariablesApi.md#getprojectsvariables) | **GET** /projects/{projectId}/variables/{projectVariableId} | Get a project variable
*ProjectVariablesApi* | [**listProjectsVariables**](docs/Api/ProjectVariablesApi.md#listprojectsvariables) | **GET** /projects/{projectId}/variables | Get list of project variables
*ProjectVariablesApi* | [**updateProjectsVariables**](docs/Api/ProjectVariablesApi.md#updateprojectsvariables) | **PATCH** /projects/{projectId}/variables/{projectVariableId} | Update a project variable
*RecordsApi* | [**listOrgPlanRecords**](docs/Api/RecordsApi.md#listorgplanrecords) | **GET** /organizations/{organization_id}/records/plan | List plan records
*RecordsApi* | [**listOrgUsageRecords**](docs/Api/RecordsApi.md#listorgusagerecords) | **GET** /organizations/{organization_id}/records/usage | List usage records
*ReferencesApi* | [**listReferencedOrgs**](docs/Api/ReferencesApi.md#listreferencedorgs) | **GET** /ref/organizations | List referenced organizations
*ReferencesApi* | [**listReferencedProjects**](docs/Api/ReferencesApi.md#listreferencedprojects) | **GET** /ref/projects | List referenced projects
*ReferencesApi* | [**listReferencedRegions**](docs/Api/ReferencesApi.md#listreferencedregions) | **GET** /ref/regions | List referenced regions
*ReferencesApi* | [**listReferencedTeams**](docs/Api/ReferencesApi.md#listreferencedteams) | **GET** /ref/teams | List referenced teams
*ReferencesApi* | [**listReferencedUsers**](docs/Api/ReferencesApi.md#listreferencedusers) | **GET** /ref/users | List referenced users
*RegionsApi* | [**getRegion**](docs/Api/RegionsApi.md#getregion) | **GET** /regions/{region_id} | Get region
*RegionsApi* | [**listRegions**](docs/Api/RegionsApi.md#listregions) | **GET** /regions | List regions
*RepositoryApi* | [**getProjectsGitBlobs**](docs/Api/RepositoryApi.md#getprojectsgitblobs) | **GET** /projects/{projectId}/git/blobs/{repositoryBlobId} | Get a blob object
*RepositoryApi* | [**getProjectsGitCommits**](docs/Api/RepositoryApi.md#getprojectsgitcommits) | **GET** /projects/{projectId}/git/commits/{repositoryCommitId} | Get a commit object
*RepositoryApi* | [**getProjectsGitRefs**](docs/Api/RepositoryApi.md#getprojectsgitrefs) | **GET** /projects/{projectId}/git/refs/{repositoryRefId} | Get a ref object
*RepositoryApi* | [**getProjectsGitTrees**](docs/Api/RepositoryApi.md#getprojectsgittrees) | **GET** /projects/{projectId}/git/trees/{repositoryTreeId} | Get a tree object
*RepositoryApi* | [**listProjectsGitRefs**](docs/Api/RepositoryApi.md#listprojectsgitrefs) | **GET** /projects/{projectId}/git/refs | Get list of repository refs
*RoutingApi* | [**createProjectsEnvironmentsRoutes**](docs/Api/RoutingApi.md#createprojectsenvironmentsroutes) | **POST** /projects/{projectId}/environments/{environmentId}/routes | Create a new route
*RoutingApi* | [**deleteProjectsEnvironmentsRoutes**](docs/Api/RoutingApi.md#deleteprojectsenvironmentsroutes) | **DELETE** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Delete a route
*RoutingApi* | [**getProjectsEnvironmentsRoutes**](docs/Api/RoutingApi.md#getprojectsenvironmentsroutes) | **GET** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Get a route&#39;s info
*RoutingApi* | [**listProjectsEnvironmentsRoutes**](docs/Api/RoutingApi.md#listprojectsenvironmentsroutes) | **GET** /projects/{projectId}/environments/{environmentId}/routes | Get list of routes
*RoutingApi* | [**updateProjectsEnvironmentsRoutes**](docs/Api/RoutingApi.md#updateprojectsenvironmentsroutes) | **PATCH** /projects/{projectId}/environments/{environmentId}/routes/{routeId} | Update a route
*RuntimeOperationsApi* | [**runOperation**](docs/Api/RuntimeOperationsApi.md#runoperation) | **POST** /projects/{projectId}/environments/{environmentId}/deployments/{deploymentId}/operations | Execute a runtime operation
*SSHKeysApi* | [**createSshKey**](docs/Api/SSHKeysApi.md#createsshkey) | **POST** /ssh_keys | Add a new public SSH key to a user
*SSHKeysApi* | [**deleteSshKey**](docs/Api/SSHKeysApi.md#deletesshkey) | **DELETE** /ssh_keys/{key_id} | Delete an SSH key
*SSHKeysApi* | [**getSshKey**](docs/Api/SSHKeysApi.md#getsshkey) | **GET** /ssh_keys/{key_id} | Get an SSH key
*SourceOperationsApi* | [**listProjectsEnvironmentsSourceOperations**](docs/Api/SourceOperationsApi.md#listprojectsenvironmentssourceoperations) | **GET** /projects/{projectId}/environments/{environmentId}/source-operations | List source operations
*SourceOperationsApi* | [**runSourceOperation**](docs/Api/SourceOperationsApi.md#runsourceoperation) | **POST** /projects/{projectId}/environments/{environmentId}/source-operation | Trigger a source operation
*SubscriptionsApi* | [**canCreateNewOrgSubscription**](docs/Api/SubscriptionsApi.md#cancreateneworgsubscription) | **GET** /organizations/{organization_id}/subscriptions/can-create | Checks if the user is able to create a new project.
*SubscriptionsApi* | [**createOrgSubscription**](docs/Api/SubscriptionsApi.md#createorgsubscription) | **POST** /organizations/{organization_id}/subscriptions | Create subscription
*SubscriptionsApi* | [**deleteOrgSubscription**](docs/Api/SubscriptionsApi.md#deleteorgsubscription) | **DELETE** /organizations/{organization_id}/subscriptions/{subscription_id} | Delete subscription
*SubscriptionsApi* | [**estimateNewOrgSubscription**](docs/Api/SubscriptionsApi.md#estimateneworgsubscription) | **GET** /organizations/{organization_id}/subscriptions/estimate | Estimate the price of a new subscription
*SubscriptionsApi* | [**estimateOrgSubscription**](docs/Api/SubscriptionsApi.md#estimateorgsubscription) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/estimate | Estimate the price of a subscription
*SubscriptionsApi* | [**getOrgSubscription**](docs/Api/SubscriptionsApi.md#getorgsubscription) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id} | Get subscription
*SubscriptionsApi* | [**getOrgSubscriptionCurrentUsage**](docs/Api/SubscriptionsApi.md#getorgsubscriptioncurrentusage) | **GET** /organizations/{organization_id}/subscriptions/{subscription_id}/current_usage | Get current usage for a subscription
*SubscriptionsApi* | [**listOrgSubscriptions**](docs/Api/SubscriptionsApi.md#listorgsubscriptions) | **GET** /organizations/{organization_id}/subscriptions | List subscriptions
*SubscriptionsApi* | [**updateOrgSubscription**](docs/Api/SubscriptionsApi.md#updateorgsubscription) | **PATCH** /organizations/{organization_id}/subscriptions/{subscription_id} | Update subscription
*SupportApi* | [**createTicket**](docs/Api/SupportApi.md#createticket) | **POST** /tickets | Create a new support ticket
*SupportApi* | [**listTicketCategories**](docs/Api/SupportApi.md#listticketcategories) | **GET** /tickets/category | List support ticket categories
*SupportApi* | [**listTicketPriorities**](docs/Api/SupportApi.md#listticketpriorities) | **GET** /tickets/priority | List support ticket priorities
*SupportApi* | [**updateTicket**](docs/Api/SupportApi.md#updateticket) | **PATCH** /tickets/{ticket_id} | Update a ticket
*SystemInformationApi* | [**actionProjectsSystemRestart**](docs/Api/SystemInformationApi.md#actionprojectssystemrestart) | **POST** /projects/{projectId}/system/restart | Restart the Git server
*SystemInformationApi* | [**getProjectsSystem**](docs/Api/SystemInformationApi.md#getprojectssystem) | **GET** /projects/{projectId}/system | Get information about the Git server.
*TeamAccessApi* | [**getProjectTeamAccess**](docs/Api/TeamAccessApi.md#getprojectteamaccess) | **GET** /projects/{project_id}/team-access/{team_id} | Get team access for a project
*TeamAccessApi* | [**getTeamProjectAccess**](docs/Api/TeamAccessApi.md#getteamprojectaccess) | **GET** /teams/{team_id}/project-access/{project_id} | Get project access for a team
*TeamAccessApi* | [**grantProjectTeamAccess**](docs/Api/TeamAccessApi.md#grantprojectteamaccess) | **POST** /projects/{project_id}/team-access | Grant team access to a project
*TeamAccessApi* | [**grantTeamProjectAccess**](docs/Api/TeamAccessApi.md#grantteamprojectaccess) | **POST** /teams/{team_id}/project-access | Grant project access to a team
*TeamAccessApi* | [**listProjectTeamAccess**](docs/Api/TeamAccessApi.md#listprojectteamaccess) | **GET** /projects/{project_id}/team-access | List team access for a project
*TeamAccessApi* | [**listTeamProjectAccess**](docs/Api/TeamAccessApi.md#listteamprojectaccess) | **GET** /teams/{team_id}/project-access | List project access for a team
*TeamAccessApi* | [**removeProjectTeamAccess**](docs/Api/TeamAccessApi.md#removeprojectteamaccess) | **DELETE** /projects/{project_id}/team-access/{team_id} | Remove team access for a project
*TeamAccessApi* | [**removeTeamProjectAccess**](docs/Api/TeamAccessApi.md#removeteamprojectaccess) | **DELETE** /teams/{team_id}/project-access/{project_id} | Remove project access for a team
*TeamsApi* | [**createTeam**](docs/Api/TeamsApi.md#createteam) | **POST** /teams | Create team
*TeamsApi* | [**createTeamMember**](docs/Api/TeamsApi.md#createteammember) | **POST** /teams/{team_id}/members | Create team member
*TeamsApi* | [**deleteTeam**](docs/Api/TeamsApi.md#deleteteam) | **DELETE** /teams/{team_id} | Delete team
*TeamsApi* | [**deleteTeamMember**](docs/Api/TeamsApi.md#deleteteammember) | **DELETE** /teams/{team_id}/members/{user_id} | Delete team member
*TeamsApi* | [**getTeam**](docs/Api/TeamsApi.md#getteam) | **GET** /teams/{team_id} | Get team
*TeamsApi* | [**getTeamMember**](docs/Api/TeamsApi.md#getteammember) | **GET** /teams/{team_id}/members/{user_id} | Get team member
*TeamsApi* | [**listTeamMembers**](docs/Api/TeamsApi.md#listteammembers) | **GET** /teams/{team_id}/members | List team members
*TeamsApi* | [**listTeams**](docs/Api/TeamsApi.md#listteams) | **GET** /teams | List teams
*TeamsApi* | [**listUserTeams**](docs/Api/TeamsApi.md#listuserteams) | **GET** /users/{user_id}/teams | User teams
*TeamsApi* | [**updateTeam**](docs/Api/TeamsApi.md#updateteam) | **PATCH** /teams/{team_id} | Update team
*ThirdPartyIntegrationsApi* | [**createProjectsIntegrations**](docs/Api/ThirdPartyIntegrationsApi.md#createprojectsintegrations) | **POST** /projects/{projectId}/integrations | Integrate project with a third-party service
*ThirdPartyIntegrationsApi* | [**deleteProjectsIntegrations**](docs/Api/ThirdPartyIntegrationsApi.md#deleteprojectsintegrations) | **DELETE** /projects/{projectId}/integrations/{integrationId} | Delete an existing third-party integration
*ThirdPartyIntegrationsApi* | [**getProjectsIntegrations**](docs/Api/ThirdPartyIntegrationsApi.md#getprojectsintegrations) | **GET** /projects/{projectId}/integrations/{integrationId} | Get information about an existing third-party integration
*ThirdPartyIntegrationsApi* | [**listProjectsIntegrations**](docs/Api/ThirdPartyIntegrationsApi.md#listprojectsintegrations) | **GET** /projects/{projectId}/integrations | Get list of existing integrations for a project
*ThirdPartyIntegrationsApi* | [**updateProjectsIntegrations**](docs/Api/ThirdPartyIntegrationsApi.md#updateprojectsintegrations) | **PATCH** /projects/{projectId}/integrations/{integrationId} | Update an existing third-party integration
*UserAccessApi* | [**getProjectUserAccess**](docs/Api/UserAccessApi.md#getprojectuseraccess) | **GET** /projects/{project_id}/user-access/{user_id} | Get user access for a project
*UserAccessApi* | [**getUserProjectAccess**](docs/Api/UserAccessApi.md#getuserprojectaccess) | **GET** /users/{user_id}/project-access/{project_id} | Get project access for a user
*UserAccessApi* | [**grantProjectUserAccess**](docs/Api/UserAccessApi.md#grantprojectuseraccess) | **POST** /projects/{project_id}/user-access | Grant user access to a project
*UserAccessApi* | [**grantUserProjectAccess**](docs/Api/UserAccessApi.md#grantuserprojectaccess) | **POST** /users/{user_id}/project-access | Grant project access to a user
*UserAccessApi* | [**listProjectUserAccess**](docs/Api/UserAccessApi.md#listprojectuseraccess) | **GET** /projects/{project_id}/user-access | List user access for a project
*UserAccessApi* | [**listUserProjectAccess**](docs/Api/UserAccessApi.md#listuserprojectaccess) | **GET** /users/{user_id}/project-access | List project access for a user
*UserAccessApi* | [**removeProjectUserAccess**](docs/Api/UserAccessApi.md#removeprojectuseraccess) | **DELETE** /projects/{project_id}/user-access/{user_id} | Remove user access for a project
*UserAccessApi* | [**removeUserProjectAccess**](docs/Api/UserAccessApi.md#removeuserprojectaccess) | **DELETE** /users/{user_id}/project-access/{project_id} | Remove project access for a user
*UserAccessApi* | [**updateProjectUserAccess**](docs/Api/UserAccessApi.md#updateprojectuseraccess) | **PATCH** /projects/{project_id}/user-access/{user_id} | Update user access for a project
*UserAccessApi* | [**updateUserProjectAccess**](docs/Api/UserAccessApi.md#updateuserprojectaccess) | **PATCH** /users/{user_id}/project-access/{project_id} | Update project access for a user
*UserProfilesApi* | [**createProfilePicture**](docs/Api/UserProfilesApi.md#createprofilepicture) | **POST** /profile/{uuid}/picture | Create a user profile picture
*UserProfilesApi* | [**deleteProfilePicture**](docs/Api/UserProfilesApi.md#deleteprofilepicture) | **DELETE** /profile/{uuid}/picture | Delete a user profile picture
*UserProfilesApi* | [**getAddress**](docs/Api/UserProfilesApi.md#getaddress) | **GET** /profiles/{userId}/address | Get a user address
*UserProfilesApi* | [**getProfile**](docs/Api/UserProfilesApi.md#getprofile) | **GET** /profiles/{userId} | Get a single user profile
*UserProfilesApi* | [**listProfiles**](docs/Api/UserProfilesApi.md#listprofiles) | **GET** /profiles | List user profiles
*UserProfilesApi* | [**updateAddress**](docs/Api/UserProfilesApi.md#updateaddress) | **PATCH** /profiles/{userId}/address | Update a user address
*UserProfilesApi* | [**updateProfile**](docs/Api/UserProfilesApi.md#updateprofile) | **PATCH** /profiles/{userId} | Update a user profile
*UsersApi* | [**getCurrentUser**](docs/Api/UsersApi.md#getcurrentuser) | **GET** /users/me | Get the current user
*UsersApi* | [**getCurrentUserDeprecated**](docs/Api/UsersApi.md#getcurrentuserdeprecated) | **GET** /me | Get current logged-in user info
*UsersApi* | [**getCurrentUserVerificationStatus**](docs/Api/UsersApi.md#getcurrentuserverificationstatus) | **POST** /me/phone | Check if phone verification is required
*UsersApi* | [**getCurrentUserVerificationStatusFull**](docs/Api/UsersApi.md#getcurrentuserverificationstatusfull) | **POST** /me/verification | Check if verification is required
*UsersApi* | [**getUser**](docs/Api/UsersApi.md#getuser) | **GET** /users/{user_id} | Get a user
*UsersApi* | [**getUserByEmailAddress**](docs/Api/UsersApi.md#getuserbyemailaddress) | **GET** /users/email&#x3D;{email} | Get a user by email
*UsersApi* | [**getUserByUsername**](docs/Api/UsersApi.md#getuserbyusername) | **GET** /users/username&#x3D;{username} | Get a user by username
*UsersApi* | [**resetEmailAddress**](docs/Api/UsersApi.md#resetemailaddress) | **POST** /users/{user_id}/emailaddress | Reset email address
*UsersApi* | [**resetPassword**](docs/Api/UsersApi.md#resetpassword) | **POST** /users/{user_id}/resetpassword | Reset user password
*UsersApi* | [**updateUser**](docs/Api/UsersApi.md#updateuser) | **PATCH** /users/{user_id} | Update a user
*VouchersApi* | [**applyOrgVoucher**](docs/Api/VouchersApi.md#applyorgvoucher) | **POST** /organizations/{organization_id}/vouchers/apply | Apply voucher
*VouchersApi* | [**listOrgVouchers**](docs/Api/VouchersApi.md#listorgvouchers) | **GET** /organizations/{organization_id}/vouchers | List vouchers

## Models

- [AListOfFilesToAddToTheRepositoryDuringInitializationInner](docs/Model/AListOfFilesToAddToTheRepositoryDuringInitializationInner.md)
- [APIToken](docs/Model/APIToken.md)
- [AcceptedResponse](docs/Model/AcceptedResponse.md)
- [AccessControlDefinitionForThisEnviromentInner](docs/Model/AccessControlDefinitionForThisEnviromentInner.md)
- [Activity](docs/Model/Activity.md)
- [Address](docs/Model/Address.md)
- [AddressGrantsInner](docs/Model/AddressGrantsInner.md)
- [AddressMetadata](docs/Model/AddressMetadata.md)
- [AddressMetadataMetadata](docs/Model/AddressMetadataMetadata.md)
- [Alert](docs/Model/Alert.md)
- [ApplyOrgVoucherRequest](docs/Model/ApplyOrgVoucherRequest.md)
- [ArrayFilter](docs/Model/ArrayFilter.md)
- [Backup](docs/Model/Backup.md)
- [BitbucketIntegration](docs/Model/BitbucketIntegration.md)
- [BitbucketIntegrationConfigurations](docs/Model/BitbucketIntegrationConfigurations.md)
- [BitbucketIntegrationCreateInput](docs/Model/BitbucketIntegrationCreateInput.md)
- [BitbucketIntegrationPatch](docs/Model/BitbucketIntegrationPatch.md)
- [BitbucketServerIntegration](docs/Model/BitbucketServerIntegration.md)
- [BitbucketServerIntegrationConfigurations](docs/Model/BitbucketServerIntegrationConfigurations.md)
- [BitbucketServerIntegrationCreateInput](docs/Model/BitbucketServerIntegrationCreateInput.md)
- [BitbucketServerIntegrationPatch](docs/Model/BitbucketServerIntegrationPatch.md)
- [BlackfireEnvironmentsCredentialsValue](docs/Model/BlackfireEnvironmentsCredentialsValue.md)
- [BlackfireIntegration](docs/Model/BlackfireIntegration.md)
- [BlackfireIntegrationConfigurations](docs/Model/BlackfireIntegrationConfigurations.md)
- [BlackfireIntegrationCreateInput](docs/Model/BlackfireIntegrationCreateInput.md)
- [BlackfireIntegrationPatch](docs/Model/BlackfireIntegrationPatch.md)
- [Blob](docs/Model/Blob.md)
- [BuildResources](docs/Model/BuildResources.md)
- [BuildResources1](docs/Model/BuildResources1.md)
- [BuildResources2](docs/Model/BuildResources2.md)
- [CacheConfiguration](docs/Model/CacheConfiguration.md)
- [CacheConfiguration1](docs/Model/CacheConfiguration1.md)
- [CanCreateNewOrgSubscription200Response](docs/Model/CanCreateNewOrgSubscription200Response.md)
- [CanCreateNewOrgSubscription200ResponseRequiredAction](docs/Model/CanCreateNewOrgSubscription200ResponseRequiredAction.md)
- [Certificate](docs/Model/Certificate.md)
- [CertificateCreateInput](docs/Model/CertificateCreateInput.md)
- [CertificatePatch](docs/Model/CertificatePatch.md)
- [CommandsToManageTheApplicationSLifecycle](docs/Model/CommandsToManageTheApplicationSLifecycle.md)
- [Commit](docs/Model/Commit.md)
- [Components](docs/Model/Components.md)
- [Config](docs/Model/Config.md)
- [ConfigurationAboutTheTrafficRoutedToThisVersion](docs/Model/ConfigurationAboutTheTrafficRoutedToThisVersion.md)
- [ConfigurationAboutTheTrafficRoutedToThisVersion1](docs/Model/ConfigurationAboutTheTrafficRoutedToThisVersion1.md)
- [ConfigurationForAccessingThisApplicationViaHTTP](docs/Model/ConfigurationForAccessingThisApplicationViaHTTP.md)
- [ConfigurationForPreFlightChecks](docs/Model/ConfigurationForPreFlightChecks.md)
- [ConfigurationForSupportingRequestBuffering](docs/Model/ConfigurationForSupportingRequestBuffering.md)
- [ConfigurationOfAWorkerContainerInstance](docs/Model/ConfigurationOfAWorkerContainerInstance.md)
- [ConfigurationOnHowTheWebServerCommunicatesWithTheApplication](docs/Model/ConfigurationOnHowTheWebServerCommunicatesWithTheApplication.md)
- [ConfigurationRelatedToTheSourceCodeOfTheApplication](docs/Model/ConfigurationRelatedToTheSourceCodeOfTheApplication.md)
- [ConfirmPhoneNumberRequest](docs/Model/ConfirmPhoneNumberRequest.md)
- [ConfirmTotpEnrollment200Response](docs/Model/ConfirmTotpEnrollment200Response.md)
- [ConfirmTotpEnrollmentRequest](docs/Model/ConfirmTotpEnrollmentRequest.md)
- [Connection](docs/Model/Connection.md)
- [ContainerProfilesValueValue](docs/Model/ContainerProfilesValueValue.md)
- [CreateApiTokenRequest](docs/Model/CreateApiTokenRequest.md)
- [CreateAuthorizationCredentials200Response](docs/Model/CreateAuthorizationCredentials200Response.md)
- [CreateAuthorizationCredentials200ResponseRedirectToUrl](docs/Model/CreateAuthorizationCredentials200ResponseRedirectToUrl.md)
- [CreateOrgInviteRequest](docs/Model/CreateOrgInviteRequest.md)
- [CreateOrgMemberRequest](docs/Model/CreateOrgMemberRequest.md)
- [CreateOrgRequest](docs/Model/CreateOrgRequest.md)
- [CreateOrgSubscriptionRequest](docs/Model/CreateOrgSubscriptionRequest.md)
- [CreateProfilePicture200Response](docs/Model/CreateProfilePicture200Response.md)
- [CreateProjectInviteRequest](docs/Model/CreateProjectInviteRequest.md)
- [CreateProjectInviteRequestEnvironmentsInner](docs/Model/CreateProjectInviteRequestEnvironmentsInner.md)
- [CreateProjectInviteRequestPermissionsInner](docs/Model/CreateProjectInviteRequestPermissionsInner.md)
- [CreateSshKeyRequest](docs/Model/CreateSshKeyRequest.md)
- [CreateTeamMemberRequest](docs/Model/CreateTeamMemberRequest.md)
- [CreateTeamRequest](docs/Model/CreateTeamRequest.md)
- [CreateTicketRequest](docs/Model/CreateTicketRequest.md)
- [CreateTicketRequestAttachmentsInner](docs/Model/CreateTicketRequestAttachmentsInner.md)
- [CreateUsageAlertRequest](docs/Model/CreateUsageAlertRequest.md)
- [CreateUsageAlertRequestConfig](docs/Model/CreateUsageAlertRequestConfig.md)
- [CurrentUser](docs/Model/CurrentUser.md)
- [CurrentUserCurrentTrialInner](docs/Model/CurrentUserCurrentTrialInner.md)
- [CurrentUserProjectsInner](docs/Model/CurrentUserProjectsInner.md)
- [CustomDomains](docs/Model/CustomDomains.md)
- [DataRetention](docs/Model/DataRetention.md)
- [DataRetentionConfigurationValue](docs/Model/DataRetentionConfigurationValue.md)
- [DataRetentionConfigurationValue1](docs/Model/DataRetentionConfigurationValue1.md)
- [DateTimeFilter](docs/Model/DateTimeFilter.md)
- [DedicatedDeploymentTarget](docs/Model/DedicatedDeploymentTarget.md)
- [DedicatedDeploymentTargetCreateInput](docs/Model/DedicatedDeploymentTargetCreateInput.md)
- [DedicatedDeploymentTargetPatch](docs/Model/DedicatedDeploymentTargetPatch.md)
- [DefaultConfig](docs/Model/DefaultConfig.md)
- [DefaultConfig1](docs/Model/DefaultConfig1.md)
- [Deployment](docs/Model/Deployment.md)
- [DeploymentTarget](docs/Model/DeploymentTarget.md)
- [DeploymentTargetCreateInput](docs/Model/DeploymentTargetCreateInput.md)
- [DeploymentTargetPatch](docs/Model/DeploymentTargetPatch.md)
- [Domain](docs/Model/Domain.md)
- [DomainCreateInput](docs/Model/DomainCreateInput.md)
- [DomainPatch](docs/Model/DomainPatch.md)
- [EmailIntegration](docs/Model/EmailIntegration.md)
- [EmailIntegrationCreateInput](docs/Model/EmailIntegrationCreateInput.md)
- [EmailIntegrationPatch](docs/Model/EmailIntegrationPatch.md)
- [EnterpriseDeploymentTarget](docs/Model/EnterpriseDeploymentTarget.md)
- [EnterpriseDeploymentTargetCreateInput](docs/Model/EnterpriseDeploymentTargetCreateInput.md)
- [EnterpriseDeploymentTargetPatch](docs/Model/EnterpriseDeploymentTargetPatch.md)
- [Environment](docs/Model/Environment.md)
- [EnvironmentActivateInput](docs/Model/EnvironmentActivateInput.md)
- [EnvironmentBackupInput](docs/Model/EnvironmentBackupInput.md)
- [EnvironmentBranchInput](docs/Model/EnvironmentBranchInput.md)
- [EnvironmentInfo](docs/Model/EnvironmentInfo.md)
- [EnvironmentInitializeInput](docs/Model/EnvironmentInitializeInput.md)
- [EnvironmentMergeInput](docs/Model/EnvironmentMergeInput.md)
- [EnvironmentOperationInput](docs/Model/EnvironmentOperationInput.md)
- [EnvironmentPatch](docs/Model/EnvironmentPatch.md)
- [EnvironmentRestoreInput](docs/Model/EnvironmentRestoreInput.md)
- [EnvironmentSourceOperation](docs/Model/EnvironmentSourceOperation.md)
- [EnvironmentSourceOperationInput](docs/Model/EnvironmentSourceOperationInput.md)
- [EnvironmentSynchronizeInput](docs/Model/EnvironmentSynchronizeInput.md)
- [EnvironmentType](docs/Model/EnvironmentType.md)
- [EnvironmentVariable](docs/Model/EnvironmentVariable.md)
- [EnvironmentVariableCreateInput](docs/Model/EnvironmentVariableCreateInput.md)
- [EnvironmentVariablePatch](docs/Model/EnvironmentVariablePatch.md)
- [Error](docs/Model/Error.md)
- [EstimationObject](docs/Model/EstimationObject.md)
- [FastlyCDNIntegrationConfigurations](docs/Model/FastlyCDNIntegrationConfigurations.md)
- [FastlyIntegration](docs/Model/FastlyIntegration.md)
- [FastlyIntegrationCreateInput](docs/Model/FastlyIntegrationCreateInput.md)
- [FastlyIntegrationPatch](docs/Model/FastlyIntegrationPatch.md)
- [FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue](docs/Model/FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue.md)
- [Firewall](docs/Model/Firewall.md)
- [FoundationDeploymentTarget](docs/Model/FoundationDeploymentTarget.md)
- [FoundationDeploymentTargetCreateInput](docs/Model/FoundationDeploymentTargetCreateInput.md)
- [FoundationDeploymentTargetPatch](docs/Model/FoundationDeploymentTargetPatch.md)
- [GetAddress200Response](docs/Model/GetAddress200Response.md)
- [GetCurrentUserVerificationStatus200Response](docs/Model/GetCurrentUserVerificationStatus200Response.md)
- [GetCurrentUserVerificationStatusFull200Response](docs/Model/GetCurrentUserVerificationStatusFull200Response.md)
- [GetTotpEnrollment200Response](docs/Model/GetTotpEnrollment200Response.md)
- [GetUsageAlerts200Response](docs/Model/GetUsageAlerts200Response.md)
- [GitHubIntegrationConfigurations](docs/Model/GitHubIntegrationConfigurations.md)
- [GitLabIntegration](docs/Model/GitLabIntegration.md)
- [GitLabIntegrationConfigurations](docs/Model/GitLabIntegrationConfigurations.md)
- [GitLabIntegrationCreateInput](docs/Model/GitLabIntegrationCreateInput.md)
- [GitLabIntegrationPatch](docs/Model/GitLabIntegrationPatch.md)
- [GithubIntegration](docs/Model/GithubIntegration.md)
- [GithubIntegrationCreateInput](docs/Model/GithubIntegrationCreateInput.md)
- [GithubIntegrationPatch](docs/Model/GithubIntegrationPatch.md)
- [GoogleSSOConfig](docs/Model/GoogleSSOConfig.md)
- [GrantProjectTeamAccessRequestInner](docs/Model/GrantProjectTeamAccessRequestInner.md)
- [GrantProjectUserAccessRequestInner](docs/Model/GrantProjectUserAccessRequestInner.md)
- [GrantTeamProjectAccessRequestInner](docs/Model/GrantTeamProjectAccessRequestInner.md)
- [GrantUserProjectAccessRequestInner](docs/Model/GrantUserProjectAccessRequestInner.md)
- [HTTPLogForwardingIntegrationConfigurations](docs/Model/HTTPLogForwardingIntegrationConfigurations.md)
- [HalLinks](docs/Model/HalLinks.md)
- [HalLinksNext](docs/Model/HalLinksNext.md)
- [HalLinksPrevious](docs/Model/HalLinksPrevious.md)
- [HalLinksSelf](docs/Model/HalLinksSelf.md)
- [HealthEmailNotificationIntegrationConfigurations](docs/Model/HealthEmailNotificationIntegrationConfigurations.md)
- [HealthPagerDutyNotificationIntegrationConfigurations](docs/Model/HealthPagerDutyNotificationIntegrationConfigurations.md)
- [HealthSlackNotificationIntegrationConfigurations](docs/Model/HealthSlackNotificationIntegrationConfigurations.md)
- [HealthWebHookIntegration](docs/Model/HealthWebHookIntegration.md)
- [HealthWebHookIntegrationCreateInput](docs/Model/HealthWebHookIntegrationCreateInput.md)
- [HealthWebHookIntegrationPatch](docs/Model/HealthWebHookIntegrationPatch.md)
- [HealthWebhookNotificationIntegrationConfigurations](docs/Model/HealthWebhookNotificationIntegrationConfigurations.md)
- [HooksExecutedAtVariousPointInTheLifecycleOfTheApplication](docs/Model/HooksExecutedAtVariousPointInTheLifecycleOfTheApplication.md)
- [HttpAccessPermissions](docs/Model/HttpAccessPermissions.md)
- [HttpAccessPermissions1](docs/Model/HttpAccessPermissions1.md)
- [HttpLogIntegration](docs/Model/HttpLogIntegration.md)
- [HttpLogIntegrationCreateInput](docs/Model/HttpLogIntegrationCreateInput.md)
- [HttpLogIntegrationPatch](docs/Model/HttpLogIntegrationPatch.md)
- [ImagesValueValue](docs/Model/ImagesValueValue.md)
- [Integration](docs/Model/Integration.md)
- [IntegrationCreateInput](docs/Model/IntegrationCreateInput.md)
- [IntegrationPatch](docs/Model/IntegrationPatch.md)
- [Integrations](docs/Model/Integrations.md)
- [Invoice](docs/Model/Invoice.md)
- [InvoicePDF](docs/Model/InvoicePDF.md)
- [LineItem](docs/Model/LineItem.md)
- [LineItemComponent](docs/Model/LineItemComponent.md)
- [ListLinks](docs/Model/ListLinks.md)
- [ListLinksNext](docs/Model/ListLinksNext.md)
- [ListLinksPrevious](docs/Model/ListLinksPrevious.md)
- [ListLinksSelf](docs/Model/ListLinksSelf.md)
- [ListOrgInvoices200Response](docs/Model/ListOrgInvoices200Response.md)
- [ListOrgMembers200Response](docs/Model/ListOrgMembers200Response.md)
- [ListOrgOrders200Response](docs/Model/ListOrgOrders200Response.md)
- [ListOrgPlanRecords200Response](docs/Model/ListOrgPlanRecords200Response.md)
- [ListOrgProjects200Response](docs/Model/ListOrgProjects200Response.md)
- [ListOrgSubscriptions200Response](docs/Model/ListOrgSubscriptions200Response.md)
- [ListOrgUsageRecords200Response](docs/Model/ListOrgUsageRecords200Response.md)
- [ListOrgs200Response](docs/Model/ListOrgs200Response.md)
- [ListPlans200Response](docs/Model/ListPlans200Response.md)
- [ListProfiles200Response](docs/Model/ListProfiles200Response.md)
- [ListProjectUserAccess200Response](docs/Model/ListProjectUserAccess200Response.md)
- [ListRegions200Response](docs/Model/ListRegions200Response.md)
- [ListTeamMembers200Response](docs/Model/ListTeamMembers200Response.md)
- [ListTeamProjectAccess200Response](docs/Model/ListTeamProjectAccess200Response.md)
- [ListTeams200Response](docs/Model/ListTeams200Response.md)
- [ListTicketCategories200ResponseInner](docs/Model/ListTicketCategories200ResponseInner.md)
- [ListTicketPriorities200ResponseInner](docs/Model/ListTicketPriorities200ResponseInner.md)
- [ListTickets200Response](docs/Model/ListTickets200Response.md)
- [ListUserExtendedAccess200Response](docs/Model/ListUserExtendedAccess200Response.md)
- [ListUserExtendedAccess200ResponseItemsInner](docs/Model/ListUserExtendedAccess200ResponseItemsInner.md)
- [ListUserOrgs200Response](docs/Model/ListUserOrgs200Response.md)
- [LogsForwarding](docs/Model/LogsForwarding.md)
- [MappingOfClustersToEnterpriseApplicationsValue](docs/Model/MappingOfClustersToEnterpriseApplicationsValue.md)
- [Metrics](docs/Model/Metrics.md)
- [NewRelicIntegration](docs/Model/NewRelicIntegration.md)
- [NewRelicIntegrationCreateInput](docs/Model/NewRelicIntegrationCreateInput.md)
- [NewRelicIntegrationPatch](docs/Model/NewRelicIntegrationPatch.md)
- [NewRelicLogForwardingIntegrationConfigurations](docs/Model/NewRelicLogForwardingIntegrationConfigurations.md)
- [OperationsThatCanBeAppliedToTheSourceCodeValue](docs/Model/OperationsThatCanBeAppliedToTheSourceCodeValue.md)
- [OperationsThatCanBeTriggeredOnThisApplicationValue](docs/Model/OperationsThatCanBeTriggeredOnThisApplicationValue.md)
- [Order](docs/Model/Order.md)
- [OrderBillingPeriodLabel](docs/Model/OrderBillingPeriodLabel.md)
- [OrderLinks](docs/Model/OrderLinks.md)
- [OrderLinksInvoices](docs/Model/OrderLinksInvoices.md)
- [Organization](docs/Model/Organization.md)
- [OrganizationInvitation](docs/Model/OrganizationInvitation.md)
- [OrganizationInvitationOwner](docs/Model/OrganizationInvitationOwner.md)
- [OrganizationLinks](docs/Model/OrganizationLinks.md)
- [OrganizationLinksAddress](docs/Model/OrganizationLinksAddress.md)
- [OrganizationLinksApplyVoucher](docs/Model/OrganizationLinksApplyVoucher.md)
- [OrganizationLinksCreateMember](docs/Model/OrganizationLinksCreateMember.md)
- [OrganizationLinksCreateSubscription](docs/Model/OrganizationLinksCreateSubscription.md)
- [OrganizationLinksDelete](docs/Model/OrganizationLinksDelete.md)
- [OrganizationLinksEstimateSubscription](docs/Model/OrganizationLinksEstimateSubscription.md)
- [OrganizationLinksMembers](docs/Model/OrganizationLinksMembers.md)
- [OrganizationLinksMfaEnforcement](docs/Model/OrganizationLinksMfaEnforcement.md)
- [OrganizationLinksOrders](docs/Model/OrganizationLinksOrders.md)
- [OrganizationLinksPaymentSource](docs/Model/OrganizationLinksPaymentSource.md)
- [OrganizationLinksProfile](docs/Model/OrganizationLinksProfile.md)
- [OrganizationLinksSelf](docs/Model/OrganizationLinksSelf.md)
- [OrganizationLinksSubscriptions](docs/Model/OrganizationLinksSubscriptions.md)
- [OrganizationLinksUpdate](docs/Model/OrganizationLinksUpdate.md)
- [OrganizationLinksVouchers](docs/Model/OrganizationLinksVouchers.md)
- [OrganizationMFAEnforcement](docs/Model/OrganizationMFAEnforcement.md)
- [OrganizationMember](docs/Model/OrganizationMember.md)
- [OrganizationMemberLinks](docs/Model/OrganizationMemberLinks.md)
- [OrganizationMemberLinksDelete](docs/Model/OrganizationMemberLinksDelete.md)
- [OrganizationMemberLinksSelf](docs/Model/OrganizationMemberLinksSelf.md)
- [OrganizationMemberLinksUpdate](docs/Model/OrganizationMemberLinksUpdate.md)
- [OrganizationProject](docs/Model/OrganizationProject.md)
- [OrganizationProjectLinks](docs/Model/OrganizationProjectLinks.md)
- [OrganizationProjectLinksApi](docs/Model/OrganizationProjectLinksApi.md)
- [OrganizationProjectLinksDelete](docs/Model/OrganizationProjectLinksDelete.md)
- [OrganizationProjectLinksSelf](docs/Model/OrganizationProjectLinksSelf.md)
- [OrganizationProjectLinksSubscription](docs/Model/OrganizationProjectLinksSubscription.md)
- [OrganizationProjectLinksUpdate](docs/Model/OrganizationProjectLinksUpdate.md)
- [OrganizationProjectPlan](docs/Model/OrganizationProjectPlan.md)
- [OrganizationProjectStatus](docs/Model/OrganizationProjectStatus.md)
- [OrganizationProjectType](docs/Model/OrganizationProjectType.md)
- [OrganizationReference](docs/Model/OrganizationReference.md)
- [OrganizationSSOConfig](docs/Model/OrganizationSSOConfig.md)
- [OutboundFirewall](docs/Model/OutboundFirewall.md)
- [OutboundFirewallRestrictionsInner](docs/Model/OutboundFirewallRestrictionsInner.md)
- [OwnerInfo](docs/Model/OwnerInfo.md)
- [PagerDutyIntegration](docs/Model/PagerDutyIntegration.md)
- [PagerDutyIntegrationCreateInput](docs/Model/PagerDutyIntegrationCreateInput.md)
- [PagerDutyIntegrationPatch](docs/Model/PagerDutyIntegrationPatch.md)
- [PerServiceResourcesOverridesValue](docs/Model/PerServiceResourcesOverridesValue.md)
- [Plan](docs/Model/Plan.md)
- [PlanRecords](docs/Model/PlanRecords.md)
- [ProdDomainStorage](docs/Model/ProdDomainStorage.md)
- [ProdDomainStorageCreateInput](docs/Model/ProdDomainStorageCreateInput.md)
- [ProdDomainStoragePatch](docs/Model/ProdDomainStoragePatch.md)
- [Profile](docs/Model/Profile.md)
- [ProfileCurrentTrial](docs/Model/ProfileCurrentTrial.md)
- [ProfileCurrentTrialCurrent](docs/Model/ProfileCurrentTrialCurrent.md)
- [ProfileCurrentTrialProjects](docs/Model/ProfileCurrentTrialProjects.md)
- [ProfileCurrentTrialProjectsTotal](docs/Model/ProfileCurrentTrialProjectsTotal.md)
- [ProfileCurrentTrialSpend](docs/Model/ProfileCurrentTrialSpend.md)
- [ProfileCurrentTrialSpendRemaining](docs/Model/ProfileCurrentTrialSpendRemaining.md)
- [Project](docs/Model/Project.md)
- [ProjectCapabilities](docs/Model/ProjectCapabilities.md)
- [ProjectInfo](docs/Model/ProjectInfo.md)
- [ProjectInvitation](docs/Model/ProjectInvitation.md)
- [ProjectInvitationEnvironmentsInner](docs/Model/ProjectInvitationEnvironmentsInner.md)
- [ProjectOptions](docs/Model/ProjectOptions.md)
- [ProjectOptionsDefaults](docs/Model/ProjectOptionsDefaults.md)
- [ProjectOptionsEnforced](docs/Model/ProjectOptionsEnforced.md)
- [ProjectPatch](docs/Model/ProjectPatch.md)
- [ProjectReference](docs/Model/ProjectReference.md)
- [ProjectSettings](docs/Model/ProjectSettings.md)
- [ProjectSettingsPatch](docs/Model/ProjectSettingsPatch.md)
- [ProjectVariable](docs/Model/ProjectVariable.md)
- [ProjectVariableCreateInput](docs/Model/ProjectVariableCreateInput.md)
- [ProjectVariablePatch](docs/Model/ProjectVariablePatch.md)
- [ProxyRoute](docs/Model/ProxyRoute.md)
- [ProxyRouteCreateInput](docs/Model/ProxyRouteCreateInput.md)
- [ProxyRoutePatch](docs/Model/ProxyRoutePatch.md)
- [RedirectRoute](docs/Model/RedirectRoute.md)
- [RedirectRouteCreateInput](docs/Model/RedirectRouteCreateInput.md)
- [RedirectRoutePatch](docs/Model/RedirectRoutePatch.md)
- [Ref](docs/Model/Ref.md)
- [Region](docs/Model/Region.md)
- [RegionDatacenter](docs/Model/RegionDatacenter.md)
- [RegionEnvironmentalImpact](docs/Model/RegionEnvironmentalImpact.md)
- [RegionProvider](docs/Model/RegionProvider.md)
- [RegionReference](docs/Model/RegionReference.md)
- [ReplacementDomainStorage](docs/Model/ReplacementDomainStorage.md)
- [ReplacementDomainStorageCreateInput](docs/Model/ReplacementDomainStorageCreateInput.md)
- [ReplacementDomainStoragePatch](docs/Model/ReplacementDomainStoragePatch.md)
- [RepositoryInformation](docs/Model/RepositoryInformation.md)
- [ResetEmailAddressRequest](docs/Model/ResetEmailAddressRequest.md)
- [Resources](docs/Model/Resources.md)
- [Resources1](docs/Model/Resources1.md)
- [Resources2](docs/Model/Resources2.md)
- [Resources3](docs/Model/Resources3.md)
- [Resources4](docs/Model/Resources4.md)
- [Resources5](docs/Model/Resources5.md)
- [ResourcesForDevelopmentEnvironments](docs/Model/ResourcesForDevelopmentEnvironments.md)
- [ResourcesForProductionEnvironments](docs/Model/ResourcesForProductionEnvironments.md)
- [ResourcesLimits](docs/Model/ResourcesLimits.md)
- [ResourcesOverridesValue](docs/Model/ResourcesOverridesValue.md)
- [RestrictedAndDeniedImageTypes](docs/Model/RestrictedAndDeniedImageTypes.md)
- [Route](docs/Model/Route.md)
- [RouteCreateInput](docs/Model/RouteCreateInput.md)
- [RoutePatch](docs/Model/RoutePatch.md)
- [RoutesValue](docs/Model/RoutesValue.md)
- [RuntimeOperations](docs/Model/RuntimeOperations.md)
- [SSHKey](docs/Model/SSHKey.md)
- [ScheduledCronTasksExecutedByThisApplicationValue](docs/Model/ScheduledCronTasksExecutedByThisApplicationValue.md)
- [ScriptIntegration](docs/Model/ScriptIntegration.md)
- [ScriptIntegrationConfigurations](docs/Model/ScriptIntegrationConfigurations.md)
- [ScriptIntegrationCreateInput](docs/Model/ScriptIntegrationCreateInput.md)
- [ScriptIntegrationPatch](docs/Model/ScriptIntegrationPatch.md)
- [SendOrgMfaReminders200ResponseValue](docs/Model/SendOrgMfaReminders200ResponseValue.md)
- [SendOrgMfaRemindersRequest](docs/Model/SendOrgMfaRemindersRequest.md)
- [ServerSideIncludeConfiguration](docs/Model/ServerSideIncludeConfiguration.md)
- [ServicesValue](docs/Model/ServicesValue.md)
- [SlackIntegration](docs/Model/SlackIntegration.md)
- [SlackIntegrationCreateInput](docs/Model/SlackIntegrationCreateInput.md)
- [SlackIntegrationPatch](docs/Model/SlackIntegrationPatch.md)
- [SourceOperations](docs/Model/SourceOperations.md)
- [SpecificOverridesValue](docs/Model/SpecificOverridesValue.md)
- [SplunkIntegration](docs/Model/SplunkIntegration.md)
- [SplunkIntegrationCreateInput](docs/Model/SplunkIntegrationCreateInput.md)
- [SplunkIntegrationPatch](docs/Model/SplunkIntegrationPatch.md)
- [SplunkLogForwardingIntegrationConfigurations](docs/Model/SplunkLogForwardingIntegrationConfigurations.md)
- [Status](docs/Model/Status.md)
- [StrictTransportSecurityOptions](docs/Model/StrictTransportSecurityOptions.md)
- [StrictTransportSecurityOptions1](docs/Model/StrictTransportSecurityOptions1.md)
- [StringFilter](docs/Model/StringFilter.md)
- [Subscription](docs/Model/Subscription.md)
- [Subscription1](docs/Model/Subscription1.md)
- [SubscriptionCurrentUsageObject](docs/Model/SubscriptionCurrentUsageObject.md)
- [SubscriptionInformation](docs/Model/SubscriptionInformation.md)
- [SumoLogicLogForwardingIntegrationConfigurations](docs/Model/SumoLogicLogForwardingIntegrationConfigurations.md)
- [SumologicIntegration](docs/Model/SumologicIntegration.md)
- [SumologicIntegrationCreateInput](docs/Model/SumologicIntegrationCreateInput.md)
- [SumologicIntegrationPatch](docs/Model/SumologicIntegrationPatch.md)
- [SyslogIntegration](docs/Model/SyslogIntegration.md)
- [SyslogIntegrationCreateInput](docs/Model/SyslogIntegrationCreateInput.md)
- [SyslogIntegrationPatch](docs/Model/SyslogIntegrationPatch.md)
- [SyslogLogForwardingIntegrationConfigurations](docs/Model/SyslogLogForwardingIntegrationConfigurations.md)
- [SystemInformation](docs/Model/SystemInformation.md)
- [TLSSettingsForTheRoute](docs/Model/TLSSettingsForTheRoute.md)
- [TLSSettingsForTheRoute1](docs/Model/TLSSettingsForTheRoute1.md)
- [Team](docs/Model/Team.md)
- [TeamCounts](docs/Model/TeamCounts.md)
- [TeamMember](docs/Model/TeamMember.md)
- [TeamProjectAccess](docs/Model/TeamProjectAccess.md)
- [TeamProjectAccessLinks](docs/Model/TeamProjectAccessLinks.md)
- [TeamProjectAccessLinksDelete](docs/Model/TeamProjectAccessLinksDelete.md)
- [TeamProjectAccessLinksSelf](docs/Model/TeamProjectAccessLinksSelf.md)
- [TeamProjectAccessLinksUpdate](docs/Model/TeamProjectAccessLinksUpdate.md)
- [TeamReference](docs/Model/TeamReference.md)
- [TheAddonCredentialInformationOptional](docs/Model/TheAddonCredentialInformationOptional.md)
- [TheAddonCredentialInformationOptional1](docs/Model/TheAddonCredentialInformationOptional1.md)
- [TheBackupScheduleSpecificationInner](docs/Model/TheBackupScheduleSpecificationInner.md)
- [TheBuildConfigurationOfTheApplication](docs/Model/TheBuildConfigurationOfTheApplication.md)
- [TheCommandsDefinition](docs/Model/TheCommandsDefinition.md)
- [TheCommandsToManageTheWorker](docs/Model/TheCommandsToManageTheWorker.md)
- [TheCommitDistanceInfoBetweenParentAndChildEnvironments](docs/Model/TheCommitDistanceInfoBetweenParentAndChildEnvironments.md)
- [TheConfigurationOfPathsManagedByTheBuildCacheValue](docs/Model/TheConfigurationOfPathsManagedByTheBuildCacheValue.md)
- [TheConfigurationOfTheRedirects](docs/Model/TheConfigurationOfTheRedirects.md)
- [TheConfigurationOfTheRedirects1](docs/Model/TheConfigurationOfTheRedirects1.md)
- [TheContinuousProfilingConfiguration](docs/Model/TheContinuousProfilingConfiguration.md)
- [TheCronsDeploymentState](docs/Model/TheCronsDeploymentState.md)
- [TheDefaultResourcesForThisService](docs/Model/TheDefaultResourcesForThisService.md)
- [TheDisksResources](docs/Model/TheDisksResources.md)
- [TheEnvironmentDeploymentState](docs/Model/TheEnvironmentDeploymentState.md)
- [TheHostsOfTheDeploymentTargetInner](docs/Model/TheHostsOfTheDeploymentTargetInner.md)
- [TheHostsOfTheDeploymentTargetInner1](docs/Model/TheHostsOfTheDeploymentTargetInner1.md)
- [TheInformationAboutTheAuthor](docs/Model/TheInformationAboutTheAuthor.md)
- [TheInformationAboutTheCommitter](docs/Model/TheInformationAboutTheCommitter.md)
- [TheIssuerOfTheCertificateInner](docs/Model/TheIssuerOfTheCertificateInner.md)
- [TheMinimumResourcesForThisService](docs/Model/TheMinimumResourcesForThisService.md)
- [TheOAuth2ConsumerInformationOptional](docs/Model/TheOAuth2ConsumerInformationOptional.md)
- [TheOAuth2ConsumerInformationOptional1](docs/Model/TheOAuth2ConsumerInformationOptional1.md)
- [TheObjectTheReferencePointsTo](docs/Model/TheObjectTheReferencePointsTo.md)
- [ThePathsToRedirectValue](docs/Model/ThePathsToRedirectValue.md)
- [ThePathsToRedirectValue1](docs/Model/ThePathsToRedirectValue1.md)
- [TheRelationshipsOfTheApplicationToDefinedServicesValue](docs/Model/TheRelationshipsOfTheApplicationToDefinedServicesValue.md)
- [TheSpecificationOfTheWebLocationsServedByThisApplicationValue](docs/Model/TheSpecificationOfTheWebLocationsServedByThisApplicationValue.md)
- [TheTreeItemsInner](docs/Model/TheTreeItemsInner.md)
- [TheVariablesApplyingToThisEnvironmentInner](docs/Model/TheVariablesApplyingToThisEnvironmentInner.md)
- [Ticket](docs/Model/Ticket.md)
- [TicketJiraInner](docs/Model/TicketJiraInner.md)
- [Tree](docs/Model/Tree.md)
- [UpdateOrgMemberRequest](docs/Model/UpdateOrgMemberRequest.md)
- [UpdateOrgProfileRequest](docs/Model/UpdateOrgProfileRequest.md)
- [UpdateOrgRequest](docs/Model/UpdateOrgRequest.md)
- [UpdateOrgSubscriptionRequest](docs/Model/UpdateOrgSubscriptionRequest.md)
- [UpdateProfileRequest](docs/Model/UpdateProfileRequest.md)
- [UpdateProjectUserAccessRequest](docs/Model/UpdateProjectUserAccessRequest.md)
- [UpdateTeamRequest](docs/Model/UpdateTeamRequest.md)
- [UpdateTicketRequest](docs/Model/UpdateTicketRequest.md)
- [UpdateUsageAlertRequest](docs/Model/UpdateUsageAlertRequest.md)
- [UpdateUserRequest](docs/Model/UpdateUserRequest.md)
- [UpstreamRoute](docs/Model/UpstreamRoute.md)
- [UpstreamRouteCreateInput](docs/Model/UpstreamRouteCreateInput.md)
- [UpstreamRoutePatch](docs/Model/UpstreamRoutePatch.md)
- [Usage](docs/Model/Usage.md)
- [UsageGroupCurrentUsageProperties](docs/Model/UsageGroupCurrentUsageProperties.md)
- [User](docs/Model/User.md)
- [UserProjectAccess](docs/Model/UserProjectAccess.md)
- [UserReference](docs/Model/UserReference.md)
- [VPNConfiguration](docs/Model/VPNConfiguration.md)
- [VerifyPhoneNumber200Response](docs/Model/VerifyPhoneNumber200Response.md)
- [VerifyPhoneNumberRequest](docs/Model/VerifyPhoneNumberRequest.md)
- [Version](docs/Model/Version.md)
- [VersionCreateInput](docs/Model/VersionCreateInput.md)
- [VersionPatch](docs/Model/VersionPatch.md)
- [Vouchers](docs/Model/Vouchers.md)
- [VouchersLinks](docs/Model/VouchersLinks.md)
- [VouchersLinksSelf](docs/Model/VouchersLinksSelf.md)
- [VouchersVouchersInner](docs/Model/VouchersVouchersInner.md)
- [VouchersVouchersInnerOrdersInner](docs/Model/VouchersVouchersInnerOrdersInner.md)
- [WebApplicationsValue](docs/Model/WebApplicationsValue.md)
- [WebHookIntegration](docs/Model/WebHookIntegration.md)
- [WebHookIntegrationCreateInput](docs/Model/WebHookIntegrationCreateInput.md)
- [WebHookIntegrationPatch](docs/Model/WebHookIntegrationPatch.md)
- [WebhookIntegrationConfigurations](docs/Model/WebhookIntegrationConfigurations.md)
- [WorkersValue](docs/Model/WorkersValue.md)

## Authorization

### OAuth2

- **Type**: `OAuth`
- **Flow**: `accessCode`
- **Authorization URL**: `https://auth.api.platform.sh/oauth2/authorize`
- **Scopes**: N/A


### OAuth2Admin

- **Type**: `OAuth`
- **Flow**: `application`
- **Authorization URL**: ``
- **Scopes**: 
    - **admin**: administrative operations

## Tests

To run the tests, use:

```bash
composer install
vendor/bin/phpunit
```

## Author



## About this package

This PHP package is automatically generated by the [OpenAPI Generator](https://openapi-generator.tech) project:

- API version: `1.0`
    - Generator version: `7.13.0`
- Build package: `org.openapitools.codegen.languages.PhpClientCodegen`

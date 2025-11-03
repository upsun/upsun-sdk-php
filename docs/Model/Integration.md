# # Integration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** |  |
**fetchBranches** | **bool** | Whether or not to fetch branches. |
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). |
**environmentInitResources** | **string** | The resources used when initializing a new service |
**repository** | **string** | The GitHub repository (in the form &#x60;user/repo&#x60;). |
**buildPullRequests** | **bool** | Whether or not to build pull requests. |
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building pull requests. |
**resyncPullRequests** | **bool** | Whether or not pull request environment data should be re-synced on every build. |
**url** | **string** | The URL of the webhook |
**username** | **string** | The Bitbucket Server user. |
**project** | **string** | The GitLab project (in the form &#x60;namespace/repo&#x60;). |
**environmentsCredentials** | [**array<string,\Upsun\Model\EnvironmentsCredentialsValue>**](EnvironmentsCredentialsValue.md) | Blackfire environments credentials |
**continuousProfiling** | **bool** | Whether continuous profiling is enabled for the project |
**events** | **string[]** | Events to execute the hook on |
**environments** | **string[]** | The environments to execute the hook on |
**excludedEnvironments** | **string[]** | The environments to not execute the hook on |
**states** | **string[]** | Events to execute the hook on |
**result** | **string** | Result to execute the hook on |
**serviceId** | **string** |  |
**baseUrl** | **string** | The base URL of the GitLab installation. |
**buildDraftPullRequests** | **bool** | Whether or not to build draft pull requests (requires &#x60;build_pull_requests&#x60;). |
**buildPullRequestsPostMerge** | **bool** | Whether to build pull requests post-merge (if true) or pre-merge (if false). |
**tokenType** | **string** | The type of the token of this GitHub integration |
**tokenExpiresAt** | **\DateTime** |  |
**rotateToken** | **bool** |  |
**rotateTokenValidityInWeeks** | **int** |  |
**buildMergeRequests** | **bool** | Whether or not to build merge requests. |
**buildWipMergeRequests** | **bool** | Whether or not to build work in progress merge requests (requires &#x60;build_merge_requests&#x60;). |
**mergeRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. |
**fromAddress** | **string** | The email address to use |
**recipients** | **string[]** | Recipients of the email |
**routingKey** | **string** | The PagerDuty routing key |
**channel** | **string** | The Slack channel to post messages to |
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs |
**headers** | **array<string,string>** | HTTP headers to use in POST requests |
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification |
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging |
**script** | **string** | The script to run |
**index** | **string** | The Splunk Index |
**sourcetype** | **string** | The event &#39;sourcetype&#39; |
**category** | **string** | The Category used to easy filtering (sent as X-Sumo-Category header) |
**host** | **string** | Syslog relay/collector host |
**port** | **int** | Syslog relay/collector port |
**protocol** | **string** | Transport protocol |
**facility** | **int** | Syslog facility |
**messageFormat** | **string** | Syslog message format |
**sharedKey** | **string** | The JWS shared secret key |
**id** | **string** | The identifier of WebHookIntegration | [optional]
**appCredentials** | [**\Upsun\Model\OAuth2Consumer**](OAuth2Consumer.md) |  | [optional]
**addonCredentials** | [**\Upsun\Model\AddonCredential**](AddonCredential.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

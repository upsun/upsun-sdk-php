# # IntegrationPatch

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**type** | **string** |  |
**repository** | **string** | The GitHub repository (in the form &#x60;user/repo&#x60;). |
**url** | **string** | The URL of the webhook |
**username** | **string** | The Bitbucket Server user. |
**token** | **string** | The Splunk Authorization Token |
**project** | **string** | The GitLab project (in the form &#x60;namespace/repo&#x60;). |
**serviceId** | **string** |  |
**recipients** | **string[]** | Recipients of the email |
**routingKey** | **string** | The PagerDuty routing key |
**channel** | **string** | The Slack channel to post messages to |
**licenseKey** | **string** | The NewRelic Logs License Key |
**script** | **string** | The script to run |
**index** | **string** | The Splunk Index |
**fetchBranches** | **bool** | Whether or not to fetch branches. | [optional]
**pruneBranches** | **bool** | Whether or not to remove branches that disappeared remotely (requires &#x60;fetch_branches&#x60;). | [optional]
**environmentInitResources** | **string** | The resources used when initializing a new service | [optional]
**appCredentials** | [**\Upsun\Model\OAuth2Consumer1**](OAuth2Consumer1.md) |  | [optional]
**addonCredentials** | [**\Upsun\Model\AddonCredential1**](AddonCredential1.md) |  | [optional]
**buildPullRequests** | **bool** | Whether or not to build pull requests. | [optional]
**pullRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building pull requests. | [optional]
**resyncPullRequests** | **bool** | Whether or not pull request environment data should be re-synced on every build. | [optional]
**events** | **string[]** | Events to execute the hook on | [optional]
**environments** | **string[]** | The environments to execute the hook on | [optional]
**excludedEnvironments** | **string[]** | The environments to not execute the hook on | [optional]
**states** | **string[]** | Events to execute the hook on | [optional]
**result** | **string** | Result to execute the hook on | [optional]
**baseUrl** | **string** | The base URL of the GitLab installation. | [optional]
**buildDraftPullRequests** | **bool** | Whether or not to build draft pull requests (requires &#x60;build_pull_requests&#x60;). | [optional]
**buildPullRequestsPostMerge** | **bool** | Whether to build pull requests post-merge (if true) or pre-merge (if false). | [optional]
**rotateToken** | **bool** |  | [optional]
**rotateTokenValidityInWeeks** | **int** |  | [optional]
**buildMergeRequests** | **bool** | Whether or not to build merge requests. | [optional]
**buildWipMergeRequests** | **bool** | Whether or not to build work in progress merge requests (requires &#x60;build_merge_requests&#x60;). | [optional]
**mergeRequestsCloneParentData** | **bool** | Whether or not to clone parent data when building merge requests. | [optional]
**fromAddress** | **string** | The email address to use | [optional]
**sharedKey** | **string** | The JWS shared secret key | [optional]
**extra** | **array<string,string>** | Arbitrary key/value pairs to include with forwarded logs | [optional]
**headers** | **array<string,string>** | HTTP headers to use in POST requests | [optional]
**tlsVerify** | **bool** | Enable/Disable HTTPS certificate verification | [optional]
**excludedServices** | **string[]** | Comma separated list of service and application names to exclude from logging | [optional]
**sourcetype** | **string** | The event &#39;sourcetype&#39; | [optional]
**category** | **string** | The Category used to easy filtering (sent as X-Sumo-Category header) | [optional]
**host** | **string** | Syslog relay/collector host | [optional]
**port** | **int** | Syslog relay/collector port | [optional]
**protocol** | **string** | Transport protocol | [optional]
**facility** | **int** | Syslog facility | [optional]
**messageFormat** | **string** | Syslog message format | [optional]
**authToken** | **string** |  | [optional]
**authMode** | **string** |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

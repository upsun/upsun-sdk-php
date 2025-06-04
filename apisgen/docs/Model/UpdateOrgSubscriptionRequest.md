# # UpdateOrgSubscriptionRequest

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**plan** | [**\OpenAPI\Client\Model\PlanType**](PlanType.md) |  |
**environments** | **int** | The maximum number of environments which can be provisioned on the project. | [optional]
**storage** | **int** | The total storage available to each environment, in MiB. | [optional]
**big_dev** | **string** | The development environment plan. | [optional]
**big_dev_service** | **string** | The development service plan. | [optional]
**backups** | **string** | The backups plan. | [optional]
**observability_suite** | **string** | The observability suite option. | [optional]
**blackfire** | **string** | The Blackfire integration option. | [optional]
**continuous_profiling** | **string** | The Blackfire continuous profiling option. | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

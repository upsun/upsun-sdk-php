# # Subscription1

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**licenseUri** | **string** | URI of the subscription |
**storage** | **int** | Size of storage (in MB) |
**includedUsers** | **int** | Number of users |
**subscriptionManagementUri** | **string** | URI for managing the subscription |
**restricted** | **bool** | True if subscription attributes, like number of users, are frozen |
**suspended** | **bool** | Whether or not the subscription is suspended |
**userLicenses** | **int** | Current number of users |
**plan** | **string** |  | [optional]
**environments** | **int** | Number of environments | [optional]
**resources** | [**\Upsun\Model\ResourcesLimits**](ResourcesLimits.md) |  | [optional]
**resourceValidationUrl** | **string** | URL for resources validation | [optional]
**imageTypes** | [**\Upsun\Model\ImageTypeRestrictions**](ImageTypeRestrictions.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

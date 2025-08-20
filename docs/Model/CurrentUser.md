# # CurrentUser

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The UUID of the owner. | [optional]
**uuid** | **string** | The UUID of the owner. | [optional]
**username** | **string** | The username of the owner. | [optional]
**display_name** | **string** | The full name of the owner. | [optional]
**status** | **int** | Status of the user. 0 &#x3D; blocked; 1 &#x3D; active. | [optional]
**mail** | **string** | The email address of the owner. | [optional]
**ssh_keys** | [**\Upsun\Model\SSHKey[]**](SSHKey.md) | The list of user&#39;s public SSH keys. | [optional]
**has_key** | **bool** | The indicator whether the user has a public ssh key on file or not. | [optional]
**projects** | [**\Upsun\Model\CurrentUserProjectsInner[]**](CurrentUserProjectsInner.md) |  | [optional]
**sequence** | **int** | The sequential ID of the user. | [optional]
**roles** | **string[]** |  | [optional]
**picture** | **string** | The URL of the user image. | [optional]
**tickets** | **object** | Number of support tickets by status. | [optional]
**trial** | **bool** | The indicator whether the user is in trial or not. | [optional]
**current_trial** | [**\Upsun\Model\CurrentUserCurrentTrialInner[]**](CurrentUserCurrentTrialInner.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

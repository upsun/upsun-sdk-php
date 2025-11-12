# # Activity

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The identifier of Activity |
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**type** | **string** | The type of the activity |
**parameters** | **object** | The parameters of the activity |
**project** | **string** | The project the activity belongs to |
**state** | **string** | The state of the activity |
**result** | **string** | The result of the activity |
**startedAt** | **\DateTime** | The start date of the activity |
**completedAt** | **\DateTime** | The completion date of the activity |
**completionPercent** | **int** | The completion percentage of the activity |
**cancelledAt** | **\DateTime** | The Cancellation date of the activity |
**timings** | **array<string,float>** | Timings related to different phases of the activity |
**log** | **string** | The log of the activity |
**payload** | **object** | The payload of the activity |
**description** | **string** | The description of the activity, formatted with HTML |
**text** | **string** | The description of the activity, formatted as plain text |
**expiresAt** | **\DateTime** | The date at which the activity will expire |
**commands** | [**\Upsun\Model\CommandsInner[]**](CommandsInner.md) | The commands of the activity |
**integration** | **string** | The integration the activity belongs to | [optional]
**environments** | **string[]** | The environments related to the activity | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

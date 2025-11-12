# # Backup

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The identifier of Backup |
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**attributes** | **array<string,string>** | Arbitrary attributes attached to this resource |
**status** | **string** | The status of the backup |
**expiresAt** | **\DateTime** | Expiration date of the backup |
**index** | **int** | The index of this automated backup |
**commitId** | **string** | The ID of the code commit attached to the backup |
**environment** | **string** | The environment the backup belongs to |
**safe** | **bool** | Whether this backup was taken in a safe way |
**sizeOfVolumes** | **int** | Total size of volumes backed up |
**sizeUsed** | **int** | Total size of space used on volumes backed up |
**deployment** | **string** | The current deployment at the time of backup |
**restorable** | **bool** | Whether the backup is restorable |
**automated** | **bool** | Whether the backup is automated |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

# # BuildCachesValue

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**directory** | **string** | The directory, relative to the application root, that should be cached. |
**watch** | **string[]** | The file or files whose hashed contents should be considered part of the cache key. |
**allowStale** | **bool** | If true, on a cache miss the last cache version will be used and can be updated in place. |
**shareBetweenApps** | **bool** | Whether multiple applications in the project should share cached directories. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

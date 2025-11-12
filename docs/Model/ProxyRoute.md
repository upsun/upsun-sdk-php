# # ProxyRoute

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**attributes** | **array<string,string>** | Arbitrary attributes attached to this resource |
**type** | **string** | Route type. |
**tls** | [**\Upsun\Model\TLSSettings**](TLSSettings.md) |  |
**to** | **string** |  |
**id** | **string** | The identifier of ProxyRoute | [optional]
**primary** | **bool** | This route is the primary route of the environment | [optional]
**productionUrl** | **string** | How this URL route would look on production environment | [optional]
**redirects** | [**\Upsun\Model\RedirectConfiguration**](RedirectConfiguration.md) |  | [optional]
**cache** | [**\Upsun\Model\CacheConfiguration**](CacheConfiguration.md) |  | [optional]
**ssi** | [**\Upsun\Model\SSIConfiguration**](SSIConfiguration.md) |  | [optional]
**upstream** | **string** | The upstream to use for this route. | [optional]
**sticky** | [**\Upsun\Model\StickyConfiguration**](StickyConfiguration.md) |  | [optional]

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

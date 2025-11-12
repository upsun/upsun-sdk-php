# # Certificate

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **string** | The identifier of Certificate |
**createdAt** | **\DateTime** | The creation date |
**updatedAt** | **\DateTime** | The update date |
**certificate** | **string** | The PEM-encoded certificate |
**chain** | **string[]** | The certificate chain |
**isProvisioned** | **bool** | Whether this certificate is automatically provisioned |
**isInvalid** | **bool** | Whether this certificate should be skipped during provisioning |
**isRoot** | **bool** | Whether this certificate is root type |
**domains** | **string[]** | The domains covered by this certificate |
**authType** | **string[]** | The type of authentication the certificate supports |
**issuer** | [**\Upsun\Model\IssuerInner[]**](IssuerInner.md) | The issuer of the certificate |
**expiresAt** | **\DateTime** | Expiration date |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

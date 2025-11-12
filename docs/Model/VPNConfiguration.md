# # VPNConfiguration

## Properties

Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**version** | **int** | The IKE version to use (1 or 2) |
**aggressive** | **string** | Whether to use IKEv1 Aggressive or Main Mode |
**modeconfig** | **string** | Defines which mode is used to assign a virtual IP (must be the same on both sides) |
**authentication** | **string** | The authentication scheme |
**gatewayIp** | **string** |  |
**identity** | **string** | The identity of the ipsec participant |
**secondIdentity** | **string** | The second identity of the ipsec participant |
**remoteIdentity** | **string** | The identity of the remote ipsec participant |
**remoteSubnets** | **string[]** | Remote subnets (CIDR notation) |
**ike** | **string** | The IKE algorithms to negotiate for this VPN connection. |
**esp** | **string** | The ESP algorithms to negotiate for this VPN connection. |
**ikelifetime** | **string** | The lifetime of the IKE exchange. |
**lifetime** | **string** | The lifetime of the ESP exchange. |
**margintime** | **string** | The margin time for re-keying. |

[[Back to Model list]](../../README.md#models) [[Back to API list]](../../README.md#endpoints) [[Back to README]](../../README.md)

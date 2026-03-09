# Config

Low level Config (auto-generated)

***

* Full name: `\Upsun\Model\Config`
* This class is marked as **final** and can't be subclassed
* This class implements:
  [`\Upsun\Model\Model`](./Model.md),
  `JsonSerializable`

**See Also:**

* https://docs.upsun.com

## Properties

### newrelic

```php
private ?\Upsun\Model\NewRelic $newrelic
```

***

### sumologic

```php
private ?\Upsun\Model\SumoLogic $sumologic
```

***

### splunk

```php
private ?\Upsun\Model\Splunk $splunk
```

***

### httplog

```php
private ?\Upsun\Model\HTTPLogForwarding $httplog
```

***

### syslog

```php
private ?\Upsun\Model\Syslog $syslog
```

***

### webhook

```php
private ?\Upsun\Model\Webhook $webhook
```

***

### script

```php
private ?\Upsun\Model\Script $script
```

***

### github

```php
private ?\Upsun\Model\GitHub $github
```

***

### gitlab

```php
private ?\Upsun\Model\GitLab $gitlab
```

***

### bitbucket

```php
private ?\Upsun\Model\Bitbucket $bitbucket
```

***

### bitbucketServer

```php
private ?\Upsun\Model\BitbucketServer $bitbucketServer
```

***

### healthEmail

```php
private ?\Upsun\Model\HealthEmail $healthEmail
```

***

### healthWebhook

```php
private ?\Upsun\Model\HealthWebHook $healthWebhook
```

***

### healthPagerduty

```php
private ?\Upsun\Model\HealthPagerDuty $healthPagerduty
```

***

### healthSlack

```php
private ?\Upsun\Model\HealthSlack $healthSlack
```

***

### cdnFastly

```php
private ?\Upsun\Model\FastlyCDN $cdnFastly
```

***

### blackfire

```php
private ?\Upsun\Model\Blackfire $blackfire
```

***

### otlplog

```php
private ?\Upsun\Model\OpenTelemetry $otlplog
```

***

## Methods

### __construct

```php
public __construct(?\Upsun\Model\NewRelic $newrelic = null, ?\Upsun\Model\SumoLogic $sumologic = null, ?\Upsun\Model\Splunk $splunk = null, ?\Upsun\Model\HTTPLogForwarding $httplog = null, ?\Upsun\Model\Syslog $syslog = null, ?\Upsun\Model\Webhook $webhook = null, ?\Upsun\Model\Script $script = null, ?\Upsun\Model\GitHub $github = null, ?\Upsun\Model\GitLab $gitlab = null, ?\Upsun\Model\Bitbucket $bitbucket = null, ?\Upsun\Model\BitbucketServer $bitbucketServer = null, ?\Upsun\Model\HealthEmail $healthEmail = null, ?\Upsun\Model\HealthWebHook $healthWebhook = null, ?\Upsun\Model\HealthPagerDuty $healthPagerduty = null, ?\Upsun\Model\HealthSlack $healthSlack = null, ?\Upsun\Model\FastlyCDN $cdnFastly = null, ?\Upsun\Model\Blackfire $blackfire = null, ?\Upsun\Model\OpenTelemetry $otlplog = null): mixed
```

**Parameters:**

| Parameter          | Type                                | Description |
|--------------------|-------------------------------------|-------------|
| `$newrelic`        | **?\Upsun\Model\NewRelic**          |             |
| `$sumologic`       | **?\Upsun\Model\SumoLogic**         |             |
| `$splunk`          | **?\Upsun\Model\Splunk**            |             |
| `$httplog`         | **?\Upsun\Model\HTTPLogForwarding** |             |
| `$syslog`          | **?\Upsun\Model\Syslog**            |             |
| `$webhook`         | **?\Upsun\Model\Webhook**           |             |
| `$script`          | **?\Upsun\Model\Script**            |             |
| `$github`          | **?\Upsun\Model\GitHub**            |             |
| `$gitlab`          | **?\Upsun\Model\GitLab**            |             |
| `$bitbucket`       | **?\Upsun\Model\Bitbucket**         |             |
| `$bitbucketServer` | **?\Upsun\Model\BitbucketServer**   |             |
| `$healthEmail`     | **?\Upsun\Model\HealthEmail**       |             |
| `$healthWebhook`   | **?\Upsun\Model\HealthWebHook**     |             |
| `$healthPagerduty` | **?\Upsun\Model\HealthPagerDuty**   |             |
| `$healthSlack`     | **?\Upsun\Model\HealthSlack**       |             |
| `$cdnFastly`       | **?\Upsun\Model\FastlyCDN**         |             |
| `$blackfire`       | **?\Upsun\Model\Blackfire**         |             |
| `$otlplog`         | **?\Upsun\Model\OpenTelemetry**     |             |

***

### getModelName

The original name of the model.

```php
public getModelName(): string
```

***

### jsonSerialize

```php
public jsonSerialize(): array
```

***

### __toString

```php
public __toString(): string
```

***

### getNewrelic

New Relic log-forwarding integration configurations

```php
public getNewrelic(): ?\Upsun\Model\NewRelic
```

***

### getSumologic

Sumo Logic log-forwarding integration configurations

```php
public getSumologic(): ?\Upsun\Model\SumoLogic
```

***

### getSplunk

Splunk log-forwarding integration configurations

```php
public getSplunk(): ?\Upsun\Model\Splunk
```

***

### getHttplog

HTTP log-forwarding integration configurations

```php
public getHttplog(): ?\Upsun\Model\HTTPLogForwarding
```

***

### getSyslog

Syslog log-forwarding integration configurations

```php
public getSyslog(): ?\Upsun\Model\Syslog
```

***

### getWebhook

Webhook integration configurations

```php
public getWebhook(): ?\Upsun\Model\Webhook
```

***

### getScript

Script integration configurations

```php
public getScript(): ?\Upsun\Model\Script
```

***

### getGithub

GitHub integration configurations

```php
public getGithub(): ?\Upsun\Model\GitHub
```

***

### getGitlab

GitLab integration configurations

```php
public getGitlab(): ?\Upsun\Model\GitLab
```

***

### getBitbucket

Bitbucket integration configurations

```php
public getBitbucket(): ?\Upsun\Model\Bitbucket
```

***

### getBitbucketServer

Bitbucket server integration configurations

```php
public getBitbucketServer(): ?\Upsun\Model\BitbucketServer
```

***

### getHealthEmail

Health Email notification integration configurations

```php
public getHealthEmail(): ?\Upsun\Model\HealthEmail
```

***

### getHealthWebhook

```php
public getHealthWebhook(): ?\Upsun\Model\HealthWebHook
```

***

### getHealthPagerduty

Health PagerDuty notification integration configurations

```php
public getHealthPagerduty(): ?\Upsun\Model\HealthPagerDuty
```

***

### getHealthSlack

Health Slack notification integration configurations

```php
public getHealthSlack(): ?\Upsun\Model\HealthSlack
```

***

### getCdnFastly

Fastly CDN integration configurations

```php
public getCdnFastly(): ?\Upsun\Model\FastlyCDN
```

***

### getBlackfire

Blackfire integration configurations

```php
public getBlackfire(): ?\Upsun\Model\Blackfire
```

***

### getOtlplog

OpenTelemetry log-forwarding integration configurations

```php
public getOtlplog(): ?\Upsun\Model\OpenTelemetry
```

***

<?php

namespace Upsun\Core\Tasks;

use OpenAPI\Client\ApiException;
use OpenAPI\Client\apisgen\DeploymentApi;
use Upsun\UpsunClient;

class ApplicationTask extends TaskBase
{
    public readonly DeploymentApi $api;

    public function __construct(
        public readonly UpsunClient $client,
    )
    {
        $this->api = new DeploymentApi($this->client->apiClient, $this->client->apiConfig);
    }

    /**
     * @param string $projectId
     * @param string $environmentId
     * @return array
     * @throws ApiException
     */
    public function listApplications(string $projectId, string $environmentId): array
    {
        $deployments = $this->api->listProjectsEnvironmentsDeployments($projectId, $environmentId);
        return $deployments[0]->getWebapps();
    }
    
    
    
    
    
    
    /*
     *  array:1 [
  "app" => OpenAPI\Client\Model\WebApplicationsValue^ {#8325
    #openAPINullablesSetToNull: array:2 [
      0 => "timezone"
      1 => "firewall"
    ]
    #container: array:30 [
      "resources" => OpenAPI\Client\Model\Resources^ {#8300
        #openAPINullablesSetToNull: array:2 [
          0 => "base_memory"
          1 => "memory_ratio"
        ]
        #container: array:6 [
          "base_memory" => null
          "memory_ratio" => null
          "profile_size" => "0.5"
          "minimum" => OpenAPI\Client\Model\TheMinimumResourcesForThisService^ {#7854
            #openAPINullablesSetToNull: []
            #container: array:4 [
              "cpu" => 0.1
              "memory" => 64
              "disk" => 128
              "profile_size" => "0.1"
            ]
          }
          "default" => OpenAPI\Client\Model\TheDefaultResourcesForThisService^ {#8299
            #openAPINullablesSetToNull: []
            #container: array:4 [
              "cpu" => 0.5
              "memory" => 224
              "disk" => 512
              "profile_size" => "0.5"
            ]
          }
          "disk" => OpenAPI\Client\Model\TheDisksResources^ {#7788
            #openAPINullablesSetToNull: []
            #container: array:3 [
              "temporary" => 8192
              "instance" => 8192
              "storage" => 512
            ]
          }
        ]
      }
      "size" => "AUTO"
      "disk" => 512
      "access" => array:1 [
        "ssh" => "contributor"
      ]
      "relationships" => array:1 [
        "database" => OpenAPI\Client\Model\TheRelationshipsOfTheApplicationToDefinedServicesValue^ {#8298
          #openAPINullablesSetToNull: []
          #container: array:2 [
            "service" => "database"
            "endpoint" => "postgresql"
          ]
        }
      ]
      "additional_hosts" => []
      "mounts" => array:1 [
        "/var" => OpenAPI\Client\Model\FilesystemMountsOfThisApplicationIfNotSpecifiedTheApplicationWillHaveNoWriteableDiskSpaceValue^ {#8290
          #openAPINullablesSetToNull: array:1 [
            0 => "service"
          ]
          #container: array:3 [
            "source" => "storage"
            "source_path" => "var"
            "service" => null
          ]
        }
      ]
      "timezone" => null
      "variables" => array:1 [
        "php" => array:1 [
          "opcache.preload" => "config/preload.php"
        ]
      ]
      "firewall" => null
      "container_profile" => "HIGH_CPU"
      "operations" => []
      "name" => "app"
      "type" => "php:8.2:777"
      "preflight" => OpenAPI\Client\Model\ConfigurationForPreFlightChecks^ {#8291
        #openAPINullablesSetToNull: []
        #container: array:2 [
          "enabled" => true
          "ignored_rules" => []
        ]
      }
      "tree_id" => "de507683a7499ccb13ae9dfe0619280999ee8fc3"
      "app_dir" => "/app"
      "endpoints" => array:2 [
        "http" => {#7554
          +"scheme": "http"
          +"port": 80
        }
        "php" => {#7559
          +"scheme": "http"
          +"port": 80
        }
      ]
      "runtime" => array:1 [
        "extensions" => array:8 [
          0 => "apcu"
          1 => "blackfire"
          2 => "ctype"
          3 => "iconv"
          4 => "mbstring"
          5 => "pdo_pgsql"
          6 => "sodium"
          7 => "xsl"
        ]
      ]
      "web" => OpenAPI\Client\Model\ConfigurationForAccessingThisApplicationViaHTTP^ {#8307
        #openAPINullablesSetToNull: array:6 [
          0 => "document_root"
          1 => "passthru"
          2 => "index_files"
          3 => "whitelist"
          4 => "blacklist"
          5 => "expires"
        ]
        #container: array:10 [
          "locations" => array:1 [
            "/" => OpenAPI\Client\Model\TheSpecificationOfTheWebLocationsServedByThisApplicationValue^ {#7908
              #openAPINullablesSetToNull: array:1 [
                0 => "index"
              ]
              #container: array:9 [
                "root" => "public"
                "expires" => "1h"
                "passthru" => "/index.php"
                "scripts" => true
                "index" => null
                "allow" => true
                "headers" => []
                "rules" => []
                "request_buffering" => null
              ]
            }
          ]
          "commands" => null
          "upstream" => null
          "document_root" => null
          "passthru" => null
          "index_files" => null
          "whitelist" => null
          "blacklist" => null
          "expires" => null
          "move_to_root" => false
        ]
      }
      "hooks" => OpenAPI\Client\Model\HooksExecutedAtVariousPointInTheLifecycleOfTheApplication^ {#7889
        #openAPINullablesSetToNull: array:1 [
          0 => "post_deploy"
        ]
        #container: array:3 [
          "build" => """
            set -x -e\n
            \n
            curl -fs https://get.symfony.com/cloud/configurator | bash\n
            \n
            NODE_VERSION=18 symfony-build\n
            """
          "deploy" => """
            set -x -e\n
            \n
            symfony-deploy\n
            """
          "post_deploy" => null
        ]
      }
      "crons" => array:1 [
        "security-check" => OpenAPI\Client\Model\ScheduledCronTasksExecutedByThisApplicationValue^ {#7832
          #openAPINullablesSetToNull: array:1 [
            0 => "shutdown_timeout"
          ]
          #container: array:5 [
            "spec" => "50 23 * * *"
            "commands" => OpenAPI\Client\Model\TheCommandsDefinition^ {#8303
              #openAPINullablesSetToNull: array:1 [
                0 => "stop"
              ]
              #container: array:2 [
                "start" => "if [ "$PLATFORM_ENVIRONMENT_TYPE" = "production" ]; then croncape php-security-checker; fi"
                "stop" => null
              ]
            }
            "shutdown_timeout" => null
            "timeout" => 86400
            "cmd" => null
          ]
        }
      ]
      "source" => OpenAPI\Client\Model\ConfigurationRelatedToTheSourceCodeOfTheApplication^ {#7795
        #openAPINullablesSetToNull: []
        #container: array:2 [
          "root" => "/"
          "operations" => []
        ]
      }
      "build" => OpenAPI\Client\Model\TheBuildConfigurationOfTheApplication^ {#7770
        #openAPINullablesSetToNull: []
        #container: array:2 [
          "flavor" => "none"
          "caches" => []
        ]
      }
      "dependencies" => array:1 [
        "php" => array:1 [
          "composer/composer" => "^2"
        ]
      ]
      "stack" => []
      "is_across_submodule" => false
      "instance_count" => 1
      "config_id" => "582ce52ec0af9e926e6ab0d991c4e5256c2d48fd"
      "slug_id" => "nbi3yxy27gyhe-app-de507683a7499ccb13ae9dfe0619280999ee8fc3-582ce52ec0af9e926e6ab0d991c4e5256c2d48fd"
    ]
  }
]
     */
    
    
    
    
    
    
}
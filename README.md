# extension-installer-plugin



## HOW TO USE:
=========================================

### for install

```bash

 composer require "extension-installer-plugin"

```

### sample setup config

```json

#composer.json :
{

    "require": {
        
        "easylo/extension-installer-plugin": "dev-master",
	
        "web-custom-ezpublish/document": "dev-master",
        "web-custom-ezpublish/enhancedezbinaryfile": "dev-master",
        "web-custom-ezpublish/ezaap": "dev-master",
        "web-custom-ezpublish/ezbrightcove": "dev-master",
        "web-custom-ezpublish/ezhumancaptcha": "dev-master",
        "web-custom-ezpublish/eztags": "dev-master",
        "web-custom-ezpublish/ggwebservices": "dev-master",	       
		    "web-custom-ezpublish/ezpublish-legacy-settings": "dev-master"
    },
    "config": {
        "installer-paths": {
            "ezpublish_legacy/settings/": [ 
                "web-custom-ezpublish/ezpublish-legacy-settings"
            ],
            "ezpublish_legacy/extension/{$name}/": [
                "web-custom-ezpublish/document",
                "web-custom-ezpublish/enhancedezbinaryfile",
                "web-custom-ezpublish/ezaap",
                "web-custom-ezpublish/ezbrightcove",
                "web-custom-ezpublish/ezhumancaptcha",
                "web-custom-ezpublish/eztags",
                "web-custom-ezpublish/ggwebservices"
            ]
        }
    }
}

```

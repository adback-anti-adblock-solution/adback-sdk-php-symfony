Adback/ApiClientBundle
======================

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dekalee/adback-analytics-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dekalee/adback-analytics-bundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/dekalee/adback-analytics-bundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dekalee/adback-analytics-bundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dekalee/adback-analytics-bundle/v/stable)](https://packagist.org/packages/dekalee/adback-analytics-bundle)
[![Total Downloads](https://poser.pugx.org/dekalee/adback-analytics-bundle/downloads)](https://packagist.org/packages/dekalee/adback-analytics-bundle)
[![License](https://poser.pugx.org/dekalee/adback-analytics-bundle/license)](https://packagist.org/packages/dekalee/adback-analytics-bundle)

This bundle will use the library to call the AdBack api.

See [the AdBack website](https://www.adback.co/) for more informations.

Installation
------------

Launch the composer command :

```bash
    composer require adback/adback-sdk-php-symfony
```

If you are using a version of symfony >= 4, it should automatically activate the bundle.

If you are using a version of symfony < 4, you have to add the bundle to your `AppKernel.php` file :

```php
    new Adback\ApiClientBundle\Adback\ApiClientBundle(),
```

Configuration
-------------

### Symfony 4

In your `.env` file, the following lines should have been added :

```dotenv
    ADBACK_API_CLIENT_ACCESS_TOKEN=adback-access-token
```

Modify it with the token provided by the AdBack team.

Then follow the paragraph linked to the type of cache you have choosen :

#### Redis

In the `config/packages/adback_sdk_php.yaml` you should add the following configuration :

```yaml
    cache_type: redis
    cache_service: redis_service
```

`redis_service` is the name of the redis connection you are using to store the data.

#### Doctrine

In the `config/packages/adback_sdk_php.yaml` you should add the following configuration :

```yaml
    cache_type: doctrine
    entity_manager: doctrine.orm.entity_manager
```

`doctrine.orm.entity_manager` is the name of the doctrine connection you are using to store the data.

Do not forget to create the table linked to the AdBack sdk.

#### Custom

If you want to write your own cache driver, you should create a class that implements
`Adback\ApiClient\Driver\ScriptCacheInterface` and name this service `adback_api_client.script_cache`.

In the `config/packages/adback_sdk_php.yaml` you should add the following configuration :

```yaml
    cache_type: custom
```

If the service is missing, an error will be issued by the Symfony DIC when the service is being used.

### Symfony < 4

In your `app/config/config.yml` file, you should add the following lines :

```dotenv
    adback_api_client:
        access_token: "your-access-token"
```

Modify it with the token provided by the AdBack team.

Then follow the paragraph linked to the type of cache you have choosen :

#### Redis

In the `app/config/config.yml` you should add the following configuration :

```yaml
    adback_api_client:
        cache_type: redis
        cache_service: redis_service
```

`redis_service` is the name of the redis connection you are using to store the data.

#### Doctrine

In the `app/config/config.yml` you should add the following configuration :

```yaml
    adback_api_client:
        cache_type: doctrine
        entity_manager: doctrine.orm.entity_manager
```

`doctrine.orm.entity_manager` is the name of the doctrine connection you are using to store the data.

Do not forget to create the table linked to the AdBack sdk.


#### Custom

If you want to write your own cache driver, you should create a class that implements
`Adback\ApiClient\Driver\ScriptCacheInterface` and name this service `adback_api_client.script_cache`.

In the `app/config/config.yml` you should add the following configuration :

```yaml
    adback_api_client:
        cache_type: custom
```

If the service is missing, an error will be issued by the Symfony DIC when the service is being used

### Script Type

There is two possibilities for the script you could get.

#### Small scripts

This configuration will only load the AdBack script from an external url.

This usage is good for a quick start.

### Full scripts

This configuration will load our full script or bootscrap script.

This will allow us to deliver a script which is more flexible when the blocking in place are harder.

This solution is recommanded for an advanced usage.

Usage
-----

### Refresh command

In order to have the AdBack script always up-to-date you should launch the command `adback:api-client:refresh-tag`
periodically (at least once a day).

This command will call our api and store the response in the cache type you have chosen

### Add the script to your pages

At the bottom of your webpages, you should add the script twig generation function :

```twig
    {{ adback_generate_scripts() }}
```

Full configuration description
------------------------------

```yaml
    adback_api_client:
        access_token:         ~ # Required, Your personnal access token
        api_url:              'https://adback.co/api' # The base url for the api
        script_url:           script/me # The api url used to get the script
        cache_type:           redis # The cache type you are using
        generator_type:       script # The type of script you are generating
        cache_service:        redis # The service used for the caching
        entity_manager:       doctrine.orm.entity_manager # The entity manager used (only if you use the doctrine cache

        # This key is used if multiple website access the same database
        key_prefix:           ''
```

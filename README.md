Adback/AnalyticsBundle
======================

| Service | Badge |
| -------- |:--------:|
| Code quality (scrutinizer) | [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/dekalee/adback-analytics-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dekalee/adback-analytics-bundle/?branch=master) |

This bundle will use the library to call the AdBack api.

See [the AdBack website](http://adback.co) for more informations.

Installation
------------

Launch the command :

```
    composer require "dekalee/adback-analytics-bundle"
```

In the `AppKernel` file, activate the bundle: 

```php
    new Dekalee\AdbackAnalyticsBundle\DekaleeAdbackAnalyticsBundle(),
```

In the `config.yml` file add your token:

```yaml
    dekalee_adback_analytics:
        access_token: your-token
        cache_service: your.redis.service
```

Usage
-----

To update your local cache, run the command:

```php
    php app/console dekalee:adback-anayltics:refresh-tag
```

To display the tag in your page, you can add the twig command:

```twig
    {{ adback_generate_scripts() }}
```

Cache storage
-------------

If you don't want to use `Redis` as the default cache storage, you can create
a new driver which implements the `Dekalee\AdbackAnalytics\Driver\ScriptCacheInterface`.

After creating your service, you have to add the alias `dekalee_adback_analytics.script_cache.

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

To display the tag in your page, you can add the twig command:

```twig
    {{ adback_generate_scripts() }}
```

Cache storage
-------------

If you don't want to use `Redis` as the default cache storage, you can create
a new driver which implements the `Dekalee\AdbackAnalytics\Driver\ScriptCacheInterface`.

After creating your service, you can modify the `dekalee_adback_analytics.cache_service`
configuration key.

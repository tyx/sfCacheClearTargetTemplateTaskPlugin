sfCacheClearTargetTemplateTaskPlugin
==================

This plugin add new task to delete only one template or templates pattern, to avoid clearing all templates on fix deployement.


Licence
-------

see LICENSE file


Usage
-----

You need to customize view_cache_manager factories (in factories.yml) to add method removeAppCache use in new task

    view_cache_manager:
      class: myViewCacheManager
      param:
        cache_key_use_vary_headers: true
        cache_key_use_host_name:    true

As the class extends sfViewCacheManager class, it follows the same usage then.

Then, juste use the new task cache:clear-target-template (or use ctt alias) as following:
 * cache:clear-target-template --app=APP --env=ENV BASEURL TEMPLATE

BASEURL is website url in general
TEMPLATE could be a template like news/show or group templates like /all/news/show/*   

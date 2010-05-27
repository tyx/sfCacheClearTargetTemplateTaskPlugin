<?php
/*
 * This file is part of the .
 * (c) 2010 Autrement
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * myCacheManager does things.
 *
 * @package    
 * @subpackage 
 * @author     Autrement
 * @version    1.0.0
 */
class myViewCacheManager extends sfViewCacheManager
{  
  public function removeAppCache($paths, $app, $baseurl = '')
  {
    $this->cache->setOption('prefix', sfConfig::get('sf_apps_dir').'/'.$app.'/template:');

    foreach ($paths as $path)
    {
      if (strstr($path, '*') !== false)
      {
        $this->cache->removePattern('/'.$this->getCacheKeyHostNamePart($baseurl).$path);
      }
      else
      {      
        $this->cache->remove($this->generateCacheKey($path, $baseurl));
      }
    }
  }
}
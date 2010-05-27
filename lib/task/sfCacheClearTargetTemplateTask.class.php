<?php
/*
 * This file is part of the .
 * (c) 2010 Autrement
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfCacheClearTargetTemplateTask.php does things.
 *
 * @package    
 * @subpackage 
 * @author     Autrement
 * @version    1.0.0
 */
class sfCacheClearTargetTemplateTask extends sfCacheClearTask
{
  protected
    $targetTemplate = null,
    $baseurl = '';
    
  protected function configure()
  {
    $this->addArguments(array(
      new sfCommandArgument('baseurl', sfCommandArgument::REQUIRED, 'Base URL'),
      new sfCommandArgument('target', sfCommandArgument::REQUIRED, 'Target templates')
    ));
    
    $this->addOptions(array(
      new sfCommandOption('app', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', null),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_OPTIONAL, 'The environment', null),
      new sfCommandOption('type', null, sfCommandOption::PARAMETER_OPTIONAL, 'The type', 'target')
    ));

    $this->aliases = array('ctt');
    $this->namespace = 'cache-target-template';
    $this->name = 'clear';
    $this->briefDescription = 'Clears the target template';

    $this->detailedDescription = <<<EOF
  	Remove target template
  	
EOF;
  }
  
  protected function execute($arguments = array(), $options = array())
  {
    $this->targetTemplate = $arguments['target'];
    $this->baseurl = $arguments['baseurl'];
    
    parent::execute($arguments, $options);
  }
  
  protected function clearTargetCache(sfApplicationConfiguration $appConfiguration)
  {
    $config = $this->getFactoriesConfiguration($appConfiguration);
		$context = sfContext::createInstance($appConfiguration);		

    if (isset($config['view_cache']))
    {
      $class = $config['view_cache'];
      $targets = explode(',', $this->targetTemplate);
      $cache = new $class['class']($class['param']) ;
      $cacheManager = new $config['view_cache_manager']['class']($context, $cache);
      
      $cacheManager->removeAppCache($targets, 'frontend', $this->baseurl);
    }
  }
}
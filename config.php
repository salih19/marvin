<?php

// Default config
$config['env'] = isset($env) ? $env : 'prod';
$config['base_dir'] = __DIR__.'/../../..';
$config['app_dir'] = $config['base_dir'] .'/app';
$config['data_dir'] = $config['base_dir'] .'/data';
$config['themes_dir'] = $config['base_dir'] .'/app/themes';
$config['theme'] = 'default';
$config['db']['path'] = $config['data_dir'] . ($config['env'] == 'test' ? '/test.db' : '/app.db');
$config['db']['name'] = 'marvin';
$config['is_installed'] = file_exists($config['db']['path']);
$config['twig']['paths'][] = __DIR__ .'/View';


// Plugin initialization
$config['plugins'] = array('pages', 'users');


// Override defaults by app config
$appConfigFile = $config['app_dir'] .'/config.php';
if(file_exists($appConfigFile))
{
    require $appConfigFile;
}


// Add themes views to twig paths
$config['twig']['paths'][] = $config['themes_dir'];


// Add plugins views to twig paths
foreach($config['plugins'] as $plugin)
{
    $pluginViews = __DIR__ .'/../'. ucfirst($plugin) .'/View';
    if(file_exists($pluginViews))
    {
        $config['twig']['paths'][] = $pluginViews;
    }
}


return $config;
<?php return array (
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'crcms/foundation' => 
  array (
    'providers' => 
    array (
      0 => 'CrCms\\Foundation\\Providers\\FoundationServiceProvider',
      1 => 'CrCms\\Foundation\\Providers\\ModuleServiceProvider',
    ),
    'aliases' => 
    array (
    ),
    'dont-discover' => 
    array (
      0 => 'nwidart/laravel-modules',
    ),
  ),
);
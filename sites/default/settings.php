<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Include the Pantheon-specific settings file.
 *
 * n.b. The settings.pantheon.php file makes some changes
 *      that affect all envrionments that this site
 *      exists in.  Always include this file, even in
 *      a local development environment, to insure that
 *      the site settings remain consistent.
 */
include __DIR__ . "/settings.pantheon.php";

/**
 * If there is a local settings file, then include it
 */

$databases['default']['default'] = array (
  'database' => 'qed',
  'username' => 'root',
  'password' => 'root',
  'prefix' => '',
  'host' => 'localhost',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['hash_salt'] = 'mOCDND4bcKihXEydUwtMaJb04mP_g32lryDY9R26rtFLrnvU31hC2Ie9jB2d_0ikpmnprDulXA';
$settings['install_profile'] = 'standard';
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}
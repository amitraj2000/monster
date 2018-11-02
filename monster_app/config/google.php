<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
| 
| To get API details you have to create a Google Project
| at Google API Console (https://console.developers.google.com)
| 
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '238911531242-4rmmaae3i9lg4vbu2rdbqkr087v14gic.apps.googleusercontent.com';
$config['google']['client_secret']    = 'bJec7o528B01H_aa8t12RuJm';
$config['google']['redirect_uri']     = 'http://localhost/monster/login/google_user_authentication';
$config['google']['application_name'] = 'Login to Monster';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();
?>
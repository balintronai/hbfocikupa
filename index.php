<?php

/*****************************************************************************************************
 * Entry of the framework
 * Author: Csaba Olajos
 * E-mail: olajos.csaba.88@gmail.com
 * 
 * This is the main entry of the framework -> every request has to go through this file.
 * The actual class is given by the 'q' variable in GET. If there's a file which has the same name as the
 * value of the 'q', the actual class is loaded. If it fails, the default class will be loaded, which can
 * be modified in the Config folder.
 * 
 * The structure of the Framework is simple:
 * 
 * |-Application      Here are the functions, classes, methods, etc. in connect with your Application 
 * |  |-Config        Default values, preferences, etc...
 * |  |-CSS           Put here your CSS files.
 * |  |  |-Images     Images which are included in the CSS file
 * |  |-Emails        Templates of emails
 * |  |-Scripts       Put here your JavaScript, etc files.
 * |  |-Controllers   This is where you write your code (when everything is fine :). So here are your loops, if-else statements etc.
 * |  |-Inis          INI files, needed if the site is multilanguage
 * |  |-Errors        Custom error pages can be put here
 * |  |-Images        Images wich are needed in the site
 * |  |-Models        Here you can find the models, wich have been written by me. These are always in development.
 * |     |-Helpers    Classes, which make life easier :)
 * |  |-Views         You can put your view (almost HTML) files here.
 * |  |-Galeria       Images for the articles
 * |-Logs             Log files (not used yet)
 * index.php          Here you are.
 * 
 *****************************************************************************************************/


/*
 * Main entry of the framework; every request have to go through this file
 */

/*
 * Starting session
 */
  session_start();
  $_SESSION['query'] = 0;
  
/* 
 * Loading the config files
 */
  require('Application/Config/config_default_values.php');
  require('Application/Config/config_default_preferences.php');
  
/*
 * Displaying errors or not
 */
  ini_set('display_errors',DISPLAY_ERRORS);
  
/*
 * Checking the browser platform: mobil or not
 * If mobil than the user is going to be forwarded to the mobile version
 */ 
  
  if ( MOBIL_VERSION AND $detect->isMobile()) {
    
    require('Application/Models/Mobile-Detect-2.5.5/Mobile_Detect.php');
    $detect = new Mobile_Detect();
    
    $query_string = substr($_SERVER['QUERY_STRING'],2);             // q=hu/csomagok helyett hu/csomagok
    
    $extension = substr($query_string,0,-3);
    
    if ( ! (
            $extension == 'jpg' OR
            $extension == 'png' OR
            $extension == 'gif' OR
            $extension == 'pdf'
           )
       ) 
    {
    
      if (MOBILE_SUBDOMAIN) {
        header("Location: ".MOBILE_DOMAIN.(DEFAULT_FOLDER ? "/".DEFAULT_FOLDER : "")."/".(! SHORT_URL ? 'index.php?q=' : '').$query_string);
      }
      else {
        header("Location: ".DEFAULT_DOMAIN.(DEFAULT_FOLDER ? "/".DEFAULT_FOLDER : "")."/".MOBILE_FOLDER."/".(! SHORT_URL ? 'index.php?q=' : '').$query_string);
      }
    }
  }

/*
 * There must be a base-class
 */
  require('Application/Models/model_base.php');
  
/*
 * To make includes easier
 */
  require('Application/Models/model_load.php');
  
/*
 * Handling sessions
 */
  require('Application/Models/Helpers/helper_session.php');
  
/* 
 * Check if there's valid content of the q variable or not.
 * if yes: load that class
 * if not: load the default class
 * 
 * TEHAT index.php?q=xxx ESETEN HA VAN controller_xxx.php AKKOR AZT HIVJA MEG
 * HA NINCS, AKKOR EGY MASIK OSZTALYT, AMI ELLENORZI, HOGY VAN-E OLYAN MENUPONT/CIKK
 * // OTT: HA NINCS OLYAN MENUPONT/CIKK, AKKOR A 404-ET
 */
  if ( isset($_GET['q']) AND $_GET['q'] != '') {
    $q = explode('/',$_GET['q']);
    
    if (MULTILANG) {
      if (! isset($q[1]) AND strlen($q[0]) > 3) {
        $q[1] = $q[0];
        $q[0] = DEFAULT_LANG;
      }
      $q = ( isset($q[1]) ? $q[1] : FALSE);
      
    }
    else $q = $q[0];
    
    if ($q == '') $q = DEFAULT_CLASS;
    
    if ( file_exists('Application/Controllers/controller_'.$q.'.php') ) {
      $class = 'Controllers/controller_'.$q;
    }
    else {
      $class = 'Controllers/controller_tartalom';
      $q  = 'Tartalom';
    }
  }
  else {
    $class = 'Controllers/controller_'.DEFAULT_CLASS;
    $q = DEFAULT_CLASS;
  }
    
/*
 * Loading the class of the actual controller
 */
 
  include('Application/'.$class.'.php');

/*
 * Get an instance of the actual controller
 */
 
  $object = new $q;
  
  //echo $_SESSION['query'];
  
?>

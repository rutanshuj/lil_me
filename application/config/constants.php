<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESCTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|retail_app
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html 
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('LOGIN_HEADER','Lilme');
define('HEADER_SUB_TITLE','Lilme');
define("GOOGLE_API_KEY", "AIzaSyC_9synajSZ612oPHMJdKwO8xfBXe5tj-c");
define('MARKET_NEWS_IMAGE_UPLOAD','./assets/market_news_img/');

define('CATEGORY_IMAGE_UPLOAD','./assets/img/category/');
define('CATALOG_UPLOAD','./assets/product_catalog/');
define('CATALOG_THUMBNAIL','./assets/product_catalog/thumbnail/');


define('MARKET_NEWS_IMAGE_TYPE','gif|jpg|png');


define('MARKET_NEWS_IMAGE_MAX_SIZE','1000');
define('MARKET_NEWS_IMAGE_MAX_WIDTH','1024');
define('MARKET_NEWS_IMAGE_MAX_HEIGHT','768');

define('CATEGORY_IMAGE_MAX_SIZE','4000');
define('CATEGORY_IMAGE_MAX_WIDTH','4024');
define('CATEGORY_IMAGE_MAX_HEIGHT','4000');



define('THUMBNAIL_IMAGE_MAX_WIDTH','320');
define('THUMBNAIL_IMAGE_MAX_HEIGHT','200');

define('redirectUrl','http://www.prvy.in/sme/lil_me/web/user/fb_login');
define('fbPermissions', 'email');
define('appId','1811597855784256');
define('appSecret', 'cab4d0ab90e43d585a4d6afaa885d02e');



define('DIAMOND_CERTIFICATE_UPLOAD_LOCATION','./assets/img/diamond_certificate/');

define('DIAMOND_CERTIFICATE_TYPE','gif|jpg|png');
define('DIAMOND_CERTIFICATE_MAX_SIZE','4000');
define('DIAMOND_CERTIFICATE_MAX_WIDTH','4024');
define('DIAMOND_CERTIFICATE_MAX_HEIGHT','4000');

define('CERTIFICATE_THUMBNAIL_IMAGE_MAX_WIDTH','320');
define('CERTIFICATE_THUMBNAIL_IMAGE_MAX_HEIGHT','200');


define('DIAMOND_IMAGE_UPLOAD_LOCATION','./assets/img/diamond/');

define('DIAMOND_IMAGE_TYPE','gif|jpg|png');
define('DIAMOND_IMAGE_MAX_SIZE','4000');
define('DIAMOND_IMAGE_MAX_WIDTH','4024');
define('DIAMOND_IMAGE_MAX_HEIGHT','4000');

define('DIAMOND_THUMBNAIL_IMAGE_MAX_WIDTH','320');
define('DIAMOND_THUMBNAIL_IMAGE_MAX_HEIGHT','200');

define('URL_CONST',"http://prvy.in/sme/lil_me/");
define('LOGIN_LOGO','./assets/img/svgs/logo.svg');






define('MOOD_IMAGE_UPLOAD','./assets/img/home_page_images/');

define('MOOD_IMAGE_TYPE','gif|jpg|png');
define('MOOD_IMAGE_MAX_SIZE','4000');
define('MOOD_IMAGE_MAX_WIDTH','4024');
define('MOOD_IMAGE_MAX_HEIGHT','4000');

define('MOOD_THUMBNAIL_IMAGE_MAX_WIDTH','637');
define('MOOD_THUMBNAIL_IMAGE_MAX_HEIGHT','850');





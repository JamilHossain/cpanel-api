# cPanel API Class
Sample PHP Class for calling cPanel API 2 &amp; WHM API 1

## How to use
Change the values in the constructor

| Variable  | Info |
| ------------- | ------------- |
| rootUser  | the user you login into WHM  |
| hash  | you can get it from WHM Interface (Home >> Clusters >> Remote Access Key) or from file /root/.accesshash more details https://confluence2.cpanel.net/display/1144Docs/Remote+Access+Key |
| ipAddress | your cPanel IP Address |

The function **callCpanelApi** has the parameters 

1. has to be the cpanel user you want to use
2. is the Module name
3. is the function you want to call 
4. is an array with required and/or additional parameters

The function **callWHMApi** has the parameters

1. the function you want to call 
2. an array with required and/or optional paramters

## Sample Code

```php
<?php

include_once 'src/Cpanel.php';

$cpanel = new Cpanel();

$cpanel->callWHMApi('listaccts');
$cpanel->callCpanelApi('user', 'Email', 'listpopswithdisk')
```

## Samples

### cPanel API 2 Calls (callCpanelApi function) 

#### Email::listpopswithdisk
Details: https://confluence2.cpanel.net/display/SDK/cPanel+API+2+Functions+-+Email%3A%3Alistpopswithdisk
```php
$cpanel->callCpanelApi('cpaneluser', 'Email', 'listpopswithdisk');
```

#### SubDomain::addsubdomain
Details: https://confluence2.cpanel.net/display/SDK/cPanel+API+2+Functions+-+SubDomain%3A%3Aaddsubdomain
```php
$cpanel->callCpanelApi('cpaneluser', 'SubDomain', 'addsubdomain', 
  array(
    'domain' => 'subdomain.yourdomain.com', 
    'rootdomain' => 'yourdomain.com'
  )
);
```

### WHM API 1 Calls (callWHMApi function)

#### create_user_session
Details: This function creates a new temporary user session for a specified service... https://confluence2.cpanel.net/display/SDK/WHM+API+1+Functions+-+create_user_session
```php
$cpanel->callWHMApi('create_user_session', 
  array(
    'user' => 'yourcpaneluser', 
    'service' => 'webmaild', 
    'locale' => 'de', 
    'app' => 'roundcube'
  )
);
```
Available Services are webmaild, cpaneld and whostmgrd

#### accountsummary
Details: https://confluence2.cpanel.net/display/SDK/WHM+API+1+Functions+-+accountsummary
```php
$cpanel->callWHMApi('accountsummary', array('user' => 'yourcpaneluser'));
```

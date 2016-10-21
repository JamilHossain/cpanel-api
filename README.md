# cPanel API Class
Sample PHP Class for calling cPanel API 2 &amp; WHM API 1

## How to use
Change the values in the constructor

| Variable  | Info |
| ------------- | ------------- |
| rootUser  | the user you login with into WHM  |
| hash  | you can get it from WHM Interface (Home >> Clusters >> Remote Access Key) or from file /root/.accesshash  |
| ipAddress | your cPanel IP Address |

## Sample Code

```php
<?php

include_once 'src/Cpanel.php';

$cpanel = new Cpanel();

$cpanel->callWHMApi('listaccts');
$cpanel->callCpanelApi('user', 'Email', 'listpopswithdisk')
```

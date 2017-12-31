Nette popup
===========
popup, overlay

Installation
------------
```sh
$ composer require geniv/nette-popup
```
or
```json
"geniv/nette-popup": ">=1.0.0"
```

require:
```json
"php": ">=5.6.0",
"nette/nette": ">=2.4.0"
```

Include in application
----------------------
neon configure:
```neon
services:
    - Popup
```

usage:
```php
protected function createComponentPopup(Popup $popup): Popup
{
    //$popup->setTemplatePath();
    //$popup->setCookieName();
    //$popup->setCookieExpire();
    return $popup;
}
```

usage:
```latte
{control popup}
```

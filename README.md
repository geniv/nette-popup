Popup
=====

Installation
------------
```sh
$ composer require geniv/nette-popup
```
or
```json
"geniv/nette-popup": "^2.0"
```

require:
```json
"php": ">=7.0",
"nette/nette": ">=2.4",
"geniv/nette-general-form": ">=1.0"
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
protected function createComponentPopup(IPopup $popup): IPopup
{
    //$popup->setTemplatePath(__DIR__ . '/templates/popup.latte');
    //$popup->setCookieName('cookie-popup');
    //$popup->setCookieExpire('+10 years');
    return $popup;
}
```

usage:
```latte
{control popup}
```

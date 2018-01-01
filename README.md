Nette popup
===========
popup & overlay

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
    - Overlay
```

usage:
```php
protected function createComponentPopup(Popup $popup): Popup
{
    //$popup->setTemplatePath('');
    //$popup->setCookieName();
    //$popup->setCookieExpire();
    return $popup;
}

protected function createComponentOverlay(Overlay $overlay): Overlay
{
    //$overlay->setTemplatePath('','');
    return $overlay;
}
```

usage:
```latte
{control popup}

{control overlay:begin}
content
{control overlay:end}
```

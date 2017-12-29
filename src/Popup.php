<?php

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;


/**
 * Class Popup
 *
 * @author  geniv
 */
class Popup extends Control
{
    /** @var ITranslator */
    private $translator = null;
    /** @var string template path */
    private $templatePath;
    /** @var string */
    private $cookieName = 'popup-cookies';
    /** @var string */
    private $cookieExpire = '+10 year';


    /**
     * Popup constructor.
     *
     * @param ITranslator|null $translator
     */
    public function __construct(ITranslator $translator = null)
    {
        parent::__construct();

        $this->translator = $translator;

        $this->templatePath = __DIR__ . '/Popup.latte';  // implicit path
    }


    /**
     * Set template path.
     *
     * @param $path
     * @return $this
     */
    public function setTemplatePath($path)
    {
        $this->templatePath = $path;
        return $this;
    }


    /**
     * Set cookie name.
     *
     * @param $name
     * @return $this
     */
    public function setCookieName($name)
    {
        $this->cookieName = $name;
        return $this;
    }


    /**
     * Set cookie expire.
     *
     * @param $time
     * @return $this
     */
    public function setCookieExpire($time)
    {
        $this->cookieExpire = $time;
        return $this;
    }


    /**
     * Handle hide block.
     */
    public function handleHideBlock()
    {
        $this->presenter->getHttpResponse()->setCookie($this->cookieName, 1, $this->cookieExpire);

        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        }
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();

        $template->showBlock = $this->presenter->getHttpRequest()->getCookie($this->cookieName, 0);

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}

<?php declare(strict_types=1);

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;


/**
 * Class Popup
 *
 * @author  geniv, MartinFugess
 */
class Popup extends Control implements IPopup
{
    /** @var ITranslator */
    private $translator = null;
    /** @var string */
    private $templatePath;
    /** @var string */
    private $cookieName = 'cookie-popup';
    /** @var string */
    private $cookieExpire = '+10 years';
    /** @var int */
    private $showBlock = 0;


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
     * @param string $path
     */
    public function setTemplatePath(string $path)
    {
        $this->templatePath = $path;
    }


    /**
     * Set cookie name.
     *
     * @param string $name
     */
    public function setCookieName(string $name)
    {
        $this->cookieName = $name;
    }


    /**
     * Set cookie expire.
     *
     * @param string $time
     */
    public function setCookieExpire(string $time)
    {
        $this->cookieExpire = $time;
    }


    /**
     * Handle hide block.
     *
     * @throws \Nette\Application\AbortException
     */
    public function handleHideBlock()
    {
        $this->presenter->getHttpResponse()->setCookie($this->cookieName, 1, $this->cookieExpire);
        $this->showBlock = 1;

        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        } else {
            $this->redirect('this');
        }
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();
        $template->showBlock = $this->presenter->getHttpRequest()->getCookie($this->cookieName, $this->showBlock);

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}

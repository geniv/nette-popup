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
    /** @var bool */
    private $autoOpen = false;
    /** @var bool */
    private $enableSaveCookie = false;
    /** @var bool */
    private $showBlock = false;
    /** @var array */
    private $variableTemplate = [];


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
     * Set auto open.
     *
     * @param bool $state
     */
    public function setAutoOpen(bool $state)
    {
        $this->autoOpen = $state;
    }


    /**
     * Enable save cookie.
     *
     * @param bool $state
     */
    public function enableSaveCookie(bool $state)
    {
        $this->enableSaveCookie = $state;
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
     * Set cookie.
     *
     * @param bool $state
     */
    private function setCookie(bool $state)
    {
        if ($this->enableSaveCookie) {
            $this->presenter->getHttpResponse()->setCookie($this->cookieName, $state, $this->cookieExpire);
        }
    }


    /**
     * Handle show block.
     */
    public function handleShowBlock()
    {
        $this->show();
    }


    /**
     * Handle hide block.
     */
    public function handleHideBlock()
    {
        $this->hide();
    }


    /**
     * Show.
     */
    public function show()
    {
        $this->showBlock = true;
        $this->setCookie($this->showBlock);

        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        }
    }


    /**
     * Hide.
     */
    public function hide()
    {
        $this->showBlock = false;
        $this->setCookie($this->showBlock);

        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        }
    }


    /**
     * Add variable template.
     *
     * @param string $name
     * @param        $values
     */
    public function addVariableTemplate(string $name, $values)
    {
        $this->variableTemplate[$name] = $values;
    }


    /**
     * Render.
     */
    public function render()
    {
        /** @var stdClass $template */
        $template = $this->getTemplate();

        if ($this->enableSaveCookie) {
            $template->showBlock = $this->presenter->getHttpRequest()->getCookie($this->cookieName, $this->autoOpen ? true : $this->showBlock);
        } else {
            $template->showBlock = $this->showBlock;
        }

        // add user defined variable
        foreach ($this->variableTemplate as $name => $value) {
            $template->$name = $value;
        }

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}

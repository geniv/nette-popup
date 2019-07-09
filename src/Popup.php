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
    private $autoOpen = false, $enableSaveCookie = true, $showBlock = false;

    //TODO dodelat, doresit interface, pouziti, a co bool v cookie

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


    public function setAutoOpen(bool $state) {
        $this->autoOpen = $state;
    }


    public function enableSaveCookie(bool $state) {
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
     * Handle hide block.
     *
     * @throws \Nette\Application\AbortException
     */
    public function handleHideBlock()
    {
        if ($this->enableSaveCookie){
            $this->showBlock=false;
            $this->presenter->getHttpResponse()->setCookie($this->cookieName, $this->showBlock, $this->cookieExpire);
        }

        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        } else {
            $this->redirect('this');
        }
    }
    
    public function show(){
        $this->showBlock=true;
        
        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        } 
    }
    
    public function hide(){
        $this->showBlock=false;
        
        if ($this->presenter->isAjax()) {
            $this->redrawControl('snippetBlock');
        } 
    }
    
    public function addVariableTemplate(string $name, $values): self {
        $this->variableTemplate[$name] = $values;
        return $this;
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();

       
        if ($this->enableSaveCookie) {
         $template->showBlock = $this->presenter->getHttpRequest()->getCookie($this->cookieName, $this->autoOpen ? true : $this->showBlock);
        } else {
        $template->showBlock= $this->showBlock;
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

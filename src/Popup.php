<?php declare(strict_types=1);

use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Localization\ITranslator;


/**
 * Class Popup
 *
 * @author  geniv
 */
class Popup extends Control
{
    /** @var string template path */
    private $templatePath;
    /** @var ITranslator */
    private $translator = null;
    /** @var string */
    private $expireCookie = '2 weeks';
    /** @var callback method */
    public $onSuccess;


    /**
     * Popup constructor.
     *
     * @param null             $expireCookie
     * @param ITranslator|null $translator
     */
    public function __construct($expireCookie = null, ITranslator $translator = null)
    {
        parent::__construct();

        if ($expireCookie) {
            $this->expireCookie = $expireCookie;
        }
        $this->translator = $translator;

        $this->templatePath = __DIR__ . '/Popup.latte';  // implicit path

        // default onSuccess
        if (!$this->onSuccess) {
            $this->onSuccess[] = function () {
                $this->redirect('this');
            };
        }
    }


    /**
     * Set template path.
     *
     * @param $path
     * @return Popup
     */
    public function setTemplatePath($path): self
    {
        $this->templatePath = $path;
        return $this;
    }


    /**
     * Create component form.
     *
     * @param $name
     * @return Form
     */
    protected function createComponentForm($name): Form
    {
        $form = new Form($this, $name);
        $form->setTranslator($this->translator);
        $form->addSubmit('send', 'popup-form-send');
        $form->onSuccess[] = function ($form, $values) {
            $this->presenter->getHttpResponse()->setCookie('popupShow', 0, $this->expireCookie);
            $this->onSuccess();
        };
        return $form;
    }


    /**
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();

        $template->popupShow = $this->presenter->getHttpRequest()->getCookie('popupShow', 1);

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}

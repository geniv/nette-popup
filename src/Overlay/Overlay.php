<?php

use Nette\Application\UI\Control;
use Nette\Localization\ITranslator;


/**
 * Class Overlay
 *
 * @author  geniv
 */
class Overlay extends Control
{
    /** @var ITranslator */
    private $translator = null;
    /** @var string template path */
    private $templatePath;
    /** @var bool */
    private $showBlock = false;


    /**
     * Overlay constructor.
     *
     * @param ITranslator|null $translator
     */
    public function __construct(ITranslator $translator = null)
    {
        parent::__construct();

        $this->translator = $translator;

        $this->templatePath = __DIR__ . '/Overlay.latte';  // implicit path
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
     * Render.
     */
    public function render()
    {
        $template = $this->getTemplate();
        $template->showBlock = $this->showBlock;

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath);
        $template->render();
    }
}

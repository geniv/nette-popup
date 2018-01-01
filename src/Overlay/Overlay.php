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


    /**
     * Overlay constructor.
     *
     * @param ITranslator|null $translator
     */
    public function __construct(ITranslator $translator = null)
    {
        parent::__construct();

        $this->translator = $translator;

        // implicit path
        $this->templatePath = [
            'begin' => __DIR__ . '/OverlayBegin.latte',
            'end'   => __DIR__ . '/OverlayEnd.latte',
        ];
    }


    /**
     * Set template path.
     *
     * @param $pathBegin
     * @param $pathEnd
     * @return $this
     */
    public function setTemplatePath($pathBegin, $pathEnd)
    {
        $this->templatePath = [
            'begin' => $pathBegin,
            'end'   => $pathEnd,
        ];
        return $this;
    }


    /**
     * Render begin.
     */
    public function renderBegin()
    {
        $template = $this->getTemplate();

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath['begin']);
        $template->render();
    }


    /**
     * Render end.
     */
    public function renderEnd()
    {
        $template = $this->getTemplate();

        $template->setTranslator($this->translator);
        $template->setFile($this->templatePath['end']);
        $template->render();
    }
}

<?php declare(strict_types=1);

use GeneralForm\ITemplatePath;


/**
 * Interface IPopup
 *
 * @author  geniv
 */
interface IPopup extends ITemplatePath
{

    /**
     * Set cookie name.
     *
     * default: cookie-popup
     *
     * @param string $name
     */
    public function setCookieName(string $name);


    /**
     * Set cookie expire.
     *
     * default: +10 years
     *
     * @param string $time
     */
    public function setCookieExpire(string $time);


    /**
     * Set auto open.
     *
     * default: false
     *
     * @param bool $state
     */
    public function setAutoOpen(bool $state);


    /**
     * Enable save cookie.
     *
     * default: false
     *
     * @param bool $state
     */
    public function enableSaveCookie(bool $state);


    /**
     * Show.
     */
    public function show();


    /**
     * Hide.
     *
     * default: hide
     */
    public function hide();


    /**
     * Add variable template.
     *
     * @param string $name
     * @param        $values
     */
    public function addVariableTemplate(string $name, $values);
}

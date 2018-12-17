<?php declare(strict_types=1);


/**
 * Interface IPopup
 *
 * @author  geniv
 */
interface IPopup
{

    /**
     * Set cookie name.
     *
     * @param string $name
     */
    public function setCookieName(string $name);


    /**
     * Set cookie expire.
     *
     * @param string $time
     */
    public function setCookieExpire(string $time);


    /**
     * Handle hide block.
     */
    public function handleHideBlock();
}

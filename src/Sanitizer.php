<?php


namespace BrosSquad\FluVal;

/**
 * Class Sanitizer
 *
 * @package BrosSquad\FluVal
 */
class Sanitizer
{
    /**
     * @param string $html
     *
     * @return string
     */
    public function sanitizeHtml(string $html): string
    {
        return htmlspecialchars($html, ENT_QUOTES);
    }

    /**
     * @param string $email
     *
     * @return string
     */
    public function sanitizeEmail(string $email): string
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function sanitizeUrl(string $url): string
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    /**
     * @param string $str
     *
     * @return string
     */
    public function sanitizeString(string $str): string
    {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    /**
     * @param $str
     *
     * @return string
     */
    public function sanitizeInteger($str): string
    {
        return filter_var($str, FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * @param $str
     *
     * @return float
     */
    public function sanitizeFloat($str): float
    {
        return filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT);
    }


    /**
     * @param string $str
     *
     * @return string
     */
    public function addSlashes(string $str): string
    {
        return filter_var($str, FILTER_SANITIZE_ADD_SLASHES);
    }

}
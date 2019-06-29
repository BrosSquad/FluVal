<?php


namespace BrosSquad\FluVal;


class Sanitizer
{
    public function sanitizeHtml(string $html)
    {
        return htmlspecialchars($html, ENT_QUOTES);
    }

    public function sanitizeEmail(string $email)
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

    public function sanitizeUrl(string $url)
    {
        return filter_var($url, FILTER_SANITIZE_URL);
    }

    public function sanitizeString(string $str)
    {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    public function sanitizeInteger($str)
    {
        return filter_var($str, FILTER_SANITIZE_NUMBER_INT);
    }

    public function sanitizeFloat($str): float
    {
        return filter_var($str, FILTER_SANITIZE_NUMBER_FLOAT);
    }

    public function sanitizeQuotes(string $str)
    {
        return filter_var($str, FILTER_SANITIZE_MAGIC_QUOTES);
    }

    public function addSlashes(string $str)
    {
        return filter_var($str, FILTER_SANITIZE_ADD_SLASHES);
    }

}
<?php
class UrlLibrary
{

  public function redirect(string $url)
  {
    if (!preg_match('~http(s)?:\/\/~', $url)) {
      $protocol = '';
      preg_match('~http(s)?~Uui', $_SERVER['SERVER_PROTOCOL'], $match);
      if (!empty($match)) {
        $protocol = strtolower($match[0]) . '://';
      }
      $url = $protocol . $url;
    }
    header('Location: ' . $url);
  }

  public function getBackLink() : string
  {
    $referer = '';
    if (array_key_exists('HTTP_REFERER', $_SERVER)) {
      $referer = $_SERVER['HTTP_REFERER'];
    }
    return $referer;
  }

  public function getUserAgent() : string
  {
    $user_agent = '';
    if (array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
      $user_agent = $_SERVER['HTTP_USER_AGENT'];
    }
    return $user_agent;
  }

}
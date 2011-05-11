<?php

/**
 * Redirect the user to another URL before other Symfony code has
 * a chance to get involved. Useful when editing .htaccess on a regular
 * basis is not desirable. Almost as fast, too (Doctrine::HYDRATE_ARRAY)
 */
 
class pkRedirectFilter extends sfFilter
{
  /**
   * Executes the filter chain.
   *
   * @param sfFilterChain $filterChain
   */
  public function execute($filterChain)
  {
    $url = $this->context->getRequest()->getUri();
    // That comes back as an absolute URL, remove the protocol part
    if (preg_match('/^\w+\:\/\/.*?(\/.*)$/', $url, $matches))
    {
      $url = $matches[1];
    }
    $redirect = Doctrine::getTable('pkRedirect')->findOneByUrlFrom($url, Doctrine::HYDRATE_ARRAY);
    if ($redirect)
    {
      return $this->context->getController()->redirect($redirect['url_to']);
    }
    $filterChain->execute();
  }
}

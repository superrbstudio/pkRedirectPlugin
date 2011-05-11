<?php

/**
 * PluginpkRedirect form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginpkRedirectForm extends BasepkRedirectForm
{
  public function setup()
  {
    parent::setup();
    $this->setWidget('url_to', new sfWidgetFormInputText(array(), array('maxlength' => 1000)));
  }
  public function updateObject($values = null)
  {
    if (is_null($values))
    {
      $values = $this->getValues();
    }
    $url = $values['url_from'];
    // Absolute URL like http://foo.edu/whatever, convert it to just /whatever
    if (preg_match('/^\w+\:\/\/.*?(\/.*)$/', $url, $matches))
    {
      $values['url_from'] = $matches[1];
    }
    return parent::updateObject($values);
  }
}

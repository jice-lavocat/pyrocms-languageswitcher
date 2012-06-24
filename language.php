<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Language plugin
 * 
 * @author	Antoine Benevaut
 * 
 * @package	OursITShow
 * @subpackage  Lang
 * @category  	Plugin
 */
class Plugin_Language extends Plugin
{
  /**
   * {{ language:switcher }}
   *
   * Language switcher allow to display selected site language as text or
   * image flags and allow users to change current language.
   *
   * Optionals arguments:
   *
   * select mode :
   * mode = txt | gif | png
   *
   * select display mode :
   * display = inline
   *
   * {{ language:switcher mode='png' display='inline' }}
   */
  public function	switcher() {
    $html		= null;

    $mode		= $this->attribute('mode', 'txt');
    $display		= $this->attribute('display');

    $langs		= explode(",", Settings::get('site_public_lang'));

    if (isset($langs) && !empty($langs)) {
      $html .= "<style>";

      if (isset($display) && (strcmp($display, 'inline') === 0)) {
	$html .= "#language_switcher li { margin-right:2px;display:inline;list-style:none; }";
      }
      else {
	$html .= "#language_switcher li { list-style:none; }";
      }
      unset($display);

      $html .= "</style>";      
      $html .= "<ul id='language_switcher'>";

      foreach ($langs as $lang) {
	$html .= "<li>";
	$html .= "<a href='".current_url()."/?lang=".$lang."'>";
	switch ($mode) {
	case 'png':
	  $html .= "<img src='".base_url()."/uploads/flags/png/".$lang.".png'/>";
	  break;
	case 'gif':
	  $html .= "<img src='".base_url()."/uploads/flags/gif/".$lang.".gif'/>";
	  break;
	default:
	  $html .= $lang;
	}
	$html .= "</a></li>";
      }
      $html .= "</ul>";
    }
    return $html;
  }
}

/* End of file language.php */
<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is a language manager for PyroCMS
 *
 * @author	Antoine Benevaut
 * @date	24 sept 2012
 * @website	http://www.cavaencoreparlerdebits.fr
 * @website	http://languageswitcher.cavaencoreparlerdebits.fr
 *
 * @package	pyrocms-plugin
 * @subpackage LanguageSwitcher Plugin
 *
 */
 
class Plugin_Language extends Plugin
{
	/**
	 * Language switcher allow to display selected site language as text or
	 * image flags and allow users to change current language.
	 *
	 * Options list :
	 *
	 * mode : select mode txt or gif or png
	 * display : select display mode inline or none
	 *
	 * {{ language:switcher mode='png' display='inline' }}
 	 * {{ language:switcher mode='gif' }}
 	 *
	 */
	public function	switcher()
	{
		$html		= null;

		$mode		= $this->attribute('mode', 'txt');
		$display	= $this->attribute('display');

		Asset::add_path('language', 'assets/language/');
			
		$this->template->append_css('language::language.css');
      				
		//if ( ! ($html = $this->pyrocache->get('language-switcher-'.$mode.'-'.$display)))
		//{
			$langs		= explode(",", Settings::get('site_public_lang'));

			if (isset($langs) && !empty($langs))
			{     
				if ($display == 'dropdown')
				{
					$html = $this->_switcher_dropdown($langs, $mode);
				}
				else
				{
					$html = $this->_switcher_list($langs, $mode, $display);
				}
			}
			
		//	$this->pyrocache->write($html, 'language-switcher-'.$mode.'-'.$display, 300);
		//}
		return $html;
	}
	
	/**
	 * Language with google translate is a plugin to display dropdown options to allow users to translate
	 * your website in any language they want !
	 *
	 * visit http://translate.google.com/manager/ for more explanation on google translate for your website.
	 *
	 *
	 * Options list :
	 *
	 * container : this is the name of div id. It's used to make relation between HTML and JS.
	 *             The default container name is : google_translate_element.
	 *
	 * {{ language:google_translate container='other_name' }}
	 * {{ language:google_translate }}
 	 *
	 */
	public function google_translate()
	{
		$container		= $this->attribute('container', 'google_translate_element');
		
		return '<div id="'. $container .'"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: \''. CURRENT_LANGUAGE .'\'}, \''. $container .'\');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>';
	}

	private function _switcher_list($langs, $mode, $display = null)
	{
		$html = null;

		if (isset($display) && (strcmp($display, 'inline') === 0))
		{
			$html .= '<ul id="language_switcher-inline">';
		}
		else
		{
			$html .= '<ul id="language_switcher">';
		}

		foreach ($langs as $lang)
		{
			$html .= "<li>";
			$html .= "<a href='".current_url()."?lang=".$lang."'>";
			$html .= $this->_img_language($lang, $mode);
			$html .= '</a></li>';
		}

		$html .= '</ul>';
		return $html;
	}

	private function _switcher_dropdown($langs, $mode)
	{
		$html = '<div id="language_switcher" class="dropdown">';

		$html .= '<script type="text/javascript">
		function switchLanguage(sel) {
		    var url = sel[sel.selectedIndex].value;
		    window.location = "'.current_url().'?lang="+url;
		}</script>';

		$html .= $this->_img_language(CURRENT_LANGUAGE, $mode);

		$html .= '<select name="language_switcher" class="" onchange="switchLanguage(this);">';

		foreach ($langs as $lang)
		{
			$html .= '<option value="'.$lang.'"';
			$html .= (CURRENT_LANGUAGE == $lang ? ' selected="selected" ' : ' ').'>';
			$html .= $this->_img_language($lang, 'txt');
		}

		$html .= '</select>';
		$html .= '</div><div style="clear:both"></div>';
		return $html;
	}

	private function _img_language($lang, $mode)
	{
		$html = null;

		switch ($mode)
		{
			case 'png':
				$html = Asset::img('language::png/'.$lang.'.png', $lang, array());
			break;
			case 'gif':
				$html = Asset::img('language::gif/'.$lang.'.gif', $lang, array());
			break;
			default:
				$html = $lang;
		}
		return $html;
	}
}
/* End of file language.php */
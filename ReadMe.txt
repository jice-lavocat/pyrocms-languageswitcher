Language plugin - For PyroCMS 2.x
--------------------------------------------------------------------------------
Language switcher allow to display selected site languages as text or image and
allow users to change current language.



How to install?
--------------------------------------------------------------------------------
This package contain :
     language.php
     flags.zip


Upload language.php to plugins sections of your website.
(like : /addons/default/plugins)

Get installer/flags directory to /uploads/ to have this directory tree:
	/uploads/flags/
	/uploads/flags/png
	/uploads/flags/gif
	/uploads/flags/readme.txt



How it's work?
--------------------------------------------------------------------------------
{{ language:switcher }}

Switcher have two optionals parameters:
	 mode='txt | gif | png'
	 display='inline'

Integrate plugin with options inside your webdesign or webpages.
You can also, integrate CSS for `#language_switcher`.

Next of use languageSwitcher, you have to use the current
language variable in PyroCMS (PHP or JS) to set your content in
correct language.

Here, a solution to show/hide content directly in your content.

{{ if lang:code == "en" }}
	English text!
{{ elseif lang:code == "fr" }}
	Texte francais!
{{endif}}


Visit www.cavaencoreparlerdebits.fr
--------------------------------------------------------------------------------
Antoine Benevaut < antoine@cavaencoreparlerdebits.fr >	Wed Jan 25 10:51:53 2012

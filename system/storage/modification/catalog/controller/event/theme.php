<?php
class ControllerEventTheme extends Controller {
	public function index(&$view, &$data) {
		if (!$this->config->get($this->config->get('config_theme') . '_status')) {
			exit('Error: A theme has not been assigned to this store!');
		}
		
		// This is only here for compatibility with old themes.
		if (substr($view, -4) == '.tpl') {
			$view = substr($view, 0, -4);
		}
		
		if ($this->config->get('config_theme') == 'theme_default') {
			$directory = $this->config->get('theme_default_directory');

                if (defined('J2SERVER') || (defined('J2ENV') && $theme === 'journal2')) {
                    $theme = version_compare(VERSION, '3', '>=') ? 'journal2_oc3' : 'journal2_oc2';
                }
            
		} else {
			$directory = $this->config->get('config_theme');
		}

		if (is_file(DIR_TEMPLATE . $directory . '/template/' . $view . '.tpl')) {
			$view = $directory . '/template/' . $view;
		} else {
			$view = 'default/template/' . $view;
		}			
	}
}

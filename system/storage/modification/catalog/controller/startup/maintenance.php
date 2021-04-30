<?php
class ControllerStartupMaintenance extends Controller {
	public function index() {
		if ($this->config->get('config_maintenance')) {
			$route = '';

			if (isset($this->request->get['route'])) {
				$part = explode('/', $this->request->get['route']);

				if (isset($part[0])) {
					$route .= $part[0];
				}
			}

			// Show site if logged in as admin
			$this->user = new Cart\User($this->registry);

			
                $is_j2_assets = isset($this->request->get['route']) && strpos($this->request->get['route'], 'journal2/assets') === 0;

                if (($route != 'payment' && $route != 'api' && !$is_j2_assets) && !$this->user->isLogged()) {
            
				return new Action('common/maintenance');
			}
		}
	}
}

<?php

class Oxy_Wpcafe_El extends OxyEl {

	protected $params;
	function init() {

		$this->El->useAJAXControls();
		//$this->setAssetsPath( OXY_WOO_ASSETS_PATH );
	}
	function render($options, $defaults, $content) {
		if (method_exists($this, 'wpcafeTemplate')) {
			call_user_func($this->wpcafeTemplate());
		}
	}

	function class_names() {
		return array('oxy-wpcafe-element');
	}

	function controls() {

		//Les.Son.Compo.Nents
	}

	public function button_place() {
		$btn_place = $this->wpcafe_button_place();

		if ($btn_place){
			return "wpcafe::".$btn_place;
		}
		return "";
	}

}

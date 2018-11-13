<?php
namespace funarte;

class Edital {
	use PostType;

	protected function init() {
		$this->POST_TYPE = "edital";
		$this->POST_TYPE_NAME = "Edital";
	}
}

Edital::get_instance();
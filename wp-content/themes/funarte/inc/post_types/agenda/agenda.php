<?php
namespace funarte;

class Agenda {
	use PostType;

	protected function init() {
		$this->POST_TYPE = "agenda";
		$this->POST_TYPE_NAME = "Agenda";
	}
}

Agenda::get_instance();
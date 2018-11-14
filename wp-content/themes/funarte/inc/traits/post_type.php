<?php
namespace funarte;

trait PostType {

	protected static $instance;

	final public static function get_instance() {
		return isset(static::$instance)
			? static::$instance
			: static::$instance = new static;
	}

	final private function __construct() {
		$this->init();
	}

	protected function init() {}
}
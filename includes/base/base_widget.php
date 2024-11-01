<?php
namespace WFE\Base;

use Elementor\Widget_Base;

abstract class Base_Widget extends Widget_Base {

	public function get_categories() {
		return [ 'wfe-elements' ];
	}
}

<?php


namespace MenuRestaurant\Classes;

/**
 * Class InputNumber
 * @package MenuRestaurant\Classes
 */
class InputNumber {
	/**
	 * @var
	 */
	protected $id, $title, $name, $id_option, $options;

	public function __construct( $options, $id, $title, $page, $section, $name, $id_option ) {
		$this->id        = $id;
		$this->title     = $title;
		$this->name      = $name;
		$this->id_option = $id_option;
		$this->options   = $options;

		add_settings_field(
			$this->id, // ID
			$title, // Title
			[ $this, 'render_input_field' ], // Callback
			$page, // Page
			$section // Section
		);
	}

	/**
	 * Get the settings option array and print one of its values
	 *
	 * @param $type
	 * @param $id
	 * @param $id_option
	 * @param $name
	 */
	public function render_input_field() {
		printf(
			'<input type="number" id="%s" name="%s[%s]" value="%s" />',
			$this->id,
			$this->id_option,
			$this->name,
			isset( $this->options[ $this->id ] ) ? esc_attr( $this->options[ $this->id ] ) : ''
		);
	}
}

<?php

namespace MenuRestaurant\Classes;

/**
 * Class InputText
 * @package MenuRestaurant\Classes
 */
class InputText {

	/**
	 * @var
	 */
	protected $id, $title, $name, $id_option, $options, $button_remove;

	public function __construct( $options, $id, $title, $page, $section, $name, $id_option, $button_remove = false ) {
		$this->id            = $id;
		$this->title         = $title;
		$this->name          = $name;
		$this->id_option     = $id_option;
		$this->options       = $options;
		$this->button_remove = $button_remove;

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
			'<input type="text" id="%s" name="%s[%s]" value="%s" />',
			$this->id,
			$this->id_option,
			$this->name,
			isset( $this->options[ $this->name ] ) ? esc_attr( $this->options[ $this->name ] ) : ''
		);

		if ( $this->button_remove ) {
			$array = explode( '|', $this->name );
			$id = $array[3];
			print_r( '<a href="#" id_section="' . $id . '" class="remove_field button button-secondary">Remove</a>' );
		}
	}

}

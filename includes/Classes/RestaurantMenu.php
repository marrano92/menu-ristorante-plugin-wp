<?php

namespace MenuRestaurant\Classes;

use MenuRestaurant\Output\AdminPage;

/**
 * Class RestaurantMenu
 *
 * @package MenuRestaurant\Classes
 */
class RestaurantMenu {
	/**
	 * @var bool|mixed|void
	 */
	protected $options = [];

	/**
	 * @var string
	 */
	protected $id_page = '';

	protected function __construct() {
		// Set class property
		$this->options = get_option( 'option_menu_ristorante' );
		$this->id_page = 'menu-ristorante';

		# Actions
		add_action( 'admin_menu', [ $this, 'wpdocs_register_my_custom_menu_page' ] );
		add_action( 'admin_init', [ $this, 'page_init' ] );
		add_action( 'admin_footer', [ $this, 'wpb_hook_javascript_footer' ] );

		# Filters
	}

	/**
	 * Register a custom menu page.
	 */
	public function wpdocs_register_my_custom_menu_page() {

		add_menu_page(
			__( 'Menu Ristorante', 'textdomain' ),
			'menu ristorante',
			'manage_options',
			$this->id_page,
			[ $this, 'output_admin_page' ],
			plugins_url( 'restaurant_menu_custom/images/menu_icon.png' ),
			1
		);

		//actions
		add_action( 'admin_init', [ $this, 'page_init' ] );
	}

	public function output_admin_page() {
		( new AdminPage() )->render();
	}

	public static function init() {

		static $instance = null;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;

	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		$id_option = 'option_menu_ristorante';
		//delete_option( $id_option );
		register_setting(
			'group_menu_ristorante', // Option group
			$id_option, // Option name
			array( $this, 'sanitize' ) // Sanitize
		);
		add_settings_section(
			'setting_section_id', // ID
			'Creazione menu ristorante', // Title
			[ $this, 'print_section_info' ],// Callback
			'menu-ristorante' // Page
		);

		if ( ! empty( $this->options ) ) {
			foreach ( $this->options as $key => $option ) {
				$array = explode( '|', $key );
				$id    = $array[0];
				$type  = $array[1];
				$title = $array[2];

				switch ( $type ) {
					case 'text':
						$pos = strpos( $title, 'Sezione' );
						new InputText( $this->options, $id, $title, 'menu-ristorante', 'setting_section_id', $key, $id_option, $pos !== false );
						break;
					case 'number':
						new InputNumber( $this->options, $key, $title, 'menu-ristorante', 'setting_section_id', $key, $id_option );
						break;
				}
			}
		} else {
			new InputText( $this->options, 'titolo_menu', 'Titolo Menu', 'menu-ristorante', 'setting_section_id', 'titolo_menu|text|Titolo Menu', $id_option );
			new InputNumber( $this->options, 'id_number', 'ID Number', 'menu-ristorante', 'setting_section_id', 'id_number|number|ID Number', $id_option );

		}

	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
//		$new_input = array();
//		if ( isset( $input['id_number'] ) ) {
//			$new_input['id_number'] = absint( $input['id_number'] );
//		}
//
//		if ( isset( $input['title'] ) ) {
//			$new_input['title'] = sanitize_text_field( $input['title'] );
//		}

		return $input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info() {
		print 'Compila i seguenti campi per creare il nuovo menu:';
	}

	public function wpb_hook_javascript_footer() {
		?>
		<script>
			(function ($) {

				"use strict";

				var max_fields = 10; //maximum input boxes allowed
				var wrapper = $(".input_fields_wrap"); //Fields wrapper
				var add_button = $(".add_field_button"); //Add button ID

				var x = 1; //initlal text box count


				$(add_button).click(function (e) { //on add input button click
					e.preventDefault();
					if (x < max_fields) { //max input box allowed
						//text box increment
						$(wrapper).append('<tr id="section_' + x + '">\n' +
							'<th scope="row">Titolo sezione ' + x + '</th>\n' +
							'<td>\n' +
							'<div><input type="text" id="section_title_' + x + '" name="option_menu_ristorante[section_title_' + x + '|text|Sezione|' + x + ']"></div>\n' +
							'<a href="#" id_section="' + x + '" class="remove_field button button-secondary">Remove</a></td>\n' +
							'</tr></div>'); //add input box
						x++;
					}
				});

				$(wrapper).on("click", ".remove_field", function (e) { //user click on remove text

					e.preventDefault();
					var trSection = '#section_title_' + $(this).attr("id_section");
					console.log(trSection);
					$(trSection).closest('tr').remove();
					x--;
				});

			})(jQuery);
		</script>
		<?php
	}

}

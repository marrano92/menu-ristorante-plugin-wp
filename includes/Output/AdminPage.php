<?php

namespace MenuRestaurant\Output;

/**
 * Class AdminPage
 *
 * @package MenuRestaurant\Output
 */
class AdminPage {

	public function __construct() {
	}

	public function render() {
		$this->add_style();


		?>
		<div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
		<h1>Menu Ristorante QRCode</h1>
		<div class="wrapper wrapper--w680">
			<div class="card card-4">
				<div class="card-body">
					<form method="post" action="options.php">
						<?php
						settings_fields( 'group_menu_ristorante' );
						do_settings_sections( 'menu-ristorante' );
						?>
						<table class="form-table" role="presentation">
							<tbody class="input_fields_wrap">
							<tr>
								<th scope="row">Sezioni:</th>
							</tr>
							</tbody>
						</table>
						<button class="add_field_button button button-secondary">Aggiungi sezione</button>
						<?php submit_button(); ?>
					</form>
				</div>
			</div>
		</div>
		<?php
	}

	protected function add_style() {
		?>

		<?php
	}
}

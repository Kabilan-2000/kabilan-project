<?php
/*
Plugin Name: Contact Form Plugin
Plugin URI: http://google.com
Description: Simple WordPress Contact Form
Version: 2.0 
Author: John
Author URI: http://youtube.com
*/
// Contact Form Function
function html_form_code() {
	echo '<form action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
	echo '<p>';
	echo 'Your Name (required) <br/>';
	echo '<input type="text" name="cf-name" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
    echo 'Your phonenumber (required) <br/>';
    echo '<input type="text" phonenumber="cf-phonenumber" pattern="[1-10]+" value="' .  (isset( $_POST["cf-phonenumber"] ) ? esc_attr($_POST["cf-phonenumber"] ) : '') . ' " size="40" />';
    echo '</p>';
	echo '<p>';
	echo 'Your Email (required) <br/>';
	echo '<input type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" />';
	echo '</p>';
	echo '<p>';
	echo 'Your Message (required) <br/>';
	echo '<textarea rows="15" cols="40" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea>';
	echo '</p>';
	echo '<p><input type="submit" name="cf-submitted" value="Send"></p>';
	echo '</form>';
}
function deliver_mail() {
	// if the submit button is clicked, send the email
	if ( isset( $_POST['cf-submitted'] ) ) {
		// sanitize form values
		$name    = sanitize_text_field( $_POST["cf-name"] );
		$email   = sanitize_email( $_POST["cf-email"] );
		$phonenumber = sanitize_phonenumber( $_POST["cf-phonenumber"] );
		$message = esc_textarea( $_POST["cf-message"] );

		// get the blog administrator's email address
		$to = get_option( 'admin_email' );
        $headers = "From: $name <$email>" . "\r\n";

		// If email has been processed for sending, display a success message
		if ( wp_mail( $to, $phonenumber, $message, $headers ) ) {
			echo '<div>';
			echo '<p>Thanks for contacting me, expect a response soon.</p>';
			echo '</div>';
		} else {
			echo 'An unexpected error occurred';
		}
	}
}

// Shortcode for Contact Form
function cf_shortcode() {
	ob_start();
	deliver_mail();
	html_form_code();
	return ob_get_clean();
}

function add_custom_tab() {
    add_menu_page('Custom Tab', 'Custom Tab', 'manage_options', 'custom-tab-slug', 'custom_tab_content');
}

function custom_tab_content() {
    // Content for the custom tab
    echo '<h2>Custom Tab Content</h2>';
}

function modify_form_fields($form) {
    // Add custom activation and mapping options to form fields
    // This is a simplified example; actual implementation may vary
    $form .= '<label>Activate</label><input type="checkbox" name="activate_field">';
    $form .= '<label>Map to Lead Field</label><input type="text" name="lead_field_mapping">';
    
    return $form;
}

?>



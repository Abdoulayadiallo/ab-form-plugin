<?php
/**
* Plugin Name: Formulaire de contact
* Plugin URI: http://localhost/woocommerce
* Description: Un plugin de formulaire de contact comportant:Email, Objet, Description et le bouton Envoyez.
* Version: 1.0.0
* Author: Abdoulaye Diallo
* Author URI: http://yourdomain.com
* License: GPL2
*/
$plugins_url = WP_PLUGIN_URL.'/ab-form-plugin';
$options = array();
function ab_form_plugin_menu(){
    add_options_page(
        'Abdoulaye Formulaire plugin',
        'Plugin Formulaire',
        'manage_options',
        'ab_form_plugin',
        'ab_form_plugin_options_page',
    );
}
add_action('admin_menu','ab_form_plugin_menu');

function ab_form_plugin_options_page(){
    if(!current_user_can('manage_options')){
        wp_die("Vous n'avez pas la permission de voir cette page");
    }
    global $options;
    global $plugins_url;
    if(isset($_POST['ab_form_submitted'])){
        $hidden_field = esc_html($_POST['ab_form_submitted']);
        if($hidden_field == 'Y'){
            $ab_email = esc_html($_POST['ab_email']);
            $ab_objet = esc_html($_POST['ab_objet']);
            $ab_description = esc_html($_POST['ab_description']);
            $options['ab_email'] = $ab_email;
            $options['ab_objet'] = $ab_objet;
            $options['ab_description'] = $ab_description;

            update_option('ab_form_plugin',$options);
        }
    }
    echo  $ab_email;
    $options = get_option('ab_form_plugin');
    if($options != ''){
        $ab_email = $options['ab_email'];
        $ab_objet = $options['ab_objet'];
        $ab_description = $options['ab_description'];
    }
  
    // echo '<p> Bienvenu sur la page de mon plugin formulaire</p>';
    require('inc/options-page-wrapper.php');

}
function ab_form_backend_style(){
    wp_enqueue_style('ab_form_backend_style', plugins_url('ab-form-plugin/ab-form-style.css'));
}

//add_action('admin_head','ab_form_backend_style');

?>
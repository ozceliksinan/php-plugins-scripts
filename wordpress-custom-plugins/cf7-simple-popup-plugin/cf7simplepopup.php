<?php
/**
 * @link         https://github.com/ozceliksinan
 * @since        1.0
 * @package      cf7_simple_popup
 * 
 * @wordpress-plugin
 *
 * Plugin Name:  Contact Form 7 Simple Popup
 * Plugin URI:   https://github.com/ozceliksinan
 * Description:  This plugin will show confirmation and error messages of CF7 inside a popup made with sweetalert2.
 * Version:      1.0
 * Author:       Sinan Özçelik
 * Contributors: Sinan Özçelik
 * Author URI:   https://github.com/ozceliksinan
 * License:      GPL-3.0+
 * License URI:  http://www.gnu.org/licenses/gpl-3.0.txt
 * Requires PHP: 5.6
 * Tested up to: 6.4.1
 * Text Domain:  cf7simplepopup
 * Tags:         contact form 7, response message, popup message, popup confirmation, popup send, cf7, contact form 7, contact form seven, contact form popup, popup, popup contact form 7
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

define( 'cf7simplepopup_CORE_CSS', plugins_url( 'assets/css/', __FILE__ ) );
define( 'cf7simplepopup_CORE_JS', plugins_url( 'assets/js/', __FILE__ ) );

function cf7simplepopup_register() {
    $cf7spVersion = '1.0';
    wp_enqueue_style( 'cf7simplepopup-css', cf7simplepopup_CORE_CSS . 'cf7simplepopup-core.css', null, $cf7spVersion, 'all' );
    wp_enqueue_script( 'cf7simplepopup-js', cf7simplepopup_CORE_JS . 'cf7simplepopup-core.js', null, $cf7spVersion, 'all' );
    wp_enqueue_script( 'sweetalert', cf7simplepopup_CORE_JS . 'sweetalert2.all.min.js', null, $cf7spVersion, 'all' );
}

add_action( 'wp_enqueue_scripts', 'cf7simplepopup_register' );

function cf7windowWidthHead() {
    $width     = get_option( 'cf7simplePopupWidth' ) == true ? get_option( 'cf7simplePopupWidth' ) : "500";
    $autoClose = get_option( 'cf7simplePopupAutoClose' ) == true ? get_option( 'cf7simplePopupAutoClose' ) : "7000";
    echo '<script>';
    echo 'var cf7windowWidth = ' . $width . ';';
    echo 'var cf7simplePopupAutoClose = ' . $autoClose . ';';
    echo '</script>';
}

add_action( 'wp_head', 'cf7windowWidthHead' );

add_action( 'admin_menu', 'cf7simplepopup_admin' );

function cf7simplepopup_admin() {
    add_submenu_page(
        'wpcf7',
        __( 'CF7 Sweet Alert Settings', 'cf7simplepopup' ),
        __( 'CF7 Popup Settings', 'cf7simplepopup' ),
        'manage_options',
        'cf7-simplepopup',
        'cf7simplepopup_page_callback' );
}

function cf7simplepopup_page_callback() {
    if ( isset($_POST['cf7simplePopupNonce']) && ! wp_verify_nonce( $_POST['cf7simplePopupNonce'], __FILE__ ) ) {
        update_option( 'cf7simplePopupWidth', $_POST['cf7simplePopupWidth'] );
        update_option( 'cf7simplePopupAutoClose', $_POST['cf7simplePopupAutoClose'] );
    }
    ?>
    <div class="wrap">
        <h1>
            <?php _e( 'CF7 Sweet Alert Ayarları', 'cf7simplepopup' ) ?>
        </h1>
        <p>
            <?php echo '<span class="dashicons dashicons-info" aria-hidden="true"></span> ' . __( 'Varsayılan değerler için kutuları boş bırakabilirsiniz.', 'cf7simplepopup' ) ?>
        </p>
        <form method="post">
            <?php wp_nonce_field( 'cf7simplePopup', 'cf7simplePopupNonce' ); ?>
            <table class="form-table">
                <tr>
                    <th><label for="cf7simplePopupWidth">
                            <?php _e( 'Açılır Pencere Genişliği', 'cf7simplepopup' ); ?>
                        </label></th>
                    <td>
                        <input type="text" name="cf7simplePopupWidth" id="cf7simplePopupWidth" value="<?php echo get_option( 'cf7simplePopupWidth' ); ?>" class="regular-text" placeholder="Default: 500px">
                        <p class="description" id="tagline-description">
                            <?php _e( 'Lütfen <b>Pixel</b> Cinsinden Giriş Yapınız.', 'cf7simplepopup' ); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th><label for="cf7simplePopupWidth">
                            <?php _e( 'Açılır Pencere Otomatik Kapanma Süresi', 'cf7simplepopup' ); ?>
                        </label></th>
                    <td>
                        <input type="text" name="cf7simplePopupAutoClose" id="cf7simplePopupAutoClose" value="<?php echo get_option( 'cf7simplePopupAutoClose' ); ?>" class="regular-text" placeholder="Default: 7000ms">
                        <p class="description" id="tagline-description">
                            <?php _e( 'Lütfen değeri milisaniye cinsinden girin. <b>1 Saniye = 1000ms</b>', 'cf7simplepopup' ); ?>
                        </p>
                    </td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Ayarları Kaydet', 'cf7simplepopup' ); ?>"></p>
        </form>
    </div>
    <?php
}
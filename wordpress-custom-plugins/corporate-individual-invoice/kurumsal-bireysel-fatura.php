<?php

/**
 * Plugin Name: Bireysel Kurumsal Fatura Seçimi
 * Description: Ödeme alanında bireysel veya kurumsal fatura seçimi yapılmasını sağlar
 * Version: 1.1
 * Author: Sinan ÖZÇELİK
 * Author URI: https://github.com/ozceliksinan
*/


/********************************************************************************/
/*                START -> ÖDEME SAYFASI FORM DÜZENLEMESİ                       */
/********************************************************************************/

/********************************************************************************/
/*          Optional Tag ( Zorunlu Değil ) Alanının Kaldırılması                */
/********************************************************************************/
add_filter( 'woocommerce_form_field' , 'elex_remove_checkout_optional_text', 10, 4 );
function elex_remove_checkout_optional_text( $field, $key, $args, $value ) {
if( is_checkout() && ! is_wc_endpoint_url() ) {
$optional = '&nbsp;<span class="optional">(' . esc_html__( 'optional', 'woocommerce' ) . ')</span>';
$field = str_replace( $optional, '', $field );
}
return $field;
} 
/********************************************************************************/

function custom_override_checkout_fields( $fields ) {
	unset($fields['billing']['billing_address_2']);
	$fields['billing']['billing_country'];
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_company']);
	//unset($fields['order']['order_comments']);
	$fields['billing']['billing_address_1']['label'] = 'Adres';
	$fields['billing']['billing_address_1']['placeholder'] = 'Mahalle, Sokak, Bina No, Daire vb.';
	$fields['billing']['billing_address_1']['priority'] = '9';
	$fields['billing']['billing_first_name']['placeholder'] = 'Ad';
	$fields['billing']['billing_first_name']['label'] = 'Ad';
	$fields['billing']['billing_first_name']['priority'] = '5';
	$fields['billing']['billing_first_name']['class'] = array('form-row-wide');
	$fields['billing']['billing_last_name']['placeholder'] = 'Soyad';
	$fields['billing']['billing_last_name']['label'] = 'Soyad';
	$fields['billing']['billing_last_name']['priority'] = '6';
	$fields['billing']['billing_last_name']['class'] = array('form-row-wide');
	$fields['billing']['billing_city']['label'] = 'İlçe';
	$fields['billing']['billing_city']['priority'] = '8';
	$fields['billing']['billing_city']['placeholder'] = 'İlçe';
	unset($fields['shipping']['shipping_address_2']);
	$fields['shipping']['shipping_country'];
	unset($fields['shipping']['shipping_postcode']);
	unset($fields['shipping']['shipping_company']);
	$fields['shipping']['shipping_address_1']['label'] = 'Adres';
	$fields['shipping']['shipping_address_1']['priority'] = '9';
	$fields['shipping']['shipping_city']['label'] = 'İlçe';
	$fields['shipping']['shipping_city']['placeholder'] = 'İlçe';
	$fields['shipping']['shipping_address_1']['placeholder'] = 'Mahalle, Sokak, Bina No, Daire vb.';
	$fields['shipping']['shipping_first_name']['placeholder'] = 'Ad';
	$fields['shipping']['shipping_first_name']['label'] = 'Ad';
	$fields['shipping']['shipping_last_name']['placeholder'] = 'Soyad';
	$fields['shipping']['shipping_last_name']['label'] = 'Soyad';
	return $fields;
	}
	
	add_filter('woocommerce_checkout_fields','custom_override_checkout_fields');
	
	//add_filter( 'woocommerce_enable_order_notes_field', '__return_false', 9999 );
	
	//T.C. No, Vergi No ve Vergi Dairesi Alanlarını Oluştur
	add_filter('woocommerce_checkout_fields', 'tc_vergi_icin_new_checkout_field');
	
	function tc_vergi_icin_new_checkout_field($fields)
	{
	$fields['billing']['checkbox_tckno'] = array(
	'type' => 'checkbox',
	'priority' => 1,
	'label' => __('Bireysel', 'woocommerce'),
	'class' => array('form-row-wide'),
	'clear' => true
	);
	$fields['billing']['checkbox_trigger'] = array(
	'type' => 'checkbox',
	'priority' => 2,
	'label' => __('Kurumsal Fatura', 'woocommerce'),
	'class' => array('form-row-wide'),
	'clear' => true
	);
	
	$fields['billing']['billing_tc_kimlik_no'] = array(
		'label'     => __('Vergi / Bireysel', 'woocommerce'),
		'placeholder'   => _x('Vergi No', 'placeholder', 'woocommerce'),
		'class'     => array('form-row form-row-wide'),
		'required' => true,
		'priority' => 3,
		'clear'     => true
	);
	
	$fields['billing']['billing_vergi_dairesi'] = array(
		'label'     => __('Vergi Dairesi', 'woocommerce'),
		'placeholder'   => _x('Vergi Dairesi', 'placeholder', 'woocommerce'),
		'class'     => array('form-row form-row-wide'),
		'required' => true,
		'priority' => 4,
		'clear'     => true
	);
	
	if (!isset($_POST['checkbox_trigger'])) {
		$fields['billing']['billing_tc_kimlik_no']['required'] = false;
		$fields['billing']['billing_vergi_dairesi']['required'] = false;
	} else {
		$fields['billing']['billing_tc_kimlik_no']['required'] = true;        
		$fields['billing']['billing_vergi_dairesi']['required'] = true;
	}
		if (!isset($_POST['checkbox_trigger'])) {
		$fields['billing']['billing_tc_kimlik_no']['default'] = '11111111111';
		} else {
		$fields['billing']['billing_tc_kimlik_no']['default'] = '11111111111';
	}
	
	return $fields;
	}
	// TC Doğrula Fonksiyonu
	function isTcKimlik($tc)
	{
	if (strlen($tc) < 10) {
	return false;
	}
	if ($tc[0] == '0') {
	return false;
	}
	
	return true;
	}
	// TC Kimlik Noyu Doğrula
	add_action('woocommerce_checkout_process', 'tc_numara_dogrula');
	
	function tc_numara_dogrula()
	{
	$tcno = $_POST['billing_tc_kimlik_no'];
	if (!empty($tcno)) {
	if (!is_numeric($tcno) && !isset($_POST['checkbox_tckno'])) {
	wc_add_notice(('Lütfen Vergi Numaranızı yada TC Kimlik Numaranızı kontrol edin.'), 'error');
	} else if (!empty($tcno) && !isset($_POST['checkbox_tckno'])) {
	if (!isTcKimlik($tcno))
	wc_add_notice(('Lütfen Vergi Numaranızı yada TC Kimlik Numaranızı kontrol edin.'), 'error');
	}
	}
	}
	//Adminin Sipariş Detayında Fatura Bilgilerinde TC No ve Vergi Dairesi Görebilmesi İçin
	add_action('woocommerce_admin_order_data_after_billing_address', 'vergi_no_dairesi', 10, 1);
	
	function vergi_no_dairesi($order)
	{
	echo '
	
	' . __('Vergi / TC Kimlik No') . ': ' . $tc_kimlik_no = get_post_meta($order->get_id(), '_billing_tc_kimlik_no', true) . '
	
	';
	echo '
	' . __('Vergi Dairesi') . ': ' . $vergi_dairesi = get_post_meta($order->get_id(), '_billing_vergi_dairesi', true) . '
	
	';
	}
	//Koşullara göre alanları göstermek için gerekli javascript kodları
	
	add_action('woocommerce_after_checkout_form', 'kosullu_alan_goster', 6);
	
	function kosullu_alan_goster()
	{
	
	?>
	<script type="text/javascript">
		jQuery('#payment_method_paytrcheckout').hide()
		jQuery('#ship-to-different-address').show()
		jQuery('.woocommerce-billing-fields > h3').html('Adres bilgileri');
			jQuery('#billing_tc_kimlik_no').hide();
			 jQuery('#billing_vergi_dairesi').hide();
		jQuery('#billing_tc_kimlik_no_field  > label').hide();
			jQuery('#billing_vergi_dairesi_field  > label').hide();
			   jQuery("#billing_tc_kimlik_no_field > label").append("<abbr class='required' title='gerekli'>*</abbr>");
			jQuery("#billing_vergi_dairesi_field > label").append("<abbr class='required' title='gerekli'>*</abbr>");
		
		jQuery('input#checkbox_trigger').change(function() {
			if (this.checked) {
	
			jQuery('.woocommerce-billing-fields > h3').html('Fatura bilgileri');
			jQuery("#checkbox_tckno").prop( "checked", false );
			jQuery('#billing_tc_kimlik_no').show();
					jQuery('#billing_vergi_dairesi').show();
					jQuery('#billing_last_name_field').hide();
					jQuery('#billing_tc_kimlik_no_field  > label').show();				
					jQuery('#billing_vergi_dairesi_field  > label').show();
					jQuery('#billing_tc_kimlik_no_field > label > span').remove();
					jQuery('#billing_vergi_dairesi_field > label > span').remove();
					jQuery('#billing_tc_kimlik_no_field').addClass('validate-required');
					jQuery('#billing_vergi_dairesi_field').addClass('validate-required');
			jQuery('#billing_first_name_field > label').html('Şirket Ünvanı&nbsp;<abbr class="required" title="gerekli">*</abbr>')
			jQuery('#billing_tc_kimlik_no').attr("value", "")
			jQuery('#billing_first_name').attr("placeholder", "Şirket Ünvanı")
			jQuery('#billing_first_name_field').attr("class", "form-row form-row-wide validate-required fullwidth_custom")
	
			jQuery('#ship-to-different-address').show()
			jQuery('#billing_tc_kimlik_no').attr("placeholder", "Vergi No")
			jQuery('#billing_tc_kimlik_no_field').attr("class", "form-row form-row form-row-wide ")
			jQuery('#billing_tc_kimlik_no_field > label').html('Vergi No&nbsp;<abbr class="required" title="gerekli">*</abbr>')
	
			} else {				
			jQuery('.woocommerce-billing-fields > h3').html('Adres bilgileri');
					jQuery('#billing_last_name_field').show();
					jQuery('#billing_vergi_dairesi').hide();
					jQuery('#billing_vergi_dairesi_field > label').hide();
					jQuery('#billing_vergi_dairesi').hide();
					jQuery('#billing_tc_kimlik_no').hide();
					jQuery('#billing_vergi_dairesi_field > label').hide();
					jQuery('#billing_tc_kimlik_no_field  > label').hide();
			jQuery('#billing_first_name_field > label').html('Ad&nbsp;<abbr class="required" title="gerekli">*</abbr>')
			jQuery('#billing_tc_kimlik_no').attr("value", "11111111111")
			jQuery('#billing_first_name').attr("placeholder", "Ad")
			jQuery('#billing_first_name_field').attr("class", "form-row form-row-wide validate-required")
			jQuery('#billing_tc_kimlik_no_field > label').html('TC Kimlik No&nbsp;<abbr class="required" title="gerekli">*</abbr>')
			jQuery('#ship-to-different-address').show()
			}
	
		});
		jQuery('input#checkbox_tckno').change(function() {
			if (this.checked) {
			jQuery( "#checkbox_trigger" ).prop( "checked", false );
					jQuery('#billing_tc_kimlik_no').show();
					jQuery('#billing_tc_kimlik_no_field  > label').show();
					jQuery('#billing_tc_kimlik_no_field > label > span').remove();
					jQuery('#billing_tc_kimlik_no_field').addClass('validate-required');
			jQuery('#billing_tc_kimlik_no').attr("value", "")
			jQuery('#billing_first_name').attr("placeholder", "Ad")
			jQuery('#billing_tc_kimlik_no').attr("placeholder", "TC Kimlik No")
			jQuery('#billing_tc_kimlik_no_field').attr("class", "form-row form-row form-row-wide fullwidth_custom ")
					jQuery('#billing_last_name_field').show()
			jQuery('#billing_first_name_field > label').html('Ad&nbsp;<abbr class="required" title="gerekli">*</abbr>')
				
					jQuery('#billing_vergi_dairesi').hide();
					jQuery('#billing_vergi_dairesi_field > label').hide();
					jQuery('#billing_vergi_dairesi').hide();
					jQuery('#billing_vergi_dairesi_field > label').hide();
			jQuery('#billing_first_name_field').attr("class", "form-row form-row-wide validate-required")
			jQuery('#billing_tc_kimlik_no_field > label').html('TC Kimlik No&nbsp;<abbr class="required" title="gerekli">*</abbr>')
			jQuery('#ship-to-different-address').show()
			jQuery('.woocommerce-billing-fields > h3').html('Adres bilgileri');
	
			} else {
					jQuery('#billing_tc_kimlik_no').hide();
					jQuery('#billing_tc_kimlik_no_field  > label').hide();
			jQuery('#billing_tc_kimlik_no').attr("value", "11111111111")
			jQuery('#billing_first_name').attr("placeholder", "Ad")
			jQuery('#billing_tc_kimlik_no').attr("placeholder", "Vergi No")
			jQuery('#billing_tc_kimlik_no_field').attr("class", "form-row form-row form-row-wide ")
			jQuery('#billing_first_name_field').attr("class", "form-row form-row-wide validate-required")
					jQuery('#billing_last_name_field').show()
			jQuery('#billing_first_name_field > label').html('Ad&nbsp;<abbr class="required" title="gerekli">*</abbr>')
			jQuery('#billing_tc_kimlik_no_field > label').html('Vergi No&nbsp;<abbr class="required" title="gerekli">*</abbr>')
				
			}
		});
	</script>

<?php

}

/********************************************************************************/
/*                   END -> ÖDEME SAYFASI FORM DÜZENLEMESİ                      */
/********************************************************************************/
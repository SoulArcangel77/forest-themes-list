<?php 
$html_shortcode = '';
$page = !empty($_GET['ftl_page']) ? $_GET['ftl_page'] : "1";
$content = wp_remote_get("http://themeforest.net/category/".$ftl_category."?view=grid&date=this-year&page=$page");
if ( 200 == $content['response']['code'] && isset($content['body']) ) {
	$body = $content['body'];
	/*$elements = substr($body, strpos($body, html_entity_decode('<div class="content-l content-right">')));
	$elements = substr($elements, 0, strpos($elements, html_entity_decode('</nav>')));
	echo $elements;*/
	$doc = new DOMDocument();
	$doc->loadHTML($body);
	$finder = new DomXPath($doc);
	$html_shortcode .= '<div id="ftl_container">';
	/* Show theme list */
	foreach( $finder->query("//ul[@class='item-grid']") as $element)
		$html_shortcode .=  '<div id="ftl_gallery">'.$doc->saveHTML($element).'</div>';
	/* Show pagination */
	foreach( $finder->query("//ul[@class='pagination__list']") as $element)
		$html_shortcode .=  '<div id="ftl_pagination">'.$doc->saveHTML($element).'</div>';
	/* Show Evanto logo */
	$html_shortcode .=  '<div id="ftl_gallery_footer"><img src="http://extras.envato.com/wp-content/uploads/2011/07/EnvatoAPI_small.png" style="width:200px" /></div>';
	$html_shortcode .=  '</div>';
	
	/* pass options in javascript */
	$html_shortcode .=  '<script type="text/javascript">';
	if(array_key_exists('user_name',$ftl_options)){
		$html_shortcode .=  'var ftl_evanto_username = "'.$ftl_options['user_name'].'";'."\n\r";
	}
	if(array_key_exists('price_change',$ftl_options)){
		$html_shortcode .=  'var ftl_price_change = "'.$ftl_options['price_change'].'";'."\n\r";
	}
	if(array_key_exists('price_symbol',$ftl_options)){
		$html_shortcode .=  'var ftl_price_symbol = "'.$ftl_options['price_symbol'].'";'."\n\r";
	}
	if(array_key_exists('price_symbol',$ftl_options)){
		$html_shortcode .=  'var ftl_active_form = "'.$ftl_options['active_form'].'";'."\n\r";
	}
	if(!empty($ftl_selectedTheme_input)){
		$html_shortcode .=  'var ftl_selectedTheme_input = "'.$ftl_selectedTheme_input.'";'."\n\r";
	}
    $html_shortcode .=  '</script>';
}else{
	$html_shortcode .=  __("Nessun risultato trovato!",'forest-themes-list');
}
?>
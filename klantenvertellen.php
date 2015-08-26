<?php
/*
Plugin Name: Klantenvertellen
Plugin URI: http://expertees.nl
Description: Klantenvertellen plugin
Version: 1.0
Author: Expertees <ties@expertees.nl>
Author URI: http://expertees.nl
*/

function getSnippet($attr)
{

	if(!isset($attr['slug']))
		return;

	$slug = $attr['slug'];
	$v    = (isset($attr['v'])) ? $attr['v'] : 'v1';


	$average = wp_cache_get('average', 'klantenvertellen');
	$total   = wp_cache_get('total', 'klantenvertellen');


	// get from xml if cache is empty
	if($average === FALSE || $total === FALSE)
	{
		$data  = file_get_contents('http://www.klantenvertellen.nl/xml/'.$slug.'/all');

		$xml   = simplexml_load_string($data);
		$json  = json_encode($xml);
		$array = json_decode($json, TRUE);

		$stats = $array['statistieken'];

		$average = $stats['gemiddelde'];
		$total   = $stats['aantalbeoordelingen'];


		wp_cache_set('average', $average, 'klantenvertellen', 86400);
		wp_cache_set('total', $total, 'klantenvertellen', 86400);
	}
	?>

	<div class="recommendation-container" itemscope itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating">
        <meta itemprop="bestRating" content="10">
        <meta itemprop="worstRating" content="0">
        <meta itemprop="ratingCount" content="<?=$total?>">
        <meta itemprop="ratingValue" content="<?=$average?>">
   		<iframe frameborder="0" allowtransparency="true" class="recommendation" src="http://klantenvertellen.nl/widget/<?=$v?>/<?=$slug?>"></iframe>
    </div>

	<?

}

add_shortcode('klantenvertellen', 'getSnippet');

<?php
/*
Plugin Name: Klantenvertellen
Plugin URI: http://expertees.nl
Description: Klantenvertellen plugin
Version: 1.1
Author: Expertees <ties@expertees.nl>
Author URI: http://expertees.nl
*/

function file_get_contents_curl($url)
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       

    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
}

function getSnippet($attr)
{

  if(!isset($attr['slug']))
    return;

  $slug       = $attr['slug'];
  $v          = (isset($attr['v'])) ? '&version='.$attr['v'] : '&version=1';
  $width      = (isset($attr['width'])) ? $attr['width'] : '100';
  $height     = (isset($attr['height'])) ? $attr['height'] : '140';
  $dark       = (isset($attr['dark']) == 'true') ? '&color=dark' : '';


  $name       = (isset($attr['name'])) ? $attr['name'] : NULL;
  $street     = (isset($attr['street'])) ? $attr['street'] : NULL;
  $postalcode = (isset($attr['postalcode'])) ? $attr['postalcode'] : NULL;
  $city       = (isset($attr['city'])) ? $attr['city'] : NULL;
  $telephone  = (isset($attr['telephone'])) ? $attr['telephone'] : NULL;

  $hide       = (isset($attr['hide']) == 'true') ? TRUE : FALSE;


  $average    = wp_cache_get('average', 'klantenvertellen');
  $total      = wp_cache_get('total', 'klantenvertellen');

  

  // get from xml if cache is empty
  if(($average === FALSE || !is_numeric($average)) || ($total === FALSE || !is_numeric($total)))
  {
    $data = file_get_contents_curl('https://www.klantenvertellen.nl/xml/'.$slug.'/all');
    
    $xml   = simplexml_load_string($data);
    $json  = json_encode($xml);
    $array = json_decode($json, TRUE);

    $stats = $array['statistieken'];

    $average = $stats['gemiddelde'];
    $total   = $stats['aantalbeoordelingen'];


    wp_cache_set('average', $average, 'klantenvertellen', 86400);
    wp_cache_set('total', $total, 'klantenvertellen', 86400);
  }

  ob_start();
  ?>

  <address class="klantenvertellen-widget" itemscope itemtype="http://schema.org/localbusiness">
          
        <? if($name != NULL || $street != NULL || $postalcode != NULL || $city != NULL || $telephone != NULL): ?>
        <div <? if($hide):?>style="display:none;"<? endif; ?>>
              <? if($name != NULL): ?><span class="name" itemprop="name"><?=$name?></span><? endif; ?>
              <div class="address" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                    <? if($street != NULL): ?><span class="street" itemprop="streetAddress"><?=$street?></span><br><? endif; ?>
                    <? if($postalcode != NULL): ?><span class="postalcode" itemprop="postalCode"><?=$postalcode?></span><br><? endif; ?>
                    <? if($city != NULL): ?><span class="city" itemprop="addressLocality"><?=$city?></span><br><? endif; ?>
                    <? if($telephone != NULL): ?><span class="telephone" itemprop="telephone"><?=$telephone?></span><br><? endif; ?>                 
              </div>
        </div>
        <? endif; ?>

         <div class="recommendation-container" itemscope itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating">
              <meta itemprop="bestRating" content="10">
              <meta itemprop="worstRating" content="0">
              <meta itemprop="ratingCount" content="<?=$total?>">
              <meta itemprop="ratingValue" content="<?=$average?>">
          <iframe frameborder="0" allowtransparency="true" width="<?=$width?>" height="<?=$height?>" class="recommendation" src="//klantenvertellen.nl/widget/dtg/<?=$slug?>/?<?=$v?><?=$dark?>"></iframe>
        </div>

  </address>

  <?

  return ob_get_clean();

}


function displaySnippet($attr)
{
    return getSnippet($attr);
}


add_shortcode('klantenvertellen', 'displaySnippet');

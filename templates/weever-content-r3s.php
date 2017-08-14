<?php

$html = WeeverSimpleHTMLDomHelper::str_get_html( $jsonHtml->html );

foreach ( @$html->find('img') as $vv )
{
    if ( $vv->src )
    {
        $jsonHtml->image = WeeverHelper::make_absolute($vv->src, site_url());
        break;
    }
}

if ( ! $jsonHtml->image )
    $jsonHtml->image = "";

// Mask external links so we leave only internal ones to play with.
$jsonHtml->html = str_replace( "href=\"http://", "hrefmask=\"weever://", $jsonHtml->html );
$jsonHtml->html = str_replace( "href='http://", "hrefmask='weever://", $jsonHtml->html );

// For HTML5 compliance, we take out spare target="_blank" links just so we don't duplicate
$jsonHtml->html = str_replace( "target=\"_blank\"", "", $jsonHtml->html );
$jsonHtml->html = str_replace( "target='_blank'", "", $jsonHtml->html );

//$jsonHtml->html = str_replace( "href=\"", "target=\"_blank\" href=\"", $jsonHtml->html );
//$jsonHtml->html = str_replace("src=\"/", "src=\"".get_site_url()."/", $jsonHtml->html);
//$jsonHtml->html = str_replace("src=\"images", "src=\"".get_site_url()."/images", $jsonHtml->html);

// Change all links to absolute vs. relative
// http://wintermute.com.au/bits/2005-09/php-relative-absolute-links/
$jsonHtml->html = preg_replace( '#(href|src)="([^:"]*)("|(?:(?:%20|\s|\+)[^"]*"))#', '$1="' . get_site_url() . '$2$3', $jsonHtml->html );
$jsonHtml->html = preg_replace( '#(href|src)=\'([^:\']*)(\'|(?:(?:%20|\s|\+)[^\']*\'))#', '$1=\'' . get_site_url() . '$2$3', $jsonHtml->html );

// Restore external links, ensure target="_blank" applies
$jsonHtml->html = str_replace( "hrefmask=\"weever://", "target=\"_blank\" href=\"http://", $jsonHtml->html);
$jsonHtml->html = str_replace( "hrefmask='weever://", "target=\"_blank\" href='http://", $jsonHtml->html);
$jsonHtml->html = str_replace( "<iframe title=\"YouTube video player\" width=\"480\" height=\"390\"",
    "<iframe title=\"YouTube video player\" width=\"160\" height=\"130\"", $jsonHtml->html );

// Add full=1 to the end of all links
// With query param
$jsonHtml->html = preg_replace( '`(href)="http([^?"]*)\?([^?"#]*)(#)?([^?"#]*)"`i', '$1="http$2?$3&full=1$4$5"', $jsonHtml->html );
$jsonHtml->html = preg_replace( '`(href)=\'http([^?\']*)\?([^?\']*)(#)?([^?\'#]*)\'`i', '$1=\'http$2?$3&full=1$4$5\'', $jsonHtml->html );
// Without query param
$jsonHtml->html = preg_replace( '`(href)="http([^?"#]*)(#)?([^?"#]*)"`i', '$1="http$2?full=1$3$4"', $jsonHtml->html );
$jsonHtml->html = preg_replace( '`(href)=\'http([^?\']*)(#)?([^?\'#]*)\'`i', '$1=\'http$2?full=1$3$4\'', $jsonHtml->html );
//$jsonHtml->html = preg_replace( '#(href)=("|\')http(.*)(?)([^("|\')]*)\2#', '$1=$2http$3$4$5&full=1$2', $jsonHtml->html );
//$jsonHtml->html = preg_replace( '#(href)=("|\')http([^\2]+)(\2)#', '$1=$2http$3?full=1$2', $jsonHtml->html );

// Make sure any internal app links aren't affected by the full=1
$jsonHtml->html = str_replace('?full=1#!/', '#!/', $jsonHtml->html);
$jsonHtml->html = str_replace('full=1#!/', '#!/', $jsonHtml->html);

// Add the geo data if any
if ( function_exists( 'get_post_meta' ) ) {
    if ( get_post_meta( get_the_ID(), 'geo_public', true ) != '' ) {
        // Make sure geo is enabled on the post and pass the lat/lon
        $geo_on = get_post_meta( get_the_ID(), 'geo_enabled', true );
        if ( '' == $geo_on )
            $geo_on = true;

        if ( $geo_on ) {
            $geo_latitude = get_post_meta( get_the_ID(), 'geo_latitude', true );
            $geo_longitude = get_post_meta( get_the_ID(), 'geo_longitude', true );
            $geo_address = get_post_meta( get_the_ID(), 'weever_map_address', true ) ? get_post_meta( get_the_ID(), 'weever_map_address', true ) : get_post_meta( get_the_ID(), 'geo_address', true );

            $jsonHtml->geo[0]['latitude'] = $geo_latitude;
            $jsonHtml->geo[0]['longitude'] = $geo_longitude;
            $jsonHtml->geo[0]['altitude'] = '';
            $jsonHtml->geo[0]['address'] = $geo_address;
            $jsonHtml->geo[0]['label'] = '';
            $jsonHtml->geo[0]['marker'] = get_post_meta( get_the_ID(), 'weever_map_marker', true );
            $jsonHtml->geo[0]['kml'] = get_post_meta( get_the_ID(), 'weever_kml', true );
        }
    }

    if ( ! isset( $jsonHtml->geo[0] ) and get_post_meta( get_the_ID(), '_wp_geo_latitude', true ) != '' and get_post_meta( get_the_ID(), '_wp_geo_longitude', true ) != '' ) {
        // WP Geo
        $jsonHtml->geo[0]['latitude'] = get_post_meta( get_the_ID(), '_wp_geo_latitude', true );
        $jsonHtml->geo[0]['longitude'] = get_post_meta( get_the_ID(), '_wp_geo_longitude', true );
        $jsonHtml->geo[0]['altitude'] = '';
        $jsonHtml->geo[0]['address'] = get_post_meta( get_the_ID(), 'weever_map_address', true );
        $jsonHtml->geo[0]['label'] = '';
        $jsonHtml->geo[0]['marker'] = get_post_meta( get_the_ID(), 'weever_map_marker', true );
        $jsonHtml->geo[0]['kml'] = get_post_meta( get_the_ID(), 'weever_kml', true );
    }

    if ( ! isset( $jsonHtml->geo[0] ) and get_post_meta( get_the_ID(), 'weever_kml', true ) != '' ) {
        // Just KML
        $jsonHtml->geo[0]['latitude'] = '';
        $jsonHtml->geo[0]['longitude'] = '';
        $jsonHtml->geo[0]['altitude'] = '';
        $jsonHtml->geo[0]['address'] = get_post_meta( get_the_ID(), 'weever_map_address', true );
        $jsonHtml->geo[0]['label'] = '';
        $jsonHtml->geo[0]['marker'] = get_post_meta( get_the_ID(), 'weever_map_marker', true );
        $jsonHtml->geo[0]['kml'] = get_post_meta( get_the_ID(), 'weever_kml', true );
    }
}



<?php
    require_once('geoplugin.class.php');
    $geoplugin = new geoPlugin();
    $geoplugin->locate();

/*
echo "Geolocation results for {$geoplugin->ip}: <br />\n".
        "City: {$geoplugin->city} <br />\n".
        "Region: {$geoplugin->region} <br />\n".
        "Continent: {$geoplugin->continentCode} <br \>".
		"Area Code: {$geoplugin->areaCode} <br />\n".
        "DMA Code: {$geoplugin->dmaCode} <br />\n".
        "Country Name: {$geoplugin->countryName} <br />\n".
        "Country Code: {$geoplugin->countryCode} <br />\n".
        "Longitude: {$geoplugin->longitude} <br />\n".
        "Latitude: {$geoplugin->latitude} <br />\n".
    "Currency Code: {$geoplugin->currencyCode} <br />\n".
    "Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
    "Exchange Rate: {$geoplugin->currencyConverter} <br />\n";
	*/
	
	$continent_short = "{$geoplugin->continentCode}";
	$healthy = array("EU", "AU", "US");
	$yummy   = array("Europe", "Australia", "America");
	$continent = str_replace($healthy, $yummy, $continent_short);
	echo "$continent/{$geoplugin->city}";
?>
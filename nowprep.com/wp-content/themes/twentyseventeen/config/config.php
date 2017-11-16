<?php
define("APIKEY", "cb1edad023dd52f0");
define("APISERVER","http://api.wunderground.com/api/");
define("APIFORMAT", ".json");

define("API_WEATHER_ENDPOINT","/geolookup/conditions/forecast/q/");
define("API_ALERTS_ENDPOINT","/alerts/q/");
define("API_CURRENT_HURRICANE_ENDPOINT","/currenthurricane/view");

define("API_ZIP","http://api.zippopotam.us/us/");
define("API_GOOGLE_ZIP","https://maps.googleapis.com/maps/api/geocode/json?address=");
define("API_GOOGLE_ZIP_BY_COORDINATE","https://maps.googleapis.com/maps/api/geocode/json?latlng=");
$filter = '$filter';

define("API_FEMA_ENDPOINT_WITHOUT_FILTER","https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$filter=declarationDate%20ge%20");
define("API_FEMA_ENDPOINT_STATE_FILTER","https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$filter=declarationDate%20ge%20'2017-01-01T04:00:00.000z'%20and%20state%20eq%20");
define("API_FEMA_ENDPOINT_STATE_H_FILTER","https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$filter=declarationDate%20le%20'2000-01-01T04:00:00.000z'%20and%20state%20eq%20");
define("API_FEMA_ENDPOINT_COUNTY_FILTER","https://www.fema.gov/api/open/v1/DisasterDeclarationsSummaries?$filter=declarationDate%20ge%20'2017-01-01T04:00:00.000z'%20and%20declaredCountyArea%20eq%20");

define("API_USGS_ENDPOINT_EARTHQUAKE_HISTORY","https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson");
define("API_USGS_ENDPOINT_EARTHQUAKE_REALTIME","https://earthquake.usgs.gov/fdsnws/event/1/query?format=geojson");

define("API_SPOTCRIME_ENDPOINT_REALTIME","http://api.spotcrime.com/crimes.json");
//define("API_SPOTCRIME_ENDPOINT_REALTIME","https://api.spotcrime.com/crimes.json?lat=%s&lon=%s&radius=%s&key=%s");
define("API_SPOTCRIME_KEY","privatekeyforspotcrimepublicusers-commercialuse-877.410.1607");



define("DTDB_HOST","localhost");
define("DTDB_NAME","nowprep");
define("DTDB_USER","root");
define("DTDB_PASSWORD","eMmqTdArs5rF");

/*

set @latitude=40.7484;
set @longitude=-73.9967;
set @radius=1;

set @lng_min = @longitude - @radius/abs(cos(radians(@latitude))*69);
set @lng_max = @longitude + @radius/abs(cos(radians(@latitude))*69);
set @lat_min = @latitude - (@radius/69);
set @lat_max = @latitude + (@radius/69);

SELECT * FROM zips
WHERE (FIELD11 BETWEEN @lng_min AND @lng_max)
AND (FIELD10 BETWEEN @lat_min and @lat_max);

SELECT * FROM zips
WHERE (FIELD11 BETWEEN (-73.9967 - 1/abs(cos(radians(40.7484))*69)) AND (-73.9967 + 1/abs(cos(radians(40.7484))*69)))
AND (FIELD10 BETWEEN (40.7484 - (1/69)) and (40.7484 + (1/69)))
 */
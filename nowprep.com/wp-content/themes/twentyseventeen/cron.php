<?php
require_once('config/config.php');
require_once('classes/class.WunderGround.php');
//error_reporting(0);

/*$wunderground = new WunderGround();
if( $wunderground->dbConnect) {
    $eqs = $wunderground->getUSGSHistoryData();
    if ($eqs != null) {
        echo "EQ count: " . count($eqs) . "\n";
    }
}


$wunderground = new WunderGround();
if( $wunderground->dbConnect) {
    $eqs = $wunderground->getEarthquakeFromDBByZip('[""]');
    if (is_array($eqs)) {
        foreach ($eqs as $eq) {
            if (is_object($eq)) {
                //var_dump($eq);die();
                $zipcode = $wunderground->getZipByCoordinate($eq->getCoordinates());
                if (is_array($zipcode)) {
                    echo "Country: " . $zipcode['country'] . "\n";
                    echo "County: " . $zipcode['county'] . "\n";
                    if($zipcode['country'] != 'US') continue;
                    if(!empty($zipcode['county'])) {
                        $sqlGetZips = "SELECT postal_code FROM zips WHERE county_name LIKE '" . $zipcode['county'] . "%'";
                        $ZipsRow = mysqli_query($wunderground->dbConnect, $sqlGetZips);
                        $zipcodes = array();
                        if ($ZipsRow->num_rows != 0) {
                            while ($row = $ZipsRow->fetch_assoc()) {
                                array_push($zipcodes, $row['postal_code']);
                            }
                        }
                        if (count($zipcodes) != 0) {
                            echo "Zipcode: " . join(',', $zipcodes) . "\n";
                            $sqlUpdateUSGS = "UPDATE USGSEarthquake SET zipcode = '" . json_encode($zipcodes) . "' WHERE id='" . $eq->getId() . "'";
                            $UpdateUSGS = mysqli_query($wunderground->dbConnect, $sqlUpdateUSGS);
                            echo "ID: " . $eq->getId() . " UPDATED\n";
                        }
                    }
                }
            }
        }
    }
}


$wunderground = new WunderGround();
if( $wunderground->dbConnect) {
    $eqs = $wunderground->getCurrentHurricanes();
}
$return_disasters = array();
$return_disaster_numbers = array();
$wunderground = new WunderGround();
if( $wunderground->dbConnect){
    $json_string = file_get_contents("/var/www/html/dev-nowprep.digitalarrowtech.com/wp-content/themes/twentyseventeen/DisasterDeclarationsSummaries.json");
    $json_string ="[" . str_replace("}{","},{",$json_string) ."]";
    $parsed_json = json_decode($json_string);
    $iCountAll = count($parsed_json);
    $iCount = 0;
    foreach ($parsed_json as $disaster_json) {
        $disaster = null;
        $disaster = new FemaDisaster();
        if ($disaster) {
            $zipcodes = array();
            $disaster->initFemaDisaster($disaster_json);
            $iCount++;
            echo "==================================================\n";
            echo "Item : ".$iCount." of ".$iCountAll."\n";
            echo "State = " . $disaster->getState() . " County = ".trim(str_replace('(County)','',$disaster->getDeclaredCountyArea())). "\n";
            $sqlGetZipsList = "SELECT postal_code FROM zips WHERE state_code='" . $disaster->getState() . "' AND county_name LIKE '".$wunderground->dbConnect->real_escape_string(trim(str_replace('(County)','',$disaster->getDeclaredCountyArea())))."%'";
            $ZipsList = mysqli_query($wunderground->dbConnect, $sqlGetZipsList);
            if ($ZipsList->num_rows != 0) {
                while ($row = $ZipsList->fetch_assoc()) {
                    array_push($zipcodes,$row['postal_code']);
                }
            }
            //echo "ZIP Codes for county = " . join(',',$zipcodes). "\n";
            //if($disaster->getState() != $state) continue;
            //if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers))
            {
                if ($wunderground->dbConnect) {
                    $sqlCheckDisaster = "SELECT id,zipcodes FROM fema WHERE id='" . $disaster->getId() . "'";
                    $disasterRow = mysqli_query($wunderground->dbConnect, $sqlCheckDisaster);
                    if ($disasterRow->num_rows == 0) {
                        echo "DisasterNumber = " . $disaster->getDisasterNumber() . " not found, insert \n";
                        $sqlInsertDisaster = "INSERT INTO fema(
                                                      type, 
                                                      disasterNumber, 
                                                      state, 
                                                      declarationDate, 
                                                      disasterType, 
                                                      incidentType, 
                                                      title, 
                                                      incidentBeginDate, 
                                                      incidentEndDate, 
                                                      disasterCloseOutDate, 
                                                      placeCode, 
                                                      declaredCountyArea, 
                                                      lastRefresh, 
                                                      hash, 
                                                      id,
                                                      zipcodes,
                                                      object) 
                                                  VALUES (
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getType()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getDisasterNumber()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getState()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getDeclarationDate()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getDisasterType()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getIncidentType()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getTitle()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getIncidentBeginDate()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getIncidentEndDate()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getDisasterCloseOutDate()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getPlaceCode()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getDeclaredCountyArea()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getLastRefresh()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getHash()) . "',
                                                  '" . $wunderground->dbConnect->real_escape_string($disaster->getId()) . "',
                                                  '" . json_encode($zipcodes) . "',
                                                  '" . json_encode($disaster_json) . "'
                                                  )";
                        //var_dump($sqlInsertDisaster);
                        $disasterInsertRow = mysqli_query($wunderground->dbConnect, $sqlInsertDisaster);
                    } else {
                        $idfema = "";
                        while ($row = $disasterRow->fetch_assoc()) {
                            $idfema = $row['id'];
                            $zipcodes1 = json_decode($row['zipcodes']);
                            if(is_array($zipcodes1)) {
                                foreach ($zipcodes1 as $zip1) {
                                    if (!in_array($zip1, $zipcodes)) {
                                        array_push($zipcodes, $zip1);
                                    }
                                }
                            }
                        }
                        if(is_array($zipcodes)) {
                            //if (!in_array($zipcode, $zipcodes)) {
                            //    array_push($zipcodes, $zipcode);
                            //}
                            $sqlUpdateDisaster ="UPDATE fema 
                                        SET placeCode = '".$wunderground->dbConnect->real_escape_string($disaster->getPlaceCode())."',
                                            zipcodes ='".json_encode($zipcodes)."',
                                            object = '".json_encode($disaster_json)."'
                                            WHERE id='".$idfema . "'";
                            echo "DisasterNumber = " . $disaster->getDisasterNumber() . " found DBID = ".$idfema.", update\n";
                            $disasterUpdateRow = mysqli_query($wunderground->dbConnect, $sqlUpdateDisaster);
                        }
                    }
                }
            }
            if(!in_array($disaster->getDisasterNumber(), $return_disaster_numbers)) {
                array_push($return_disaster_numbers, $disaster->getDisasterNumber());
                array_push($return_disasters, $disaster);
            }
            //$disasterRow->free_result();
        }
        $disaster_json = null;
    }

}*/


//$url = "https://api.spotcrime.com/crimes.json?lat=40.75368539999999&lon=-73.9991637&radius=0.02&callback=jQuery213028210643548844294_1501484965033&key=privatekeyforspotcrimepublicusers-commercialuse-877.410.1607&_=1501484965035https://api.spotcrime.com/crimes.json?lat=40.75368539999999&lon=-73.9991637&radius=0.02&callback=jQuery213028210643548844294_1501484965033&key=privatekeyforspotcrimepublicusers-commercialuse-877.410.1607&_=1501484965035";
//$json_string = file_get_contents($url);
//var_dump($json_string); die();

$wunderground = new WunderGround();
$return_eq = array();
for( $ii = 1899; $ii >= 1800; $ii--) {

    $arraylist = array(

        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-12-01&endtime=".($ii+1)."-01-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-11-01&endtime=".$ii."-12-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-10-01&endtime=".$ii."-11-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-09-01&endtime=".$ii."-10-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-08-01&endtime=".$ii."-09-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-07-01&endtime=".$ii."-08-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-06-01&endtime=".$ii."-07-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-05-01&endtime=".$ii."-06-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-04-01&endtime=".$ii."-05-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-03-01&endtime=".$ii."-04-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-02-01&endtime=".$ii."-03-01",
        API_USGS_ENDPOINT_EARTHQUAKE_REALTIME . "&starttime=".$ii."-01-01&endtime=".$ii."-02-01",
    );

//bitnami_wordpress
//bn_wordpress
//c089b008e3
//~/apps/wordpress/htdocs/wp-content/themes/Newspaper/config
//mysql -u bn_wordpress -p c089b008e3


//{"personal":[{"name":"name","value":"ewrwer"},{"name":"email","value":"ewrwe@dfsdf.fff"},{"name":"tel","value":"4534534534"},{"name":"info_notes","value":"fdsfsdfsdfsdf"}],"contacts":[{"name":"group-a[0][name]","value":"werwerwe"},{"name":"group-a[0][relation]","value":"Parent"},{"name":"group-a[0][in_case][]","value":"on"},{"name":"group-a[0][email]","value":"werwer@fdsgdf.ggg"},{"name":"group-a[0][tel]","value":"234234234234"},{"name":"group-a[0][info_notes]","value":"324234234323434"},{"name":"group-a[1][name]","value":"3ewrewrwerwe"},{"name":"group-a[1][relation]","value":"Child"},{"name":"group-a[1][email]","value":"ccxcvxc@fdsfsdf.fff"},{"name":"group-a[1][tel]","value":"34234234234"},{"name":"group-a[1][info_notes]","value":"fdslkdksfksdlfmlsd"}],"addresses":[{"name":"group-b[0][address]","value":"East 5th Street, NY, United States"},{"name":"group-b[1][address]","value":"East 5th Street, NY, United States"}],"plans":[{"name":"plans_notes","value":"ewrfdssdfsdf"}]}

//SELECT DISTINCT YEAR(FROM_UNIXTIME(time)), MONTH(FROM_UNIXTIME(time)),count(*) FROM USGSEarthquake GROUP BY YEAR(FROM_UNIXTIME(time)), MONTH(FROM_UNIXTIME(time)) ORDER BY YEAR(FROM_UNIXTIME(time)), MONTH(FROM_UNIXTIME(time))

//<div align="center"><a href="http://smile.amazon.com/ch/95-2456155"><img src='https://d1ev1rt26nhnwq.cloudfront.net/ccmtblv2.png' id="banner" width="200" style="border-style: none;" /></a> <table style="position: relative; text-align: center; width: 200px; top: -110px; height: 30px; vertical-align: middle; left: 0px;"> <tr><td style="vertical-align: middle"><div style="max-height: 54px; padding-left: 5px; padding-right: 5px;"> <span style="font-family: Arial; font-size: 14px; line-height: 16px;" class="charityNameSpan">Your Organization</span></div></td></tr></table></div></div>

    foreach ($arraylist as $iIndex => $item) {
        $json_string = file_get_contents($item);

        $parsed_json = json_decode($json_string);
        $iCount = count($parsed_json->{'features'});
//var_dump($iCount);die();
        foreach ($parsed_json->{'features'} as $index => $earthquake_json) {
            $earthquake = new USGSEarthquake();
            if ($earthquake) {
                $earthquake->initEarthquake($earthquake_json);

                echo "#" . ($index + 1) . " of " . $iCount . "\n";
                //if($index < 6020 && $iIndex == 0) continue;
                if ($wunderground->dbConnect) {
                    //$sqlEQCheck = "SELECT id FROM USGSEarthquake WHERE id='" . $earthquake->getId() . "'";
                    //$EQCheckRow = mysqli_query($wunderground->dbConnect, $sqlEQCheck);
                    if (true) { //($EQCheckRow->num_rows == 0) {
                        $zipcode = $wunderground->getZipsByСoord($earthquake->getCoordinates()[1], $earthquake->getCoordinates()[0], $earthquake->getCoordinates()[2]);
                        if (count($zipcode) == 0) {
                            $zipcode = $wunderground->getZipsByСoord($earthquake->getCoordinates()[1], $earthquake->getCoordinates()[0], 25);
                            if (count($zipcode) == 0) {
                                $zipcode = $wunderground->getZipsByСoord($earthquake->getCoordinates()[1], $earthquake->getCoordinates()[0], 70);
                            }
                        }
                        echo "============================================\n";
                        echo "Record not found, insert\n";
                        echo "ID: " . $earthquake->getId() . "\n";
                        echo "Title: " . $earthquake->getTitle() . "\n";
                        echo "Zip codes: " . implode(',', $zipcode) . "\n";
                        echo "============================================\n";
                        $sqlInsertEQ = "INSERT INTO USGSEarthquake(
                                  id, 
                                  title, 
                                  type, 
                                  magType, 
                                  gap, 
                                  rms, 
                                  dmin, 
                                  nst, 
                                  types, 
                                  sources, 
                                  ids, 
                                  code, 
                                  net, 
                                  sig, 
                                  tsunami, 
                                  status, 
                                  alert, 
                                  mmi, 
                                  cdi, 
                                  felt, 
                                  detail, 
                                  url, 
                                  tz, 
                                  updated, 
                                  time, 
                                  place, 
                                  mag, 
                                  coordinates,
                                  zipcode,
                                  country,
                                  address,
                                  object) 
                                  VALUES (
                                  '" . esc_sql($earthquake->getId()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getTitle()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getType()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getMagType()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getGap()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getRms()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getDmin()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getNst()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getTypes()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getSources()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getIds()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getCode()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getNet()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getSig()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getTsunami()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getStatus()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getAlert()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getMmi()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getCdi()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getFelt()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getDetail()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getUrl()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getTz()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getUpdated()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getTime()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getPlace()) . "',
                                  '" . $wunderground->dbConnect->real_escape_string($earthquake->getMag()) . "',
                                  '" . json_encode($earthquake->getCoordinates()) . "',
                                  '" . json_encode($zipcode) . "',
                                  '',
                                  '',
                                  '" . json_encode($earthquake_json) . "'
                                  )";
                        $EQInsertRow = mysqli_query($wunderground->dbConnect, $sqlInsertEQ);
                        //array_push($return_eq,$earthquake);
                    } else {
                        /*echo "Record found, update\n";
                        echo "ID: ".$earthquake->getId()."\n";
                        echo "Title: ".$earthquake->getTitle()."\n";
                        echo "Zip codes: ".implode(',',$zipcode)."\n";
                        $sqlInsertEQ = "UPDATE USGSEarthquake
                                            SET
                                            zipcode = '" . json_encode($zipcode) . "',
                                            object = '" . json_encode($earthquake_json) . "'
                                        WHERE id='" . $earthquake->getId() . "'";
                        $EQInsertRow = mysqli_query($wunderground->dbConnect, $sqlInsertEQ);*/
                    }
                }
                //echo "============================================\n";
            }
        }
    }
}
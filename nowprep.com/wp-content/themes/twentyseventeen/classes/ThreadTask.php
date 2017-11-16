<?php

/**
 * Created by PhpStorm.
 * User: kostryukovalexey
 * Date: 17/08/2017
 * Time: 21:27
 */
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/class.WunderGround.php');

class ThreadTask extends Thread
{

    private $item = "";
    private $wunderground;


    public function __construct($arg) {
        $this->item = $arg;
        $this->wunderground = new WunderGround();
    }

    function run()
    {
        if ($this->wunderground) {
            $json_string = file_get_contents($this->item);

            $parsed_json = json_decode($json_string);
            $iCount = count($parsed_json->{'features'});
            foreach ($parsed_json->{'features'} as $index => $earthquake_json) {
                $earthquake = new USGSEarthquake();
                if ($earthquake) {
                    $earthquake->initEarthquake($earthquake_json);
                    echo "#" . $index . " of " . $iCount . "\n";
                    //if($index < 3990 && $iIndex == 0) continue;
                    if ($this->wunderground->dbConnect) {
                        $sqlEQCheck = "SELECT id FROM USGSEarthquake WHERE id='" . $earthquake->getId() . "'";
                        $EQCheckRow = mysqli_query($this->wunderground->dbConnect, $sqlEQCheck);
                        if ($EQCheckRow->num_rows == 0) {
                            $zipcode = $this->wunderground->getZipsByСoord($earthquake->getCoordinates()[1], $earthquake->getCoordinates()[0], $earthquake->getCoordinates()[2]);
                            if (count($zipcode) == 0) {
                                $zipcode = $this->wunderground->getZipsByСoord($earthquake->getCoordinates()[1], $earthquake->getCoordinates()[0], 25);
                                if (count($zipcode) == 0) {
                                    $zipcode = $this->wunderground->getZipsByСoord($earthquake->getCoordinates()[1], $earthquake->getCoordinates()[0], 70);
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
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getId()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getTitle()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getType()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getMagType()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getGap()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getRms()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getDmin()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getNst()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getTypes()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getSources()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getIds()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getCode()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getNet()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getSig()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getTsunami()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getStatus()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getAlert()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getMmi()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getCdi()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getFelt()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getDetail()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getUrl()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getTz()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getUpdated()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getTime()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getPlace()) . "',
                                  '" . $this->wunderground->dbConnect->real_escape_string($earthquake->getMag()) . "',
                                  '" . json_encode($earthquake->getCoordinates()) . "',
                                  '" . json_encode($zipcode) . "',
                                  '',
                                  '',
                                  '" . json_encode($earthquake_json) . "'
                                  )";
                            $EQInsertRow = mysqli_query($this->wunderground->dbConnect, $sqlInsertEQ);
                        } else {
                        }
                    }
                }
            }
        }
    }
}
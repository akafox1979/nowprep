<?php

class Hurricanes implements JsonSerializable
{

    private $stormNumber;
    private $stormName;
    private $zipcodes;
    private $object;
    private $active_flag;


    public function __construct()
    {
    }

    public function jsonSerialize()
    {
        return [];
    }

    public function getRowForDB()
    {
        return array(
        );
    }

    public function setRowFromDB($row){
        if(is_array($row)){
            $this->setObject(json_decode($row['object']));
            $this->setStormNumber($row['stormNumber']);
            $this->setStormName($row['stormName']);
            $this->setZipcodes(json_decode($row['zipcode']));
            $this->setActiveFlag( boolval($row['active_flag']));
        }
    }

    public function getStormNumber()
    {
        return $this->stormNumber;
    }

    public function setStormNumber($stormNumber)
    {
        $this->stormNumber = $stormNumber;
    }

    public function getStormName()
    {
        return $this->stormName;
    }

    public function setStormName($stormName)
    {
        $this->stormName = $stormName;
    }

    public function getObject()
    {
        return $this->object;
    }

    public function setObject($object)
    {
        $this->object = $object;
    }

    public function setZipcodes($zipcodes)
    {
        $this->zipcodes = json_decode($zipcodes);
    }

    public function getZipcodes()
    {
        return $this->zipcodes;
    }

    public function getActiveFlag()
    {
        return $this->active_flag;
    }

    public function setActiveFlag($active_flag)
    {
        $this->active_flag = $active_flag;
    }

    public function getMovementLegend() {
        if(!$this->getActiveFlag()) {
            $history_marker = "C = Item stopped<br/>";
            //$history_marker .= "C = ".$this->object->{'Current'}->{'Time'}->{'pretty'}."<br/>";
        } else {
            $history_marker = "C = Current<br/>";
        }

        $count = 1;//count($this->object->{'forecast'}) + ((property_exists($this->object,'ExtendedForecast')) ? count($this->object->{'ExtendedForecast'}) : 0);
        foreach ($this->object->{'forecast'} as $item) {
            if($item) {
                //if($this->getActiveFlag()) {
                $history_marker .= $count . " = +" . $item->{'ForecastHour'} . "<br/>";
                //} else {
                //    $history_marker .= $count . " = " . $item->{'Time'}->{'pretty'} . "<br/>";
                //}
                $count++;
            }
        }
        if((property_exists($this->object,'ExtendedForecast'))) {
            foreach ($this->object->{'ExtendedForecast'} as $item) {
                if ($item) {
                    //if($this->getActiveFlag()) {
                    $history_marker .= $count . " = +" . $item->{'ForecastHour'} . "<br/>";
                    //} else {
                    //    $history_marker .= $count . " = " . $item->{'Time'}->{'pretty'} . "<br/>";
                    //}
                    $count++;
                }
            }
        }
        if((property_exists($this->object,'track'))) {
            foreach (array_reverse($this->object->{'track'}) as $item) {
                if ($item) {
                    $history_marker .= $count . " = " . $item->{'Time'}->{'pretty'} . "<br/>";
                    $count++;
                }
            }
        }

        return $history_marker;

    }

    public function getCurrentPositionImageUrl() {
        $lat = $this->object->{'Current'}->{'lat'};
        $lon = $this->object->{'Current'}->{'lon'};

        $history_marker = "";

        $count = 1;//count($this->object->{'forecast'}) + ((property_exists($this->object,'ExtendedForecast')) ? count($this->object->{'ExtendedForecast'}) : 0);
        foreach ($this->object->{'forecast'} as $item) {
            if($item) {
                $history_marker  .= "&markers=color:blue%7Clabel:".$count."%7C".$item->{'lat'}.",".$item->{'lon'};
                $count++;
            }
        }
        if((property_exists($this->object,'ExtendedForecast'))) {
            foreach ($this->object->{'ExtendedForecast'} as $item) {
                if ($item) {
                    $history_marker .= "&markers=color:blue%7Clabel:" . $count . "%7C" . $item->{'lat'} . "," . $item->{'lon'};
                    $count++;
                }
            }
        }
        if((property_exists($this->object,'track'))) {
            foreach (array_reverse($this->object->{'track'}) as $item) {
                if ($item) {
                    $history_marker .= "&markers=color:yellow%7C" . $item->{'lat'} . "," . $item->{'lon'};
                    $count++;
                }
            }
        }

        return "https://maps.googleapis.com/maps/api/staticmap?center=" . $lat . "," . $lon . "&size=600x200&zoom=3&markers=color:green%7Clabel:C%7C" . $lat . "," . $lon . $history_marker . "&key=AIzaSyDPw8GEc1gOleH1B6RAVgAKaXKeYuAlsqo";
    }

    public function initHurricane($parsed_json_object)
    {
        $this->setObject($parsed_json_object);
        $this->setStormNumber($parsed_json_object->{'stormInfo'}->{'stormNumber'});
        $this->setStormName($parsed_json_object->{'stormInfo'}->{'stormName'});
        $this->setActiveFlag(true);
    }
}

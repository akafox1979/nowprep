<?php
/*
(
    [personal] => Array
        (
            [0] => Array
                (
                    [name] => name
                    [value] => dasdasd
                )
            [1] => Array
                (
                    [name] => email
                    [value] => asdasd@dasdasd.dddd
                )

            [2] => Array
                (
                    [name] => tel
                    [value] => 3242342322
                )
            [3] => Array
                (
                    [name] => info_notes
                    [value] =>
                )
        )
    [contacts] => Array
        (
            [0] => Array
                (
                    [name] => group-a[0][name]
                    [value] =>
                )
            [1] => Array
                (
                    [name] => group-a[0][relation]
                    [value] =>
                )
            [2] => Array
                (
                    [name] => group-a[0][in_case]
                    [value] =>
                )
            [3] => Array
                (
                    [name] => group-a[0][email]
                    [value] =>
                )
            [4] => Array
                (
                    [name] => group-a[0][tel]
                    [value] =>
                )
            [5] => Array
                (
                    [name] => group-a[0][info_notes]
                    [value] =>
                )
        )
    [addresses] => Array
        (
            [0] => Array
                (
                    [name] => group-b[0][type]
                    [value] =>
                )
            [1] => Array
                (
                    [name] => group-b[0][address]
                    [value] =>
                )
        )
    [plans] => Array
        (
            [0] => Array
                (
                    [name] => plans_notes
                    [value] =>
                )
        )
)
 */
$contact_merge_fields = array(
    "EMAIL" => "",
    "FNAME" => "",
    "LNAME" => "",
    "REFERRER" => "Contacts",
    "PHONE" => ""
);

$merge_fields = array(
    "EMAIL" => "",
    "FNAME" => "",
    "LNAME" => "",
    "REFERRER" => "Self",
    "PHONE" => "",
    "ADDRESS_01" => "",
    "ADDRESS_02" => "",
    "ADDRESS_03" => "",
    "ADDRESS_04" => "",
    "PLANSNOTES" => "",
    "EMAIL_R01" => "",
    "EMAIL_R02" => "",
    "EMAIL_R03" => "",
    "EMAIL_R04" => "",
    "FNAME_R01" => "",
    "FNAME_R02" => "",
    "FNAME_R03" => "",
    "FNAME_R04" => "",
    "LNAME_R01" => "",
    "LNAME_R02" => "",
    "LNAME_R03" => "",
    "LNAME_R04" => "",
    "PHONE_R01" => "",
    "PHONE_R02" => "",
    "PHONE_R03" => "",
    "PHONE_R04" => "",
    "ICE_R01" => "",
    "ICE_R02" => "",
    "ICE_R03" => "",
    "ICE_R04" => ""
);
//var_dump($_POST);die();
if (isset($_POST['personal'])) {
    $inputPersonalData = $_POST['personal'];
    foreach ($inputPersonalData as $index => $item) {
        if ($item['name'] == 'name') {
            $fl_names = split_name($item['value']);
            $merge_fields['FNAME'] = $fl_names['FNAME'];
            $merge_fields['LNAME'] = $fl_names['LNAME'];
        } else if ($item['name'] == 'email') {
            $merge_fields['EMAIL'] = $item['value'];
        } else if ($item['name'] == 'tel') {
            $phone = $item['value'];
            if(!empty($phone)) {
                $phone = format_phone($phone);
            }
            $merge_fields['PHONE'] = $phone;
        }
    }

    // 2 Step
    $inputContactsData = $_POST['contacts'];
    $inputContactsDataCount = count($inputContactsData)/6;
    for( $i = 0; $i < $inputContactsDataCount; $i++) {
        foreach ($inputContactsData as $index => $item) {
            if($item['name'] == 'group-a['.$i.'][name]') {
                $fl_names = split_name($item['value']);
                $merge_fields['FNAME_R0'.($i+1)] = $fl_names['FNAME'];
                $merge_fields['LNAME_R0'.($i+1)] = $fl_names['LNAME'];
            } else if($item['name'] == 'group-a['.$i.'][in_case]') {
                if(empty($item['value'])) {
                    $merge_fields['ICE_R0'.($i+1)] = '';
                } else {
                    $merge_fields['ICE_R0'.($i+1)] = $item['value'];
                }
            } else if($item['name'] == 'group-a['.$i.'][email]') {
                $merge_fields['EMAIL_R0'.($i+1)] = $item['value'];
            } else if($item['name'] == 'group-a['.$i.'][tel]') {
                $phone = $item['value'];
                if(!empty($phone)) {
                    $phone = format_phone($phone);
                }
                $merge_fields['PHONE_R0'.($i+1)] = $phone;
            }
        }
    }
    // 3 Step
    $inputAddressesData = $_POST['addresses'];
    $inputGoogleAddressesData = $_POST['google_address'];
    $inputAddressesDataCount = count($inputAddressesData)/2;
    for( $i = 0; $i < $inputAddressesDataCount; $i++) {
        foreach ($inputAddressesData as $index => $item) {
            if($item['name'] == 'group-b['.$i.'][address]') {
                $address_components = array(
                    'addr1' => "",
                    'addr2' => "",
                    'city' => "",
                    'state' => "",
                    'zip' => "",
                    'country' => ""
                );

                $foundAddress = false;
                $full_address = $item['value'];

                foreach ($inputGoogleAddressesData as $ad) {
                    $street_number = "";
                    $route = "";
                    if($ad['name'] == 'group-b['.$i.'][address]') {
                        $foundAddress = true;
                        foreach ($ad['value'] as $component) {
                            if(in_array('street_number',$component['types'])) {
                                $street_number = $component['short_name'];
                            } else if(in_array('route',$component['types'])) {
                                $route = $component['long_name'];
                            } else if(in_array('administrative_area_level_1',$component['types'])) {
                                $address_components['state'] = $component['short_name'];
                            } else if(in_array('locality',$component['types'])) {
                                $address_components['city'] = $component['long_name'];
                            } else if(in_array('postal_code',$component['types'])) {
                                $address_components['zip'] = $component['short_name'];
                            } else if(in_array('country',$component['types'])) {
                                $address_components['country'] = $component['short_name'];
                            }
                        }
                        $address_components['addr1'] = $street_number . ' ' . $route;
                    }
                }
                $full_address = str_replace($address_components['addr1'],"",$full_address);
                $full_address = str_replace($address_components['city'],"",$full_address);
                $full_address = str_replace($address_components['state'],"",$full_address);
                $full_address = str_replace($address_components['zip'],"",$full_address);
                $full_address = str_replace($address_components['country'],"",$full_address);

                $full_address = str_replace("United States","",$full_address);
                $full_address = str_replace(',',"",$full_address);
                $full_address = str_replace(' ',"",$full_address);

                $address_components['addr2'] = $full_address;
                if(!$foundAddress) {
                    $address_components['addr1'] = $item['value'];
                }
                $merge_fields['ADDRESS_0'.($i+1)] = $address_components;
            }
        }
    }

    // 4 Step
    $inputPlansData = $_POST['plans'];
    foreach ($inputPlansData as $index => $item) {
        if ($item['name'] == 'plans_notes') {
            $merge_fields['PLANSNOTES'] = $item['value'];
        }
    }

    //print_r($merge_fields);
    subscribeContact($merge_fields['EMAIL'], $merge_fields);

    if($inputContactsDataCount > 0) {
        for($i = 0; $i < $inputContactsDataCount; $i++) {
            if(!empty($merge_fields['EMAIL_R0'.($i+1)])) {
                $phone = $merge_fields['PHONE_R0'.($i+1)];
                if(!empty($phone)) {
                    $phone = format_phone($phone);
                }
                $contact_merge_fields = array(
                    "EMAIL" => $merge_fields['EMAIL_R0'.($i+1)],
                    "FNAME" => $merge_fields['FNAME_R0'.($i+1)],
                    "LNAME" => $merge_fields['LNAME_R0'.($i+1)],
                    "REFERRER" => "Contacts",
                    "PHONE" => $phone
                );
                //subscribeContact($contact_merge_fields['EMAIL'], $contact_merge_fields);
            }
        }
    }
    die();
}

function split_name($name)
{
    $parts = explode(" ", trim($name));
    $num = count($parts);
    if ($num > 1) {
        $lastname = array_pop($parts);
    } else {
        $lastname = '';
    }
    $firstname = implode(" ", $parts);
    return array("FNAME" => $firstname, "LNAME" => $lastname);
}
function format_phone($phone_number)
{
    $cleaned = preg_replace('/[^[:digit:]]/', '', $phone_number);
    preg_match('/(\d{3})(\d{3})(\d{4})/', $cleaned, $matches);
    return "{$matches[1]}-{$matches[2]}-{$matches[3]}";
}
function subscribeContact($email_address, $fields)
{

    $api_key = '894834643d0181f91a7b5fae6e4f12a8-us16';
    $server = 'us16.';
    $list_id = 'a4306c905d';
    $auth = base64_encode('user:' . $api_key);

    $data = array(
        'apikey' => $api_key,
        'email_address' => $email_address,
        'status' => 'subscribed',
        'merge_fields' => $fields
    );
    $json_data = json_encode($data);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://' . $server . 'api.mailchimp.com/3.0/lists/' . $list_id . '/members/');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
        'Authorization: Basic ' . $auth));
    curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

    $result = curl_exec($ch);

    $result_obj = json_decode($result);

    curl_close($ch);

    print_r($result_obj);

}

?>
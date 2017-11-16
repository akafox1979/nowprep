(function($) {

    var googleAddressData = [];

    function initAutocomplete(data_field) {
        var input_name = $(data_field).attr('name');
        var input_element = document.getElementsByName(input_name);
        var autocomplete = new google.maps.places.Autocomplete((input_element[0]), {
            types: ['geocode']
        });
        autocomplete.addListener('place_changed', function() {
            googleAddressData.push({
                name: input_name,
                value: autocomplete.getPlace().address_components
            });
        });
        return autocomplete;
    }

    function geolocate(data_field) {
        var autocomplete = initAutocomplete(data_field);
    }

    function getQueryParameters() {
        var queryParameters = {};
        location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (search, key, value) {
            queryParameters[key] = value
        });
        return queryParameters;
    }

    function getQueryParameter( key ) {
        var queryParameters = {};
        location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (search, key, value) {
            queryParameters[key] = value
        });
        return key ? queryParameters[key] : queryParameters;

    }

    function validateEmail(sEmail) {
        var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
        if (filter.test(sEmail)) {
            return true;
        } else {
            return false;
        }
    }

    function isDefined(fn_name){
        return fn_name !== undefined;
    }

    $(document).ready(function () {

        function phoneFormatter(elementID) {
            $('input[name="' + elementID + '"]').on('input', function() {
                var number = $(this).val().replace(/[^\d]/g, '')
                if (number.length == 7) {
                    number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                } else if (number.length == 10) {
                    number = number.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                }
                $(this).val(number)
            });
        };

        function addressGoogleInit(elementID) {
            $('input[name="' + elementID + '"]').on('focus', function() {
                geolocate($(this));
            });
        };

        phoneFormatter("_PersonalInfoPhone");

        if($( 'input[name="_PersonalInfoDOB"]' ).length) {
            //$('input[name="_PersonalInfoDOB"]').datepicker({dateFormat: "dd/mm/yy"});
        }

        phoneFormatter("_ContactsAddressPrimaryPhone");
        phoneFormatter("_ContactsAddressSecondaryPhone");
        addressGoogleInit("_ContactsAddressAddress");

        $.extend(
            {
                redirectPost: function (location, args) {
                    var form = '';
                    $.each(args, function (key, value) {
                        form += '<input type="hidden" name="' + key + '" value="' + value + '">';
                    });
                    $("#form_gen").remove();
                    $("body").append('<form id="form_gen" style="display:none" action="' + location + window.location.search + '" method="POST">' + form + '</form>');
                    $("#form_gen").submit();
                }
            });

        $("form#step7").submit(function (e) {
            e.preventDefault();

            var msg = '';
            var error = 0;
            var fld_name_cls=$(this).find('input[name="_PersonalInfoName"]');
            var fld_email_cls=$(this).find('input[name="_PersonalInfoEmail"]');
            var fld_address_cls=$(this).find('input[name="AddressStreet1"]');
            var fld_city_cls=$(this).find('input[name="City"]');
            var fld_zip_cls=$(this).find('input[name="PostalCode"]');
            var fld_state_cls=$(this).find('select[name="State"]');

            var sName = $(this).find('input[name="_PersonalInfoName"]').val();
            var sEmail = $(this).find('input[name="_PersonalInfoEmail"]').val();
            var sAddress = $(this).find('input[name="AddressStreet1"]').val();
            var sCity = $(this).find('input[name="City"]').val();
            var sZip = $(this).find('input[name="PostalCode"]').val();
            var sState = $(this).find('select[name="State"]').val();


            if ($.trim(sName).length == 0) {

                msg += "<li>Please enter name</li>";
                error = 1;
                fld_name_cls.addClass("error");
            }

            if (!validateEmail(sEmail)) {
                msg += '<li>Invalid email address</li>';
                error = 1;
                fld_email_cls.addClass("error");
            }
            if ($.trim(sAddress).length == 0) {
                msg += "<li>Please Enter Valid Address</li>";
                error = 1;
                fld_address_cls.addClass("error");
            }
            if ($.trim(sCity).length == 0) {
                msg += "<li>Please Enter City</li>";
                error = 1;
                fld_city_cls.addClass("error");
            }
            if ($.trim(sState).length == 0) {
                msg += "<li>Please Select State</li>";
                error = 1;
                fld_state_cls.addClass("error");
            }

            if ($.trim(sZip).length == 0) {
                msg += "<li>Please Enter Zip Code</li>";
                error = 1;
                fld_zip_cls.addClass("error");
            }

            if (error == 1) {
                $(this).parents(".frm").find(".form_error").remove();
                $(this).parents(".frm").prepend('<div class="form_error">Below fields are required:<ul>' + msg + '</ul></div>');
            } else {


                var fields = $("form#step7").serializeArray();

                fields.push({name: "step7", value: "1"});
                fields.push({name: "conID", value: conID});

                $.ajax({
                    type: "POST",
                    url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_icecard_short_funnel_ajax.php",
                    data: fields
                }).done(function (response) {
                    var responseJson = $.parseJSON(response);
                    if (responseJson.result == 0) {
                    }
                    if (responseJson.result == 1) {
                        $.redirectPost("https://start.nowprep.com/ice-wizard-v3/payment-info-v3/", {conID: responseJson.conID});
                        return true;
                    }
                });
            }
        });

        $("form#step8").submit(function (e) {
            e.preventDefault();

            var msg = '';
            var error = 0;
            var fld_CardNumber_cls=$(this).find('input[name="CardNumber"]');
            var fld_ExpirationMonth_cls=$(this).find('select[name="ExpirationMonth"]');
            var fld_ExpirationYear_cls=$(this).find('select[name="ExpirationYear"]');
            var fld_CVV2_cls=$(this).find('input[name="CVV2"]');
            var fld_tpp_cls=$(this).find('input[name="tpp"]');

            if($('input[name="tpp"]').is(':checked')) {
                error = 0;
            } else {
                msg += "<li>Please agree to the terms and privacy policy.</li>";
                error = 1;
                fld_tpp_cls.addClass("error");
                error = 1;
            }


            var sCardNumber=$(this).find('input[name="CardNumber"]').val();
            var sExpirationMonth=$(this).find('select[name="ExpirationMonth"]').val();
            var sExpirationYear=$(this).find('select[name="ExpirationYear"]').val();
            var sCVV2=$(this).find('input[name="CVV2"]').val();
            var stpp=$(this).find('input[name="tpp"]').val();

            if ($.trim(sCardNumber).length == 0) {
                msg += "<li>Please Enter Valid Card Number</li>";
                error = 1;
                fld_CardNumber_cls.addClass("error");
            }
            if ($.trim(sExpirationMonth).length == 0) {
                msg += "<li>Please Select Expiration Month</li>";
                error = 1;
                fld_ExpirationMonth_cls.addClass("error");
            }
            if ($.trim(sExpirationYear).length == 0) {
                msg += "<li>Please Select Expiration Year</li>";
                error = 1;
                fld_ExpirationYear_cls.addClass("error");
            }
            if ($.trim(sCVV2).length == 0) {
                msg += "<li>Please Enter CVV</li>";
                error = 1;
                fld_CVV2_cls.addClass("error");
            }

            if (error == 1) {
                $(this).parents(".frm").find(".form_error").remove();
                $(this).parents(".frm").prepend('<div class="form_error">Below fields are required:<ul>' + msg + '</ul></div>');
            } else {

                var fields = $("form#step8").serializeArray();

                fields.push({name: "step8", value: "1"});
                fields.push({name: "conID", value: conID});
                if ($('input[name="tpp"]').is(':checked')) {
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_icecard_short_funnel_ajax.php",
                        data: fields
                    }).done(function (response) {
                        var responseJson = $.parseJSON(response);
                        if (responseJson.result == 0) {
                            $(".frm").find(".form_error").remove();
                            $(".frm").prepend('<div class="form_error"><ul>' + responseJson.text + '</ul></div>');
                        }
                        if (responseJson.result == 1) {
                            $.redirectPost("https://start.nowprep.com/ice-wizard/thank-you/", {conID: responseJson.conID});
                            return true;
                        }
                    });
                } else {
                    return false;
                }
            }
        });

        $("a.lander-short-process").click(function(e){
            e.preventDefault();
            var result = "";
debugger;
            var fields = [];
            fields.push({name: "lander", value: "1"});
            //UTM ADS parameters
            fields.push({name: "_utmsource", value: getQueryParameter("utm_source")});
            fields.push({name: "_utmmedium", value: getQueryParameter("utm_medium")});
            fields.push({name: "_utmcampaign", value: getQueryParameter("utm_campaign")});
            fields.push({name: "_utmterm", value: getQueryParameter("utm_term")});
            fields.push({name: "_utmcontent", value: getQueryParameter("utm_content")});

            $.ajax({
                type: "POST",
                url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_icecard_short_funnel_ajax.php",
                data: fields
            }).done(function (response) {
                var responseJson = $.parseJSON(response);
                if (responseJson.result == 0) {
                }
                if (responseJson.result == 1) {
                    $.redirectPost("https://start.nowprep.com/ice-wizard-v3/shipping-info-v3/",{ conID: responseJson.conID});
                    return true;
                }
            });
        });


    });
}(jQuery.noConflict()));


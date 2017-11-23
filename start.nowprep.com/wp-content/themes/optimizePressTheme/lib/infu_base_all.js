(function ($) {

    var googleAddressData = [];

    function initAutocomplete(data_field) {
        var input_name = $(data_field).attr('name');
        var input_element = document.getElementsByName(input_name);
        var autocomplete = new google.maps.places.Autocomplete((input_element[0]), {
            types: ['geocode']
        });
        autocomplete.addListener('place_changed', function () {
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

    function getQueryParameter(key) {
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

    function isDefined(fn_name) {
        return fn_name !== undefined;
    }

    $(document).ready(function () {

        function initPopup(msg) {
            $('body').find(".popup_error").remove();
            $('body').prepend('<div class="popup_error"><div class="form_error"><a class="close">x</a>Below fields are required:<ul>' + msg + '</ul></div></div>');
            $('.popup_error,a.close').on('click', function() {
                debugger;
                $('.popup_error').remove();
            });
        }

        function phoneFormatter(elementID) {
            $('input[name="' + elementID + '"]').on('input', function () {
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
            $('input[name="' + elementID + '"]').on('focus', function () {
                geolocate($(this));
            });
        };

        if (typeof productData !== 'undefined') {
            debugger;
            $('img[alt="image"]').each(function () {
                debugger;
                $(this).attr("src", productData["infuProductImage"]);
            });

            $("#productShippingPrice1").html('<strong>FREE</strong>');
            $("#productPrice").each(function () {
                $(this).html('$' + parseFloat(productData["infuProductPrice"], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            });
            $("#productPriceD2").html('$' + parseFloat(productData["infuProductPrice"], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#productPriceD").html('$' + parseFloat(productData["infuProductPrice"], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#productPriceD1").html('$' + parseFloat(productData["infuProductPrice"], 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#orderTotal").html('$' + parseFloat(parseFloat(productData["infuProductPrice"]), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#orderTotal1").html('$' + parseFloat(parseFloat(productData["infuProductPrice"]), 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
            $("#productImage").attr("src", productData["infuProductImage"]);
            $("#productImage1").attr("src", productData["infuProductImage"]);
        }

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

        $("a.lander-short-process").click(function (e) {
            e.preventDefault();
            debugger;

            var redirect_url = $(this).attr("href");
            //if(window.location.href.indexOf("emergency-radio")>0 || window.location.href.indexOf("ready-power")>0) {
            //        redirect_url = "https://start.nowprep.com/ready-power/order-info/";
            //} else if(window.location.href.indexOf("radio")>0) {
            //	redirect_url = "https://start.nowprep.com/radio/order-info/";
            //} else {
            //	redirect_url = "https://start.nowprep.com/ready-vault/order-info/";
            //}

            $.redirectPost(redirect_url,
                {
                    productLander: "1"});
            /*,
                    infuProductID: productData["infuProductID"],
                    infuProductPrice: productData["infuProductPrice"],
                    infuProductShippingPrice: productData["infuProductShippingPrice"],
                    infuProductImage: productData["infuProductImage"],
                    contactGoal: productData["contactGoal"],
                    paymentGoal: productData["paymentGoal"]
                });*/
        });

        $("#billadd").on("change", function () {
            $('input[name="BillingAddressStreet1"]').val($('input[name="AddressStreet1"]').val());
            $('input[name="BillingAddressStreet2"]').val($('input[name="AddressStreet2"]').val());
            $('input[name="BillingCity"]').val($('input[name="City"]').val());
            $('select[name="BillingState"]').val($('select[name="State"]').val());
            $('input[name="BillingPostalCode"]').val($('input[name="PostalCode"]').val());
        });

        $('input[name="quantity"]').on("change", function () {
            debugger;
            if ($('div.summary').length > 0) {
                if ($('label[for="' + $(this).attr('id') + '"]').html().indexOf('4 units') > 0) {
                    $('.prod-name').html($('label[for="' + $(this).attr('id') + '"]').html());
                    var sumTotal = 110.00 + 7.10;
                    $('.prod-name').parent().next().html('$110.00');
                    $('.summary-total').find('.summary-price').html('$' + (sumTotal).toFixed(2));
                } else {
                    $('.prod-name').html($('label[for="' + $(this).attr('id') + '"]').html());
                    var sumTotal = parseFloat($(this).parent().next().html().replace('$', '')) + 7.1;
                    $('.prod-name').parent().next().html($(this).parent().next().html());
                    $('.summary-total').find('.summary-price').html('$' + (sumTotal).toFixed(2));
                }
            }
        });
debugger;

/*


 */
        if(window.location.href.indexOf("ready-power-v7/shipping-info") > 0) {
            $("form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                $("div.pay-over").remove();
                $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                $("div.pay-over").show();

                var msg = '';
                var error = 0;
                var fld_address_cls = $(this).find('input[name="AddressStreet1"]');
                var fld_city_cls = $(this).find('input[name="City"]');
                var fld_zip_cls = $(this).find('input[name="PostalCode"]');
                var fld_state_cls = $(this).find('select[name="State"]');

                var sAddress = $(this).find('input[name="AddressStreet1"]').val();
                var sAddress2 = $(this).find('input[name="AddressStreet2"]').val();
                var sCity = $(this).find('input[name="City"]').val();
                var sZip = $(this).find('input[name="PostalCode"]').val();
                var sState = $(this).find('select[name="State"]').val();

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
                    msg += "<li>Please Enter State</li>";
                    error = 1;
                    fld_state_cls.addClass("error");
                }

                if ($.trim(sZip).length == 0) {
                    msg += "<li>Please Enter Zip Code</li>";
                    error = 1;
                    fld_zip_cls.addClass("error");
                }

                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    var fields = $(this).serializeArray();


                    fields.push({name: "infuProductID", value: productData["infuProductID"]});
                    fields.push({name: "infuProductPrice", value: productData["infuProductPrice"]});
                    fields.push({name: "infuProductShippingPrice", value: productData["infuProductShippingPrice"]});
                    fields.push({name: "infuProductImage", value: productData["infuProductImage"]});
                    fields.push({name: "contactGoal", value: productData["contactGoal"]});
                    fields.push({name: "paymentGoal", value: productData["paymentGoal"]});
                    fields.push({name: "flwProductID", value: productData["flwProductID"]});
                    fields.push({name: "AddressStreet1", value: sAddress});
                    fields.push({name: "AddressStreet2", value: sAddress2});
                    fields.push({name: "City", value: sCity});
                    fields.push({name: "State", value: sState});
                    fields.push({name: "PostalCode", value: sZip});
                    fields.push({name: "BillingAddressStreet1", value: sAddress});
                    fields.push({name: "BillingAddressStreet2", value: sAddress2});
                    fields.push({name: "BillingCity", value: sCity});
                    fields.push({name: "BillingState", value: sState});
                    fields.push({name: "BillingPostalCode", value: sZip});
                    fields.push({name: "Phone", value: productData["Phone"]});
                    fields.push({name: "NameOnCard", value: productData["NameOnCard"]});
                    fields.push({name: "Email", value: productData["Email"]});

                    fields.push({name: "CardNumber", value: productData["CardNumber"]});
                    fields.push({name: "ExpirationMonth", value: productData["ExpirationMonth"]});
                    fields.push({name: "ExpirationYear", value: productData["ExpirationYear"]});
                    fields.push({name: "CVV2", value: productData["CVV2"]});

                    //UTM ADS parameters
                    fields.push({name: "utm_source", value: getQueryParameter("utm_source")});
                    fields.push({name: "utm_medium", value: getQueryParameter("utm_medium")});
                    fields.push({name: "utm_campaign", value: getQueryParameter("utm_campaign")});
                    fields.push({name: "utm_term", value: getQueryParameter("utm_term")});
                    fields.push({name: "utm_content", value: getQueryParameter("utm_content")});

                    fields.push({name: "contactID", value: productData["contactID"]});
                    debugger;
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_payment.php",
                        data: fields
                    }).done(function (response) {
                        debugger;
                        var responseJson = $.parseJSON(response);
                        //var orderTotal = responseJson.total;
                        //if (typeof(orderTotal) !== 'undefined') {
                        //    fbq('track', 'Purchase', {currency: 'USD', value: parseFloat(orderTotal)});
                        //}
                        if (responseJson.result == 0) {
                            $("div.pay-over").hide();
                            initPopup(responseJson.ErrorText);
                        }
                        if (responseJson.result == 1) {

                            var redirect_url = "https://start.nowprep.com/ready-power/thank-you/";
                            $.redirectPost(redirect_url, {thx:1, total: responseJson.total});
                            return true;
                        }
                    });
                }
            });
        } else if(window.location.href.indexOf("ready-power-v7/order-info") > 0) {

            $("form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                $("div.pay-over").remove();
                $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                $("div.pay-over").show();

                var msg = '';
                var error = 0;
                var fld_name_cls = $(this).find('input[name="NameOnCard"]');
                var fld_email_cls = $(this).find('input[name="Email"]');
                var fld_CardNumber_cls = $(this).find('input[name="CardNumber"]');
                var fld_ExpirationMonth_cls = $(this).find('select[name="ExpirationMonth"]');
                var fld_ExpirationYear_cls = $(this).find('select[name="ExpirationYear"]');
                var fld_CVV2_cls = $(this).find('input[name="CVV2"]');
                var fld_tpp_cls = $(this).find('input[name="tpp"]');

                var sName = $(this).find('input[name="NameOnCard"]').val();
                var sEmail = $(this).find('input[name="Email"]').val();
                var sCardNumber = $(this).find('input[name="CardNumber"]').val();
                var sExpirationMonth = $(this).find('select[name="ExpirationMonth"]').val();
                var sExpirationYear = $(this).find('select[name="ExpirationYear"]').val();
                var sCVV2 = $(this).find('input[name="CVV2"]').val();
                var stpp = $(this).find('input[name="tpp"]').val();


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
                if ($(this).find('input[name="tpp"]').length > 0) {
                    if ($('input[name="tpp"]').is(':checked')) {
                        fld_tpp_cls.removeClass("error");
                    } else {
                        msg += "<li>Please agree to the terms and privacy policy.</li>";
                        error = 1;
                        fld_tpp_cls.addClass("error");
                        error = 1;
                    }
                }

                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    //$('input[name="BillingAddressStreet1"]').val($('input[name="AddressStreet1"]').val());
                    //$('input[name="BillingAddressStreet2"]').val($('input[name="AddressStreet2"]').val());
                    //$('input[name="BillingCity"]').val($('input[name="City"]').val());
                    //$('select[name="BillingState"]').val($('select[name="State"]').val());
                    //$('input[name="BillingPostalCode"]').val($('input[name="PostalCode"]').val());

                    var fields = {};//$(this).serializeArray();

                    fields["productLander_oi"] = 1;

                    if ($("input#funnel-lifetime-warranty").is(':checked')) {
                        fields["flwProductID"] = 23;
                    }
                    if ($(this).find('input[name="quantity"]').length > 0) {
                        $(this).find('input[name="quantity"]').each(function () {
                            if ($(this).is(":checked")) {
                                if ($(this).attr("id") == "quantity2") {
                                    fields["infuProductID"] = 37;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_er2");
                                } else if ($(this).attr("id") == "quantity1") {
                                    fields["infuProductID"] = 39;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_er1");
                                } else if ($(this).attr("id") == "quantity3") {
                                    fields["infuProductID"] = 35;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_er3");
                                } else if ($(this).attr("id") == "quantity4") {
                                    fields["infuProductID"] = 33;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_er4");
                                }
                            }
                        });
                    } else {
                        fields["infuProductID"] = productData["infuProductID"];
                        fields["paymentGoal"] = (productData["paymentGoal"]);
                    }

                    fields["contactGoal"] = productData["contactGoal"];
//UTM ADS parameters
                    fields["utm_source"] = getQueryParameter("utm_source");
                    fields["utm_medium"] = getQueryParameter("utm_medium");
                    fields["utm_campaign"] = getQueryParameter("utm_campaign");
                    fields["utm_term"] = getQueryParameter("utm_term");
                    fields["utm_content"] = getQueryParameter("utm_content");

                    fields["CardNumber"] = $('input[name="CardNumber"]').val();
                    fields["ExpirationMonth"] = $('select[name="ExpirationMonth"]').val();
                    fields["ExpirationYear"] = $('select[name="ExpirationYear"]').val();
                    fields["CVV2"] = $('input[name="CVV2"]').val();

                    fields["AddressStreet1"] = $('input[name="AddressStreet1"]').val();
                    fields["AddressStreet2"] = $('input[name="AddressStreet2"]').val();
                    fields["City"] = $('input[name="City"]').val();
                    fields["State"] = $('select[name="State"]').val();
                    fields["PostalCode"] = $('input[name="PostalCode"]').val();
                    fields["BillingAddressStreet1"] = $('input[name="AddressStreet1"]').val();
                    fields["BillingAddressStreet2"] = $('input[name="AddressStreet2"]').val();
                    fields["BillingCity"] = $('input[name="City"]').val();
                    fields["BillingState"] = $('select[name="State"]').val();
                    fields["BillingPostalCode"] = $('input[name="PostalCode"]').val();
                    fields["Phone"] = $('input[name="Phone"]').val();
                    fields["NameOnCard"] = $('input[name="NameOnCard"]').val();
                    fields["Email"] = $('input[name="Email"]').val();

                    debugger;
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_create_contact.php",
                        data: fields
                    }).done(function (response) {
                        debugger;
                        var responseJson = $.parseJSON(response);
                        if (responseJson.result == 0) {
                        }
                        if (responseJson.result == 1) {
                            fields["contactID"] = responseJson.contactID;
                            var redirect_url = "https://start.nowprep.com/ready-power-v7/shipping-info/";
                            $.redirectPost(redirect_url + window.location.search, fields);
                            return true;
                        }
                    });
                }
            });

        } else if(window.location.href.indexOf("ready-power/order-info-v6") > 0 || window.location.href.indexOf("ready-power/order-info-v9") > 0) {

            $("form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                $("div.pay-over").remove();
                $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                $("div.pay-over").show();

                var msg = '';
                var error = 0;
                var fld_name_cls = $(this).find('input[name="NameOnCard"]');
                var fld_email_cls = $(this).find('input[name="Email"]');

                var sName = $(this).find('input[name="NameOnCard"]').val();
                var sEmail = $(this).find('input[name="Email"]').val();

                var fld_address_cls = $(this).find('input[name="AddressStreet1"]');
                var fld_city_cls = $(this).find('input[name="City"]');
                var fld_zip_cls = $(this).find('input[name="PostalCode"]');
                var fld_state_cls = $(this).find('select[name="State"]');

                var sAddress = $(this).find('input[name="AddressStreet1"]').val();
                var sAddress2 = $(this).find('input[name="AddressStreet2"]').val();
                var sCity = $(this).find('input[name="City"]').val();
                var sZip = $(this).find('input[name="PostalCode"]').val();
                var sState = $(this).find('select[name="State"]').val();

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
                    msg += "<li>Please Enter State</li>";
                    error = 1;
                    fld_state_cls.addClass("error");
                }

                if ($.trim(sZip).length == 0) {
                    msg += "<li>Please Enter Zip Code</li>";
                    error = 1;
                    fld_zip_cls.addClass("error");
                }

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


                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    //$('input[name="BillingAddressStreet1"]').val($('input[name="AddressStreet1"]').val());
                    //$('input[name="BillingAddressStreet2"]').val($('input[name="AddressStreet2"]').val());
                    //$('input[name="BillingCity"]').val($('input[name="City"]').val());
                    //$('select[name="BillingState"]').val($('select[name="State"]').val());
                    //$('input[name="BillingPostalCode"]').val($('input[name="PostalCode"]').val());

                    var fields = {};//$(this).serializeArray();

                    fields["productLander_oi"] = 1;


                    fields["contactGoal"] = productData["contactGoal"];
//UTM ADS parameters
                    fields["utm_source"] = getQueryParameter("utm_source");
                    fields["utm_medium"] = getQueryParameter("utm_medium");
                    fields["utm_campaign"] = getQueryParameter("utm_campaign");
                    fields["utm_term"] = getQueryParameter("utm_term");
                    fields["utm_content"] = getQueryParameter("utm_content");

                    fields["AddressStreet1"] = $('input[name="AddressStreet1"]').val();
                    fields["AddressStreet2"] = $('input[name="AddressStreet2"]').val();
                    fields["City"] = $('input[name="City"]').val();
                    fields["State"] = $('select[name="State"]').val();
                    fields["PostalCode"] = $('input[name="PostalCode"]').val();
                    fields["BillingAddressStreet1"] = $('input[name="AddressStreet1"]').val();
                    fields["BillingAddressStreet2"] = $('input[name="AddressStreet2"]').val();
                    fields["BillingCity"] = $('input[name="City"]').val();
                    fields["BillingState"] = $('select[name="State"]').val();
                    fields["BillingPostalCode"] = $('input[name="PostalCode"]').val();
                    fields["Phone"] = $('input[name="Phone"]').val();
                    fields["NameOnCard"] = $('input[name="NameOnCard"]').val();
                    fields["Email"] = $('input[name="Email"]').val();
                    debugger;
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_create_contact.php",
                        data: fields
                    }).done(function (response) {
                        debugger;
                        var responseJson = $.parseJSON(response);
                        if (responseJson.result == 0) {
                        }
                        if (responseJson.result == 1) {
                            fields["contactID"] = responseJson.contactID;
                            var redirect_url = "https://start.nowprep.com/ready-power/payment-info-v6/";
                            if (window.location.href.indexOf("ready-power/order-info-v9") > 0) {
                                redirect_url = "https://start.nowprep.com/ready-power/payment-info-v9/";
                            }
                            $.redirectPost(redirect_url + window.location.search, fields);
                        }
                    });
                }
            });
        } else if(window.location.href.indexOf("ready-power/upsell-firstaid") > 0) {

            $("div.order_btns a").click(function(){
                $("div.pay-over").remove();
                $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                $("div.pay-over").show();

                var fields = [];
                fields.push({name: "contactID", value: contactID});
                fields.push({name: "creditCardID", value: creditCardID});
                fields.push({name: "productID", value: 51});

                $.ajax({
                    type: "POST",
                    url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_upsell_payment.php",
                    data: fields
                }).done(function (response) {
                    debugger;
                    var responseJson = $.parseJSON(response);
                    if (responseJson.result == 0) {
                        $("div.pay-over").hide();
                        initPopup(responseJson.ErrorText);
                    }
                    if (responseJson.result == 1) {

                        var redirect_url = "https://start.nowprep.com/ready-power/thank-you/";
                        $.redirectPost(redirect_url, {thx:1, total: responseJson.total, addtowish:1});
                        return true;
                    }
                });
            });
            $("a.btn_no_thanks").click(function(){
                var redirect_url = "https://start.nowprep.com/ready-power/thank-you/";
                $.redirectPost(redirect_url, {thx:1});
            });

        } else if(window.location.href.indexOf("ready-power/payment-info-v6") > 0 || window.location.href.indexOf("ready-power/payment-info-v9") > 0) {
            $("form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                $("div.pay-over").remove();
                $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                $("div.pay-over").show();

                var msg = '';
                var error = 0;
                var fld_CardNumber_cls = $(this).find('input[name="CardNumber"]');
                var fld_ExpirationMonth_cls = $(this).find('select[name="ExpirationMonth"]');
                var fld_ExpirationYear_cls = $(this).find('select[name="ExpirationYear"]');
                var fld_CVV2_cls = $(this).find('input[name="CVV2"]');
                var fld_tpp_cls = $(this).find('input[name="tpp"]');

                var sCardNumber = $(this).find('input[name="CardNumber"]').val();
                var sExpirationMonth = $(this).find('select[name="ExpirationMonth"]').val();
                var sExpirationYear = $(this).find('select[name="ExpirationYear"]').val();
                var sCVV2 = $(this).find('input[name="CVV2"]').val();
                var stpp = $(this).find('input[name="tpp"]').val();



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
                if ($(this).find('input[name="tpp"]').length > 0) {
                    if ($('input[name="tpp"]').is(':checked')) {
                        fld_tpp_cls.removeClass("error");
                    } else {
                        msg += "<li>Please agree to the terms and privacy policy.</li>";
                        error = 1;
                        fld_tpp_cls.addClass("error");
                        error = 1;
                    }
                }
                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    var fields = $(this).serializeArray();
                    if ($("input#funnel-lifetime-warranty").is(':checked')) {
                        fields.push({name: "flwProductID", value: 23});
                    }

                    var newOrderDiscount = false;
                    if(window.location.href.indexOf("ready-power/payment-info-v9") > 0) {
                        //newOrderDiscount = true;
                    }

                    if ($(this).find('input[name="quantity"]').length > 0) {
                        $(this).find('input[name="quantity"]').each(function () {
                            if ($(this).is(":checked")) {
                                if(newOrderDiscount) {
                                    if ($(this).attr("id") == "quantity2") {
                                            fields.push({name: "infuProductID", value: 45});
                                            fields.push({
                                                name: "paymentGoal",
                                                value: (productData["paymentGoal"] + "_rpd2")
                                            });
                                    } else if ($(this).attr("id") == "quantity1") {
                                            fields.push({name: "infuProductID", value: 47});
                                            fields.push({
                                                name: "paymentGoal",
                                                value: (productData["paymentGoal"] + "_rpd1")
                                            });
                                    } else if ($(this).attr("id") == "quantity3") {
                                            fields.push({name: "infuProductID", value: 43});
                                            fields.push({
                                                name: "paymentGoal",
                                                value: (productData["paymentGoal"] + "_rpd3")
                                            });
                                    } else if ($(this).attr("id") == "quantity4") {
                                            fields.push({name: "infuProductID", value: 41});
                                            fields.push({
                                                name: "paymentGoal",
                                                value: (productData["paymentGoal"] + "_rpd4")
                                            });
                                    }
                                } else {
                                    if ($(this).attr("id") == "quantity2") {
                                        fields.push({name: "infuProductID", value: 37});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er2")
                                        });
                                    } else if ($(this).attr("id") == "quantity1") {
                                        fields.push({name: "infuProductID", value: 39});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er1")
                                        });
                                    } else if ($(this).attr("id") == "quantity3") {
                                        fields.push({name: "infuProductID", value: 35});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er3")
                                        });
                                    } else if ($(this).attr("id") == "quantity4") {
                                        fields.push({name: "infuProductID", value: 33});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er4")
                                        });
                                    }
                                }
                            }
                        });
                    } else {
                        fields["infuProductID"] = productData["infuProductID"];
                        fields["paymentGoal"] = (productData["paymentGoal"]);
                    }

                    //fields.push({name: "infuProductID", value: productData["infuProductID"]});
                    fields.push({name: "infuProductPrice", value: productData["infuProductPrice"]});
                    fields.push({name: "infuProductShippingPrice", value: productData["infuProductShippingPrice"]});
                    fields.push({name: "infuProductImage", value: productData["infuProductImage"]});
                    fields.push({name: "contactGoal", value: productData["contactGoal"]});
                    //fields.push({name: "paymentGoal", value: productData["paymentGoal"]});
                    //fields.push({name: "flwProductID", value: productData["flwProductID"]});
                    fields.push({name: "AddressStreet1", value: productData["AddressStreet1"]});
                    fields.push({name: "AddressStreet2", value: productData["AddressStreet2"]});
                    fields.push({name: "City", value: productData["City"]});
                    fields.push({name: "State", value: productData["State"]});
                    fields.push({name: "PostalCode", value: productData["PostalCode"]});
                    fields.push({name: "BillingAddressStreet1", value: productData["BillingAddressStreet1"]});
                    fields.push({name: "BillingAddressStreet2", value: productData["BillingAddressStreet2"]});
                    fields.push({name: "BillingCity", value: productData["BillingCity"]});
                    fields.push({name: "BillingState", value: productData["BillingState"]});
                    fields.push({name: "BillingPostalCode", value: productData["BillingPostalCode"]});
                    fields.push({name: "Phone", value: productData["Phone"]});
                    fields.push({name: "NameOnCard", value: productData["NameOnCard"]});
                    fields.push({name: "Email", value: productData["Email"]});

                    //UTM ADS parameters
                    fields.push({name: "utm_source", value: getQueryParameter("utm_source")});
                    fields.push({name: "utm_medium", value: getQueryParameter("utm_medium")});
                    fields.push({name: "utm_campaign", value: getQueryParameter("utm_campaign")});
                    fields.push({name: "utm_term", value: getQueryParameter("utm_term")});
                    fields.push({name: "utm_content", value: getQueryParameter("utm_content")});

                    fields.push({name: "contactID", value: productData["contactID"]});
                    debugger;
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_payment.php",
                        data: fields
                    }).done(function (response) {
                        debugger;
                        var responseJson = $.parseJSON(response);
                        //var orderTotal = responseJson.total;
                        //if (typeof(orderTotal) !== 'undefined') {
                        //    fbq('track', 'Purchase', {currency: 'USD', value: parseFloat(orderTotal)});
                        //}
                        if (responseJson.result == 0) {
                            $("div.pay-over").hide();
                            initPopup(responseJson.ErrorText);
                        }
                        if (responseJson.result == 1) {

                            var redirect_url = "https://start.nowprep.com/ready-power/thank-you/";
                            if(window.location.href.indexOf("ready-power/payment-info-v9") > 0) {
                                redirect_url = "https://start.nowprep.com/ready-power/upsell-firstaid/";
                                $.redirectPost(redirect_url, {upsell: 1, total: responseJson.total, contactID: responseJson.contactID, creditCardID: responseJson.creditCardID});
                            } else {
                                $.redirectPost(redirect_url, {thx: 1, total: responseJson.total});
                            }
                            return true;
                        }
                    });
                }
            });
        } else if(window.location.href.indexOf("ready-power-v3/payment-info") > 0) {
            $("form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                    $("div.pay-over").remove();
                    $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                    $("div.pay-over").show();

                var msg = '';
                var error = 0;
                var fld_CardNumber_cls = $(this).find('input[name="CardNumber"]');
                var fld_ExpirationMonth_cls = $(this).find('select[name="ExpirationMonth"]');
                var fld_ExpirationYear_cls = $(this).find('select[name="ExpirationYear"]');
                var fld_CVV2_cls = $(this).find('input[name="CVV2"]');
                var fld_tpp_cls = $(this).find('input[name="tpp"]');

                var sCardNumber = $(this).find('input[name="CardNumber"]').val();
                var sExpirationMonth = $(this).find('select[name="ExpirationMonth"]').val();
                var sExpirationYear = $(this).find('select[name="ExpirationYear"]').val();
                var sCVV2 = $(this).find('input[name="CVV2"]').val();
                var stpp = $(this).find('input[name="tpp"]').val();



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
                if ($(this).find('input[name="tpp"]').length > 0) {
                    if ($('input[name="tpp"]').is(':checked')) {
                        fld_tpp_cls.removeClass("error");
                    } else {
                        msg += "<li>Please agree to the terms and privacy policy.</li>";
                        error = 1;
                        fld_tpp_cls.addClass("error");
                        error = 1;
                    }
                }
                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    var fields = $(this).serializeArray();

                    fields.push({name: "infuProductID", value: productData["infuProductID"]});
                    fields.push({name: "infuProductPrice", value: productData["infuProductPrice"]});
                    fields.push({name: "infuProductShippingPrice", value: productData["infuProductShippingPrice"]});
                    fields.push({name: "infuProductImage", value: productData["infuProductImage"]});
                    fields.push({name: "contactGoal", value: productData["contactGoal"]});
                    fields.push({name: "paymentGoal", value: productData["paymentGoal"]});
                    fields.push({name: "flwProductID", value: productData["flwProductID"]});
                    fields.push({name: "AddressStreet1", value: productData["AddressStreet1"]});
                    fields.push({name: "AddressStreet2", value: productData["AddressStreet2"]});
                    fields.push({name: "City", value: productData["City"]});
                    fields.push({name: "State", value: productData["State"]});
                    fields.push({name: "PostalCode", value: productData["PostalCode"]});
                    fields.push({name: "BillingAddressStreet1", value: productData["BillingAddressStreet1"]});
                    fields.push({name: "BillingAddressStreet2", value: productData["BillingAddressStreet2"]});
                    fields.push({name: "BillingCity", value: productData["BillingCity"]});
                    fields.push({name: "BillingState", value: productData["BillingState"]});
                    fields.push({name: "BillingPostalCode", value: productData["BillingPostalCode"]});
                    fields.push({name: "Phone", value: productData["Phone"]});
                    fields.push({name: "NameOnCard", value: productData["NameOnCard"]});
                    fields.push({name: "Email", value: productData["Email"]});

                    //UTM ADS parameters
                    fields.push({name: "utm_source", value: getQueryParameter("utm_source")});
                    fields.push({name: "utm_medium", value: getQueryParameter("utm_medium")});
                    fields.push({name: "utm_campaign", value: getQueryParameter("utm_campaign")});
                    fields.push({name: "utm_term", value: getQueryParameter("utm_term")});
                    fields.push({name: "utm_content", value: getQueryParameter("utm_content")});

                    fields.push({name: "contactID", value: productData["contactID"]});
                    debugger;
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_payment.php",
                        data: fields
                    }).done(function (response) {
                        debugger;
                        var responseJson = $.parseJSON(response);
                        //var orderTotal = responseJson.total;
                        //if (typeof(orderTotal) !== 'undefined') {
                        //    fbq('track', 'Purchase', {currency: 'USD', value: parseFloat(orderTotal)});
                        //}
                        if (responseJson.result == 0) {
                            $("div.pay-over").hide();
                            initPopup(responseJson.ErrorText);
                        }
                        if (responseJson.result == 1) {

                            var redirect_url = "https://start.nowprep.com/ready-power/thank-you/";
                            $.redirectPost(redirect_url, {thx:1, total: responseJson.total});
                            return true;
                        }
                    });
                }
            });
        } else if(window.location.href.indexOf("ready-power-v3/order-info") > 0) {

            $("form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                $("div.pay-over").remove();
                $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                $("div.pay-over").show();

                var msg = '';
                var error = 0;
                var fld_name_cls = $(this).find('input[name="NameOnCard"]');
                var fld_email_cls = $(this).find('input[name="Email"]');
                var fld_address_cls = $(this).find('input[name="AddressStreet1"]');
                var fld_city_cls = $(this).find('input[name="City"]');
                var fld_zip_cls = $(this).find('input[name="PostalCode"]');
                var fld_state_cls = $(this).find('select[name="State"]');

                var sName = $(this).find('input[name="NameOnCard"]').val();
                var sEmail = $(this).find('input[name="Email"]').val();
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
                    msg += "<li>Please Enter State</li>";
                    error = 1;
                    fld_state_cls.addClass("error");
                }

                if ($.trim(sZip).length == 0) {
                    msg += "<li>Please Enter Zip Code</li>";
                    error = 1;
                    fld_zip_cls.addClass("error");
                }

                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    $('input[name="BillingAddressStreet1"]').val($('input[name="AddressStreet1"]').val());
                    $('input[name="BillingAddressStreet2"]').val($('input[name="AddressStreet2"]').val());
                    $('input[name="BillingCity"]').val($('input[name="City"]').val());
                    $('select[name="BillingState"]').val($('select[name="State"]').val());
                    $('input[name="BillingPostalCode"]').val($('input[name="PostalCode"]').val());

                    var fields = {};//$(this).serializeArray();

                    fields["productLander_oi"] = 1;

                    if ($("input#funnel-lifetime-warranty").is(':checked')) {
                        fields["flwProductID"] = 23;
                    }
                    if ($(this).find('input[name="quantity"]').length > 0) {
                        $(this).find('input[name="quantity"]').each(function () {
                            if ($(this).is(":checked")) {
                                if ($(this).attr("id") == "quantity2") {
                                    fields["infuProductID"] = 45;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_rpd2");
                                } else if ($(this).attr("id") == "quantity1") {
                                    fields["infuProductID"] = 47;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_rpd1");
                                } else if ($(this).attr("id") == "quantity3") {
                                    fields["infuProductID"] = 43;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_rpd3");
                                } else if ($(this).attr("id") == "quantity4") {
                                    fields["infuProductID"] = 41;
                                    fields["paymentGoal"] = (productData["paymentGoal"] + "_rpd4");
                                }
                            }
                        });
                    } else {
                        fields["infuProductID"] = productData["infuProductID"];
                        fields["paymentGoal"] = (productData["paymentGoal"]);
                    }
                    fields["contactGoal"] = productData["contactGoal"];
//UTM ADS parameters
                    fields["utm_source"] = getQueryParameter("utm_source");
                    fields["utm_medium"] = getQueryParameter("utm_medium");
                    fields["utm_campaign"] = getQueryParameter("utm_campaign");
                    fields["utm_term"] = getQueryParameter("utm_term");
                    fields["utm_content"] = getQueryParameter("utm_content");

                    fields["AddressStreet1"] = $('input[name="AddressStreet1"]').val();
                    fields["AddressStreet2"] = $('input[name="AddressStreet2"]').val();
                    fields["City"] = $('input[name="City"]').val();
                    fields["State"] = $('select[name="State"]').val();
                    fields["PostalCode"] = $('input[name="PostalCode"]').val();
                    fields["BillingAddressStreet1"] = $('input[name="BillingAddressStreet1"]').val();
                    fields["BillingAddressStreet2"] = $('input[name="BillingAddressStreet2"]').val();
                    fields["BillingCity"] = $('input[name="BillingCity"]').val();
                    fields["BillingState"] = $('select[name="BillingState"]').val();
                    fields["BillingPostalCode"] = $('input[name="BillingPostalCode"]').val();
                    fields["Phone"] = $('input[name="Phone"]').val();
                    fields["NameOnCard"] = $('input[name="NameOnCard"]').val();
                    fields["Email"] = $('input[name="Email"]').val();
                    debugger;
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_create_contact.php",
                        data: fields
                    }).done(function (response) {
                        debugger;
                        var responseJson = $.parseJSON(response);
                        if (responseJson.result == 0) {
                        }
                        if (responseJson.result == 1) {
                            fields["contactID"] = responseJson.contactID;
                            var redirect_url = "https://start.nowprep.com/ready-power-v3/payment-info/";
                            $.redirectPost(redirect_url + window.location.search, fields);
                        }
                    });

                }
            });

        } else {

            $("form.payment-product, form#order-payment, form#order-payment-v1").submit(function (e) {
                e.preventDefault();
                if (window.location.href.indexOf("radio") > 0 || window.location.href.indexOf("emergency-radio") > 0 || window.location.href.indexOf("ready-power") > 0) {
                    $("div.pay-over").remove();
                    $(this).parent().parent().parent().parent().parent().parent().append('<div class="pay-over"><div style="position: relative;margin-top: 20%;display: inline-block;text-align: center;width: 100%;height: 100%;"><img src="https://start.nowprep.com/wp-content/uploads/ajax-loading.gif" style="width: 30px;"><span style="color: white;font-size: 2em;margin-left: 5px;line-height: 3em;">Processing...</span><span style="color: white;font-size: 1.2em;"><br>Please wait while your order is processed.</span></div></div>');
                    $("div.pay-over").show();
                }

                var msg = '';
                var error = 0;
                var fld_name_cls = $(this).find('input[name="NameOnCard"]');
                var fld_email_cls = $(this).find('input[name="Email"]');
                //var fld_phone_cls=$(this).find('input[name="Phone"]');
                var fld_address_cls = $(this).find('input[name="AddressStreet1"]');
                var fld_city_cls = $(this).find('input[name="City"]');
                var fld_zip_cls = $(this).find('input[name="PostalCode"]');
                var fld_state_cls = $(this).find('select[name="State"]');
                var fld_CardNumber_cls = $(this).find('input[name="CardNumber"]');
                var fld_ExpirationMonth_cls = $(this).find('select[name="ExpirationMonth"]');
                var fld_ExpirationYear_cls = $(this).find('select[name="ExpirationYear"]');
                var fld_CVV2_cls = $(this).find('input[name="CVV2"]');
                var fld_tpp_cls = $(this).find('input[name="tpp"]');

                var sName = $(this).find('input[name="NameOnCard"]').val();
                var sEmail = $(this).find('input[name="Email"]').val();
                //var sPhone = $(this).find('input[name="Phone"]').val();
                var sAddress = $(this).find('input[name="AddressStreet1"]').val();
                var sCity = $(this).find('input[name="City"]').val();
                var sZip = $(this).find('input[name="PostalCode"]').val();
                var sState = $(this).find('select[name="State"]').val();
                var sCardNumber = $(this).find('input[name="CardNumber"]').val();
                var sExpirationMonth = $(this).find('select[name="ExpirationMonth"]').val();
                var sExpirationYear = $(this).find('select[name="ExpirationYear"]').val();
                var sCVV2 = $(this).find('input[name="CVV2"]').val();
                var stpp = $(this).find('input[name="tpp"]').val();


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
                //if ($.trim(sPhone).length <10) {
                //    msg += "<li>Please Enter Valid Phone Number</li>";
                //    error = 1;
                //    fld_phone_cls.addClass("error");
                //}
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
                    msg += "<li>Please Enter State</li>";
                    error = 1;
                    fld_state_cls.addClass("error");
                }

                if ($.trim(sZip).length == 0) {
                    msg += "<li>Please Enter Zip Code</li>";
                    error = 1;
                    fld_zip_cls.addClass("error");
                }

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
                if ($(this).find('input[name="tpp"]').length > 0) {
                    if ($('input[name="tpp"]').is(':checked')) {
                        fld_tpp_cls.removeClass("error");
                    } else {
                        msg += "<li>Please agree to the terms and privacy policy.</li>";
                        error = 1;
                        fld_tpp_cls.addClass("error");
                        error = 1;
                    }
                }
                if (error == 1) {
                    $("div.pay-over").hide();
                    initPopup(msg);
                } else {
                    debugger;

                    var newOrder = false;
                    var newOrder1 = false;
                    var newOrderDiscount = false;
                    var newOrderDiscount2 = false;
                    var newOrder2 = false;
                    var newOrder56 = false;
                    var newOrder475 = false;
                    var newOrder44 = false;
                    var newOrder39 = false;

                    if (window.location.href.indexOf("/ready-power-56") > 0) {
                        newOrder56 = true;
                    } else if (window.location.href.indexOf("/ready-power-475") > 0) {
                        newOrder475 = true;
                    } else if (window.location.href.indexOf("/ready-power-44") > 0) {
                        newOrder44 = true;
                    } else if (window.location.href.indexOf("/ready-power-39") > 0) {
                        newOrder39 = true;
                    } else if (window.location.href.indexOf("/ready-power-discount35") > 0) {
                        newOrderDiscount2 = true;
                    } else if (window.location.href.indexOf("/ready-power-discount") > 0) {
                        newOrderDiscount = true;
                    } else if(window.location.href.indexOf("ready-power/order-info-v10") > 0) {
                        newOrder2 = true;
                    } else if (
                                window.location.href.indexOf("/ready-power/order-info/") > 0  ||
                                window.location.href.indexOf("/ready-power-v1/order-info/") > 0  ||
                                window.location.href.indexOf("/ready-power-v2/order-info/") > 0  ||
                                window.location.href.indexOf("ready-power-v4/order-info-v4") > 0 ||
                                window.location.href.indexOf("ready-power/order-info-v5") > 0 ||
                                window.location.href.indexOf("ready-power-v8/order-info") > 0) {
                        newOrder1 = true;
                    } else if (window.location.href.indexOf("/order-info-v1") > 0 || window.location.href.indexOf("/order-info-v2") > 0) {
                        newOrder = true;
                    }
                    if (newOrder) {
                        $('input[name="BillingAddressStreet1"]').val($('input[name="AddressStreet1"]').val());
                        $('input[name="BillingAddressStreet2"]').val($('input[name="AddressStreet2"]').val());
                        $('input[name="BillingCity"]').val($('input[name="City"]').val());
                        $('select[name="BillingState"]').val($('select[name="State"]').val());
                        $('input[name="BillingPostalCode"]').val($('input[name="PostalCode"]').val());
                    }

                    var fields = $(this).serializeArray();

                    if ($("input#funnel-lifetime-warranty").is(':checked')) {
                        fields.push({name: "flwProductID", value: 23});
                    }
                    if(newOrderDiscount2) {
                        fields.push({name: "infuProductID", value: 119});
                        fields.push({
                            name: "paymentGoal",
                            value: (productData["paymentGoal"] + "_rpdd1")
                        });
                    } else if ($(this).find('input[name="quantity"]').length > 0) {
                        $(this).find('input[name="quantity"]').each(function () {
                            if ($(this).is(":checked")) {
                                if ($(this).attr("id") == "quantity2") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 55});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_2")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 71});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_2")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 87});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_2")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 103});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_2")
                                        });
                                    } else if (newOrderDiscount) {
                                        fields.push({name: "infuProductID", value: 45});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_rpd2")
                                        });
                                    } else if (newOrder1) {
                                        fields.push({name: "infuProductID", value: 37});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er2")
                                        });
                                    } else if (!newOrder) {
                                        fields.push({name: "infuProductID", value: 15});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_1")});
                                    } else {
                                        fields.push({name: "infuProductID", value: 29});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_n2")});
                                    }
                                } else if ($(this).attr("id") == "quantity1") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 61});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_1")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 77});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_1")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 93});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_1")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 109});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_1")
                                        });
                                    } else if(newOrder2) {
                                        fields.push({name: "infuProductID", value: 49});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_rpr1")
                                        });
                                    } else if (newOrderDiscount) {
                                        fields.push({name: "infuProductID", value: 47});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_rpd1")
                                        });
                                    } else if (newOrder1) {
                                        fields.push({name: "infuProductID", value: 39});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er1")
                                        });
                                    } else if (!newOrder) {
                                        fields.push({name: "infuProductID", value: 17});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_2")});
                                    } else {
                                        fields.push({name: "infuProductID", value: 31});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_n1")});
                                    }
                                } else if ($(this).attr("id") == "quantity3") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 57});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_3")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 73});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_3")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 89});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_3")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 105});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_3")
                                        });
                                    } else if (newOrderDiscount) {
                                        fields.push({name: "infuProductID", value: 43});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_rpd3")
                                        });
                                    } else if (newOrder1) {
                                        fields.push({name: "infuProductID", value: 35});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er3")
                                        });
                                    } else if (!newOrder) {
                                        fields.push({name: "infuProductID", value: 19});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_3")});
                                    } else {
                                        fields.push({name: "infuProductID", value: 27});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_n3")});
                                    }
                                } else if ($(this).attr("id") == "quantity4") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 59});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_4")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 75});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_4")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 91});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_4")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 107});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_4")
                                        });
                                    } else if (newOrderDiscount) {
                                        fields.push({name: "infuProductID", value: 41});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_rpd4")
                                        });
                                    } else if (newOrder1) {
                                        fields.push({name: "infuProductID", value: 33});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_er4")
                                        });
                                    } else if (!newOrder) {
                                        fields.push({name: "infuProductID", value: 21});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_4")});
                                    } else {
                                        fields.push({name: "infuProductID", value: 25});
                                        fields.push({name: "paymentGoal", value: (productData["paymentGoal"] + "_n4")});
                                    }
                                } else if($(this).attr("id") == "quantity5") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 63});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_5")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 79});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_5")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 95});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_5")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 111});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_5")
                                        });
                                    }
                                } else if($(this).attr("id") == "quantity10") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 65});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_10")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 81});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_10")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 97});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_10")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 113});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_10")
                                        });
                                    }
                                } else if($(this).attr("id") == "quantity15") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 67});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_15")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 83});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_15")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 99});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_15")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 115});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_15")
                                        });
                                    }
                                } else if($(this).attr("id") == "quantity20") {
                                    if (newOrder56) {
                                        fields.push({name: "infuProductID", value: 69});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_56_20")
                                        });
                                    } else if (newOrder475) {
                                        fields.push({name: "infuProductID", value: 85});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_475_20")
                                        });
                                    } else if (newOrder44) {
                                        fields.push({name: "infuProductID", value: 101});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_44_20")
                                        });
                                    } else if (newOrder39) {
                                        fields.push({name: "infuProductID", value: 117});
                                        fields.push({
                                            name: "paymentGoal",
                                            value: (productData["paymentGoal"] + "_39_20")
                                        });
                                    }
                                }
                            }
                        });
                    } else {
                        fields.push({name: "infuProductID", value: productData["infuProductID"]});
                        fields.push({name: "paymentGoal", value: productData["paymentGoal"]});
                    }
                    fields.push({name: "contactGoal", value: productData["contactGoal"]});
//                fields.push({name: "paymentGoal", value: productData["paymentGoal"]});
//UTM ADS parameters
                    fields.push({name: "utm_source", value: getQueryParameter("utm_source")});
                    fields.push({name: "utm_medium", value: getQueryParameter("utm_medium")});
                    fields.push({name: "utm_campaign", value: getQueryParameter("utm_campaign")});
                    fields.push({name: "utm_term", value: getQueryParameter("utm_term")});
                    fields.push({name: "utm_content", value: getQueryParameter("utm_content")});

                    //if ($('input[name="tpp"]').is(':checked')) {
                    $.ajax({
                        type: "POST",
                        url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_funnel_payment.php",
                        data: fields
                    }).done(function (response) {
                        var responseJson = $.parseJSON(response);
                        if (responseJson.result == 0) {
                            $("div.pay-over").hide();
                            initPopup(responseJson.ErrorText);
                        }
                        if (responseJson.result == 1) {

                            var redirect_url = "";

                            if (newOrder56 || newOrder475 || newOrder44 || newOrder39) {
                                redirect_url = "https://start.nowprep.com/ready-power/upsell-firstaid";
                                $.redirectPost(redirect_url, {upsell: 1, total: responseJson.total, contactID: responseJson.contactID, creditCardID: responseJson.creditCardID});
                            } else if (window.location.href.indexOf("emergency-radio") > 0 || window.location.href.indexOf("ready-power") > 0) {
                                redirect_url = "https://start.nowprep.com/ready-power/thank-you/";
                                $.redirectPost(redirect_url, {thx:1, total: responseJson.total});
                            } else if (window.location.href.indexOf("radio") > 0) {
                                redirect_url = "https://start.nowprep.com/radio/thank-you/";
                                $.redirectPost(redirect_url, {thx:1, total: responseJson.total});
                            } else {
                                redirect_url = "https://start.nowprep.com/ready-vault/thank-you/";
                                $.redirectPost(redirect_url, {thx:1, total: responseJson.total});
                            }
                            return true;
                        }
                    });
                    //} else {
                    //    return false;
                    //}
                }
            });
        }
    });

}(jQuery.noConflict()));


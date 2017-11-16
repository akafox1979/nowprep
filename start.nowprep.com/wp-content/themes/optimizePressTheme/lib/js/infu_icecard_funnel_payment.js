(function($) {

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

    $(document).ready(function () {
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

        $("form.checkout").submit(function (e) {
            e.preventDefault();
            $("div.disable-overlay").show();
            //page #8
            var fields = $("form.checkout").serializeArray();

            var queryParameters = getQueryParameters();
            //page #0
            fields.push({name: "_WhoFor", value: ""});
            //page #1
            fields.push({name: "_PersonalInfoSex", value: ""});
            fields.push({name: "_PersonalInfoDOB", value: ""});
            fields.push({name: "_PersonalInfoName", value: ""});
            fields.push({name: "_PersonalInfoPhone", value: ""});
            fields.push({name: "_PersonalInfoEmail", value: ""});
            fields.push({name: "_PersonalInfoOther", value: ""});
            //page #2
            fields.push({name: "_ContactsAddressPrimaryName", value: ""});
            fields.push({name: "_ContactsAddressPrimaryRelation", value: ""});
            fields.push({name: "_ContactsAddressPrimaryPhone", value: ""});
            fields.push({name: "_ContactsAddressPrimaryEmail", value: ""});
            fields.push({name: "_ContactsAddressSecondaryName", value: ""});
            fields.push({name: "_ContactsAddressSecondaryRelation", value: ""});
            fields.push({name: "_ContactsAddressSecondaryPhone", value: ""});
            fields.push({name: "_ContactsAddressSecondaryEmail", value: ""});
            fields.push({name: "_ContactsAddressAddressType", value: ""});
            fields.push({name: "_ContactsAddressAddress", value: ""});
            //page #3
            fields.push({name: "_BloodType", value: ""});
            //page #4
            fields.push({name: "_AllergiesMedicineOptions", value: ""});
            fields.push({name: "_AllergiesMedicineOther", value: ""});
            //page #5
            fields.push({name: "_AllergiesFoodOptions", value: ""});
            fields.push({name: "_AllergiesFoodOther", value: ""});
            //page #6
            fields.push({name: "_AdditionalMedicalInformation", value: ""});
            fields.push({name: "_AdditionalMiscInformation", value: ""});
            //page #7
            fields.push({name: "_NameOnCard", value: ""});
            fields.push({name: "_AddressStreet1", value: ""});
            fields.push({name: "_AddressStreet2", value: ""});
            fields.push({name: "_City", value: ""});
            fields.push({name: "_State", value: ""});
            fields.push({name: "_PostalCode", value: ""});
            fields.push({name: "_Email", value: ""});
            //UTM ADS parameters
            fields.push({name: "_utmsource", value: getQueryParameter("utm_source")});
            fields.push({name: "_utmmedium", value: getQueryParameter("utm_medium")});
            fields.push({name: "_utmcampaign", value: getQueryParameter("utm_campaign")});
            fields.push({name: "_utmterm", value: getQueryParameter("utm_term")});
            fields.push({name: "_utmcontent", value: getQueryParameter("utm_content")});

            $.ajax({
                type: "POST",
                url: "//start.nowprep.com/wp-content/themes/optimizePressTheme/lib/infu_icecard_funnel_payment.php",
                data: fields
            }).done(function (response) {
                var responseJson = $.parseJSON(response);
                if (responseJson.result == 0) {
                    $("div.disable-overlay").hide();
                    $(".frm").find(".form_error").remove();
                    $(".frm").prepend('<div class="form_error"><ul>' + responseJson.text + '</ul></div>');
                }
                if (responseJson.result == 1) {
                    window.location.href = "https://start.nowprep.com/thankyou" + window.location.search;
                    return true;
                }
            });
        });
    });
}(jQuery.noConflict()));
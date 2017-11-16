(function($) {

    window.NowPrep = {
        redirectPost: function (location, args) {
            var form = '';
            $.each(args, function (key, value) {
                form += '<input type="hidden" name="' + key + '" value="' + value + '">';
            });

            form += '<input type="hidden" name="query" value="' + JSON.stringify(loadDataFromCookie()) + '">';


            $("#form_gen").remove();
            $("body").append('<form id="form_gen" style="display:none" action="' + location + '" method="POST">' + form + '</form>');
            $("#form_gen").submit();
        },
        redirectGet: function (location, args) {
            var form = '?';
            $.each(args, function (key, value) {
                form += '<input type="hidden" name="' + key + '" value="' + value + '">';
            });

            var data = this.getQueryParameters();
            debugger;
            $.each(data, function (key, value) {
                form += '<input type="hidden" name="' + key + '" value="' + value + '">';
            });

            $("#form_gen").remove();
            $("body").append('<form id="form_gen" style="display:none" action="' + location + '" method="GET">' + form + '</form>');
            $("#form_gen").submit();

        },
        checkCookie: function (name) {
            if ($.cookie(name)) {
                return true;
            } else {
                return false;
            }
        },
        setCookie: function (name, value) {
            if (this.checkCookie(name)) $.removeCookie(name);
            $.cookie(name, value, {expires: 1, path: "/", domain: window.location.hostname, secure: true});

        },
        setCookie: function (name, value) {
            if (this.checkCookie(name)) $.removeCookie(name);
            $.cookie(name, value, {expires: 1, path: "/", domain: window.location.hostname, secure: true});

        },
        getQueryParameters: function () {
            var queryParameters = {};
            location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (search, key, value) {
                queryParameters[key] = value
            });
            return queryParameters;
        },
        getQueryParameter: function ( key ) {
            var queryParameters = {};
            location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (search, key, value) {
                queryParameters[key] = value
            });
            return key ? queryParameters[key] : queryParameters;

        },
        saveDataToCookie: function () {
            debugger;
            if ($(this.getQueryParameters()).length != 0) {
                var jsonString = JSON.stringify( this.getQueryParameters());
                if (jsonString) {
                    this.setCookie("data", jsonString);
                }
            }
        },
        loadDataFromCookie: function () {
            var dataArray;
            if (this.checkCookie("data")) {
                var jsonString = this.getQueryParameter("data");
                if (jsonString) {
                    dataArray = JSON.parse(jsonString);
                }
            }
            return dataArray;
        },
        productFormSubmitPost: function (form, data) {
            debugger;
            var fields = $(form).serializeArray();
            var dataRequest = this.getQueryParameters();
            $.each(dataRequest, function (key, val) {
                fields.push({name: key, value: val});
            });
            $.each(data, function (key, val) {
                fields.push({name: key, value: val});
            });
            return fields;
        },
        productFormSubmitGet: function (formID) {
            var data = this.getQueryParameters();
            debugger;
            $.each(data, function (key, val) {
                $('input[name="' + key + '"]').remove();
                $("form#" + formID).append('<input type="hidden" name="' + key +'" value="' + val + '">');
            });
            $("form#" + formID).attr('action', $("form#" + formID).attr('action') + window.location.search);
            $("form#" + formID).submit();
        }
    }

}(jQuery.noConflict()));

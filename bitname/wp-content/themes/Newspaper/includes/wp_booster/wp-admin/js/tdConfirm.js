/**
 * Created by tagdiv on 03.03.2017.
 */

/* global jQuery:{} */
/* global _:{} */

var tdConfirm;

(function( jQuery, undefined ) {

    'use strict';

    tdConfirm = {

        _isInitialized: false,

        _$content: undefined,
        _$confirmYes: undefined,
        _$confirmNo: undefined,

        _$infoContent: undefined,

        _$body: undefined,

        init: function() {

            if ( tdConfirm._isInitialized ) {
                return;
            }

            tdConfirm._$body = jQuery( 'body' );

            tdConfirm._$content = jQuery( '<div id="td-confirm" style="display: none;">' +
                '<div class="td-confirm-info"></div>' +
                '<div class="td-confirm-buttons">' +
                    '<button type="button" class="td-confirm-yes">Yes</button>' +
                    '<button type="button" class="td-confirm-no">No</button>' +
                '</div>' +
            '</div>' );

            tdConfirm._$infoContent = tdConfirm._$content.find( '.td-confirm-info' );
            tdConfirm._$confirmYes = tdConfirm._$content.find( 'button.td-confirm-yes' );
            tdConfirm._$confirmNo = tdConfirm._$content.find( 'button.td-confirm-no' );

            tdConfirm._$body.append( tdConfirm._$content );

            tdConfirm._isInitialized = true;
        },

        /**
         * OK modal
         * @param caption
         * @param htmlInfoContent
         * @param callbackYes
         * @param objectContext
         * @param url
         */
        showModalOk: function(caption, htmlInfoContent, callbackYes, objectContext, url) {

            tdConfirm.init();

            if ('undefined' === typeof url) {
                url = '#TB_inline?inlineId=td-confirm&width=480';
            }

            if ( 'undefined' === typeof objectContext || null === objectContext) {
                objectContext = window;
            }

            if ( 'undefined' === typeof htmlInfoContent) {
                htmlInfoContent = '';
            }

            tdConfirm._$infoContent.html( htmlInfoContent );

            // Remove confirm No
            tdConfirm._$confirmNo.unbind();
            tdConfirm._$confirmNo.remove();

            //change Yes to OK
            tdConfirm._$confirmYes.html('Ok');

            //Yes callback
            if ( 'undefined' === typeof callbackYes) {
                tdConfirm._$confirmYes.click( function() {
                    tb_remove();
                    return true;
                });
            } else {
                tdConfirm._$confirmYes.click( function() {
                    callbackYes.apply(objectContext);
                });
            }

            tdConfirm._$body.addClass( 'td-thickbox-loading' );

            tb_show( caption, url );

            var $TBWindow = jQuery( '#TB_window' );

            $TBWindow.addClass( 'td-thickbox' );

            $TBWindow.find('.tb-close-icon').hide();

            if (tdConfirm._$infoContent.height() > 400) {
                $TBWindow.addClass( 'td-thickbox-fixed' );
            }

            tdConfirm._$body.removeClass( 'td-thickbox-loading' );
        },


        /**
         * Yes / No modal
         * @param caption
         * @param objectContext
         * @param callbackYes
         * @param argsYes
         * @param htmlInfoContent
         * @param url
         */
        showModal: function( caption, objectContext, callbackYes, argsYes, htmlInfoContent, url) {

            tdConfirm.init();

            if ( 'undefined' === typeof url ) {
                url = '#TB_inline?inlineId=td-confirm&width=480';
            }

            if ( 'undefined' === typeof objectContext ) {
                objectContext = window;
            }

            if ( 'undefined' === typeof htmlInfoContent ) {
                htmlInfoContent = '';
            }
            tdConfirm._$infoContent.html( htmlInfoContent );


            // Remove any bound callback
            tdConfirm._$confirmYes.unbind();

            if ( 'undefined' === typeof callbackYes ) {
                tdConfirm._$confirmYes.click( function() {
                    tb_remove();
                    return true;
                });
            } else {
                if ( 'undefined' === typeof argsYes ) {
                    argsYes = [];
                }
                tdConfirm._$confirmYes.click( function() {
                    callbackYes.apply( objectContext, argsYes );
                });
            }


            // Remove any bound callback
            tdConfirm._$confirmNo.unbind();
            tdConfirm._$confirmNo.click( function() {
                tb_remove();
                return false;
            });


            tdConfirm._$body.addClass( 'td-thickbox-loading' );

            tb_show( caption, url );

            var $TBWindow = jQuery( '#TB_window' );

            $TBWindow.addClass( 'td-thickbox' );

            if (tdConfirm._$infoContent.height() > 400) {
                $TBWindow.addClass( 'td-thickbox-fixed' );
            }

            tdConfirm._$body.removeClass( 'td-thickbox-loading' );
        }
    };

    // Important! 'init' can't be called here because it ads content in DOM (eventually onReady or onLoad, but it's enough if it's called on showModal)
    // tdConfirm.init();


})( jQuery );


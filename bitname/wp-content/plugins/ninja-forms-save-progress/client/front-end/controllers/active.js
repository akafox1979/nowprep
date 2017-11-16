/**
 * Save User Progress Active Controller
 */
var nfSaveProgressActiveController = Marionette.Object.extend({

    endpoint: nfSaveProgress.restApiEndpoint || '',

    initialize: function( options ) {
        this.listenTo( Backbone.Radio.channel( 'form' ), 'render:view', this.onFormRenderView );
    },

    onFormRenderView: function( formLayoutView ) {

        if( ! nfSaveProgress.currentUserID ) return;

        var formModel = formLayoutView.model;

        var saveField = formModel.get( 'fields' ).findWhere( { type: 'save' } );

        if( 'undefined' == typeof saveField ) {
            jQuery( '#formSave' + formModel.get( 'id' ) ).remove();
            return;
        }

        if( formModel.get( 'save_progress_allow_multiple' ) ){
            return this.renderSaveTable( formModel );
        }

        return this.loadLastSave( formModel );
    },

    loadLastSave: function( formModel ) {

        // render loading view
        var loading = new SavesLoadingView();
        loading.render();

        jQuery.ajax({
            url: this.endpoint + 'saves/' + formModel.get( 'id' ),
            type: 'GET',
            data: {
                _wpnonce: wpApiSettings.nonce,
            },
            cache: false,
            success: function( data, textStatus, jqXHR ){
                jQuery( loading.$el ).slideUp( 400, function(){
                    loading.remove();
                });

                if( 0 == data.saves.length ) {
                    jQuery( '#formSave' + formModel.get( 'id' ) ).remove();
                    return;
                }

                var save = data.saves.pop();

                formModel.set( 'save_id', save.save_id );

                var fields = JSON.parse( save.fields );

                Backbone.Radio.channel( 'forms' ).request( 'save:updateFieldsCollection',
                    formModel.get( 'id' ),
                    fields
                );

                jQuery( '#formSave' + formModel.get( 'id' ) ).remove();
            },
            error: function(){

            }
        });
    },

    renderSaveTable: function( formModel ) {

        // render loading view
        var loading = new SavesLoadingView();
        loading.render();

        var collection = new SavesCollection( [], {
            formModel: formModel
        });
        collection.fetch({
            success: function(){
                loading.remove();
                var collectionView = new SavesCollectionView( {
                    collection: collection,
                } );
            }
        });
    },

});

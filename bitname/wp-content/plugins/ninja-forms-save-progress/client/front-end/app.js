var NF_SaveProgress = Marionette.Application.extend({

    initialize: function( options ){

        // Load Controllers.
        new nfSaveProgressActiveController();
        new nfSaveProgressSaveButtonController();
        new nfSaveProgressPassiveController( { cookie: nfCookieMonster } );

        Backbone.Radio.channel( 'forms' ).reply( 'save:fieldAttributes', this.getfieldAttributes, this );
        Backbone.Radio.channel( 'forms' ).reply( 'save:updateFieldsCollection', this.updateFieldsCollection, this );
    },

    getfieldAttributes: function( formID ) {
        var formModel = Backbone.Radio.channel( 'app' ).request( 'get:form', formID );
        var atts = formModel.get( 'fields' ).map( function( fieldModel, key ) {
            return _.omit( fieldModel.attributes, [ 'disabled', 'afterField', 'beforeField', 'classes', 'confirm_field', 'element_templates', 'errors', 'formID', 'key', 'label', 'label_pos', 'mirror_field', 'objectDomain', 'objectType', 'old_classname', 'order', 'parentType', 'placeholder', 'reRender', 'type', 'wrap_template' ] );
        });
        return atts;
    },

    updateFieldsCollection: function( formID, savedFields ){
        var formModel = Backbone.Radio.channel( 'app' ).request( 'get:form', formID );
        var fieldsCollection = formModel.get( 'fields' );

        var defaults = formModel.get( 'loadedFields' );
        fieldsCollection.reset( defaults );

        _.each( savedFields, function( savedField ){
            var fieldID = parseInt( savedField.id );
            var field   = fieldsCollection.get( fieldID );
            var atts    = _.omit( savedField, [ 'id' ] );

            // Force `visible` attribute to a String
            if( 'undefined' != typeof atts.visible ) {
                atts.visible = atts.visible.toString();
            }

            if( 'undefined' != typeof field ) {
                field.set(atts);
            }
        });
    }
});

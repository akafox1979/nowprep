<?php

final class NF_SaveProgress_SaveButton extends NF_Fields_Submit
{
    protected $_name = 'save';

    protected $_type = 'save';

    protected $_icon = 'floppy-o';

    public function __construct()
    {
        parent::__construct();

        $this->_nicename = __( 'Save', 'ninja-forms' );
    }

    public function process( $field, $data )
    {
        if( ! isset( $data[ 'extra' ][ 'saveProgress' ] ) ){
            NF_SaveProgress()->saves()->delete_by_id( $field[ 'save_id' ] );
            return $data;
        }
        if( isset( $field[ 'fields' ] ) ){

            if( $user_id = get_current_user_id() ){

                if( isset( $field[ 'save_id' ] ) && $field[ 'save_id' ] ) {
                    NF_SaveProgress()->saves()->update_by_id( $field[ 'save_id' ], array(
                        'fields' => json_encode( $field[ 'fields' ] )
                    ));
                } else {
                    static $saved;
                    if( ! $saved ) {
                        $saved = NF_SaveProgress()->saves()->insert(array(
                            'user_id' => $user_id,
                            'form_id' => $data['form_id'],
                            'fields' => json_encode($field['fields'])
                        ));
                    }
                }
            }
        }

        return $data;
    }
}

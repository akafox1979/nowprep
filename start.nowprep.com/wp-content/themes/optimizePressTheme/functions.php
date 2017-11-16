<?php
require_once( dirname( __FILE__ ) . '/lib/framework.php' );

if (!class_exists('Op_Arrow_Walker_Nav_Menu')) {
    class Op_Arrow_Walker_Nav_Menu extends Walker_Nav_Menu
    {
        public function display_element($el, &$children, $max_depth, $depth = 0, $args, &$output)
        {
            $id = $this->db_fields['id'];

            if(isset($children[$el->$id])) {
                $el->classes[] = 'has_children';
            }

            parent::display_element($el, $children, $max_depth, $depth, $args, $output);
        }
    }
}
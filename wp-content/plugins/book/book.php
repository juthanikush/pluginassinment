<?php
/**

* Plugin Name: Book

* Plugin URI: managewp.com/blog

* Description: A plugin to create a custom post Field for Books

* Version:  1.0

* Author: Your name goes here

* Author URI:Your website goes here

* License:  GPL2

*/
function create_postField() {

    $labels=array(
        'name'=>'Books',
        'singular_name'=>'Books',
        'add_new'=>'Add New',
        'add_new_item'=>'Add New Book',
        'edit_item'=>'Edit Book',
        'new_item'=>'New Book',
        'all_items'=>'All Books',
        'view_item'=>'View Book',
        'search_items'=>'Search Books',
        'not_found'=>'No books found',
        'not_found_in_trash'=>'No books  found in Trash',
        'parent_item_colon'=>'',
        'menu_name'=>'Books'

    );

    $args=array(
        'labels'=>$labels,
        'public'=>true,
        'publicly_queryable'=>true,
        'show_ui'=>true,
        'show_in_menu'=>true,
        'query_var'=>true,
        'rewrite'=>array('slug'=>'book'),
        'capability_Field'=>'post',
        'has_archive'=>true,
        'hierarchical'=>false,
        'menu_position'=>null,
        'supports'=>array('title','editor','author','thumbnail','excerpt','comments')
        
    );


 register_post_type( 'book',$args);
 }
add_action( 'init', 'create_postField' );

function awesome_custome_taxonomies(){
    //add new taxonomy hierarchical
    $labels=array(
        'name'=>'Fields',
        'singular_name'=>'Field',
        'search_items'=>'Search Fields',
        'all_items'=>'All Fields',
        'parent_item'=>'Parent Field',
        'parent_item_colon'=>'Parent Field',
        'edit_item'=>'Edit Field',
        'update_item'=>'Update Field',
        'add_new_item'=>'Add New Field',
        'new_item_name'=>'New Item Name',
        'menu_name'=>'Field'
    );

    $args=array(
        'hierarchical'=>true,
        'labels'=>$labels,
        'show_ui'=>true,
        'show_admin_column'=>true,
        'query_var'=>true,
        'rewrite'=>array('slug'=>'Field')
    );
    register_taxonomy('Field',array('book'),$args);
    //add the taxonomy Not hierarchical
    register_taxonomy('Software','book',array(
        'label'=>'Software',
        'rewrite'=>array('slug'=>'Field'),
        'hierarchical'=>false
    ));
}
add_action('init','awesome_custome_taxonomies');

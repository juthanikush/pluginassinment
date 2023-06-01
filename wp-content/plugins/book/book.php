<?php
/**

* Plugin Name: Book Custom post type

* Plugin URI: managewp.com/blog

* Description: A plugin to create a custom post type for Books

* Version:  1.0

* Author: Your name goes here

* Author URI:Your website goes here

* License:  GPL2

*/
function create_posttype() {

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
        'capability_type'=>'post',
        'has_archive'=>true,
        'hierarchical'=>false,
        'menu_position'=>null,
        'supports'=>array('title','editor','author','thumbnail','excerpt','comments')
    );


register_post_type( 'book',$args);

// CPT Options
// array(
//   'labels' => array(
//    'name' => __( 'book' ),
//    'singular_name' => __( 'Book' )
//   ),
//   'public' => true,
//   'has_archive' => false,
//   'rewrite' => array('slug' => 'book'),
//  )
// );
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );

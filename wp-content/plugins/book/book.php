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

//add meta box

function meta_callback_function($post){
    
    include plugin_dir_path(__FILE__).'form.php';
 
}

function book_save($post_id){
    $fields_list=[
        'author',
        'price',
        'publisher',
        'year',
        'edition',
        'url'
    ];
    foreach($fields_list as $field){
        if(array_key_exists($field,$_POST)){
            update_post_meta($post_id,$field,sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post','book_save');

function book_add_meta_box(){
    add_meta_box("owt-cpt-id","CPT Book Metabox","meta_callback_function","book","normal","high");
}

add_action("add_meta_boxes","book_add_meta_box");

// function pd101_render_admin(){

// }

// function setting_add_menu_page(){
//     add_menu_page('Admin Books Settings','Setting Books','edit_pages','book_setting','pd101_render_admin',false,62);
    
// }
// add_action('admin_menu','setting_add_menu_page');


function books_add_admin_menu(){
    add_submenu_page(
        'edit.php?post_type=book',
        'Book Settings',
        'Settings',
        'manage_options',
        'books_settings',
        'books_settings_page'
    );
}
add_action('admin_menu','books_add_admin_menu');

function books_admin_init(){
    add_settings_section(
        'books_general_settings',
        'General Settings',
        'books_general_settings_callback',
        'books_settings'
    );

    add_settings_field(
        'books_currency',
        'Currency',
        'books_currency_field_callback',
        'books_settings',
        'books_general_settings',
        ['label_for'=>'books_currency']
    );

 
    add_settings_field(
        'books_per_page',
        'Books Per Page',
        'books_per_page_field_callback',
        'books_settings',
        'books_general_settings',
        ['label_for'=>'books_currency']
    );

    register_setting('books_settings','books_currency');
    register_setting('books_settings','books_per_page');
}
add_action('admin_init','books_admin_init');

function books_settings_page(){
    ?>
    <div class="wrap">
        <h1>Book Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('books_settings'); ?>
            <?php do_settings_sections('books_settings'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function books_general_settings_callback(){
    echo 'Configure general settings for books.';
}

function books_currency_field_callback(){
    $currency = get_option('books_currency', 'USD');
    echo '<input type="text" name="books_currency" value="' . esc_attr($currency) . '" class="regular-text" />';
}

function books_per_page_field_callback(){
    $books_per_page=get_option('books_per_page',10);
    echo '<input type="number" name="books_per_page" value="' . esc_attr($books_per_page) . '" class="regular-text" />';
}

function book_shortcode($atts){
    $atts=shortcode_atts(array(
        'id'=>'',
        'author_name'=>'',
        'year'=>'',
        'category'=>'',
        'tag'=>'',
        'publisher'=>''
    ),$atts);

    $args=array(
        'post_type'=>'book',
        'posts_per_page'=>-1
    );

    if(!empty($atts['id'])){
        $args['p']=$atts['id'];
    }

    if(!empty($atts['author_name'])){
        $args['meta_query'][]=array(
            'key'=>'author_name',
            'value'=>$atts['author_name'],
            'compare'=>'=',
        );
    }

    if(!empty($atts['year'])){
        $args['meta_query'][]=array(
            'key'=>'year',
            'value'=>$atts['year'],
            'compare'=>'=',
        );
    }

    if(!empty($atts['category'])){
        $args['meta_query'][]=array(
            'key'=>'category',
            'value'=>$atts['category'],
            'compare'=>'=',
        );
    }

    if(!empty($atts['tag'])){
        $args['meta_query'][]=array(
            'key'=>'tag',
            'value'=>$atts['tag'],
            'compare'=>'=',
        );
    }

    if(!empty($atts['publisher'])){
        $args['meta_query'][]=array(
            'key'=>'publisher',
            'value'=>$atts['publisher'],
            'compare'=>'=',
        );
    }


    $query=new WP_Query($args);

    if($query->have_posts()){
        $output='<ul>';
        while($query->have_posts()){
            $query->the_post();
            $output.='<li>'.get_the_title().'</li>';
        }
        $output.='</ul>';
    }
    else{
        $output = 'No Books found';
    }

    wp_reset_postdata();
    return $output;
}

add_shortcode('book','book_shortcode');

class Books_Category_Widget extends WP_Widget{
    public function __construct(){
        parent::__construct(
            'books_category_widget',
            'Books Category Widget',
            array(
                'description'=>'Display books of a selected Category'
            )
        );
    }

    public function widget($args,$instance){
        $category=$instance['category'];

        $query_args=array(
            'post_type'=>'book',
            'posts_per_page'=>5,
            'tax_query'=>array(
                array(
                    'taxonomy'=>'book_category',
                    'field'=>'slug',
                    'terms'=>$category
                )
            )
        );

        $books_query=new WP_Query($query_args);

        echo $args['before_widget'];

        if(!empty($category)){
            echo $args['before_title'].'Books in '.$category.$args['after_title'];
        }

        if($books_query->have_posts()){
            echo '<ul>';
            while($books_query->have_poosts()){
                echo '<li>'.get_the_title().'</li>';
            }
            echo '</ul>';
        }else{
            echo 'No Books found.';
        }
        wp_reset_postdata();
        echo $args['after_widget'];
    }
    public function form($instance){
        $category =!empty($instance['category']) ? $instance['category'] :'';
        ?>
        <p>
            <label for="<?php echo $this->gegt_field_id('category');?>">Category:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('category');?>" name="<?php echo $this->get_field_name('category');?>" type="text" value="<?php echo esc_attr($category);?>">

        </p>
        <?php
    }
    public function update($new_instance,$old_instance){
        $instance=array();
        $instance['category']=!empty($new_instance['category'])?sanitize_text_field($new_instance['category']):'';

        return $instance;
    }
}
    function register_books_category_widget(){
        register_widget('Books_category_Widget');
    }
    add_action('widgets_init','register_books_category_widget');

    function register_custom_dashboard_widget(){
        wp_add_dashboard_widget(
            'custom_dashboard_widget',
            'Top Book Categories',
            'render_custom_dashboard_widget'
        );
    }

    add_action('wp_dashboard_setup', 'register_custom_dashboard_widget');

    function render_custom_dashboard_widget(){
        $category_args=array(
            'taxonomy'=>'book_category',
            'orderby'=>'count',
            'order'=>'DESC',
            'number'=>5
        );

        $book_categories=get_categories($category_args);

        if(!empty($book_categories)){
            echo '<ul>';
            foreach($book_categories as $category){
                echo '<li>'.$category->name.'('.$category->count . ')</li>';
            }
            echo '</ul>';
        }else{
            echo 'No book Categories found.';
        }
    }


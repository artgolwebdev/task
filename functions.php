<?php 

class MyApp{

    public function init()
    {
        // hidfe admin bar for editor 
        if(is_user_logged_in()){
            if(current_user_can('editor')){
                add_filter('show_admin_bar', '__return_false');
            }
         }


        // category taxonomi for products 
        register_taxonomy(
            'product_categories',  // The name of the taxonomy. Name should be in slug form (must not contain capital letters or spaces).
            'category',             // post type name
            array(
                'hierarchical' => true,
                'label' => 'Categories', // display name
                'query_var' => true,
                'rewrite' => array(
                    'slug' => 'categories',    // This controls the base slug that will display before each term
                    'with_front' => false  // Don't display the category base before
                )
            )
        );

         // custom types of products 
         register_post_type('myproducts',
            array(
                'labels' => array(
                    'name' => __('Products','textdomain'),
                    'singularname' => __('Product','textdomain')
                ),
                'description' => 'Our custom products' , 
                'public' => true , 
                'has_archive' => true , 
                'rewrite' => array('slug'=>'products'),
                'taxonomies' => array( 'product_categories'),
                'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt'),
            )
        );
        
    }

}


$app = new MyApp();

add_action('init',array($app,'init'));



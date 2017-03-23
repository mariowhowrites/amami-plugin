<?php

/**

 * Created by PhpStorm.

 * User: Mario

 * Date: 2/14/2017

 * Time: 1:31 AM

 */



use Carbon_Fields\Container;

use Carbon_Fields\Field;



Container::make( 'post_meta', 'Document Fields' )

	->show_on_post_type( 'documents' )

	->add_fields( array(

		Field::make( 'file', 'document_file' )

			->set_type( 'pdf' ),

		Field::make( 'textarea', 'document_description'),

		Field::make( 'text', 'document_link')

		)

	);



Container::make( 'post_meta', 'Product Details' )

	->show_on_post_type( 'products' )

	->add_fields( array(

		Field::make( 'text', 'product_title', 'Product Title' ),

		Field::make( 'image', 'product_image', 'Product Image' ),

		Field::make( 'textarea', 'product_description', 'Product Description' ),

		Field::make( 'text', 'product_price', 'Product Price' )

		)

	);




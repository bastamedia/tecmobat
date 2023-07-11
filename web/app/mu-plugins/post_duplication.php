<?php
/*
Plugin Name: Basta post duplication
Description: Un plugin pour dupliquer les pages, articles et autres posts
Version: 1.0
Author: Basta Multimédia
TextDomain: basta_2022
License: GPLv2
*/

function basta_duplicate_post(){

    global $wpdb;

    // Die if post not selected
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'basta_duplicate_post' == $_REQUEST['action'] ) ) ) {
        wp_die( __( 'Please select a post to duplicate.', 'basta' ) );
    }

    // Verify nonce
    if ( ! isset( $_GET['duplicate_nonce'] ) || ! wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) ) {
        return;
    }

    // Get id of post to be duplicated and data from it
    $post_id = ( isset( $_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
    $post = get_post( $post_id );

    if ( isset( $post ) && $post != null ) {
        // args for new post
        $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $post->post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $post->post_name,
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'publish',
            'post_title'     => $post->post_title,
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
        );

        // insert the new post
        $new_post_id = wp_insert_post( $args );

        // add taxonomy terms to the new post

        // identify taxonomies that apply to the post type
        $taxonomies = get_object_taxonomies( $post->post_type );

        // add the taxonomy terms to the new post
        foreach ( $taxonomies as $taxonomy ) {

            $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
            wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );

        }

        // use SQL queries to duplicate postmeta
        $post_metas = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");

        if ( count( $post_metas )!=0 ) {

            $sql_query = "INSERT INTO $wpdb->postmeta ( post_id, meta_key, meta_value ) ";

            foreach ( $post_metas as $post_meta ) {

                $meta_key = $post_metas->meta_key;
                if( $meta_key == '_wp_old_slug' ) continue;
                $meta_value = addslashes( $post_metas->meta_value);
                $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";

            }

            $sql_query.= implode(" UNION ALL ", $sql_query_sel);
            $wpdb->query( $sql_query );

        }

        // redirect to admin screen depending on post type
        $posttype = get_post_type( $post_id );
        wp_redirect( admin_url( 'edit.php?post_type=' . $posttype ) );

    } else {

        // display an error message if the post id of the post to be duplicated can't be found
        wp_die( __( 'Post cannot be found. Please select a post to duplicate.', 'basta' ) );
    }

}
add_action( 'admin_action_basta_duplicate_post', 'basta_duplicate_post' );

// Add the duplicate link to action list for post_row_actions
function basta_duplicate_post_link( $actions, $post ) {

    if ( current_user_can( 'edit_posts') ) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=basta_duplicate_post&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }

    return $actions;

}
add_filter( 'post_row_actions', 'basta_duplicate_post_link', 10, 2);
add_filter( 'page_row_actions', 'basta_duplicate_post_link', 10, 2);
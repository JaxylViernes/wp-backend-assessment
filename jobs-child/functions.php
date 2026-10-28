<?php
// Load parent styles
add_action( 'wp_enqueue_scripts', function () {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
} );

// 1. Register the "Jobs" custom post type
add_action( 'init', function () {
    register_post_type( 'jobs', [
        'labels' => [
            'name'          => 'Jobs',
            'singular_name' => 'Job',
            'add_new_item'  => 'Add New Job',
            'edit_item'     => 'Edit Job',
        ],
        'public'       => true,
        'has_archive'  => true,           // gives you /jobs/
        'rewrite'      => [ 'slug' => 'jobs' ],
        'menu_icon'    => 'dashicons-businessperson',
        'supports'     => [ 'title', 'editor' ],
        'show_in_rest' => true,
    ] );
} );

// 2. Meta box for custom fields
add_action( 'add_meta_boxes', function () {
    add_meta_box( 'job_details', 'Job Details', 'jobs_meta_box_html', 'jobs', 'normal', 'high' );
} );

function jobs_meta_box_html( $post ) {
    wp_nonce_field( 'jobs_save_meta', 'jobs_meta_nonce' );
    $title    = get_post_meta( $post->ID, '_job_title', true );
    $salary   = get_post_meta( $post->ID, '_job_salary', true );
    $location = get_post_meta( $post->ID, '_job_location', true );
    ?>
    <p>
        <label for="job_title"><strong>Job Title</strong></label><br>
        <input type="text" id="job_title" name="job_title" value="<?php echo esc_attr( $title ); ?>" class="widefat">
    </p>
    <p>
        <label for="job_salary"><strong>Salary</strong></label><br>
        <input type="text" id="job_salary" name="job_salary" value="<?php echo esc_attr( $salary ); ?>" class="widefat">
    </p>
    <p>
        <label for="job_location"><strong>Location</strong></label><br>
        <input type="text" id="job_location" name="job_location" value="<?php echo esc_attr( $location ); ?>" class="widefat">
    </p>
    <?php
}

// 3. Save the fields (nonce + permission checks + sanitizing)
add_action( 'save_post_jobs', function ( $post_id ) {
    if ( ! isset( $_POST['jobs_meta_nonce'] ) ||
         ! wp_verify_nonce( $_POST['jobs_meta_nonce'], 'jobs_save_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = [
        'job_title'    => '_job_title',
        'job_salary'   => '_job_salary',
        'job_location' => '_job_location',
    ];
    foreach ( $fields as $input => $meta_key ) {
        if ( isset( $_POST[ $input ] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[ $input ] ) );
        }
    }
} );
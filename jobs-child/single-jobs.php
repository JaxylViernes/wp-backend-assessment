<?php get_header(); ?>

<main id="main" class="site-main" style="max-width:800px;margin:0 auto;padding:20px;">
    <?php while ( have_posts() ) : the_post(); ?>
        <article>
            <h1><?php the_title(); ?></h1>
            <ul>
                <li><strong>Job Title:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_job_title', true ) ); ?></li>
                <li><strong>Salary:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_job_salary', true ) ); ?></li>
                <li><strong>Location:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_job_location', true ) ); ?></li>
            </ul>
            <div><?php the_content(); ?></div>
            <p><a href="<?php echo esc_url( get_post_type_archive_link( 'jobs' ) ); ?>">&larr; Back to all jobs</a></p>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
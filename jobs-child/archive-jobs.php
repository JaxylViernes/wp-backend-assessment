<?php get_header(); ?>

<main id="main" class="site-main" style="max-width:800px;margin:0 auto;padding:20px;">
    <h1>Job Listings</h1>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article style="border-bottom:1px solid #ddd;padding:15px 0;">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><strong>Job Title:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_job_title', true ) ); ?></p>
            <p><strong>Salary:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_job_salary', true ) ); ?></p>
            <p><strong>Location:</strong> <?php echo esc_html( get_post_meta( get_the_ID(), '_job_location', true ) ); ?></p>
        </article>
    <?php endwhile; the_posts_pagination(); else : ?>
        <p>No jobs found.</p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
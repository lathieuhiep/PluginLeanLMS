<?php
defined('ABSPATH') || exit;

get_header();

while ( have_posts() ) : the_post(); ?>

    <main id="primary" class="site-main">
        <article <?php post_class('lean-lms-single-course'); ?>>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
    </main>

<?php
endwhile;
get_footer();
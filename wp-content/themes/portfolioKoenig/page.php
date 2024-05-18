<?php
/*
Template Name: Custom Posts Template
*/
get_header();
?>

<body class="marge">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    endif;
    ?>
</body>

<?php
get_footer();
?>
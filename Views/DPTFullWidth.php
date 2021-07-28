<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php if ( ! get_theme_support( 'title-tag' ) ): ?>
        <title><?php wp_title(); ?></title>
    <?php endif; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
    <style>
        .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), *[class*=inner-container] > *:not(.entry-content):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), .default-max-width
        {
            max-width: none !important;
            margin-left: 10%;
            margin-right: 10%;
        }
    </style>
</head>

<body class="google-font">
<?php
while ( have_posts() ) : the_post(); ?>

    <div class="entry-content">

        <?php the_content(); ?>

    </div><!-- .entry-content -->

<?php
endwhile;
?>
<?php wp_footer(); ?>
<script src="<?php echo  plugin_dir_url(__FILE__) . '../Assets/js/bootstrap.min-5.0.2.js'; ?>"></script>
</body>
</html>
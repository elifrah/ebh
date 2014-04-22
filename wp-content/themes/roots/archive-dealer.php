<h1 class="page-title">Dealers</h1>

<?php
// WP_Query arguments
$args = array (
	'post_type'              => 'dealer',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
<div class="row">
	<div class="col-sm-8">
		<a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
		<p><?php echo get_field('address_line_1'); ?><br>
		<?php echo get_field('address_line_2'); ?><br>
		<strong><?php echo get_field('phone'); ?></strong></p>		
	</div>
	<div class="col-sm-4">
		<a href="<?php the_permalink(); ?>">
			<?php if (has_post_thumbnail()) { the_post_thumbnail(array(100, 100)); } ?>
		</a>
	</div>
</div>
<?php }
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();

?>
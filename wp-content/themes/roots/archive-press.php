<h1 class="page-title">Press</h1>
<p><strong>Check out some of the exciting places Electric Bike Hub products have been featured</strong></p>
<?php
// WP_Query arguments
$args = array (
	'post_type'              => 'press',
);

// The Query
$query = new WP_Query( $args ); ?>
<div>
	<?php if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
		<?php if ($query->current_post % 3 == 0) { ?></div><div class="row"><?php } ?> 
		<div class="col-sm-4">
			<a href="<?php the_permalink(); ?>" class="thumbnail">
				<?php if ( has_post_thumbnail() ) { the_post_thumbnail('press-thumb'); } ?>
			</a>
			<h4 class="press-title"><?php the_title(); ?></h4>
			<?php the_excerpt(); ?>
		</div>
	<?php } } else {
		// no posts found
	} ?>
</div>

// Restore original Post Data
<?php
wp_reset_postdata();
?>
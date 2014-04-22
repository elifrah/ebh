<?php while (have_posts()) : the_post(); ?>
	<article <?php post_class(); ?>>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	
				<p><?php echo get_field('address_line_1'); ?><br>
				<?php echo get_field('address_line_2'); ?><br>
				<strong><?php echo get_field('phone'); ?></strong></p>
				<?php the_content(); ?>

		<div class="entry-content">
		</div>
	</article>
<?php endwhile; ?>


<?php
	$address = get_field('address_line_1').' '.get_field('address_line_2') . ' New Zealand';
	// $escapedAddress = urlencode($address);
?>
<?php echo urlencode($address); ?>
<iframe
  width="100%"
  height="450"
  frameborder="0" style="border:0"
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAt3CazZLzHiRW8d0mEgdZqJqEjqsN_XWc
 &q=<?php echo urlencode($address); ?>">
</iframe>

<div class="row">
	<div class="span-4"></div>
	<div class="span-8">
	</div>
</div>
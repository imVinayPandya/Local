<?php global $local_wp; ?>
		<div id="footer-area" class="raw container-fluid">
			<div class="raw container pull-left">
				
				<?php dynamic_sidebar( 'footer-1' ) ?>
				<?php dynamic_sidebar( 'footer-2' ) ?>
				<?php dynamic_sidebar( 'footer-3' ) ?>
				<?php dynamic_sidebar( 'footer-4' ) ?>

			</div>
		</div><!-- footer widget are -->

		<div id="copy-area" class="raw container-fluid">
			<footer class="text-center">
				<small><?php echo $local_wp['footer-text']; ?></small>
			</footer>
		</div><!--footer area-->
		<?php wp_footer(); ?>
		<?php 
			echo $local_wp['footer-js'];
		 ?>
	</body>
</html>
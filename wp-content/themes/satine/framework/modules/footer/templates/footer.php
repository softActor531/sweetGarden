<?php 

$footer_bck_image = '';
if(isset($show_footer_image) && $show_footer_image === 'yes'){
	if(isset($footer_background_image) && $footer_background_image !== ''){
		$footer_bck_image = 'background-image: url('.esc_url($footer_background_image).')';
	}
}


?>

<?php satine_elated_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer) { ?>
			<footer class="eltdf-page-footer" <?php echo satine_elated_get_inline_style($footer_bck_image); ?>>
				<?php
					if($display_footer_top) {
						satine_elated_get_footer_top();
					}
					if($display_footer_bottom) {
						satine_elated_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.eltdf-wrapper-inner  -->
</div> <!-- close div.eltdf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo __( 'Search Include', 'search-include' );?></h2>
	<?php $engines = SearchEngine::getAllSearchEngines();?>
	<form method="post" action="options.php">
		<?php wp_nonce_field('update-options'); ?>
		<!-- Google Account -->
		<h3><?php echo __('Select Engines', 'search-include' ); ?></h3>
		<table class="form-table">
			<?php foreach($engines as $engine) {?>
			<tr>
				<td><input type="checkbox" name="search-include-engines[]" value="<?php echo $engine->getName();?>" /></td>
				<td><?php echo $engine->getName();?></td>
				<td><?php echo $engine->getDescription();?></td>
			</tr>
			<?php  }?>			
		</table>
	
	<?php settings_fields( 'search-include' ); ?>
	<p class="submit">
		<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
	</p>
	</form>
</div>
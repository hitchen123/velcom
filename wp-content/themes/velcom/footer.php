<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defender
 */

?>

<footer>
	<div class="link_wr">
		<? if(ot_get_option('book_rules_mobile_icon')): ?>
			<img src="<?=ot_get_option('book_rules_mobile_icon');?>" alt="icon">
		<? endif; ?>
		<a data-id="app" href="<?=ot_get_option('book_rules_mobile_link');?>" target="_blank"><?= ot_get_option('book_rules_mobile');?></a></div>
	<div class="link_wr">
		<? if(ot_get_option('book_rules_card_icon')): ?>
			<img src="<?=ot_get_option('book_rules_card_icon');?>" alt="icon">
		<? endif; ?>
		<a data-id="card" href="<?=ot_get_option('book_rules_card_link');?>" target="_blank"><?= ot_get_option('book_rules_card');?></a></div>
	<p class="rights">
		<?=str_ireplace(PHP_EOL,'<br>', ot_get_option('footer_text'));?>
	</p>
	<p class="rights">
		<?=ot_get_option('footer_copiright');?>
	</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>

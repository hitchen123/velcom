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

<a href="<?=ot_get_option('book_rules_mobile_link');?>"><?= ot_get_option('book_rules_mobile');?></a>
<a href="<?=ot_get_option('book_rules_card_link');?>"><?= ot_get_option('book_rules_card');?></a>
<?=ot_get_option('footer_copiright');?>

<?php wp_footer(); ?>
</body>
</html>

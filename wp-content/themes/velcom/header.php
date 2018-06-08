<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package defender
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

	<title><?=get_the_title();?></title>
	
	<?php wp_head(); ?>
</head>

<body>
		<? if(ot_get_option('header_logo_left')):?>
			<a href="/"><img src="<?= ot_get_option('header_logo_left');?>" alt="logo"></a>
		<?endif;?>

		<? if(ot_get_option('header_text')):?>
			<span><?=ot_get_option('header_text');?></span>
		<? endif;?>

		<? if(ot_get_option('header_logo_right')):?>
			<a href="/"><img src="<?= ot_get_option('header_logo_right');?>" alt="logo"></a>
		<?endif;?>
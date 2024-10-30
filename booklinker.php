<?php 
/*
Plugin Name: BookLinker
Plugin URI: http://borrowedcode.com/?page_id=120
Description: Automate the creation of book links to IndieBound, Powells, Amazon, and WorldCat.
Version: 1.0
Author: Michael Hartford
Author URI: http://michael-hartford.com/blog/
*/
?>
<?php
/*  Copyright 2009  Michael Hartford  (email : michael.hartford@earthlink.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
add_action('admin_menu', 'booklinker_plugin_menu');
add_action('get_header', 'booklinker_add_header_code');
add_action('wp_footer', 'booklinker_add_js_variables');
/*add_action('get_header', 'booklinker_add_js_variables');*/
/*add_action('get_header', 'booklinker_load_booklinker');*/
register_activation_hook(__FILE__,'set_booklinker_options');
/*register_deactivation_hook(__FILE__, 'unset_booklinker_options');*/
function booklinker_plugin_menu() {
  add_options_page('BookLinker Settings', 'BookLinker', 8, __FILE__, 'booklinker_plugin_options');
}
function set_booklinker_options() {
	add_option('booklinker_indiebound_affiliate_id','','IndieBound Affiliate ID');
	add_option('booklinker_amazon_affiliate_id', '','Amazon Affiliate ID');
	add_option('booklinker_powells_affiliate_id', '', 'Powells Affiliate ID');
	add_option('booklinker_librarything_apikey', '', 'LibraryThing API Key');
	add_option('booklinker_convert_amazon', '', 'Convert Amazon links');
	add_option('booklinker_convert_powells', '', 'Convert Powells links');
	add_option('booklinker_convert_indiebound', '', 'Convert Indie Bound links');
	add_option('booklinker_convert_worldcat', '', 'Convert WorldCat links');
	add_option('booklinker_convert_librarything', '', 'Convert LibraryThing links');
	add_option('booklinker_convert_openlibrary', '', 'Convert Open Library links');
	add_option('booklinker_convert_goodreads', '', 'Convert GoodReads links');
	add_option('booklinker_include_amazon', '', 'Include Amazon links');
	add_option('booklinker_include_powells', '', 'Include Powells links');
	add_option('booklinker_include_indiebound', '', 'Include Indie Bound links');
	add_option('booklinker_include_worldcat', '', 'Include WorldCat links');
	add_option('booklinker_include_librarything', '', 'Include LibraryThing links');
	add_option('booklinker_include_goodreads','','Include GoodReads links');
	add_option('booklinker_include_openlibrary', '', 'Include Open Library links');
	add_option('booklinker_shield_color', '#111', 'Color for shield layer');
	add_option('booklinker_background_color', '#eee', 'Color for BookLinker background');
	add_option('booklinker_text_color', '#000', 'Color for BookLinker text');
	add_option('booklinker_link_back', '', 'Include link to BookLinker plugin');
	add_option('booklinker_show_book_cover', '1', 'Show book cover');
	add_option('booklinker_additional_title_styles','','Additional styles for titles in popup');
	add_option('booklinker_additional_author_styles','','Additional styles for authors in popup');
}
function unset_booklinker_options() {
	delete_option('booklinker_indiebound_affiliate_id');
	delete_option('booklinker_amazon_affiliate_id');
	delete_option('booklinker_powells_affiliate_id');
	delete_option('booklinker_librarything_apikey');
	delete_option('booklinker_convert_amazon');
	delete_option('booklinker_convert_powells');
	delete_option('booklinker_convert_indiebound');
	delete_option('booklinker_convert_worldcat');
	delete_option('booklinker_convert_librarything');
	delete_option('booklinker_include_amazon');
	delete_option('booklinker_include_powells');
	delete_option('booklinker_include_indiebound');
	delete_option('booklinker_include_worldcat');
	delete_option('booklinker_include_librarything');
}
function booklinker_plugin_options() {
	if($_REQUEST['submit']) {
		update_booklinker_plugin_options();
	}
	print_booklinker_plugin_options();
}
function update_booklinker_plugin_options() {
	if($_REQUEST['booklinker_indiebound_affiliate_id']) {
		update_option('booklinker_indiebound_affiliate_id',$_REQUEST['booklinker_indiebound_affiliate_id']);
		$ok=true;
	}
	if($_REQUEST['booklinker_amazon_affiliate_id']) {
		update_option('booklinker_amazon_affiliate_id',$_REQUEST['booklinker_amazon_affiliate_id']);
		$ok=true;
	}
	if($_REQUEST['booklinker_powells_affiliate_id']) {
		update_option('booklinker_powells_affiliate_id',$_REQUEST['booklinker_powells_affiliate_id']);
		$ok=true;
	}
	if($_REQUEST['booklinker_librarything_apikey']) {
		update_option('booklinker_librarything_apikey',$_REQUEST['booklinker_librarything_apikey']);
		$ok=true;
	}
	if($_REQUEST['booklinker_convert_amazon']) {
		update_option('booklinker_convert_amazon',$_REQUEST['booklinker_convert_amazon']);
		$ok=true;
	}
	if($_REQUEST['booklinker_convert_powells']) {
		update_option('booklinker_convert_powells',$_REQUEST['booklinker_convert_powells']);
		$ok=true;
	}
	if($_REQUEST['booklinker_convert_indiebound']) {
		update_option('booklinker_convert_indiebound',$_REQUEST['booklinker_convert_indiebound']);
		$ok=true;
	}
	if($_REQUEST['booklinker_convert_worldcat']) {
		update_option('booklinker_convert_worldcat',$_REQUEST['booklinker_convert_worldcat']);
		$ok=true;
	}
	if($_REQUEST['booklinker_convert_librarything']) {
		update_option('booklinker_convert_librarything',$_REQUEST['booklinker_convert_librarything']);
		$ok=true;
	}	
	if($_REQUEST['booklinker_convert_goodreads']) {
		update_option('booklinker_convert_goodreads',$_REQUEST['booklinker_convert_goodreads']);
		$ok=true;
	}
	if($_REQUEST['booklinker_convert_openlibrary']) {
		update_option('booklinker_convert_openlibrary',$_REQUEST['booklinker_convert_openlibrary']);
		$ok=true;
	}	
	if($_REQUEST['booklinker_include_amazon']) {
		update_option('booklinker_include_amazon',$_REQUEST['booklinker_include_amazon']);
		$ok=true;
	}
	if($_REQUEST['booklinker_include_powells']) {
		update_option('booklinker_include_powells',$_REQUEST['booklinker_include_powells']);
		$ok=true;
	}
	if($_REQUEST['booklinker_include_indiebound']) {
		update_option('booklinker_include_indiebound',$_REQUEST['booklinker_include_indiebound']);
		$ok=true;
	}
	if($_REQUEST['booklinker_include_worldcat']) {
		update_option('booklinker_include_worldcat',$_REQUEST['booklinker_include_worldcat']);
		$ok=true;
	}
	if($_REQUEST['booklinker_include_librarything']) {
		update_option('booklinker_include_librarything',$_REQUEST['booklinker_include_librarything']);
		$ok=true;
	}
	if($_REQUEST['booklinker_include_goodreads']) {
		update_option('booklinker_include_goodreads',$_REQUEST['booklinker_include_goodreads']);
		$ok=true;
	}
	if($_REQUEST['booklinker_include_openlibrary']) {
		update_option('booklinker_include_openlibrary',$_REQUEST['booklinker_include_openlibrary']);
		$ok=true;
	}
	if($_REQUEST['booklinker_shield_color']) {
		update_option('booklinker_shield_color',$_REQUEST['booklinker_shield_color']);
		$ok=true;
	}
	if($_REQUEST['booklinker_background_color']) {
		update_option('booklinker_background_color',$_REQUEST['booklinker_background_color']);
		$ok=true;
	}
	if($_REQUEST['booklinker_text_color']) {
		update_option('booklinker_text_color',$_REQUEST['booklinker_text_color']);
		$ok=true;
	}
	
	if($_REQUEST['booklinker_link_back']) {
		update_option('booklinker_link_back',$_REQUEST['booklinker_link_back']);
		$ok=true;
	}
	if($_REQUEST['booklinker_show_book_cover']) {
		update_option('booklinker_show_book_cover',$_REQUEST['booklinker_show_book_cover']);
		$ok=true;
	}
	if($_REQUEST['booklinker_additional_title_styles']) {
		update_option('booklinker_additional_title_styles',$_REQUEST['booklinker_additional_title_styles']);
		$ok=true;
	}
	
	if($_REQUEST['booklinker_additional_author_styles']) {
		update_option('booklinker_additional_author_styles',$_REQUEST['booklinker_additional_author_styles']);
		$ok=true;
	}
	
	if($ok)
	{
		?><div id="message" class="updated fade"><p>Options saved</p></div><?php
	} else {
		?><strong>An error has occurred updating your BookLinker options</strong><?php
	}
}
function print_booklinker_plugin_options() {
?>
	<div class="wrap">
	<p>You can create BookLinker links by using the tools for your affiliate program (IndieBound, Powells, Amazon), or by create a link in the following format:</p>
	<pre style="padding-bottom:1em">&lt;a href="[isbn]" rel="BookLinker"&gt;My Link&lt;/a&gt;</pre>
	<p>You can prevent BookLinker from converting an affiliate/library link by adding <em>rel='noBookLinker'</em> to the link:</p>
	<pre style="padding-bottom:1em">&lt;a href="[URL]" rel="noBookLinker"&gt;My Link&lt;/a&gt;</pre>
	<form method="post">
	<fieldset>
		<legend><strong>Affiliate and API Information</strong></legend>
		<p><label for="booklinker_indiebound_affiliate_id">Indie Bound Affiliate ID:</label> <input type="text" name="booklinker_indiebound_affiliate_id" value="<?=get_option('booklinker_indiebound_affiliate_id')?>"></p>
		<p><label for="booklinker_amazon_affiliate_id">Amazon Affiliate ID:</label> <input type="text" name="booklinker_amazon_affiliate_id" value="<?=get_option('booklinker_amazon_affiliate_id')?>"></p>
		<p><label for="booklinker_powells_affiliate_id">Powells Affiliate ID:</label> <input type="text" name="booklinker_powells_affiliate_id" value="<?=get_option('booklinker_powells_affiliate_id')?>"></p>
		<p><label for="booklinker_librarything_apikey">LibraryThing API Key:</label> <input type="text" name="booklinker_librarything_apikey" value="<?=get_option('booklinker_librarything_apikey')?>"> <em>(optional; high-resolution book images will display only with a LibraryThing API Key; otherwise, low-resolution Open Library images will be used)</em></p>
	</fieldset>
	<fieldset>
		<legend><strong>Links to Convert</strong></legend>
		<?php
		$conv_amz='';
		if(get_option('booklinker_convert_amazon')=='1')
		{
			$conv_amz='checked';
		}
		$conv_pwl='';
		if(get_option('booklinker_convert_powells')=='1')
		{
			$conv_pwl='checked';
		}
		$conv_ib='';
		if(get_option('booklinker_convert_indiebound')=='1')
		{
			$conv_ib='checked';
		}
		$conv_wc='';
		if(get_option('booklinker_convert_worldcat')=='1')
		{
			$conv_wc='checked';
		}
		$conv_lt='';
		if(get_option('booklinker_convert_librarything')=='1')
		{
			$conv_lt='checked';
		}
		$conv_gr='';
		if(get_option('booklinker_convert_goodreads')=='1')
		{
			$conv_gr='checked';
		}
		$conv_ol='';
		if(get_option('booklinker_convert_openlibrary')=='1')
		{
			$conv_ol='checked';
		}
		
		$show_book_cover='';
		if(get_option('booklinker_show_book_cover')=='1')
		{
		$show_book_cover='checked';
		}

		?>
		<p><input type="checkbox" name="booklinker_convert_amazon" value="1" <?=$conv_amz?>/><label for="booklinker_convert_amazon">Convert Amazon Affiliate links to BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_convert_powells" value="1" <?=$conv_pwl?>/><label for="booklinker_convert_powells">Convert Powells Affiliate links to BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_convert_indiebound" value="1" <?=$conv_ib?>/><label for="booklinker_convert_indiebound">Convert Indie Bound Affiliate links to BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_convert_worldcat" value="1" <?=$conv_wc?>/><label for="booklinker_convert_worldcat">Convert WorldCat ISBN query links to BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_convert_librarything" value="1" <?=$conv_lt?>/><label for="booklinker_convert_librarything">Convert LibraryThing links to BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_convert_goodreads" value="1" <?=$conv_gr?>/><label for="booklinker_convert_librarything">Convert GoodReads links to BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_convert_openlibrary" value="1" <?=$conv_ol?>/><label for="booklinker_convert_librarything">Convert OpenLibrary links to BookLinker</label></p>
	</fieldset>
	<fieldset>
		<legend><strong>Links to Include in the BookLinker Popup</strong></legend>
		<?php
		$inc_amz='';
		if(get_option('booklinker_include_amazon')=='1')
		{
			$inc_amz='checked';
		}
		$inc_pwl='';
		if(get_option('booklinker_include_powells')=='1')
		{
			$inc_pwl='checked';
		}
		$inc_ib='';
		if(get_option('booklinker_include_indiebound')=='1')
		{
			$inc_ib='checked';
		}
		$inc_wc='';
		if(get_option('booklinker_include_worldcat')=='1')
		{
			$inc_wc='checked';
		}
		$inc_lt='';
		if(get_option('booklinker_include_librarything')=='1')
		{
			$inc_lt='checked';
		}
		$inc_gr='';
		if(get_option('booklinker_include_goodreads')=='1')
		{
			$inc_gr='checked';
		}
		$inc_ol='';
		if(get_option('booklinker_include_openlibrary')=='1')
		{
			$inc_ol='checked';
		}
		$inc_lb='';
		if(get_option('booklinker_link_back')=='1')
		{
			$inc_lb='checked';
		}
		
		
		?>
		<p><input type="checkbox" name="booklinker_include_amazon" value="1" <?=$inc_amz?>/><label for="booklinker_include_amazon">Include Amazon Affiliate links in BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_include_powells" value="1" <?=$inc_pwl?>/><label for="booklinker_include_powells">Include Powells Affiliate links in BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_include_indiebound" value="1" <?=$inc_ib?>/><label for="booklinker_include_indiebound">Include Indie Bound Affiliate links in BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_include_worldcat" value="1" <?=$inc_wc?>/><label for="booklinker_include_worldcat">Include WorldCat ISBN query links in BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_include_librarything" value="1" <?=$inc_lt?>/><label for="booklinker_include_librarything">Include LibraryThing links in BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_include_goodreads" value="1" <?=$inc_gr?>/><label for="booklinker_include_librarything">Include GoodReads links in BookLinker</label></p>
		<p><input type="checkbox" name="booklinker_include_openlibrary" value="1" <?=$inc_ol?>/><label for="booklinker_include_librarything">Include Open Library links in BookLinker</label></p>
	</fieldset>
	<fieldset>
	<legend><strong>Display</strong></legend>
	<p><input type="checkbox" name="booklinker_show_book_cover" value="1" <?=$show_book_cover?>/><label for="booklinker_show_book_cover">Display book covers in popup</label></p>
	<p><label for="booklinker_background_color">Popup background color:</label> <input type="text" name="booklinker_background_color" value="<?=get_option('booklinker_background_color')?>"></p>
	<p><label for="booklinker_background_color">Popup text color:</label> <input type="text" name="booklinker_text_color" value="<?=get_option('booklinker_text_color')?>"></p>
	<p><label for="booklinker_shield_color">Popup shield layer color:</label> <input type="text" name="booklinker_shield_color" value="<?=get_option('booklinker_shield_color')?>"></p>
	<p><label for="booklinker_additional_title_styles">Additional title styling:</label> <input type="text" name="booklinker_additional_title_styles" value="<?=get_option('booklinker_additional_title_styles')?>"> <em>(enter CSS code, semicolon delimited: ex., <strong>font-size:9pt;font-variant:small-caps;</strong>)</em></p>
	<p><label for="booklinker_additional_author_styles">Additional author styling:</label> <input type="text" name="booklinker_additional_author_styles" value="<?=get_option('booklinker_additional_author_styles')?>"> <em>(enter CSS code, semicolon delimited: ex., <strong>font-size:9pt;font-variant:small-caps;</strong>)</em></p>
	<p><input type="checkbox" name="booklinker_link_back" value="1" <?=$inc_lb?>/><label for="booklinker_link_back">Display a link back to the BookLinker plugin</label></p>

	</fieldset>
	</div>
	<input type="submit" name="submit" value="Submit"/>
	</form>
<?php
}
function booklinker_load_booklinker()
{
	booklinker_add_header_code();
	booklinker_add_js_variables();
}
function booklinker_add_header_code() {
	echo '<link type="text/css" rel="stylesheet" href="' . get_bloginfo('wpurl') . '/wp-content/plugins/booklinker/css/booklinker.css" />' . "\n";
	if (function_exists('wp_enqueue_script')) {
		wp_enqueue_script('booklinker', get_bloginfo('wpurl') . '/wp-content/plugins/booklinker/js/booklinker.js', null, '');
	}
}
function booklinker_add_js_variables() {
	if(get_option('booklinker_convert_amazon')==1)
	{
		$convert_amz = 'true';
	} else {
		$convert_amz = 'false';
	}
	if(get_option('booklinker_convert_powells')==1)
	{
		$convert_pwl = 'true';
	} else {
		$convert_pwl = 'false';
	}
	if(get_option('booklinker_convert_indiebound')==1)
	{
		$convert_ib = 'true';
	} else {
		$convert_ib = 'false';
	}
	if(get_option('booklinker_convert_worldcat')==1)
	{
		$convert_wc = 'true';
	} else {
		$convert_wc = 'false';
	}
	if(get_option('booklinker_convert_librarything')==1)
	{
		$convert_lt = 'true';
	} else {
		$convert_lt = 'false';
	}
	if(get_option('booklinker_convert_goodreads')==1)
	{
		$convert_gr = 'true';
	} else {
		$convert_gr = 'false';
	}
	if(get_option('booklinker_convert_openlibrary')==1)
	{
		$convert_ol = 'true';
	} else {
		$convert_ol = 'false';
	}
	if(get_option('booklinker_include_amazon')==1)
	{
		$include_amz = 'true';
	} else {
		$include_amz = 'false';
	}
	if(get_option('booklinker_include_powells')==1)
	{
		$include_pwl = 'true';
	} else {
		$include_pwl = 'false';
	}
	if(get_option('booklinker_include_indiebound')==1)
	{
		$include_ib = 'true';
	} else {
		$include_ib = 'false';
	}
	if(get_option('booklinker_include_worldcat')==1)
	{
		$include_wc = 'true';
	} else {
		$include_wc = 'false';
	}
	if(get_option('booklinker_include_librarything')==1)
	{
		$include_lt = 'true';
	} else {
		$include_lt = 'false';
	}
	if(get_option('booklinker_include_goodreads')==1)
	{
		$include_gr = 'true';
	} else {
		$include_gr = 'false';
	}
	if(get_option('booklinker_include_openlibrary')==1)
	{
		$include_ol = 'true';
	} else {
		$include_ol = 'false';
	}
	if(get_option('booklinker_link_back')==1)
	{
		$include_lb = 'true';
	} else {
		$include_lb = 'false';
	}
	if(get_option('booklinker_show_book_cover')==1)
	{
		$show_book_cover = 'true';
	} else {
		$show_book_cover = 'false';
	}
	
	?>
	<script>
	var libraryThingDevKey = "<?=get_option('booklinker_librarything_apikey')?>";
	var convertAmazon=<?=$convert_amz?>;
	var convertPowells=<?=$convert_pwl?>;
	var convertIndieBound=<?=$convert_ib?>;
	var convertWorldCat=<?=$convert_wc?>;
	var convertLibraryThing=<?=$convert_lt?>;
	var convertGoodReads=<?=$convert_gr?>;
	var convertOpenLibrary=<?=$convert_ol?>;
	var indieBoundAffiliateId="<?=get_option('booklinker_indiebound_affiliate_id')?>";
	var amazonAffiliateId="<?=get_option('booklinker_amazon_affiliate_id')?>";
	var powellsAffiliateId="<?=get_option('booklinker_powells_affiliate_id')?>";
	var includeIndieBoundLink=<?=$include_ib?>;
	var includeAmazonLink=<?=$include_amz?>;
	var includePowellsLink=<?=$include_pwl?>;
	var includeLibraryThingLink=<?=$include_lt?>;
	var includeWorldCatLink=<?=$include_wc?>;
	var includeGoodReadsLink=<?=$include_gr?>;
	var includeOpenLibraryLink=<?=$include_ol?>;
	var includePluginLinkBack=<?=$include_lb?>;
	var imagePath="<?=get_bloginfo('wpurl')?>/wp-content/plugins/booklinker/images";
	var showBookCover=<?=$show_book_cover?>;
	bookLinkerConvertLinks();
	</script>
	<style>
	#shield {
		background-color:<?=get_option(booklinker_shield_color)?>;
	}
	.bookLinkerDiv {
		background-color:<?=get_option(booklinker_background_color)?>;
	}
	.bookLinkerTitle {
		color:<?=get_option(booklinker_text_color)?>;
		<?=get_option(booklinker_additional_title_styles)?>;
	}
	.bookLinkerAuthor {
		color:<?=get_option(booklinker_text_color)?>;
		<?=get_option(booklinker_additional_author_styles)?>;
	}
	.bookLinkerCloseLink, .bookLinkerCloseLink:visited {
		color:<?=get_option(booklinker_text_color)?>;
	}
	</style>
	<div id="bookLinkerCollection"></div>
	<div id="shield"></div>
	<?php
}
?>
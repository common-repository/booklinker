=== Plugin Name ===
Contributors: mhartford
Donate link: http://borrowedcode.com/?page_id=120
Tags: books,affiliate,indiebound,amazon,powells,librarything,open library,worldcat,goodreads,isbn
Requires at least: 2.7
Tested up to: 2.7.1
Stable tag: 1.1

Give your visitors the freedom of choice with BookLinker, a WordPress plug-in that converts existing affiliate links (Amazon, IndieBound, Powell's) into links for the major book resources on the Internet.

== Description ==

Give your visitors the freedom of choice with BookLinker, a WordPress plug-in that converts existing affiliate links into a list of book resources: Amazon, Powells, and IndieBound affiliate links, WorldCat library searches, and LibraryThing book pages.

With BookLinker, you provide your affiliate ID for the three primary book resources on-line, and select which links to display. Any existing affiliate links in your blog will be transformed on the fly to the links you've selected. No changes are made to the actual content of your posts, so if you choose to return to a single-affiliate mode, simply deactivate the plug-in or turn off the option to convert the affiliate links of your choice.

For each book link on a page or post, BookLinker will display a tasteful DHTML pop-up window containing an image of the book cover, and links to each of the book resources you've selected. The window displays only when a visitor clicks the link, and can be dismissed with the "Close" link.

When a visitor clicks one of the links, a new browser tab or window opens to the selected page. If you've provided affiliate ID information in the BookLinker settings, all of the affiliate tracking will be in effect.

After you install and activate the plugin, go the Settings menu in the WordPress administration panel and find "BookLinker." Click the "BookLinker" link to set your options:

Affiliate IDs can be entered for IndieBound, Powells, or Amazon. The IDs you enter will be used to build the affiliate links in the BookLinker window.

To display high-resolution book covers, you'll need an API key from LibraryThing. Without this key, BookLinker will still build the affiliate links, but it won't show a book cover. You can get an API key by joining LibraryThing and requesting one at the API Keys page. It's free and easy, and should you be so inclined it gives you access to some of the most interesting projects that combine the web with books.  Without the API key, BookLinker will retrieve low-resolution book covers from Open Library.

You can choose which links to convert to BookLinker links, and which links to display in the BookLinker window.  If you wish to provide a link back to the plugin homepage in the popup window, check the "Display a link back to the BookLinker plugin" box.

If you've already been using your affiliate program's tools to create links to books, you don't have to change a thing. Keep generating the links from the Amazon, Powells, or IndieBound affiliate pages, and BookLinker will take care of the rest.

If you wish to create native BookLinker links instead of starting with an affiliate link, you can use this pattern:

<a href="isbn" rel="BookLinker">My Link</a>

where "isbn" is the 10 or 13 character International Standard Book Number for the book you want to link. (Hint: the ISBN is prominently displayed on the IndieBound, Powells, Amazon, WorldCat, and LibraryThing pages for most books.)

If you want to selectively leave some links unconverted (for example, Amazon affiliate links to non-book items, or links to specific editions of books available only through certain retailers), simply add "rel='NoBookLinker'" to the link:

<a href="URL" rel="noBookLinker">My Link</a>

Affiliate links with "rel='NoBookLinker'" will be ignored by the conversion process.

== Installation ==

1. Download and unpack the zip file. The plug-in consists of a PHP file, a JavaScript file, a CSS file, and several image files.
2. Copy the contents of the "booklinker" folder to a new "booklinker" folder in your blog's wp-content/plugins directory.
3. Activate the "BookLinker" plugin through the Plugins menu.
4. BookLinker settings can be found under your Settings menu.

== Frequently Asked Questions ==

= Why don't images or titles appear for all books? =

BookLinker uses the LibraryThing (librarything.com) and Open Library (openlibrary.org) projects for images and book information; these projects may not catalog all available ISBNs.  Check these projects for ways you can help make their services more comprehensive.

== Screenshots ==

1. Example of a BookLinker popup window.
2. Example of a BookLinker administration panel.


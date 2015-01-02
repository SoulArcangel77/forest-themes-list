=== Forest Themes List ===

(Document translated with Google Translator, so you can suggest corrections!)

(Per leggere questo documento in italiano leggi il file leggimi.md)

Video tutorial (IT): http://youtu.be/jKAGCsIwxjo

* **Plugin Name:** Forest Themes List
* **Plugin URI:** http://www.mediaclaim.it/forest-themes-list-wp-plugin/
* **Description:** Forest Themes List is a UNOFFICIAL plugin of EnvantoMarket that, with a shortcode, displays a ThemeForest's gallery to create a quote for their customers.
* **Version:** 0.1 
* **Author:** MediaClaim (Fabrizio Zippo)
* **Author URI:** http://www.mediaclaim.it
* **Requires at least:** 4.0
* **Tested up to:** 4.1
* **Tags:** gallery, themeforest, evanto, template, theme
* **License:** GPLv2 or later
* **Requires at least:** 4.0 
* **Tested up to:** 4.1 
* **Tags:**  gallery, ThemeForest, evanto, template, theme
* **License:** GPLv2 or later 
* **License URI:** http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Forest Themes List is a UNOFFICIAL plugin of EnvantoMarket that, with a shortcode, displays a ThemeForest's gallery to create a quote for their customers.

# System Requirements

* PHP5
* PHP cURL Library
* WordPress 4.0 or higher.
* A plugin for contact, eg. [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) (optional)

# == Installation ==

After downloaded the zip file, to access the Wordpress admin panel and follow these steps:

1. Click on **Plugins**
2. Click on the **Add New**
3. Click on **Upload plugin**
4. **Select** the zip file from the local drive and click on the **Install Now**
5. **Enable plugin**

![image](http://www.mediaclaim.it/wp-content/uploads/2014/12/installazione_ftl_1.jpg)

# Configuration

To configure the plugin you must:

6. Click on **Settings**
7. Click on **Forest Themes List** 

In the first section of the configuration, you can write your Evanto username so you can gain from EvantoMarket Affiliation, if your customer purchases the theme starting from your site.

In exchange rate section, you can enter data to convert the price of the theme displayed.

In advanced options section, you can show the "Select" button under each theme. This gives the possibility to your customer, after have to selected of the theme, to send a request for quote.

![image](http://www.mediaclaim.it/wp-content/uploads/2014/12/installazione_ftl_2.jpg)

# How to use

To see the gallery of ThemeForest you must first create a new page. Into The page you can enter one of the following shortcode:

- Without quotation form

* **[ftl_gallery]** (show the WordPress's themes gallery from ThemeForest, ref. http://themeforest.net/category/wordpress)
* **[ftl_gallery category="ecommerce/opencart"]** (show the OpenCart's themes gallery from ThemeForest, ref. http://themeforest.net/category/ecommerce/opencart)

- With the quote request form

* **[ftl_gallery category="ecommerce/prestashop" input="selected_theme"]** (show the Prestashop's theme gallery from ThemeForest and adds a select button under each theme)

If you have enabled the advanced options with the display of the "select" button it is necessary to add the shortcode on your contact form. The plugin has been tested with both [Contact Form 7](https://wordpress.org/plugins/contact-form-7/), both with [Form Maker](https://wordpress.org/plugins/form- maker /). In this case the contact form will be visible only after selecting the theme.

![image](http://www.mediaclaim.it/wp-content/uploads/2014/12/uso_ftl.jpg)


## Shortcode Options 
The options are:

* **category** {string}: show the ThemeForest's themes of one category (default: Wordpress)
* **input** {string}: denote the name of the input text (or hidden) of the contact form, located in the page, where the plugin saves the link of the selected theme (es. <input type="text" name="selectedTheme" value="" readonly="readonly" /> )

# Tips

To prevent indexing errors, I suggest to install this plugin, [WordPress Meta Robots](https://wordpress.org/plugins/wordpress-meta-robots/) and set the meta robots of the page whit contain this plugin to "index, nofollow ", because the links of the template are corrected with the javascript, while the robots would follow an incorrect link. (N.B. This plugin also works on WP 4.1)

# == Changelog ==

v.0.1 Start version

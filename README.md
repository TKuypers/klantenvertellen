# Wordpress Klantenvertellen Plugin

With this plugin you can add the Klantenvertellen widget to your Wordpress website. The plugin fetches data from the XML feed provided by Klantenvertellen. The plugin uses the Schema.org AggregateRating vocabulary (**https://schema.org/AggregateRating**)

## Installation
1. Go to **Plugins** > **Add new**  > **Upload plugin**
2. Upload the provided .zip file
3. Go to Plugins and activate the plugin

### Manual installation
1. Unpack the .zip file
2. With your FTP program, upload the **klantenvertellen** folder to the **wp-content/plugins** folder in your Wordpress directory online.
3. Go to Plugins and activate the plugin

## Usage
The plugin can be used in an post or page the following shortcode:

```
[klantenvertellen slug="expertees" v="v1"]
```
**Parameters**
* ***SLUG*** - the name of your company as used by klantenvertellen.
* ***V*** - the plugin version you want to use. This can be v1, v6, v7, v8, v9, v10. Default - v1

To use it in a theme use the following php code:

```
<?php echo do_shortcode('[klantenvertellen slug="expertees" v="v1"]'); ?>
```
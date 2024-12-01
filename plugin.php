<?php

/**
 * Consent Studio for WordPress
 *
 * @author            Vallonic B.V.
 * @copyright         2024 Vallonic B.V.
 * @license           GNU-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Consent Studio CMP
 * Plugin URI:        https://consent.studio
 * Description:       Adds the Consent Studio CMP banner.js script to your WordPress website. Will offer more features in the future.
 * Version:           0.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Vallonic B.V.
 * Author URI:        https://vallonic.com
 * Text Domain:       consent-studio
 * License:           GNU v3 or later
 */

namespace Vallonic\ConsentStudio;

/**
 * Add the banner.js script to the <head> element of the website
 */
add_action('wp_head', function() 
{
    /** @var array */
    $urlInfo = parse_url(get_bloginfo('url'));

    /** 
     * Add the Consent Studio banner.js script to the head element of WordPress. We have
     * explicitly chosen not to use enqueue_script as we want our banner.js code to be loaded
     * as early as possible.
     */
    echo('<script src="https://consent.studio/' . $urlInfo['host'] . '/banner.js"></script>');
}, 0);
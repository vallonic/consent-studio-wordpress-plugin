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

    echo (<<<HTML
        <script type="text/javascript" id="consent-studio-google-como">
            /**
             * Manual implementation of the Consent Studio CMP
             * - Remember to replace the following placeholders: [YOUR DOMAIN HERE]
             * - Remember to adjust the default consent signals if needed
             */

            /** Initialize the dataLayer variable */
            window.dataLayer = window.dataLayer || [];

            /** Define a short-hand function for writing to the dataLayer */
            function gtag(){dataLayer.push(arguments);}

            if(window.location.hash ? window.location.hash == '#cs-scan' : false) 
            {
                /** Don't touch: set all consent signals to granted for the Consent Studio cookie scanner */
                gtag("consent","default",{ad_storage:"granted",ad_user_data:"granted",ad_personalization:"granted",analytics_storage:"granted",functionality_storage:"granted",personalization_storage:"granted",security_storage:"granted",wait_for_update:500}); 
            } 
                else
            {
                /** 
                 * Set the default consent signals
                 * (You may edit these defaults)
                 */
                gtag("consent", "default", { 
                    ad_storage: "denied", 
                    ad_user_data: "denied", 
                    ad_personalization: "denied", 
                    analytics_storage: "denied",
                    functionality_storage: "granted",
                    personalization_storage: "granted",
                    security_storage: "granted", 
                    wait_for_update: 500,
                });
            }

            /** 
             * Set a value for ads data redaction
             * - More information: https://support.google.com/analytics/answer/13544947?hl=en
             */
            gtag("set", "ads_data_redaction", true);

            /** Set the Consent Studio developer ID */
            gtag("set", "developer_id.dZTlmZj", true);
        </script>
    HTML);

    /** 
     * Add the Consent Studio banner.js script to the head element of WordPress. We have
     * explicitly chosen not to use enqueue_script as we want our banner.js code to be loaded
     * as early as possible.
     */
    echo('<script type="text/javascript" id="consent-studio-banner" src="https://consent.studio/' . $urlInfo['host'] . '/banner.js"></script>');
}, 0);
<?php

$cleverpush_id = null;
$static_subdomain_suffix = '';

if (!empty($_GET['channel'])) {
    $cleverpush_id = sanitize_text_field($_GET['channel']);

} else {

    // No need for the template engine
    define('WP_USE_THEMES', false);

    // Assuming we're in a subdir: "~/wp-content/plugins/cleverpush"
    $wpConfigPath = '../../../wp-load.php';
    
    // maybe the user uses bedrock
    if (!file_exists($wpConfigPath)) {
        $wpConfigPath = '../../../wp/wp-load.php';
    }

    if (file_exists($wpConfigPath)) {
        include_once $wpConfigPath;
    
        $cleverpush_id = get_option('cleverpush_channel_id');

        $channel = get_option('cleverpush_channel_config');
        if (!empty($channel) && !empty($channel->hostingLocation)) {
            $static_subdomain_suffix = '-' . $channel->hostingLocation;
        }
    }
}

header("Service-Worker-Allowed: /");
header("Content-Type: application/javascript");
header("X-Robots-Tag: none");

if (!empty($cleverpush_id)) {
    echo esc_js("importScripts('https://static" . $static_subdomain_suffix . ".cleverpush.com/channel/worker/" . $cleverpush_id . ".js');\n");

} else {
    echo esc_js("// error: no cleverpush channel id found\n");
}

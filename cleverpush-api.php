<?php

if (!defined('ABSPATH')) {
    exit;
}

const CLEVERPUSH_API_ENDPOINT = 'https://api.cleverpush.com';

class CleverPush_Api
{
    public static function request($path, $params)
    {
        $api_key_private = get_option('cleverpush_apikey_private');

        if (empty($api_key_private)) {
            return null;
        }

        $response = wp_remote_post(
            CLEVERPUSH_API_ENDPOINT . $path, array(
                'timeout' => 20, // phpcs:ignore
                'headers' => array(
                    'authorization' => $api_key_private,
                    'content-type' => 'application/json'
                ),
                'body' => json_encode($params)
            )
        );

        $error_message = null;
        if (is_wp_error($response)) {
            $error_message = $response->get_error_message();
        } elseif (!in_array(wp_remote_retrieve_response_code($response), array(200, 201)) ) {
            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body);
            $blocked_message = self::blocked_send_message($data);
            if ($blocked_message !== '') {
                $error_message = $blocked_message;
            } elseif ($data && !empty($data->error)) {
                $error_message = $data->error;
            } else {
                $error_message = 'HTTP ' . wp_remote_retrieve_response_code($response);
            }
        }

        if (!empty($error_message)) {
            throw new Exception($error_message);
        }

        return $response;
    }

    public static function send_notification($title, $body, $url, $options = array(), $subscriptionId = null)
    {
        $channel_id = get_option('cleverpush_channel_id');

        if (get_option('cleverpush_enable_domain_replacement') == 'on') {
            $option_url = get_option('cleverpush_replacement_domain');
            if (!empty($option_url)) {
                $parsed_url = parse_url($url);
                if ($parsed_url) {
                    $host = $parsed_url['host'];
                    if (!empty($host)) {
                        $url = str_replace($host, $option_url, $url);
                    }
                }
            }
        }
        
        if (empty($channel_id)) {
            return null;
        }

        $params = array_merge(
            array(
                'channel' => $channel_id,
                'title' => $title,
                'text' => $body,
                'url' => $url
            ),
            $options
        );

        if ($subscriptionId) {
            $params['subscriptionId'] = $subscriptionId;
        }

        $response = CleverPush_Api::request('/notification/send', $params);
        if (empty($response)) {
            return null;
        }

        $data = json_decode(wp_remote_retrieve_body($response));
        if (!$data) {
            return (object) array(
                'success' => false,
                'error' => 'Invalid response from CleverPush.',
            );
        }

        return $data;
    }

    /**
     * A 200 response is a new send only when CleverPush accepted it and did not
     * report that the same article was already sent or is already being sent.
     *
     * @param object|null $data Decoded /notification/send body.
     * @return array{status: string, message: string}
     */
    public static function classify_send_response($data)
    {
        $blocked_message = self::blocked_send_message($data);
        if ($blocked_message !== '') {
            return array(
                'status' => 'warning',
                'message' => $blocked_message,
            );
        }

        if ($data && !empty($data->success) && !empty($data->notificationId)) {
            return array(
                'status' => 'success',
                'message' => '',
            );
        }

        $message = 'CleverPush did not confirm that this notification was sent.';
        if ($data && !empty($data->error)) {
            $message = (string) $data->error;
        }

        return array(
            'status' => 'error',
            'message' => $message,
        );
    }

    /**
     * @param object|null $data
     * @return string
     */
    private static function blocked_send_message($data)
    {
        if (!$data || empty($data->warnings)) {
            return '';
        }

        $warnings = is_array($data->warnings) ? $data->warnings : array($data->warnings);
        $blocked = array();
        foreach ($warnings as $warning) {
            $warning = (string) $warning;
            if (
                stripos($warning, 'already existed') !== false
                || stripos($warning, 'already trying to send') !== false
            ) {
                $blocked[] = $warning;
            }
        }

        return implode(' ', $blocked);
    }

    public static function update_channel($channel_id, $params = array())
    {
        if (empty($channel_id)) {
            return null;
        }

        return CleverPush_Api::request('/channel/' . $channel_id, $params);
    }
}

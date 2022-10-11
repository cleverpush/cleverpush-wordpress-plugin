<?php

function cleverpush_amp_styles()
{
    $button_background = 'green';
    $button_color = '#fff';

    $channel = get_option('cleverpush_channel_config');
    if (!empty($channel)) {
        if (!empty($channel->confirmAlertAllowButtonStyle) && !empty($channel->confirmAlertAllowButtonStyle->backgroundColor)) {
            $button_background = $channel->confirmAlertAllowButtonStyle->backgroundColor;
            if (!empty($channel->confirmAlertAllowButtonStyle->color)) {
                $button_color = $channel->confirmAlertAllowButtonStyle->color;
            }
        } else if (!empty($channel->notificationBellColor)) {
            $button_background = $channel->notificationBellColor;
        }
    }

    $position = get_option('cleverpush_amp_widget_position');
    if (empty($position)) {
        $position = 'bottom';
    }
    $border_position = $position == 'top' ? 'bottom' : 'top';

    ?>

.cleverpush-confirm {
  left: 10px;
  right: 10px;
  padding: 15px;
    <?php echo esc_attr($position); ?>: 0;
  position: fixed;
  z-index: 999;
  background-color: #fff;
  border-<?php echo esc_attr($border_position); ?>-left-radius: 15px;
  border-<?php echo esc_attr($border_position); ?>-right-radius: 15px;
  box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
}

.cleverpush-confirm-title {
  font-size: 17px;
  font-weight: bold;
  margin-bottom: 5px;
}

.cleverpush-confirm-text {
  font-size: 14px;
  margin-bottom: 10px;
  color: #555;
  line-height: 1.65;
}

.cleverpush-confirm-buttons {
  display: flex;
  align-items: center;
  margin-top: 15px;
}

.cleverpush-confirm-button {
  color: #555;
  background-color: transparent;
  padding: 10px;
  width: 50%;
  margin-right: 5px;
  text-align: center;
  border: none;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  border-radius: 5px;
}

.cleverpush-confirm-button:hover {
  opacity: 0.9;
}

.cleverpush-confirm-button-allow {
  background-color: <?php echo esc_attr($button_background); ?>;
  color: <?php echo esc_attr($button_color); ?>;
  margin-left: 5px;
  margin-right: 0;
}

    <?php
}

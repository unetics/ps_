<?php
	
/* Set logging for debug
log_me(array('This is a message' => 'for debugging purposes'));
log_me('This is a message for debugging purposes');
*/

function log_me($message) {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}

<?php
const FLASH = 'FLASH_MESSAGES';
const FLASH_ERROR = 'error';
const FLASH_WARNING = 'warning';
const FLASH_INFO = 'info';
const FLASH_SUCCESS = 'success';

/* Create a flash message */
function flash(string $name, string $message, string $type): void
{
    // remove existing message with the name
    if (isset($_SESSION[FLASH][$name])):
        unset($_SESSION[FLASH][$name]);
    endif;
    // add the message to the session
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

/* Format a flash message */
function format_flash(array $flash_message): string
{
    return sprintf('<div class="alert %s fade in alert-dismissible show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>%s
        </div>',
        $flash_message['type'],
        $flash_message['message']
    );
}

/* Display all flash messages */
function display_flash(): void
{
    if (!isset($_SESSION[FLASH])) {
        return;
    }

    // get flash messages
    $flash_messages = $_SESSION[FLASH];

    // remove all the flash messages
    unset($_SESSION[FLASH]);

    // show all flash messages
    foreach ($flash_messages as $flash_message) {
        echo format_flash($flash_message);
    }
}
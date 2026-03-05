<?php
// Function to handle translations

function init_i18n()
{
    // Determine language from session, then env, default to pt_BR
    if (isset($_GET['lang'])) {
        $lang = filter_input(INPUT_GET, 'lang', FILTER_SANITIZE_STRING);
        $allowed_langs = ['pt_BR', 'en_US', 'id_ID'];
        if (in_array($lang, $allowed_langs)) {
            $_SESSION['app_lang'] = $lang;
        }
    }

    $current_lang = $_SESSION['app_lang'] ?? getenv('APP_LANG') ?: 'pt_BR';

    // Load dictionary
    $lang_file = __DIR__ . '/../lang/' . $current_lang . '.php';
    if (!file_exists($lang_file)) {
        $current_lang = 'id_ID'; // Fallback to original
        $lang_file = __DIR__ . '/../lang/' . $current_lang . '.php';
    }

    global $_TRANSLATIONS;
    if (file_exists($lang_file)) {
        $_TRANSLATIONS = require $lang_file;
    } else {
        $_TRANSLATIONS = [];
    }
}

// Helper function to get translated string
function __($key, $replacements = [])
{
    global $_TRANSLATIONS;

    $text = $_TRANSLATIONS[$key] ?? $key;

    if (!empty($replacements)) {
        foreach ($replacements as $search => $replace) {
            $text = str_replace(':' . $search, $replace, $text);
        }
    }

    return $text;
}

// Initialize on include
init_i18n();

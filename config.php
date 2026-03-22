<?php
function getEnvValue($key, $default = "") {
    static $config = null;
    if ($config === null) {
        $envPath = __DIR__ . '/.env';
        if (file_exists($envPath)) {
            $config = parse_ini_file($envPath);
        } else {
            $config = [];
        }
    }
    return isset($config[$key]) ? $config[$key] : $default;
}

// กำหนดตัวแปร Global
$googleSheetUrl = getEnvValue('GOOGLE_SHEET_URL');
$appName        = getEnvValue('APP_NAME', 'UDON THANI CREDIT BANK CENTER');
$appLogo        = getEnvValue('APP_LOGO_URL');
$appFavicon     = getEnvValue('APP_FAVICON_URL');
?>
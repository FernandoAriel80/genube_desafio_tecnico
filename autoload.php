<?php
// Convierte los namespaces en rutas
spl_autoload_register(function ($class) {
    // Convierte los namespaces en rutas del sistema de archivos
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Construye la ruta completa al archivo
    $file = __DIR__ . '/' . $path;

    // Incluye el archivo si existe
    if (file_exists($file)) {
        require_once $file;
    } else {
        die("Clase no encontrada: $class");
    }
}); 

// Carga variables de .env, se pide ej: getenv('APP_NAME'); 
if (file_exists(__DIR__ . '/.env')) {
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value, " \t\n\r\0\x0B\"'");

        putenv("$key=$value");
    }
}
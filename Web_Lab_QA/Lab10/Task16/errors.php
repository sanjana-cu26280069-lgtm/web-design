<?php
// Production php.ini: display_errors=Off; log_errors=On; error_log=/var/log/php/app-error.log
set_exception_handler(function(Throwable $e){
    error_log((string)$e);
    http_response_code(500);
    require __DIR__.'/views/500.php';
});

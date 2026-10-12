php -m | grep -E "mysqli|pdo_mysql|mbstring|curl"
sudo phpenmod mysqli pdo_mysql mbstring curl      # enable
sudo systemctl restart apache2

<?php
foreach (['mysqli', 'pdo_mysql', 'mbstring', 'curl'] as $e)
    echo $e . ": " . (extension_loaded($e) ? "ENABLED" : "missing") . "<br>";

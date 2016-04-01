#!/usr/bin/env bash
sudo php5dismod -s cli xdebug
sudo php5dismod xdebug
sudo php5enmod xdebug
clear && export PATH=$PATH:/var/www/html/bin && cd /var/www/html && rm -rf var/cache/* var/page_cache/* var/generation/* /var/www/html/pub/static/adminhtml /var/www/html/pub/static/frontend && bin/magento cache:clean
#filesystem owner
clear && cd /var/www/html && rm -rf var/cache/* var/page_cache/* var/generation/* /var/www/html/var/di /var/www/html/pub/static/adminhtml /var/www/html/pub/static/frontend /var/www/html/var/report/* && export PATH=$PATH:/var/www/html/bin && bin/magento cache:clean && magento setup:upgrade && magento setup:di:compile && php bin/magento setup:static-content:deploy

#filesystem owner
clear && cd /var/www/html && cat /var/log/apac*/*err*.log && truncate -s 0 /var/log/apac*/*err*.log && rm -rf var/cache/* var/page_cache/* var/generation/* /var/www/html/var/di /var/www/html/pub/static/adminhtml /var/www/html/pub/static/frontend /var/www/html/var/report/*
bin/magento cache:clean

HPS_SecureSubmit(document, Heartland);


php bin/magento list
echo 'upgrade'
echo 'compile modules'
rm -rf var/cache/* var/page_cache/* var/generation/* /var/www/html/var/di /var/www/html/pub/static/adminhtml /var/www/html/pub/static/frontend
sudo chmod u+x /var/www/html/bin/magento
export PATH=$PATH:/var/www/html/bin
magento setup:upgrade
magento setup:di:compile
composer update
composer install
php bin/magento setup:static-content:deploy
echo 'fixing permissions'
clear
cd /var/www/html
chown -R magento_user:www-data /var/www/html
sudo find /var/www/html -type d -exec chmod 770 {} \;
sudo find /var/www/html -type f -exec chmod 660 {} \;
sudo chmod u+x /var/www/html/bin/magento
export PATH=$PATH:/var/www/html/bin

cd /var/www/html && clear && cd /var/www/html && chown -R magento_user:www-data /var/www/html && sudo find /var/www/html -type d -exec chmod 770 {} \; && sudo find /var/www/html -type f -exec chmod 660 {} \; && sudo chmod u+x /var/www/html/bin/magento && export PATH=$PATH:/var/www/html/bin && cd /var/www/html
magento cron:run
magento cron:run
cd update
php cron.php
cd /var/www/html
sudo chmod u+x /var/www/html/pc.sh

sudo find /var/www/html/pub -type d -exec chmod 770 {} \;
sudo find /var/www/html/pub -type f -exec chmod 660 {} \;

[Mon Jan 11 18:53:54.150619 2016] [access_compat:error] [pid 10543] [client 10.12.220.81:53133] AH01797: client denied by server configuration: /var/www/html/app/etc/config.php
[Mon Jan 11 19:37:20.064605 2016] [:error] [pid 2816] [client 10.12.220.154:50800] PHP Fatal error:  Uncaught exception 'InvalidArgumentException' with message 'Constant name is expected.' in /var/www/html/lib/internal/Magento/Framework/Data/Argument/Interpreter/Constant.php:23\nStack trace:\n
#0 /var/www/html/lib/internal/Magento/Framework/Data/Argument/Interpreter/Composite.php(61): Magento\\Framework\\Data\\Argument\\Interpreter\\Constant->evaluate(Array)\n
#1 /var/www/html/lib/internal/Magento/Framework/Data/Argument/Interpreter/ArrayType.php(43): Magento\\Framework\\Data\\Argument\\Interpreter\\Composite->evaluate(Array)\n
# 2 /var/www/html/lib/internal/Magento/Framework/Data/Argument/Interpreter/Composite.php(61): Magento\\Framework\\Data\\Argument\\Interpreter\\ArrayType->evaluate(Array)\n
# 3 /var/www/html/lib/internal/Magento/Framework/ObjectManager/Config/Mapper/Dom.php(103): Magento\\Framework\\Data\\Argument\\Interpreter\\Composite->evaluate(Array)\n
# 4 /var/www/html/lib/internal/Magento/Framework/Config/Reader/Filesystem.php(158): Magento\\Framework\\ObjectManager\\Config\\Mapper\\Dom->convert(Object(DOMDocument))\n#5 /var/www/html/l in /var/www/html/lib/internal/Magento/Framework/Data/Argument/Interpreter/Constant.php on line 23, referer: http://10.12.220.81/admin/admin/system_config/index/key/77aa86cd28bb9445e73ee50a1482b94b1787a13104bde0eea27889c0fa8e5d26/
composer config repositories.inchoostripe git https://github.com/Inchoo/magento2-Inchoo_Stripe.git
composer require inchoo/stripe:dev-master
composer config repositories.heartland git https://github.com/hps/heartland-php.git
composer require hps/heartland-php
composer config repositories.inchoostripe git https://github.com/Inchoo/magento2-Inchoo_Stripe.git
composer require inchoo/stripe:dev-master
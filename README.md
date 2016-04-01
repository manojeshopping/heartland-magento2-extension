# Magento2
Magento2 integration to secure submit

Current progress
Magento2
Magento2 integration to secure submit

Current progress This is an initial Payment gateway plugin for Portico Requires: Properly installed and operational Magento v2.2+ SSH access to server as file system owner of web directory Keys for Magento connect https://www.magentocommerce.com/magento-connect/customerdata/secureKeys/list/

Limitations. Supports

Card Saving

Checkout

Online Refund

No card management as of yet so you cannot delete a saved card.

Installation:

from your base Magento2 directory -> app -> code (you may have to create this directory) Clone the repo from the base Magento2 directory (instructions assume Ubuntu 14+ rm -rf var/cache/* var/page_cache/* var/generation/* /var/di pub/static/adminhtml pub/static/frontend var/report/*

the following commands should work even in windows with the forward slash swapped for back

php bin/magento cache:clean

php bin/magento setup:upgrade

php bin/magento setup:di:compile

php bin/magento setup:static-content:deploy

Navigate to your admin logon If you need the path you can retrieve it (web install usually sets this other than admin) php bin/magento info:adminuri This will echo out the path

Open Store Configuration image Expand Sales and navigate to Payment Methods

image

Fill out the Form as per the instructions on the screen. Please be aware that you can change the title to anything you would like to appear on your checkout page for the consumer to see image

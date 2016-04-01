<?php
/**
 * Created by PhpStorm.
 * User: charles.simmons
 * Date: 2/18/2016
 * Time: 3:54 PM
 * routing HPS/Heartland/etc/frontend/routes.xml
 * this file is intended to be consumed by an ajax call to get the public key
 * the javascript file is HPS/Heartland/view/frontend/web/js/view/payment/method-renderer/heartland-method.js
 *
 */
namespace HPS\Heartland\Controller\Hss;

/**
 * Class Pubkey
 *
 * @package HPS\Heartland\Controller\Hss
 *
 */
use \HPS\Heartland\Helper\Data as HPS_DATA;
class Pubkey extends \Magento\Framework\App\Action\Action
{
    public function execute(){ // void
        echo((string) HPS_DATA::getPublicKey());
    }
}

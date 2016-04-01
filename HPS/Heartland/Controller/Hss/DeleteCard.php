<?php
/**
 * Created by PhpStorm.
 * User: charles.simmons
 * Date: 3/18/2016
 * Time: 4:14 PM
 */

namespace HPS\Heartland\Controller\Hss;


use \Magento\Framework\App\Action\Action;
use \HPS\Heartland\Model\StoredCard as HPS_STORED_CARDS;
class DeleteCard extends Action
{
    public function execute(){
        HPS_STORED_CARDS::deleteStoredCards( (int) $this->getRequest()->getParam('t'));
    }
}
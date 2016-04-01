<?php
/**
 * Created by PhpStorm.
 * User: charles.simmons
 * Date: 3/15/2016
 * Time: 11:54 AM
 */

namespace HPS\Heartland\Controller\Hss;


use \Magento\Framework\App\Action\Action;
use \HPS\Heartland\Model\StoredCard as HPS_STORED_CARDS;
use \HPS\Heartland\Helper\Customer;
use \HPS\Heartland\Helper\ObjectManager as HPS_OM;
use \Magento\Framework\UrlInterface;
use \HPS\Heartland\Helper\Data as HPS_DATA;

/**
 * Class StoredCard
 *
 * @package HPS\Heartland\Controller\Hss
 */
class StoredCard extends Action
{
    /**
     * @const string
     */
    const IMAGE_STATIC_PATH = 'frontend/Magento/blank/en_US/HPS_Heartland/images/';
    /**
     * @const string
     */
    const STORE_INTERFACE = '\Magento\Store\Model\StoreManagerInterface';

    /**
     * @var bool|string
     */
    private $_baseImageUri = false;

    /**
     * @throws \Exception
     */
    public function execute(){
        if ( HPS_STORED_CARDS::getCanStoreCards() && Customer::isLoggedIn()){
            $data = HPS_STORED_CARDS::getStoredCards(); /**/
            foreach ($data as $row) {
                $jsResponse = "var response" . $row["storedcard_id"] . " = {";
                $jsResponse .= "token_value:'" . $row["storedcard_id"] . "', ";
                $jsResponse .= "last_four:'" . $row["cc_last4"] . "', ";
                $jsResponse .= "card_type:'" . $row["cc_type"] . "', ";
                $jsResponse .= "exp_month:'" . $row["cc_exp_month"] . "', ";
                $jsResponse .= "exp_year:'" . $row["cc_exp_year"] . "'";
                $jsResponse .= "};document.querySelector('#hssCardSelected" . $row['storedcard_id'] . "').checked=true;_HPS_setHssTransaction(response" . $row["storedcard_id"] . ");";

                ?><tr onclick="<?php echo $jsResponse ?>" title="Pay with this card">
                <td style="width:100px">
                    <input style="width:100px;cursor:pointer;" type="radio" name="HPSTokens[]" id="hssCardSelected<?php echo $row['storedcard_id']?>"></td>
                <th align="left" id="image_holder_<?php echo $row['storedcard_id']?>" style="position: relative;text-align: left;border-left-style:groove;cursor:pointer;">
                    <?php echo ucfirst($row['cc_type'])?> ending in <?php echo $row['cc_last4']?><br />
                    Expiring on <?php echo $row['cc_exp_month']?>/<?php echo $row['cc_exp_year']?>
                    <div style="
                        display: block;
                        width: 56px;
                        height: 44px;
                        position: absolute;
                        top: 4px;
                        left: 200px;
                        background-repeat: no-repeat;
                        background-size: 56px auto;
                    background-position: top; background-image: url('<?php echo $this->getImageLink($row['cc_type']);?>')"></div> </th>
                </tr>
                <?php
            }
        }
    }

    /**
     * @return string
     */
    private function getStaticURL(){
        if ($this->_baseImageUri === false){
            $this->_baseImageUri = HPS_OM::getObjectManager()
                                        ->get(self::STORE_INTERFACE)
                                        ->getStore()
                                        ->getBaseUrl(UrlInterface::URL_TYPE_STATIC);
        }
        return $this->_baseImageUri;
    }

    /**
     * @param null|string $cardType
     *
     * @return string
     * @throws \Exception
     */
    private function getImageLink($cardType = null){
        if ($cardType === null || $cardType === '' || preg_match('/[\W]/', $cardType) === 1){
            throw new \Exception(__( 'Card type not configured for saved token!!' ));
        }
        return  $this->getStaticURL() . self::IMAGE_STATIC_PATH . 'ss-inputcard-' . strtolower($cardType) . '@2x.png';
    }
}
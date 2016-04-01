/**
 * HPS_Heartland Magento JS component
 *
 * @category    HPS
 * @package     HPS_Heartland
 * @author      Charles Simmons <charles.simmons@e-hps.com>
 * @copyright   HPS (http://heartland.us)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/*browser:true*/
/*global define*/
define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'hps_heartland',
                component: 'HPS_Heartland/js/view/payment/method-renderer/heartland-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
        
    }
);
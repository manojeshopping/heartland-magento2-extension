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
        'ko',
        'jquery',
        'Magento_Payment/js/view/payment/cc-form',
        'Magento_Checkout/js/action/place-order',
        'Magento_Checkout/js/action/select-payment-method',
        'Magento_Checkout/js/model/quote',
        'Magento_Customer/js/model/customer',
        'Magento_Checkout/js/model/payment-service',
        'Magento_Checkout/js/checkout-data',
        'Magento_Checkout/js/model/checkout-data-resolver',
        'uiRegistry',
        'Magento_Checkout/js/model/payment/additional-validators',
        'Magento_Ui/js/model/messages',
        'uiLayout'
    ],
    function (


        ko,
        $,
        Component,
        placeOrderAction,
        selectPaymentMethodAction,
        quote,
        customer,
        paymentService,
        checkoutData,
        checkoutDataResolver,
        registry,
        additionalValidators,
        Messages,
        layout

    ) {
        'use strict';
        /**
         * Get the public key from HPS/Heartland/Controller/Hss/Pubkey.php as url configured based on HPS/Heartland/etc/frontend/routes.xml
         * if there is any form of error we disable the payment form
         *
         */
        return Component.extend({
            defaults: {
                template: 'HPS_Heartland/payment/heartland-form'

            },
            hpsSavedCards: function(){
                var self = this;
                $("#SavedCardsTable").fadeIn();
                //alert($("#SavedCardsTable").visible());
                if ($("#SavedCardsTable tr").length < 2) {
                    self.hpsBusy();
                    $.ajax({
                        url: "../public_key/hss/storedcard"
                        , success: function (data) {
                            if (data) {
                                $("#SavedCardsTable").append(data);
                                self.hpsNotBusy();
                            } else {
                                $("#SavedCardsTable").append($("<tr></tr>"));
                                self.hpsNewCard();
                            }
                        }
                    });
                }
                return true;
            },
            hpsNewCard: function(){
                var self = this;
                self.hpsBusy();
                if ($("#SavedCardsTable tr").length > 1){
                    $.get("../public_key/hss/pubkey") // as url configured based on HPS/Heartland/etc/frontend/routes.xml
                        .success( function(publicKey) {
                            self.hpsShowCcForm(publicKey);
                            self.hpsNotBusy();
                        }).fail(function(){
                        $('#hps_heartland').parent().parent().querySelector('span').innerHTML = ' <font color=red>Please contact site owner</font>';
                        self.hpsNotBusy();
                    });
                }

                return true;
            },
            hpsBusy: function(){
                $("#checkout-loader-iframeEdition").fadeIn();
                return true;
            },
            hpsNotBusy: function(){
                $("#checkout-loader-iframeEdition").fadeOut();_HPS_EnablePlaceOrder()
                return true;
            },
            hpsShowCcForm: function(publicKey){
                if ( publicKey ){
                    var self = this;
                    $("#SavedCardsTable").fadeOut();
                    $("#iframes").fadeIn();
                    HPS_SecureSubmit(document, Heartland, publicKey);
                    self.hpsGetCanSave();
                }
                return true;

            }
            ,
            hpsGetCanSave: function(){
                var data;
                $.get("../public_key/hss/cansave/").success(function(data){
                    if( data === '1'){
                        $("#saveCardCheck").parent().fadeIn();
                    }else{
                        $("#saveCardCheck").parent().fadeOut();
                    }

                });
                return data
            },
            getCode: function () {
                return 'hps_heartland';

            },
            isActive: function () {
                return true;
            },

            /**
             * Create child message renderer component
             *
             * @returns {Component} Chainable.
             */

            getToken: function (data, event)
            {
                var self = this;
                document.querySelector('#bValidateButton').click();
            },
            /**
             * Place order.
             */
            placeOrder: function (data, event) {

                var self = this,
                    placeOrder;
                if (event) {
                    event.preventDefault();
                }

                if (this.validate() && additionalValidators.validate()) {
                    this.isPlaceOrderActionAllowed(false);

                    var pData = this.getData();
                    this.getData();
                    pData.additional_data.cc_type = document.querySelector('#hps_heartland_cc_type').value;
                    pData.additional_data.cc_exp_year =  document.querySelector('#hps_heartland_expiration_yr').value;
                    pData.additional_data.cc_exp_month = document.querySelector('#hps_heartland_expiration').value;
                    pData.additional_data.cc_number = document.querySelector('#hps_heartland_cc_number').value;
                    pData.additional_data.token_value = document.querySelector('#securesubmit_token').value;

                    pData.additional_data._save_token_value = (document.querySelector('#saveCardCheck').checked?1:0);
                    placeOrder = placeOrderAction(pData, this.redirectAfterPlaceOrder, this.messageContainer);

                    $.when(placeOrder).fail(function () {
                        self.isPlaceOrderActionAllowed(true);
                    }).done(window.location.replace('/checkout/onepage/success/'));
                    return true;
                }
                return false;
            }
        });
    }
);
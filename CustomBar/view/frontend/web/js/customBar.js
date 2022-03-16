define([
    'uiComponent',
    'ko',
    'Magento_Customer/js/customer-data'
    ], function(Component, ko, customerData) {
    return Component.extend({
         
        customBarData: ko.observable(""),

         initialize: function () {
             this._super();
             this.customer = customerData.get('customer');
             this.customBarData = customerData.get('custombar-data');
            
         }
    });
});
    window.baseurl = "http://drivefly.xyz";

var prices = new Vue({
    el: '#prices_app',
    data : {
        sites : null,
        site_products : null,
        current_site_key : null,
        current_product_key : null,
        promo : null,
        table : {
            months : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        },
        options : {
            grid_threshold : 15,
            grid_limit : 20
        }
    },

    mounted : function(){
        this.getSites();
    },

    methods : {

        changeGridValues : function(giKey, evt){

            // Make a grid_temp array to hold the initial values of the fields
            if('undefined' == typeof this.sites[this.current_site_key].site_products[this.current_product_key].grid_temp)
                this.sites[this.current_site_key].site_products[this.current_product_key].grid_temp = [];

            //
            // Copy grid item from original grid object to grid_temp
            //

            // If current Grid Item key property is not set on the temp object
            if('undefined' == typeof this.sites[this.current_site_key].site_products[this.current_product_key].grid_temp[giKey]){

                // Create empty object as property
                this.sites[this.current_site_key].site_products[this.current_product_key].grid_temp[giKey] = {};

                // Remove reactivity from temp object property
                Object.assign(this.sites[this.current_site_key].site_products[this.current_product_key].grid_temp[giKey], this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey]);
            }

            // Prepare iteration
            var prices = this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey];

            for (var indx in prices) {

                if(indx == 'band' || indx == 0)
                    continue; // exits current iteration if keys are 'band' or first key

                var original_value = this.sites[this.current_site_key].site_products[this.current_product_key].grid_temp[giKey][indx];

                 var newval = parseFloat(
                    Math.round((parseFloat(original_value) + parseFloat(evt.target.value)) * 100) / 100
                ).toFixed(2);

                prices[indx] = newval;
            }
        },

        saveGridValues : function(giKey){

        },

        range : function (start, end) {
            return Array(end - start + 1).fill().map((_, idx) => start + idx)
        },

        /*
            Gets list of products, organized by "sites"
        */
        getSites : function(){

            $.ajax({
                context : this,
                url: window.baseurl + '/request_dummy_data/admin_price_get_products.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                },
            }).done(function(response) {
                Vue.set(this, 'sites', response.result);
            });
        },

        /*
            Shows the products belonging to one "site"
        */

        showSiteProducts : function(site, sKey){

            // Prevent clicking on selected button
            if(site.selected) return false;

            // Set site_products
            Vue.set(this, 'current_site_key', sKey);
            Vue.set(this, 'current_product_key', null);
        },


        getProduct : function(siteproduct, spKey){

            if(siteproduct.selected)
                return false;

            // Set current_product equal to the clicked product
            Vue.set(this, 'current_product_key', spKey);

            $.ajax({
                url: window.baseurl + '/request_dummy_data/admin_price_get_product.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                },
                context: this,
            }).done(function(response) {

                // Update values in component data
                Vue.set(siteproduct, 'bands', response.result.bands);
                Vue.set(siteproduct, 'grid', response.result.grid);
                Vue.set(siteproduct, 'rules', response.result.rules);

                // Get promo for the current product
                this.getPromo(siteproduct);
            });

        },

        getPromo : function(siteproduct){

            var pricesapp = this;

            $.ajax({
                url: window.baseurl + '/request_dummy_data/admin_price_get_promo.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                },
            }).done(function(response) {
                Vue.set(siteproduct, 'promo', response.result);
            });
        }

    }
});


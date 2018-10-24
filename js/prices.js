    window.baseurl = "http://drivefly.xyz";

var pricesApp = new Vue({
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
        },
        focused_field_old_val : null,
        newpromo : {
            code : null,
            discount : 1
        },
        bandschanged : false
    },

    mounted : function(){


        this.getSites();

    },

    methods : {

        saveBands : function(b, d, i){
            $.ajax({
                context : this,
                url: window.baseurl,
                type: 'post',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                    'site_id' : this.sites[this.current_site_key].site_id,
                    'product_id' : this.sites[this.current_site_key].site_products[this.current_product_key].product_id,
                    'action' : 'saveBands',
                    'band' : JSON.stringify(this.sites[this.current_site_key].site_products[this.current_product_key].bands)
                },
                context: this,
            }).done(function(response) {

            });

        },

        bandsChanged : function(){
            Vue.set(this, 'bandschanged', true);
        },

        knobUpdate : function(giKey, evt){

            // Prepare iteration
            var grid_items = this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey];

            for (var i in grid_items) {
                if (i == 'band' || i == 'knobval' || i == 0)
                    continue; // exits current iteration if keys are 'band' or knobval or first key

                // Get original value from temp object
                var original_value = this.sites[this.current_site_key].site_products[this.current_product_key].grid_original[giKey][i];

                //
                grid_items[i] = parseFloat(
                    Math.round((parseFloat(original_value) + parseFloat(evt.target.value)) * 100) / 100
                ).toFixed(2);
            }
        },


        // Used for Grid Inputs - to know what the old value was before entering a new value
        storeOldVal : function(evt){
            Vue.set(this, 'focused_field_old_val', evt.target.value);
        },

        clearOldVal : function(evt){
            this.focused_field_old_val = null;
        },


        // Grid item property changed by

        gridItemPropChanged : function(giKey, ipKey, evt){

            // Adjust original value
            // When manually editing an input, there will be an offset from the original value and the increment won't know that
            // so we adjust the original value by that offset
            var amount_changed = parseFloat(evt.target.value) - parseFloat(this.focused_field_old_val);
            var original_value = parseFloat(this.sites[this.current_site_key].site_products[this.current_product_key].grid_original[giKey][ipKey]);
            this.sites[this.current_site_key].site_products[this.current_product_key].grid_original[giKey][ipKey] = parseFloat(Math.round((parseFloat(original_value) + parseFloat(amount_changed)) * 100) / 100).toFixed(2); // updates original value

            evt.target.blur();

            var parsed_value = parseFloat(Math.round((evt.target.value) * 100) / 100).toFixed(2);
            Vue.set(this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey], ipKey, parsed_value); // updates current live value




            /*
                CALCULATE FOR LOCKED FIELDS
                If last editable field or second to last editable fields change - calculate the values for all the locked fields
            */

            if(ipKey == this.options.grid_threshold || ipKey == (this.options.grid_threshold - 1)){

                var last_field_val = this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey][this.options.grid_threshold];
                var penultimate_field_val = this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey][this.options.grid_threshold - 1];

                Vue.set(this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey], 0, parseFloat(last_field_val - penultimate_field_val));

                // Set a reactive variable that will be used by the number field for this Grid Item
                for(var i in this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey]){

                    if (i == 'band' || i == 'knobval' || i <= this.options.grid_threshold)
                        continue; // exits current iteration if keys are 'band' or knobval or first key

                    var offset = (this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey][0]) * (i - this.options.grid_threshold);

                    var new_value = parseFloat(Math.round((
                        parseFloat(this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey][this.options.grid_threshold]) + parseFloat(offset)
                    ) * 100) / 100).toFixed(2);

                    Vue.set(this.sites[this.current_site_key].site_products[this.current_product_key].grid[giKey], i, new_value);
                }









            }

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
                context : this,
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


                // Create grid_original - for storing original grid data for comparison

                this.sites[this.current_site_key].site_products[this.current_product_key].grid_original = [];

                var normalized = JSON.parse(JSON.stringify(this.sites[this.current_site_key].site_products[this.current_product_key].grid));

                // Remove reactivity from temp object property
                // Object.assign(this.sites[this.current_site_key].site_products[this.current_product_key].grid_original, normalized);

                Vue.set(this.sites[this.current_site_key].site_products[this.current_product_key], 'grid_original', normalized);



                // Set a reactive variable that will be used by the number field for this Grid Item
                for(var i in siteproduct.grid){
                    Vue.set(siteproduct.grid[i], 'knobval', 0);
                }

                // Get promo for the current product
                this.getPromo(siteproduct);
            });

        },

        getPromo : function(siteproduct){

            $.ajax({
                context : this,
                url: window.baseurl + '/request_dummy_data/admin_price_get_promo.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                    'site_id' : this.sites[this.current_site_key].site_id,
                    'product_id' : this.sites[this.current_site_key].site_products[this.current_product_key].product_id,
                    'action' : 'getPromo',
                },
            }).done(function(response) {
                Vue.set(siteproduct, 'promo', response.result);
            });
        },

        removePromo : function(promo_id){

        },

        addPromo : function(){



            $.ajax({
                context : this,
                url: window.baseurl + '/request_dummy_data/addpromo.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                    'site_id' : this.sites[this.current_site_key].site_id,
                    'product_id' : this.sites[this.current_site_key].site_products[this.current_product_key].product_id,
                    'action' : 'addPromo',
                    'promo' : this.newpromo
                },
            }).done(function(response) {

                this.sites[this.current_site_key].site_products[this.current_product_key].promo.push(response);

                // Reset promo
                Vue.set(pricesApp.newpromo, 'code', null);
                Vue.set(pricesApp.newpromo, 'discount', 1);
                alert('DEV: Add promo request sent');

            });
        }

    }
});


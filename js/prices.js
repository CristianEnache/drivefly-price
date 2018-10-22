window.baseurl = "http://drivefly.xyz";

var prices = new Vue({
    el: '#prices_app',
    data : {
        sites : null,
        current_site : null,

        site_products : null,
        current_product : null,
        promo : null,
        table : {
            months : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
        }
    },

    mounted : function(){
        this.getSitesAndProducts();
    },

    methods : {

        /*
            Gets list of products, organized by "sites"
        */
        getSitesAndProducts : function(){

            var pricesapp = this;

            $.ajax({
                url: window.baseurl + '/request_dummy_data/admin_price_get_products.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                },
            }).done(function(response) {
                Vue.set(pricesapp, 'sites', response.result);
            });
        },

        /*
            Shows the products belonging to one "site"
        */

        showSiteProducts : function(site){

            if(site.selected)
                return false;

            Vue.set(this, 'current_product', null);

            var pricesapp = this;

                // All sites not selected
                $.each(pricesapp.sites, function(i, el){
                    Vue.set(pricesapp.sites[i], 'selected', false);
                });

            // Current site selected
            Vue.set(site, 'selected', true);

            // Set site_products
            Vue.set(this, 'current_site', site);
            Vue.set(this, 'site_products', site.site_products);
        },



        getProduct : function(siteproduct){

            if(siteproduct.selected)
                return false;

            var pricesapp = this;

            // Set current_product equal to the clicked product
            Vue.set(pricesapp, 'current_product', siteproduct);


                // All sites not selected
                $.each(pricesapp.site_products, function(i, el){
                    Vue.set(pricesapp.site_products[i], 'selected', false);
                });

                // Current site selected
                Vue.set(siteproduct, 'selected', true);


            $.ajax({
                url: window.baseurl + '/request_dummy_data/admin_price_get_product.json',
                type: 'GET',
                dataType: 'json',
                data: {
                    '_token' : 'entersessiontokenhere',
                },
            }).done(function(response) {

                // Update values in component data
                Vue.set(siteproduct, 'bands', response.result.bands);
                Vue.set(siteproduct, 'grid', response.result.grid);
                Vue.set(siteproduct, 'rules', response.result.rules);

                // Get promo for the current product
                pricesapp.getPromo(siteproduct);
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


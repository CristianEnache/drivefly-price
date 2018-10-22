<?php

ob_start();
session_start();

include('connection_m.php');
include('_functions.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<title>DriveFly</title>

	<!-- Disable caching - in DEV -->
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	<!-- Disable caching - in DEV -->


	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="_design-01/style.css" >
	<link rel="stylesheet" type="text/css" href="_design-01/dropzone.css" >
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
	<!--	<script src="_design-01/js/dropzone.js"></script>-->

	<link rel="stylesheet" type="text/css" href="css/prices.css" >

	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
</head>
<body>
<div class="alertZone">
</div>

<div class="alertTemplate" style="display: none;">
	<div class="alert alert-success" style="display: none; margin-bottom: 0;">
		<strong>...</strong>...
		<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
</div>

<?php
include('top_menu.php');
include('top_search.php');
?>

<div class="template_search" style="display: none;">
	<table class="table">
		<tbody>
		<tr class="pointer" data-toggle="modal" data-target="#editReportModal" data-report-id="">
			<td><span class="badge badge-secondary data__leavingDate_formatted">&nbsp;</span></td>
			<td><span class="badge badge-secondary data__returnDate_formatted" >&nbsp;</span></td>
			<td><span class="badge badge-secondary data__consolidator_name">&nbsp;</span> <span class="badge badge-primary data_product">&nbsp;</span></td>
			<td><span class="badge badge-secondary data_refNum">&nbsp;</span></td>
			<td><span class="badge badge-secondary data__airport_name">&nbsp;</span></td>
			<td class="data__name">&nbsp;</td>
			<td class="data_carReg">&nbsp;</td>
			<td><span class="badge badge-pill data_color_selector_status data_status">&nbsp;</span></td>
		</tr>
		</tbody>
	</table>
</div>

<div id="prices_app">

<!--	"Site" selector	-->
	<template v-if="null !== sites">
		<div class="btn-group mr-100 mt-20">
			<button type="button" class="btn btn-default consolidators" v-bind:class="(site.selected) ? 'btn-success' : ''" v-for="site in sites" v-text="site.site_name" v-on:click="showSiteProducts(site)"></button>
		</div>
	</template>

<!--	Product selector	-->
	<template v-if="null !== site_products">
		<div class="btn-group mt-20">

			<button type="button" class="btn btn-default packages" v-bind:class="(siteproduct.selected) ? 'btn-success' : ''" v-for="siteproduct in site_products" v-on:click="getProduct(siteproduct)">
				<span class="badge" v-text="siteproduct.product_airport"></span>
				<span class="badge" v-text="siteproduct.product_type"></span>  <span v-text="current_site.site_name"></span>
			</button>

		</div>
	</template>
	<!-- // start prices -->

	<!-- // price menu -->
	<div class="col-12">
	</div>

	<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<!-- // results -->

	<template v-if="null !== current_product">
		<div id="search-result" class="panel panel-default days">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-lists">
			<div class="panel-heading" style="text-align:center; color: #333; background-color: #f5f5f5; border-color: #ddd;">
				<h3 class=""><span class="badge" v-text="current_product.product_airport"></span> <span class="badge" v-text="current_product.product_type">MG</span> Drivefly </h3>
			</div>
			<div class="panel-body">
				<table class="table table-hover">
					<thead>
					<tr>
						<th></th>
						<template v-for="(n, index) in 31">
							<th v-text="n"></th>
						</template>
					</tr>
					</thead>
					<tbody>
					<template v-if="'undefined' !== typeof current_product.bands">
						<tr v-for="(month, mKey) in table.months">
							<td v-text="month"></td>
							<td v-for="(item, key) in current_product.bands[mKey]" v-text="item.b" v-bind:class="'band' + item.b"></td>
						</tr>
					</template>
					</tbody>
				</table>
				<a href="api/print/pdf.pricelist.php?product_id=x" target="_blank" class="btn btn-primary btn-large pull-left distant-tl-20-6">Export to PDF</a>
			</div>
		</div>





		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 price-lists margined">
			<table class="table table-hover bandA" style="">
				<thead>
				<tr>
				</tr>
				</thead>
				<tbody>
				<tr> </tr>

				<tr>
					<td colspan="21">
						<div class="col-xs-4">
							<span style="font-size:20px;" class="">A</span>

							<span class="form-inline" style="margin-left: 50px;">
                                   <div class="form-group">
                                       <label>+ -</label>
                                       <input type="number" step="1" class="form-controler" style="width: 70px">
                                   </div>
                               </span>
						</div>
						<div class="col-xs-8">
							<button type="button" class="btn btn-large btn-success pull-right">Save</button>
						</div>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	</template>
</div>
<!-- // stop prices -->

<?php

include('modal.php');
?>

<script src="/js/prices.js" type="text/javascript" language="javascript"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>

    $(document).ready(function() {

        $(".consolidators").click(function(){

            $(".consolidators").removeClass("btn-success");
            $(this).addClass("btn-success");
            console.log('consolidator: '+this.value);
        });

        $(".packages").click(function(){

            $(".packages").removeClass("btn-success");
            $(this).addClass("btn-success");
            console.log('packs: '+this.value);
        });
    });
</script>
</body>
</html>

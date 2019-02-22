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


	<link rel="stylesheet" type="text/css" href="/css/prices.css" >
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

<!-- // Start prices app -->
<div id="prices_app">

<!--	"Site" selector	-->
	<template v-if="null !== sites">
		<div class="btn-group mr-100 mt-20">
			<button type="button" class="btn btn-default consolidators" v-bind:class="(sKey == current_site_key) ? 'btn-success' : ''" v-for="(site, sKey) in sites" v-text="site.site_name" v-on:click="showSiteProducts(site, sKey)"></button>
		</div>
	</template>

<!--	Product selector	-->
	<template v-if="null !== current_site_key">
		<div class="btn-group mt-20">

			<button type="button" class="btn btn-default packages" v-bind:class="(spKey == current_product_key) ? 'btn-success' : ''" v-for="(siteproduct, spKey) in sites[current_site_key].site_products" v-on:click="getProduct(siteproduct, spKey)">
				<span class="badge" v-text="siteproduct.product_airport"></span>
				<span class="badge" v-text="siteproduct.product_type"></span>  <span v-text="sites[current_site_key].site_name"></span>
			</button>

		</div>
	</template>
	<!-- // start prices -->

	<!-- // price menu -->
	<div class="col-12">
	</div>

	<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

	<!-- // results -->

	<template v-if="null !== current_product_key">
		<div id="search-result" class="panel panel-default days">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-lists">
			<div class="panel-heading" style="text-align:center; color: #333; background-color: #f5f5f5; border-color: #ddd;">
				<h3 class="">
					<span class="badge" v-text="sites[current_site_key].site_products[current_product_key].product_airport"></span>
					<span class="badge" v-text="sites[current_site_key].site_products[current_product_key].product_type"></span>
					<span v-text="sites[current_site_key].site_products[current_product_key].product_name"></span>
				</h3>
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
					<template v-if="'undefined' !== typeof sites[current_site_key].site_products[current_product_key].bands">
						<tr v-for="(month, mKey) in table.months">
							<td v-text="month"></td>
							<td v-for="(item, key) in sites[current_site_key].site_products[current_product_key].bands[mKey]" v-bind:class="'band' + item.b">
								<input class="border-none background-transparent" type="text" v-model="item.b" v-on:change="bandsChanged(item.b, item.d, item.i)">
							</td>
						</tr>
					</template>
					</tbody>
				</table>

				<div class="row nomargins">
					<div class="col-lg-12">
						<div class="btn-group pull-left">
							<a href="api/print/pdf.pricelist.php?product_id=x" target="_blank" class="btn btn-primary btn-large pull-left distant-tl-20-6">Export to PDF</a>
						</div>

						<div class="btn-group pull-right" v-if="bandschanged">
							<button type="button" class="btn btn-large  btn-success " v-on:click="saveBands()">Save</button>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 price-lists margined">
			<table class="table table-hover band " v-bind:class="'band' + gridItem.band" style="" v-for="(gridItem, giKey) in sites[current_site_key].site_products[current_product_key].grid">
				<thead>
				<tr>
					<th></th>
					<template v-for="(n, index) in options.grid_threshold">
						<th v-text="n"></th>
					</template>
					<th>Next days</th>
					<template v-for="(nr, i) in range((options.grid_threshold + 1), options.grid_limit)">
						<th v-text="nr"></th>
					</template>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td></td>

					<!-- Grid Item Properties : -->
					<template v-for="(el, ipKey) in gridItem">

						<!-- Editable inputs -->
						<template v-if="ipKey > 0 && ipKey <= options.grid_threshold">
							<td>
								<div class="form-group">
									<input class="grid_item_prop" type="text" v-model="gridItem[ipKey]" v-on:change="gridItemPropChanged(giKey, ipKey, $event)" v-on:focus="storeOldVal($event)" v-on:blur="clearOldVal()">
								</div>
							</td>
						</template>

						<!-- Next days input disabled -->
						<td v-if="ipKey == (options.grid_threshold + 1)">
							<div class="form-group">
								<input class="" type="text" v-model="gridItem[0]" disabled>
							</div>
						</td>

						<!-- Rest of disabled inputs -->
						<template v-if="ipKey > options.grid_threshold && ipKey <= options.grid_limit">
							<td>
								<div class="form-group">
									<input class="" type="text" v-model="gridItem[ipKey]" disabled>
								</div>
							</td>
						</template>

					</template>
				</tr>
				<tr>
					<td v-bind:colspan="options.grid_limit + 2">
						<div class="row nomargins">
							<div class="col-4">
								<span class="fsz-20" v-text="gridItem.band"></span>
								<span class="form-inline ml-50">
                                   <div class="form-group">
                                       <label>+ -</label>
                                       <input type="number" step="1" class="form-controler" style="width: 70px" v-model="gridItem.knobval" v-on:change="knobUpdate(giKey, $event)">
                                   </div>
                               </span>
							</div>
							<div class="col-4 text-center">
								<div class="form-group">
									<input type="text" name="clipboard" value="">
									<button type="button" class="btn btn-xs btn-secondary" v-on:click="pasteValues(giKey, $event)">Paste</button>
								</div>
							</div>
							<div class="col-4 text-right">
								<button type="button" class="btn btn-large btn-secondary pull-right" v-on:click="copyValues(giKey)">
									Copy
								</button>
								<button type="button" class="btn btn-large btn-success pull-right" v-on:click="saveGridItem(giKey, $event)">Save</button>
							</div>
						</div>
					</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
	</template>

	<template v-if="null !== current_site_key && null !== current_product_key">
		<div class="row nomargins">
			<div class="col-xs-12 col-sm-8 col-md-6 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">Promo codes</div>
					<div class="panel-body">
						<form action="" class="form-inline ng-pristine ng-valid-min ng-valid-max ng-valid-step ng-invalid ng-invalid-required">

							<div class="form-group" v-for="(promo, pKey) in sites[current_site_key].site_products[current_product_key].promo">
								<input type="text" disabled="true" class="form-control" v-model="promo.promocode">
								<input type="text" disabled="true" class="form-control" v-model="promo.discount" style="width: 50px;">
								<button type="button" class="btn btn-default pull-right" v-on:click="removePromo(promo.promo_id, pKey)" tooltip="Delete">
									Remove <!-- <span class="glyphicon glyphicon-remove"></span> -->
								</button>
							</div>

							<div class="form-group">
								<input type="text" class="form-control" v-model="newpromo.code">
								<input class="form-control" v-model="newpromo.discount" type="number" style="width: 68px;" min="0" max="100" step="1" required="required" title="">
								<button type="button" class="btn btn-default pull-right" v-on:click="addPromo()" tooltip="Add">
									Add
									<!--								<span class="glyphicon glyphicon-plus"></span>-->
								</button>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</template>


</div>
<!-- // end prices app -->

<?php

include('modal.php');
?>

<script src="/js/prices.js" type="text/javascript" language="javascript"></script>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</body>
</html>
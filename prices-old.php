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
	<script src="_design-01/js/dropzone.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>

	<script>
        Dropzone.autoDiscover = false;

        var myDropzone = null;
        var reportId = 0;

        $(document).ready(function() {
            $('.a_search_close').on('click', function(e) {
                $('.a_search_container').hide();
            });

            $('.trigger_search').on('click', function(e) {
                $.ajax({
                    url: 'ajax_search.php',
                    method: 'post',
                    data: { search: $('.data_search').val() }
                }).done(function(data) {
                    $('.a_table_search').find('tbody').html('');

                    for (var reportIndex in data) {
                        var item = $($('.template_search').html());

                        for (var reportProperty in data[reportIndex]) {
                            item.find('.data_' + reportProperty).each(function(index, element) {
                                $(element).html(data[reportIndex][reportProperty]);
                            });
                        }

                        item.find('.data_color_selector_status').each(function(index, element) {
                            switch (data[reportIndex]['status']) {
                                case 'OK': $(element).addClass('badge-success'); break;
                                case 'Paid': $(element).addClass('badge-success'); break;
                                case 'Amended': $(element).addClass('badge-success'); break;
                                case 'Pending': $(element).addClass('badge-warning'); break;
                                case 'Cancelled': $(element).addClass('badge-danger'); break;
                                default: $(element).addClass('bg-white');
                            }
                        });

                        item.find('tr').attr('data-report-id', data[reportIndex]['id']);

                        $('.a_table_search').find('tbody').append(item.find('tr'));
                    }

                    $('.a_search_container').show();
                });
            });

            myDropzone = new Dropzone('.dropzone', {
                url: '/image_upload.php',
                acceptedFiles: 'image/*',
                thumbnailWidth: 75,
                thumbnailHeight: null,
                addRemoveLinks: true,
                removedfile: function(file) {
                    Dropzone.confirm('Do you want to delete?', function() {
                        $.ajax({
                            url: 'image_delete.php',
                            type: 'post',
                            cache: false,
                            dataType: 'json',
                            traditional: true,
                            data: { id: file.id },
                            success: function (data) {
                                $(document).find(file.previewElement).remove();
                            },
                            error: function (err) {
                                alert('Failed to delete file (' + err.status + ').');
                            }
                        });
                    }, function() { return false; });
                }
            });

            myDropzone.on('sending', function(file, xhr, formData) {
                formData.append('report', reportId);
            });

            $('.dropzone').on('click', '.dz-preview', function(event) {
                window.open($(event.currentTarget).find('img').attr('src').replace('.jpg', '-original.jpg'), '_blank');
            });

            $('#editReportModal').on('show.bs.modal', function (event) {
                $('#editReportModal').find('.modal-content > div').each(function(index, element) {
                    if ($(element).hasClass('modal-loader')) {
                        $(element).show();
                    } else {
                        $(element).hide();
                    }
                });

                reportId = $(event.relatedTarget).data('report-id');

                $.ajax({
                    url: 'ajax_report.php',
                    method: 'post',
                    data: { report: $(event.relatedTarget).data('report-id') }
                }).done(function(data) {
                    $('.dropzone').find('.dz-preview').remove();

                    $.ajax({
                        url: 'image_upload.php',
                        type: 'get',
                        cache: false,
                        traditional: true,
                        data: { report: reportId }
                    }).done(function(data) {
                        $.each(data, function(key,value) {
                            var mockFile = { id: value.id, name: value.name, size: value.size, reportId: value.reportId };

                            myDropzone.emit('addedfile', mockFile);

                            myDropzone.emit('thumbnail', mockFile, 'data/images/' + value.name);

                            myDropzone.emit('complete', mockFile);
                        });
                    });

                    for (var reportProperty in data) {
                        $('#editReportModal').find('.data_' + reportProperty).each(function(index, element) {
                            if ($(element).is('input') || $(element).is('textarea')) {
                                $(element).val(data[reportProperty]);
                            } else {
                                $(element).html(data[reportProperty]);
                            }
                        });
                    }

                    $('#editReportModal').find('.data_color_selector_status').each(function(index, element) {
                        switch (data['status']) {
                            case 'OK': $(element).addClass('badge-success'); $(element).removeClass('badge-warning badge-danger'); break;
                            case 'Paid': $(element).addClass('badge-success'); $(element).removeClass('badge-warning badge-danger'); break;
                            case 'Amended': $(element).addClass('badge-success'); $(element).removeClass('badge-warning badge-danger'); break;
                            case 'Pending': $(element).addClass('badge-warning'); $(element).removeClass('badge-success badge-danger'); break;
                            case 'Cancelled': $(element).addClass('badge-danger'); $(element).removeClass('badge-warning badge-success'); break;
                            default: $(element).addClass('bg-white');
                        }
                    });

                    $('#editReportModal').find('.modal-content > div').each(function(index, element) {
                        if ($(element).hasClass('modal-loader')) {
                            $(element).hide();
                        } else {
                            $(element).show();
                        }
                    });

                    $('#leaving_datepicker').val(data['_leavingDate_formatted']);
                    $('[data-target="#leaving_time"]').val(data['_leavingDate_additional']);
                    $('#returning_datepicker').val(data['_returnDate_formatted']);
                    $('[data-target="#returning_time"]').val(data['_returnDate_additional']);

                    // Amendments
                    //

                    $('#editReportModal').find('.a_amendments').find('tbody').children().remove();

                    for (var auditTrailItemIndex in data['_auditTrail']) {
                        var auditTrailRow = $($('.template_modal_amendments_row1').html());

                        for (var auditTrailProperty in data['_auditTrail'][auditTrailItemIndex]) {
                            auditTrailRow.find('.data_' + auditTrailProperty).each(function(index, element) {
                                $(element).html(data['_auditTrail'][auditTrailItemIndex][auditTrailProperty]);
                            });
                        }

                        for (var auditTrailRecordIndex in data['_auditTrail'][auditTrailItemIndex]['_record']) {
                            var auditTrailRecord = $($('.template_modal_amendments_row2').html());

                            for (var auditTrailProperty in data['_auditTrail'][auditTrailItemIndex]['_record'][auditTrailRecordIndex]) {
                                auditTrailRecord.find('.data_' + auditTrailProperty).each(function(index, element) {
                                    $(element).html(data['_auditTrail'][auditTrailItemIndex]['_record'][auditTrailRecordIndex][auditTrailProperty]);
                                });
                            }

                            auditTrailRow.find('.a_before').after($(auditTrailRecord.find('tr').get(0)));
                        }

                        $($('#editReportModal').find('.a_amendments').find('tbody').get(0)).append($(auditTrailRow.find('tr').get(0)));
                    }

                    // Payments
                    //

                    $('#editReportModal').find('.a_payments_list').find('tbody').children().remove();

                    for (var paymentItemIndex in data['_payment']) {
                        var paymentRow = $($('.template_modal_payments_row').html());

                        for (var property in data['_payment'][paymentItemIndex]) {
                            paymentRow.find('.data_' + property).each(function(index, element) {
                                if ($(element).is('input')) {
                                    $(element).val(data['_payment'][paymentItemIndex][property]);
                                } else {
                                    $(element).html(data['_payment'][paymentItemIndex][property]);
                                }
                            });
                        }

                        paymentRow.find('.a-link-setaspaid').on('click', function(event) {
                            $.ajax({
                                url: 'ajax_payment_setaspaid.php',
                                method: 'post',
                                data: { id: $(event.currentTarget).parents('tr').find('.data_id').val() }
                            }).done(function(data) {
                                $(event.currentTarget).parents('tr').find('.data_status').html(data['status']);
                            });
                        });

                        paymentRow.find('.a-link-delete').on('click', function(event) {
                            $.ajax({
                                url: 'ajax_payment_delete.php',
                                method: 'post',
                                data: { id: $(event.currentTarget).parents('tr').find('.data_id').val() }
                            }).done(function(data) {
                                $(event.currentTarget).parents('tr').remove();
                            });
                        });

                        $($('#editReportModal').find('.a_payments_list').find('tbody').get(0)).append($(paymentRow.find('tr').get(0)));
                    }

                    $('#editReportModal .a_payments_add_payment').off('click');

                    $('#editReportModal .a_payments_add_payment').on('click', function(event) {
                        var properties = {report: reportId}
                        var invalid = false;

                        $('#editReportModal').find('.a_payments_data').each(function(index, element) {
                            var classList = $(element).attr('class').split(/\s+/);
                            $.each(classList, function(index, item) {
                                if (item.indexOf('a_payments_data_property_') === 0) {
                                    properties[item.substr(25)] = $(element).val();

                                    invalid = invalid || !element.checkValidity();
                                }
                            });
                        });

                        if (!invalid) {
                            $.ajax({
                                url: 'ajax_payment_add.php',
                                method: 'post',
                                data: properties
                            }).done(function(data) {
                                var paymentRow = $($('.template_modal_payments_row').html());

                                for (var property in data['payment']) {
                                    paymentRow.find('.data_' + property).each(function(index, element) {
                                        if ($(element).is('input')) {
                                            $(element).val(data['payment'][property]);
                                        } else {
                                            $(element).html(data['payment'][property]);
                                        }
                                    });
                                }

                                paymentRow.find('.a-link-setaspaid').on('click', function(event) {
                                    $.ajax({
                                        url: 'ajax_payment_setaspaid.php',
                                        method: 'post',
                                        data: { id: $(event.currentTarget).parents('tr').find('.data_id').val() }
                                    }).done(function(data) {
                                        $(event.currentTarget).parents('tr').find('.data_status').html(data['status']);
                                    });
                                });

                                paymentRow.find('.a-link-delete').on('click', function(event) {
                                    $.ajax({
                                        url: 'ajax_payment_delete.php',
                                        method: 'post',
                                        data: { id: $(event.currentTarget).parents('tr').find('.data_id').val() }
                                    }).done(function(data) {
                                        $(event.currentTarget).parents('tr').remove();
                                    });
                                });

                                $($('#editReportModal').find('.a_payments_list').find('tbody').get(0)).prepend($(paymentRow.find('tr').get(0)));

                                $('#editReportModal').find('.a_payments_data').each(function(index, element) {
                                    var classList = $(element).attr('class').split(/\s+/);
                                    $.each(classList, function(index, item) {
                                        if (item.indexOf('a_payments_data_property_') === 0) {
                                            $(element).val('');
                                        }
                                    });
                                });
                            });
                        }
                    });

                    $('#editReportModal .button-save').off('click');

                    $('#editReportModal .button-save').on('click', function(event) {
                        var properties = {};
                        var invalid = false;

                        $('#editReportModal').find('.save-data').each(function(index, element) {
                            var classList = $(element).attr('class').split(/\s+/);
                            $.each(classList, function(index, item) {
                                if (item.indexOf('save-data-property-') === 0) {
                                    properties[item.substr(19)] = $(element).val();

                                    invalid = invalid || !element.checkValidity();
                                }
                            });
                        });

                        properties['leavingDate'] = moment(properties['leavingDate1'] + ' ' + properties['leavingDate2'], 'D/M/YYYY h:m A').format('YYYY-MM-DD HH:mm:ss');
                        properties['returnDate'] = moment(properties['returnDate1'] + ' ' + properties['returnDate2'], 'D/M/YYYY h:m A').format('YYYY-MM-DD HH:mm:ss');

                        if (!invalid) {
                            $('#editReportModal').find('.modal-content > div').each(function(index, element) {
                                if ($(element).hasClass('modal-loader')) {
                                    $(element).show();
                                } else {
                                    $(element).hide();
                                }
                            });

                            $.ajax({
                                url: 'ajax_report_save.php',
                                method: 'post',
                                data: properties
                            }).done(function(data) {
                                $('#editReportModal').modal('hide');

                                refresh();

                                $('.alertZone').html($('.alertTemplate').html());

                                $('.alertZone').find('.alert').show();

                                $('.alertZone').on('click', 'button', function(event) {
                                    $('.alertZone').find('.alert').hide('fade');
                                });
                            });
                        }
                    });
                });
            });

            $('#leaving_datepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#returning_datepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#leaving_time').datetimepicker({
                format: 'LT'
            });

            $('#returning_time').datetimepicker({
                format: 'LT'
            });
        });
	</script>
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

<!-- // start prices -->

<!-- // price menu -->
<div class="col-12 distant-top-20">

	<div class="btn-group" style="margin-right:100px;">
		<!-- ngRepeat: (k,s) in vm.sites -->
		<button type="button" class="btn btn-default consolidators" style="padding: 10px 22px;">
			I Can Park &amp; Ride
		</button>
		<!-- end ngRepeat: (k,s) in vm.sites -->
		<button type="button" class="btn btn-default consolidators btn-success" style="padding: 10px 22px;">
			DriveFly
		</button>
		<!-- end ngRepeat: (k,s) in vm.sites -->
		<button type="button" class="btn btn-default consolidators" style="padding: 10px 22px;">
			Consolidators
		</button>
		<!-- end ngRepeat: (k,s) in vm.sites -->
	</div>

	<div class="btn-group">
		<!-- ngRepeat: (k,p) in vm.selectedSite.site_products -->
		<button type="button" class="btn btn-default packages btn-success" style="padding: 10px 22px;">
			<span class="badge ">LHR</span>
			<span class="badge ">MG</span>  Drivefly
		</button>
		<!-- end ngRepeat: (k,p) in vm.selectedSite.site_products -->
		<button type="button" class="btn btn-default packages" style="padding: 10px 22px;">
			<span class="badge ">BHX</span>
			<span class="badge ">MG</span>  Drivefly
		</button>
		<!-- end ngRepeat: (k,p) in vm.selectedSite.site_products -->
		<button type="button" class="btn btn-default packages" style="padding: 10px 22px;">
			<span class="badge ">LHR</span>
			<span class="badge ">PR</span>  Drivefly
		</button>
		<!-- end ngRepeat: (k,p) in vm.selectedSite.site_products -->
		<button type="button" class="btn btn-default packages" style="padding: 10px 22px;">
			<span class="badge ">LTN</span>
			<span class="badge ">MG</span>  Drivefly
		</button>
		<!-- end ngRepeat: (k,p) in vm.selectedSite.site_products -->
		<button type="button" class="btn btn-default packages" style="padding: 10px 22px;">
			<span class="badge ">BHX</span>
			<span class="badge ">PR</span>  I Can Park &amp; Ride Flex
		</button>
		<!-- end ngRepeat: (k,p) in vm.selectedSite.site_products -->
	</div>
</div>


<div class="col-12">
</div>

<!--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

<!-- // results -->
<div id="search-result" class="panel panel-default days">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 panel-lists">
		<div class="panel-heading" style="text-align:center; color: #333; background-color: #f5f5f5; border-color: #ddd;">
			<h3 class=""><span class="badge ">LHR</span> <span class="badge ">MG</span> Drivefly </h3>
		</div>

		<div class="panel-body">

			<form name="bandsForm" class="  -maxlength" style="">

				<table class="table table-hover">
					<thead>
					<tr>
						<th></th>

						<?php

						for ($i = 1; $i <= 31; $i++) {
							echo '<th class="">'.$i.'</th>';
						}
						?>

					</tr>
					</thead>
					<tbody>

					<tr class="" style="">

						<td class="">Jan</td>

						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 1 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>

					</tr>

					<tr class="" style="">

						<td class="">Feb</td>

						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 2 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Mar</td>

						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 3 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Apr</td>

						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 4 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">May</td>

						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 5 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Iun</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 6 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Jul</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 7 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Aug</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 8 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Sep</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 9 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Oct</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 10 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Nov</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 11 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					<tr class="" style="">

						<td class="">Dec</td>
						<?php

						$sql_jan = "SELECT * FROM pricing_denominator WHERE pack=1 AND month = 12 ORDER BY id";
						if($stmt = mysqli_prepare($conn, $sql_jan)) {

							if(mysqli_stmt_execute($stmt)){

								$result = mysqli_stmt_get_result($stmt);

								if(mysqli_num_rows($result) > 0) {

									while($row 		= mysqli_fetch_array($result, MYSQLI_ASSOC)){

										$threshold = $row['threshold'];

										echo '<td class="band'.$row['threshold'].'"><input value='.$threshold.' onclick="this.setSelectionRange(0, this.value.length)" maxlength="1" class=""></td>';
									}
								}
							}
						}
						?>
					</tr>

					</tbody>
				</table>
			</form>

			<a href="api/print/pdf.pricelist.php?product_id=x" target="_blank" class="btn btn-primary btn-large pull-left distant-tl-20-6">Export to PDF</a>
		</div>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 price-lists margined">
		<table class="table table-hover bandA" style="">
			<thead>
			<tr>
				<?php

				$sql_denom = "SELECT * FROM pack_denominator WHERE id=1";
				if($stmt = mysqli_prepare($conn, $sql_denom)) {

					if(mysqli_stmt_execute($stmt)){

						$result = mysqli_stmt_get_result($stmt);

						if(mysqli_num_rows($result) > 0) {

							while($row      = mysqli_fetch_array($result, MYSQLI_ASSOC)){

								$threshold  = $row['day_incremental'];
								$days       = json_decode($threshold, true);
								$day        = $days['A'];
								$_1_A       = $day;

								for ($i = 1; $i <= $day; $i++) {

									echo '<th class=" ">'.$i.'</th>';
								}
							}
						}
					}
				}
				?>
				<th>Next days increment</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<?php

				$sql_denom = "SELECT * FROM pack_denominator WHERE id=1";
				if($stmt = mysqli_prepare($conn, $sql_denom)) {

					if(mysqli_stmt_execute($stmt)){

						$result = mysqli_stmt_get_result($stmt);

						if(mysqli_num_rows($result) > 0) {

							while($row      = mysqli_fetch_array($result, MYSQLI_ASSOC)){

								$threshold  = $row['day_incremental'];
								$days       = json_decode($threshold, true);
								$day        = $days['A'];
								$_1_A      = $day;

								for ($i = 1; $i <= $day; $i++) {

									echo '<td class="centered"><input onclick="this.setSelectionRange(0, this.value.length)" value="1" class=""></td>';
								}
							}
						}
					}
				}
				?>
			</tr>
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

<!-- // stop prices -->

<?php

include('modal.php');
?>

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

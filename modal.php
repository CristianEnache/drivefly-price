<!-- Modal -->
<div class="modal fade" id="editReportModal" tabindex="-1" role="dialog" aria-labelledby="editReportModalLabel" aria-hidden="true">
   <div class="modal-dialog">

       <div class="modal-content">
           <div class="modal-loader" style="display: none;">
               <div style="margin: 36px 0; color: #777; padding-top: 1rem;" class="text-center">
                   <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
                   <div style="margin-bottom: 24px; font-size: 36px; line-height: 40px; font-weight: 900">One moment please</div>
                   <p>We are loading your entry details.</p>
               </div>
           </div>

           <div class="modal-header">
               <div class="col-md-8 p-0">
                   <h5 class="modal-title" id="editReportModalLabel"> <span class="data__name">... ...</span> | <span class="data_mobile">...</span> </h5>
               </div>
               <div class="col-md-4 p-0 d-flex justify-content-end">
                   <h5>Ref:  <span class="badge badge-secondary data_refNum">...</span></h5>
               </div>
           </div>

           <div class="modal-body">
               <input type="hidden" class="data_id save-data save-data-property-id"  />
               <ul id="edit_Report_Tab" class="nav nav-tabs nav-justified" role="tablist">
                   <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#booking_details" role="tab" aria-controls="booking_details" aria-selected="true">Booking details</a></li>
                   <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#amendments" role="tab" aria-controls="amendments" aria-selected="true">Amendments</a></li>
                   <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="true">Photos</a></li>
                   <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="true">Payments</a></li>
               </ul>
               <div id="edit_Report_Tab_Content" class="tab-content">
                   <div title="Booking details" class="tab-pane am-fade show active" style="margin-top: 15px;" id="booking_details" role="tabpanel">
                       <div class="row pt-2">
                           <div class="col-md-3">
                               <div class="smallLabel pb-1">Flying from</div>
                               <span class="badge badge-secondary p-2 data__airport_name">Heathrow</span>
                               <span class="span-tooltip glyphicon glyphicon-edit  pull-right pointer" data-toggle="tooltip" aria-hidden="true" title="Edit name"></span>
                           </div>
                           <div class="col-md-6">
                               <div class="smallLabel">Leaving on</div>
                               <div class="input-group date pr-2">
                                   <input type="text" class="form-control datetimepicker-input save-data save-data-property-leavingDate1" id="leaving_datepicker" placeholder="dd/mm/yyyy" data-toggle="datetimepicker" data-target="#leaving_datepicker">
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="smallLabel text-white">&nbsp;</div>
                               <div class="form-group">
                                   <div class="input-group date" id="leaving_time" data-target-input="nearest">
                                       <input type="text" class="form-control datetimepicker-input save-data save-data-property-leavingDate2" data-target="#leaving_time" placeholder="hh:mm"/>
                                       <div class="input-group-append" data-target="#leaving_time" data-toggle="datetimepicker">
                                           <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-md-3">
                               <div class="smallLabel pb-1">Type</div>
                               <span class="">
                                   <span class="badge badge-info p-2 data__type_name" >Meet &amp; Greet</span>
                                   <span class="span-tooltip glyphicon glyphicon-edit  pull-right pointer" aria-hidden="true" data-toggle="tooltip" title="Edit"></span>
                               </span>
                           </div>
                           <div class="col-md-6">
                               <div class="smallLabel">Returning on</div>
                               <div class="input-group date pr-2">
                                   <input type="text" class="form-control datetimepicker-input save-data save-data-property-returnDate1" id="returning_datepicker" placeholder="dd/mm/yyyy" data-toggle="datetimepicker" data-target="#returning_datepicker">
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="smallLabel text-white">&nbsp;</div>
                               <div class="form-group">
                                   <div class="input-group date" id="returning_time" data-target-input="nearest">
                                       <input type="text" class="form-control datetimepicker-input save-data save-data-property-returnDate2" data-target="#returning_time" placeholder="hh:mm"/>
                                       <div class="input-group-append" data-target="#returning_time" data-toggle="datetimepicker">
                                           <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>

                       <div class="dropdown-divider"></div>

                       <div class="row">
                          <div class="col-md-4">
                                 <div class="smallLabel">Car Make and Model</div>
                                 <input maxlength="25" type="text" name="carModel" class="form-control data_carModel save-data save-data-property-carModel" value="" pattern="[A-Za-z0-9 ]{1,}" title="">
                          </div>
                          <div class="col-md-4">
                                 <div class="smallLabel">Car Colour</div>
                                 <input maxlength="12" type="text" name="carColor" class="form-control data_carColour save-data save-data-property-carColour" value="" pattern="[A-Za-z ]{1,}" title="">
                          </div>
                          <div class="col-md-4">
                                 <div class="smallLabel">Reg Number</div>
                                 <input maxlength="10" type="text" name="carReg" class="form-control text-center data_carReg save-data save-data-property-carReg" value="" pattern="[A-Za-z0-9 ]{1,}" title="">
                          </div>
                      </div>

                      <div class="dropdown-divider"></div>

                      <div class="row">
                          <div class="col-md-4">
                                 <div class="smallLabel">Returning Flight Number</div>
                                 <input maxlength="10" type="text" name="flightEnd" class="form-control text-center data_returnFlightNum save-data save-data-property-returnFlightNum" pattern="[A-Z]{2}[0-9]{1,}" autocomplete="off">
                          </div>
                          <div class="col-md-4">
                                 <div class="smallLabel">Terminal In</div>
                                 <input maxlength="11" type="text" name="terminalEnd" class="form-control text-center data_terminal_in save-data save-data-property-terminal_in" value="" pattern="[A-Za-z0-9]{1,}" title="" autocomplete="off">
                          </div>
                          <div class="col-md-4">
                                 <div class="smallLabel">Terminal Out</div>
                                 <input maxlength="11" type="text" name="terminalStart" class="form-control text-center data_terminal_out save-data save-data-property-terminal_out" value="" pattern="[A-Za-z0-9]{1,}" title="" autocomplete="off">
                          </div>
                      </div>

                     <div class="dropdown-divider"></div>

                      <div class="row">
                          <div class="col-md-4">
                              <div class="row">
                                 <div class="col-md-6">
                                   <div class="smallLabel">Amount:</div>
                                   <div><span class="badge badge-secondary text-lg p-1 data_amountPaid">&pound; 54.80</span></div>
                                   <div><span class="badge badge-secondary text-lg p-1 data_net">&pound; 68.50</span></div>
                                   <div><span class="badge badge-info p-1"></span></div>
                                 </div>
                                 <div class="col-md-6">
                                   <div class="smallLabel">Via:</div>
                                   <span class="badge badge-warning data__consolidator_name">DriveFly</span>
                                   <span class="badge badge-info p-1 data_product">D</span>
                                 </div>
                              </div>
                              <div class="row">
                               <div class="col-md-12">
                                 <button type="button" class="cancel btn btn-danger mx-0 mt-3 button-cancel">Cancel booking</button>
                               </div>
                              </div>
                          </div>

                          <div class="col-md-8">
                                 <textarea maxlength="255" rows="5" class="form-control save-data save-data-property-notes data_notes"></textarea>
                                 <div class="smallLabel ">&nbsp;</div>
                          </div>
                      </div>

                      <div class="dropdown-divider"></div>

                      <div class="row">
                         <div class="col-md-6">
                           <span>Status: <span class="badge p-2 data_color_selector_status data_status">OK</span></span>
                         </div>
                         <div class="col-md-6 text-right">
                           <small>Created:  <span class="data__created_formatted">05 Sep 10:46</span></small> | <small>Updated: <span class="data__lastUpdate_formatted">05 Sep 10:46</span></small>
                         </div>
                      </div>
                   </div>

                   <div title="Amendments" class="tab-pane am-fade" id="amendments" role="tabpanel">
                       <table class="table table-condensed a_amendments"  style="margin-top: 15px;">
                           <tbody>
                               <tr class="">
                                   <td class="">2018-09-23 10:17:32<br><br>DDFHPR</td>
                                   <td>
                                       <table class="table table-condensed">
                                           <tbody><tr><th>field</th><th>before</th><th>after</th></tr>
                                           <tr class="">
                                              <td class="">notes</td>
                                              <td class=""></td>
                                              <td class="">Customer left his rack sack in the bus. He told us to to deliver it and will pay for the delivery cost. He will call us back on Monday morning.</td>

                                           </tr>
                                           </tbody>
                                       </table>
                                   </td>
                               </tr>
                               <tr class="">

                                   <td class="">2018-09-10 17:33:33<br><br>DDFHPR</td>
                                   <td>
                                       <table class="table table-condensed">
                                           <tbody><tr><th>field</th><th>before</th><th>after</th></tr>
                                           <tr class="">
                                              <td class="">ppl</td>
                                              <td class="">0</td>
                                              <td class="">2</td>
                                           </tr>
                                           <tr class="">
                                              <td class="">ppl2</td>
                                              <td class=""></td>
                                              <td class="">2</td>
                                           </tr>
                                           </tbody>
                                       </table>
                                   </td>
                               </tr>
                               <tr class="">
                                   <td class="">2018-09-10 11:43:18<br><br>DDFHPR</td>
                                   <td>
                                       <table class="table table-condensed">
                                           <tbody><tr><th>field</th><th>before</th><th>after</th></tr>
                                               <tr class="">
                                                   <td class="">terminal_out</td>
                                                   <td class="">LHR3</td>
                                                   <td class="">3</td>
                                               </tr>
                                               <tr class="">
                                                   <td class="">terminal_in</td>
                                                   <td class="">LHR3</td>
                                                   <td class="">3</td>
                                               </tr>
                                           </tbody>
                                       </table>
                                  </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>

                   <div title="Photos" class="tab-pane am-fade" id="photos" role="tabpanel">
                       <div class="container-fluid">
                           <div class="row" style="margin-top: 15px;" id="">
                               <div class="col-sm-12">
                                   <span class="heading">Report images:</span>
                                   <div class='image-upload-container'>
                                       <div class="dropzone"></div>
                                       <p class="explanation text-center"><strong>Accepted files:</strong> JPG, PNG, GIF; maximum file size: 20MB.</p>
                                   </div>
                               </div>
                           </div>
                           <div><span class="clearfix"></span></div>
                       </div>
                   </div>

                   <div title="Payments" class="tab-pane am-fade" id="payments" role="tabpanel">
                       <div class="row" style="margin-top: 15px;">
                           <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">
                               <div class="smallLabel">For what</div>
                               <input type="text" class="form-control a_payments_data a_payments_data_property_for" maxlength="50" placeholder="Description">
                           </div>
                           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                               <div class="smallLabel">Value</div>
                               <input type="number" class="form-control a_payments_data a_payments_data_property_amount" placeholder="Amount">
                           </div>
                           <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                               <div class="smallLabel">.</div>
                               <button type="button" class="btn btn-primary a_payments_add_payment">Add payment</button>
                           </div>
                       </div>

                       <hr>

                       <div style="text-align: center; margin-top: 16px;color:lightgreen;" class="pointer ">
                           <span style="font-size: 30px;" class=" glyphicon glyphicon-refresh" aria-hidden="true"></span>
                           <div>Refresh after finished payment</div>
                       </div>

                       <table class="table table-hover a_payments_list">
                           <thead>
                               <tr>
                                   <th>created</th>
                                   <th>for</th>
                                   <th>value</th>
                                   <th></th>
                                   <th></th>
                               </tr>
                           </thead>
                           <tbody></tbody>
                       </table>
                   </div>
               </div>
           </div>
           <div class="modal-footer">
               <a target="_self" class="btn btn-default button-add"><span style="font-size: 20px;" class="text-secondary" aria-hidden="true"><i class="fas fa-2x fa-plus-circle"></i></span></a>
               <button type="button" class="btn btn-dark button-save">Save</button>
               <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Print</button>
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
           </div>
       </div>
   </div>
</div>

<div class="template_modal_amendments_row1" style="display: none;">
 <table>
   <tbody>
     <tr class="">
       <td class="">
         <span class="data_date">2018-09-10 17:33:33</span><br><br>DDFHPR
       </td>
       <td>
         <table class="table table-condensed">
           <tbody>
             <tr class="a_before">
               <th>field</th>
               <th>before</th>
               <th>after</th>
             </tr>
           </tbody>
         </table>
       </td>
     </tr>
   </tbody>
 </table>
</div>

<div class="template_modal_amendments_row2" style="display: none;">
 <table>
   <tbody>
     <tr class="">
       <td class="data_field">ppl</td>
       <td class="data_before">0</td>
       <td class="data_after">2</td>
     </tr>
   </tbody>
 </table>
</div>

<div class="template_modal_payments_row" style="display: none;">
 <table>
   <tbody>
     <tr>
       <td class="data_date">&nbsp;</td>
       <td class="data_for">&nbsp;</td>
       <td class="data_amount">&nbsp;</td>
       <td><span class="badge badge-pill data_color_selector_status data_status badge-success data_status">OK</span></td>
       <td>
         <input type="hidden" class="data_id" />
         <div class="btn-group dropup">
           <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Actions</button>
           <div class="dropdown-menu">
             <a class="dropdown-item a-link-paynow" href="#">Pay now</a>
             <a class="dropdown-item a-link-setaspaid" href="#">Set as paid</a>
             <a class="dropdown-item a-link-copylinktopayment" href="#">Copy link to Payment</a>
             <div class="dropdown-divider"></div>
             <a class="dropdown-item a-link-delete" href="#">Delete</a>
           </div>
         </div>
       </td>
     </tr>
   </tbody>
 </table>
</div>

<!-- End Modal -->

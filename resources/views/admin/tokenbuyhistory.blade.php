@extends('admin/layouts/default')
@section('content')
<div class="container">
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Token Buy History</li>
        </ol>
        <h6 class="slim-pagetitle">Token Buy History</h6>
    </div><!-- slim-pageheader -->
    <div class="section-wrapper">
        <div class="table-wrapper">
            <table id="datatable" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-10p">No</th>
                  <th class="wd-20p">Transaction ID</th>
                  <th class="wd-15p">User Email</th>
                  <th class="wd-10p">Amount Due</th>
                  <th class="wd-25p">Transaction Fees</th>
                  <th class="wd-25p">Transaction Time</th>
                  <th class="wd-25p">Verified</th>
                  <!--<th class="wd-25p">Action</th>-->
                </tr>
              </thead>
              <tbody>
                  <?php $sum_token_buy_history = 0;$sum_fee = 0 ?>
                @foreach ($token_buy_histories as $token_buy_history)
                <tr>
                  <td> {{ $loop->iteration }}</td>
                  <td onclick="editrow({{$token_buy_history->id}})"   style="cursor:pointer">{{$token_buy_history->txref}}</td>
                  <td>{{$token_buy_history->user_email}}</td>
                  <td>{{$token_buy_history->amountsettledforthistransaction}}</td>
                  <td>{{$token_buy_history->appfee}}</td>
                  <td>{{$token_buy_history->created_at}}</td>
                  <td><?php echo $token_buy_history->verified==1?"verified":"not verified"?></td>
                  <!--<td>
                      <button class="btn btn-primary btn-sm active wd-30" onclick="editrow({{$token_buy_history->id}})"><i class="icon ion-document-text"></i></button>
                      <button class="btn btn-secondary btn-sm active wd-30" onclick="deleterow({{$token_buy_history->id}})"><i class="icon ion-trash-a"></i></button>
                  </td>-->
                </tr>
                <?php 
                $sum_token_buy_history += $token_buy_history->amountsettledforthistransaction;
                $sum_fee += $token_buy_history->appfee; ?>
                @endforeach
              </tbody>
              <tfooter>
                  <tr>
                      <th colspan="4" style="text-align:right">Total:{{$sum_token_buy_history}}</th>
                      <th>fee total:{{$sum_fee}}</th>
                      <th colspan="2"></th>
                  </tr>
              </tfooter>
            </table>
          </div><!-- table-wrapper -->

    </div><!-- section-wrapper -->
    <div id="modaleditrow" class="modal fade">
      <div class="modal-dialog modal-dialog-vertical-center" role="document">
        <div class="modal-content bd-0 tx-14" style="width:60vw">
          <div class="modal-header">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Transaction Info</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-25">
            <div class="col-lg-12 mg-t-20 mg-lg-t-0">
            <div class="section-wrapper">
              <div class="form-layout form-layout-5">
                <div class="row">
                    <input type="hidden" id="id" >
                  <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Transaction ID:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="text" class="form-control" id="txref" readonly="readonly">
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> User Email:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="email"  class="form-control" id="user_email" readonly="readonly">
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Amount Due:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="amountsettledforthistransaction" readonly="readonly">
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Transaction Fees:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="appfee" readonly="readonly">
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Verified:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="checkbox" class="form-control" value="1" id="verified" readonly="readonly">
                  </div>
                </div>
              </div><!-- form-layout -->
            </div><!-- section-wrapper -->
          </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="editrowaction()">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <!-- MODAL ALERT MESSAGE -->
    <div id="successmodal" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-success tx-semibold mg-b-20">The selected information is registered successfully.</h4>
            <p class="mg-b-20 mg-x-20">Saving Changes</p>
            <button type="button" class="btn btn-success pd-x-25" data-dismiss="modal">OK</button>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <!-- MODAL ALERT MESSAGE -->
    <div id="errormodal" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-danger mg-b-20">Error: Cannot process your entry!</h4>
            <p class="mg-b-20 mg-x-20">Please check all input field.</p>
            <button type="button" class="btn btn-danger pd-x-25" data-dismiss="modal" aria-label="Close">Continue</button>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->

    <div id="deleteconfirm_modal" class="modal fade">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header pd-x-20">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Notice</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-20">
              <p><h3>ATTENTION:</h3>Once the information has been deleted, it will not be able to be recovered! Continue anyway? </p>
          </div>
          <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-primary" onclick="deleterowaction()">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <script>
        function editrow(id){
            $.getJSON( "{{route('admin.transactioninfojson')}}",{id:id,_token:$('meta[name=csrf-token]').attr("content")}, function( data ){
                $('#id').val(data.id);
                $('#txref').val(data.txref);
                $('#user_email').val(data.user_email);
                $('#amountsettledforthistransaction').val(data.amountsettledforthistransaction);
                $('#appfee').val(data.appfee);
                if(data.verified!=0){
                    $('#verified').prop('checked', true);
                }else{
                    $('#verified').prop('checked', false);
                }

                $('#modaleditrow').modal('show');
            });
        }
        function editrowaction (){
            if ($('#verified').is(":checked")){
                $('#verified').val(1);
            }else{
                $('#verified').val(0);
            }
            $.post("{{route('admin.transactionedit')}}",{
                _token:$('meta[name=csrf-token]').attr("content"),
                id:$('#id').val(),
                amountsettledforthistransaction:$('#amountsettledforthistransaction').val(),
                appfee:$('#appfee').val(),
                verified:$('#verified').val(),
            },function(data){
                if(data=="success"){
                    $('#modaleditrow').modal('hide');
                    $('#successmodal').modal('show');
                }else{
                    $('#errormodal').modal('show');
                }
            });
        }
        var selected_row_id=0;
        function deleterow(seleted_id){
            selected_row_id=seleted_id;
            $('#deleteconfirm_modal').modal('show');
        }
        function deleterowaction (){
            $.post("{{route('admin.transactiondelete')}}",{
                _token:$('meta[name=csrf-token]').attr("content"),
                id:selected_row_id,
            },function(data){
                if(data=="success"){
                    location.href="{{route('admin.tokenbuyhistory')}}"
                }else{
                    $('#errormodal').modal('show');
                }
            });
        }
          $(function(){
            'use strict';
            $('#datatable').DataTable({
              responsive: true,
              language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
              }
            });
            // Select2
            $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
          });
    </script>
</div><!-- container -->
      @stop

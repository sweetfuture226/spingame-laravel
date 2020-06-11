@extends('admin/layouts/default')
@section('content')
<div class="container">
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
        <h6 class="slim-pagetitle">Users</h6>
    </div><!-- slim-pageheader -->
    <div class="section-wrapper">
        <div class="table-wrapper">
            <table id="usestable" class="table display responsive ">
              <thead>
                <tr>
                  <th class="wd-10p">No</th>
                  <th class="wd-15p">first name</th>
                  <th class="wd-15p">last name</th>
                  <th class="wd-15p">email</th>
                  <th class="wd-15p">telephone</th>
                  <th class="wd-10p">Tokens</th>
                  <th class="wd-10p">Verified</th>
                  <th class="wd-10p">Registered</th>
                  <th class="wd-5p">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $states=config('constants.states')?>
                @foreach ($users as $user)
                <tr>
                  <td> {{ $loop->iteration }}</td>
                  <td onclick="edituser({{$user['id']}})"   style="cursor:pointer">{{$user['firstname']}}</td>
                  <td>{{$user['lastname']}}</td>
                  <td>{{$user['email']}}</td>
                  <td>{{$user['telephone']}}</td>
                  <td>{{$user['token_count']}}</td>
                  <td>{{$user['activated']==1?'activated':'inactive'}}</td>
                  <td>{{$user['created_at']}}</td>
                  <td>
                      <button class="btn btn-secondary btn-sm active wd-30" onclick="javascript:location.href='{{route('admin.prizewinners')}}?user={{$user['id']}}'"><i class="icon ion-search"></i></button>
                      <button class="btn btn-primary btn-sm active wd-30" onclick="edituser({{$user['id']}})"><i class="icon ion-wrench"></i></button>
                      <button class="btn btn-secondary btn-sm active wd-30" onclick="userdelete({{$user['id']}})"><i class="icon ion-trash-a"></i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- table-wrapper -->

    </div><!-- section-wrapper -->
    <div id="modaledituser" class="modal fade">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm" style="width:60vw">
          <div class="modal-header">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">User Info</h6>
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
                  <label class="col-sm-4 form-control-label">User name<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="name">
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"> Email<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="email"  class="form-control" id="email">
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">Instagram:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="ins_username" >
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"> Available Tokens<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="token_count" >
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"> State:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <select class="form-control" id="state" data-placeholder="Choose state">
                        @foreach ($states as $key=>$state)
                        <option value="{{$key}}" >{{$state}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label"> activated<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="checkbox" class="form-control" value="1" id="activated" >
                  </div>
                </div>
              </div><!-- form-layout -->
            </div><!-- section-wrapper -->
          </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="usereditaction()">Save changes</button>
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
            <h4 class="tx-success tx-semibold mg-b-20">The user information is registered successfully.</h4>
            <p class="mg-b-20 mg-x-20">Saving Changes</p>
            <button type="button" class="btn btn-success pd-x-25" onclick="location.href = '{{route('admin.users')}}'" data-dismiss="modal">OK</button>
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
              <p><h3>ATTENTION:</h3>Once the user has been deleted, it will not be able to be recovered! Continue anyway? </p>
          </div>
          <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-primary" onclick="userdeleteaction()">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <script>
        function edituser(id){
            $.getJSON( "{{route('admin.userinfojson')}}",{id:id,_token:$('meta[name=csrf-token]').attr("content")}, function( data ){
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#ins_username').val(data.ins_username);
                $('#state').val(data.state);
                $('#token_count').val(data.token_count);
                if(data.activated!=0){
                    $('#activated').prop('checked', true);
                }else{
                    $('#activated').prop('checked', false);
                }
                $('#modaledituser').modal('show');
            });
        }
        function usereditaction (){
            if ($('#activated').is(":checked")){
                $('#activated').val(1);
            }else{
                $('#activated').val(0);
            }
            $.post("{{route('admin.usereditaction')}}",{
                _token:$('meta[name=csrf-token]').attr("content"),
                id:$('#id').val(),
                name:$('#name').val(),
                email:$('#email').val(),
                activated:$('#activated').val(),
                ins_username:$('#ins_username').val(),
                state:$('#state').val(),
                token_count:$('#token_count').val()
            },function(data){
                if(data=="success"){
                    $('#modaledituser').modal('hide');
                    $('#successmodal').modal('show');
                }else{
                    $('#errormodal').modal('show');
                }
            });
        }
        var selecte_user_id=0;
        function userdelete(seleted_id){
            selecte_user_id=seleted_id;
            $('#deleteconfirm_modal').modal('show');
        }
        function userdeleteaction (){
            $.post("{{route('admin.userdelete')}}",{
                _token:$('meta[name=csrf-token]').attr("content"),
                id:selecte_user_id,
            },function(data){
                if(data=="success"){
                    location.href="{{route('admin.users')}}"
                }else{
                    $('#errormodal').modal('show');
                }
            });
        }
          $(function(){
            'use strict';
            $('#usestable').DataTable({
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

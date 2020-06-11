@extends('admin/layouts/default')
@section('content')
<link href="/plugins/jquery/jquery.datetimepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<div class="container">
    <div class="slim-pageheader">
        <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">prizes</li>
            <li class="breadcrumb-item"><a href="javascript:void(0)" onclick="addnew()">Add Prize</a></li>
        </ol>
        <h6 class="slim-pagetitle">Prizes</h6>
    </div><!-- slim-pageheader -->
    <div class="section-wrapper">
        <div class="table-wrapper">
            <table id="datatable" class="table display responsive wrap">
                <thead>
                    <tr>
                        <th class="wd-10p">No</th>
                        <th class="wd-20p">Image</th>
                        <th class="wd-25p">Prize Category</th>
                        <th class="wd-20p">Prize name</th>
                        <th class="wd-15p">cost</th>
                        <th class="wd-15p">Start Time</th>
                        <th class="wd-15p">Status</th>
                        <th class="wd-10p">Token</th>
                        <th class="wd-10p">Users</th>
                        <th class="wd-25p">description</th>
                        <th class="wd-25p">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $prize_category=array(1=>'LIFESTYLE',2=>'ELECTRONIC',3=>'EATING AND DRINKING');
                    ?>
                    @foreach ($prizes as $prize)
                    <tr>
                        <td> {{ $loop->iteration }}</td>
                        <td onclick="editrow({{$prize->id}})"   style="cursor:pointer"><img width="80" src='{{$prize->img_url}}' /></td>
                        <td>{{$prize_category[$prize->prize_category]}}</td>
                        <td>{{$prize->prize_name}}</td>
                        <td>{{$prize->prize_cost}}</td>
                        <td>{{$prize->start_time}}</td>
                        <td>{{strtotime($prize->expire_time)<(time()+3600)?"expired":"active"}}</td>
                        <td>{{$prize->token_count}}</td>
                        <td>{{$prize->user_count}}</td>
                        <td><?php echo $prize->description ?></td>
                        <td>
                            <button class="btn btn-secondary btn-sm active wd-30" onclick="javascript:location.href='{{route('admin.prizewinners')}}?prize={{$prize->id}}'"><i class="icon ion-search"></i></button>
                            <button class="btn btn-primary btn-sm active wd-30" onclick="editrow({{$prize->id}})"><i class="icon ion-wrench"></i></button>
                            <button class="btn btn-secondary btn-sm active wd-30" onclick="deleterow({{$prize->id}})"><i class="icon ion-trash-a"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- table-wrapper -->

    </div><!-- section-wrapper -->
    <div id="modaledit" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content tx-size-sm" style="width:60vw">
                <div class="modal-header">
                    <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Prize Info</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-25">
                    <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                        <form name="modal_form" id="modal_form" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                        <div class="section-wrapper">
                            <div class="form-layout form-layout-5">
                                <div class="row">
                                    <input type="hidden" id="id" >
                                    <input type="hidden" id="task" name="task" value="edit">
                                    <label class="col-sm-4 form-control-label"><img title="prize image" width="60" id="prize_img"></label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="hidden" id="img_url" name="img_url" value="/images/noprize.png"/>
                                        <input type="file" class="form-control" name="file_upload"  id="img_upload">
                                    </div>
                                </div><!-- row -->
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label"> Prize name :</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" id="prize_name">
                                    </div>
                                </div><!-- row -->
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Prize Cost:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="prize_cost" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Cash prize amount:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="cash_price" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Mystery prize :</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" id="mystery_prize" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label"> Prize Type :</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <select class="form-control" id="prize_category" name="prize_category">
                                            <option value="1">LIFESTYLE</option>
                                            <option value="2">ELECTRONIC</option>
                                            <option value="3">EATING AND DRINKING</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Start Time:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" id="start_time" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Expire Time:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" id="expire_time" readonly="readonly">
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">Tokens :</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="text" class="form-control" id="token_count" >
                                    </div>
                                </div>

                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label"> Description:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <textarea class="form-control" id="description" ></textarea>

                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of jackpot:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_jackpot" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of free token:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_free_token" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of 1/2 token:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_half_token" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of mystery prize:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_mystery_prize" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of free spin:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_free_spin" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of N500 Airtime:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_n500" >
                                    </div>
                                </div>
                                <div class="row mg-t-20">
                                    <label class="col-sm-4 form-control-label">winners of cash:</label>
                                    <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                        <input type="number" class="form-control" id="winners_cash" >
                                    </div>
                                </div>
                            </div><!-- form-layout -->
                        </div><!-- section-wrapper -->
                        </form>
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
                    <h4 class="tx-success tx-semibold mg-b-20">The prize information is registered successfully.</h4>
                    <p class="mg-b-20 mg-x-20">Saving Changes</p>
                    <button type="button" class="btn btn-success pd-x-25" onclick="location.href = '{{route('admin.prizes')}}'" data-dismiss="modal">OK</button>
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
                    <p><h3>ATTENTION:</h3>Once the prize has been deleted, it will not be able to be recovered! Continue anyway? </p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" onclick="deleterowaction()">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->
    <script>
    var prizeCheck = 0;
        function twoDigits(d) {
            if(0 <= d && d < 10) return "0" + d.toString();
            if(-10 < d && d < 0) return "-0" + (-1*d).toString();
            return d.toString();
        }

        Date.prototype.toMysqlFormat = function() {
            return this.getUTCFullYear() + "-" + twoDigits(1 + this.getUTCMonth()) + "-" + twoDigits(this.getUTCDate()) + " " + twoDigits(this.getUTCHours()) + ":" + twoDigits(this.getUTCMinutes()) + ":" + twoDigits(this.getUTCSeconds());
        };
        $(document).ready(function(){
            $('#expire_time').datetimepicker();
            $("#img_upload").change(function() {
               var data=new FormData($("#modal_form")[0]);
                $.ajax({
                    url: "{{route('ajaximgupload')}}", // Url to which the request is send
                    type: "POST",
                    data:data,
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data){
                        $('#img_url').val(data);
                        $('#prize_img').attr('src',data);
                    }
                });
            });
        });
        function addnew(){
            $('.modal-header>h6').html('Add New Prize');
            $('#prize_img').attr('src','/images/noprize.png');
            $('#img_url').val('/images/noprize.png');
            $('#task').val('addnew');
            $('#prize_name').val('');
            $('#prize_cost').val('');
            $('#prize_category').val(1);
            $('#token_count').val(1);
            $('#mystery_prize').val('');
            var today=new Date();
            today.setHours(today.getHours() +1);
            $('#start_time').val(today.toMysqlFormat());
            $('#start_time').change(function(){
              var expire_time_str=new Date(this.value);
              expire_time_str.setHours(expire_time_str.getHours() +1);
              expire_time_str.setDate(expire_time_str.getDate()+1);
              $('#expire_time').val(expire_time_str.toMysqlFormat());
            });
            var tommorrow=new Date();
            tommorrow.setDate(new Date().getDate()+1);
            tommorrow.setHours(tommorrow.getHours() +1);
            $('#expire_time').val(tommorrow.toMysqlFormat());
            $('#description').val('');
            $('#winners_jackpot').val(1);
            $('#winners_n500').val(1);
            $('#winners_free_token').val(1);
            $('#winners_half_token').val(1);
            $('#winners_mystery_prize').val(1);
            $('#winners_free_spin').val(1);
            $('#winners_cash').val(1);
            $('#cash_price').val('');
            $('#modaledit').modal('show');
        }
        function editrow(id){
            $.getJSON("{{route('admin.prizeinfojson')}}", {id:id}, function(data){
                $('#id').val(data.id);
                $('#task').val('edit');
                $('#prize_img').attr('src',data.img_url);
                $('#img_url').val(data.img_url);
                $('#prize_name').val(data.prize_name);
                $('#prize_cost').val(data.prize_cost);
                $('#prize_category').val(data.prize_category);
                $('#token_count').val(data.token_count);
                $('#mystery_prize').val(data.mystery_prize);
                $('#start_time').val(data.start_time);
                $('#expire_time').val(data.expire_time);
                $('#description').val(data.description);
                $('#winners_jackpot').val(data.winners_jackpot);
                $('#winners_n500').val(data.winners_n500);
                $('#winners_free_token').val(data.winners_free_token);
                $('#winners_half_token').val(data.winners_half_token);
                $('#winners_mystery_prize').val(data.winners_mystery_prize);
                $('#winners_free_spin').val(data.winners_free_spin);
                $('#winners_cash').val(data.winners_cash);
                $('#cash_price').val(data.cash_price);
                $('#modaledit').modal('show');
            });
        }

        function editrowaction (){
           
          if($('#prize_name').val()==''){
            alert('Prize name is required');
            return false;
          }
          if($('#description').val()==''){
            alert('Prize description is required');
            return false;
          }
          if($('#prize_cost').val()==''){
            alert('Prize Cost is required');
            return false;
          }
          if($('#mystery_prize').val()==''){
            alert('Mystery prize is required');
            return false;
          }
          if($('#token_count').val()==''){
            alert('Tokens is required');
            return false;
          }
          if($('#start_time').val()==''){
            alert('Strat Time is required');
            return false;
          }
          if($('#winners_jackpot').val()==''){
            alert('Winners of jackpot is required');
            return false;
          }
          if($('#winners_free_token').val()==''){
            alert('Winners of free token is required');
            return false;
          }
          if($('#winners_half_token').val()==''){
            alert('Winners of free 1/2token is required');
            return false;
          }
          if($('#token_count').val()==''){
            alert('Winners of mystery prize is required');
            return false;
          }
          if($('#token_count').val()==''){
            alert('Winners of free spin is required');
            return false;
          }
          if($('#token_count').val()==''){
            alert('Winners of N500 Airtime is required');
            return false;
          }
          if($('#token_count').val()==''){
            alert('Winners of cash is required');
            return false;
          }
          if($('#cash_price').val()==''){
            alert('Cash price is required');
            return false;
          }
            var url="{{route('admin.prizeeditaction')}}";
            if($('#task').val()=="addnew"){
                url="{{route('admin.prizeaddaction')}}";
            }
            $.post(url, {
                _token:$('meta[name=csrf-token]').attr("content"),
                id:$('#id').val(),
                prize_name:$('#prize_name').val(),
                prize_cost:$('#prize_cost').val(),
                prize_category:$('#prize_category').val(),
                token_count:$('#token_count').val(),
                img_url:$('#img_url').val(),
                start_time:$('#start_time').val(),
                expire_time:$('#expire_time').val(),
                description:$('#description').val(),
                winners_jackpot:$('#winners_jackpot').val(),
                winners_n500:$('#winners_n500').val(),
                winners_free_token:$('#winners_free_token').val(),
                winners_half_token:$('#winners_half_token').val(),
                winners_mystery_prize:$('#winners_mystery_prize').val(),
                winners_free_spin:$('#winners_free_spin').val(),
                winners_cash:$('#winners_cash').val(),
                cash_price:$('#cash_price').val(),
                mystery_prize:$('#mystery_prize').val(),
            }, function(data){
                if (data == "success"){
                    $('#modaledit').modal('hide');
                    $('#successmodal').modal('show');
                } else{
                    $('#errormodal').modal('show');
                }
            });
        }
        var selecte_row_id = 0;
        function deleterow(selected_id){
        selecte_row_id = selected_id;
        $('#deleteconfirm_modal').modal('show');
        }
        function deleterowaction (){
        $.post("{{route('admin.prizedeleteaction')}}", {
        _token:$('meta[name=csrf-token]').attr("content"),
                id:selecte_row_id,
        }, function(data){
        if (data == "success"){
        location.href = "{{route('admin.prizes')}}"
        } else{
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

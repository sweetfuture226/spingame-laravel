<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <meta name="robots" content="noindex">

    <!-- Meta -->
    <meta name="description" content="Thrift Gift admin panel.">
    <meta name="author" content="dongjin84229@gmail.com">

    <title>Thrift Gift Admin</title>

    <!-- vendor css -->
    <link href="/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/lib/datatables/css/jquery.dataTables.css" rel="stylesheet">

    <link href="/lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="../lib/select2/css/select2.min.css" rel="stylesheet">
    <!-- Slim CSS -->
    <link rel="stylesheet" href="/css/slim.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css"> -->

    <!-- bootstrape button toggle style -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    

    <script src="../lib/jquery/js/jquery.js"></script>
    <script src="../lib/popper.js/js/popper.js"></script>
    <script src="../lib/bootstrap/js/bootstrap.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->
    <script src="../lib/jquery.cookie/js/jquery.cookie.js"></script>
    <script src="../lib/datatables/js/jquery.dataTables.js"></script>
    <script src="../lib/datatables-responsive/js/dataTables.responsive.js"></script>
    <script src="../lib/select2/js/select2.min.js"></script>
    <script src="../lib/d3/js/d3.js"></script>
    <script src="../lib/rickshaw/js/rickshaw.min.js"></script>
    <script src="../lib/Flot/js/jquery.flot.js"></script>
    <script src="../lib/Flot/js/jquery.flot.resize.js"></script>
    <script src="../lib/peity/js/jquery.peity.js"></script>

    <script src="../js/slim.js"></script>
    <script src="../js/ResizeSensor.js"></script>
    
    <!-- bootstrap toggle button script -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  </head>
  <body class="dashboard-3">
    <div class="slim-header">
      <div class="container">
        <div class="slim-header-left">
          <h2 class="slim-logo"><a href="{{route('admin.home')}}">Thrift Gift Admin Panel<span>.</span></a></h2>

        </div><!-- slim-header-left -->
        <div class="slim-header-right">
          <div class="dropdown dropdown-c">
            <a href="#" class="logged-user" data-toggle="dropdown">
              <img src="http://via.placeholder.com/500x500" alt="">

              <span id="span_admin_name">{{Session::get('admin_name')}}</span>
              <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <nav class="nav">
                <a  data-target="#modaleditadmin" data-toggle="modal" class="nav-link" style="cursor: pointer"><i class="icon ion-compose"></i>Change Admin Info</a>
                <a href="{{route('admin.logout')}}" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
              </nav>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </div><!-- header-right -->
      </div><!-- container -->
    </div><!-- slim-header -->

    <div class="slim-navbar">
      <div class="container">
        <ul class="nav">
          <li class="nav-item with-sub {{Request::is('admin')?'active':''}} {{Request::is('admin/prizes')?'active':''}}">
            <a class="nav-link" href="{{route('admin.home')}}">
              <i class="icon ion-easel"></i>
              <span>Prize</span>
            </a>
          </li>
          <li class="nav-item with-sub {{Request::is('admin/users*')?'active':''}}">
            <a class="nav-link" href="{{route('admin.users')}}">
              <i class="icon ion-person"></i>
              <span>Users</span>
            </a>
          </li>
          <li class="nav-item with-sub {{Request::is('admin/tokenbuyhistory')?'active':''}}">
            <a class="nav-link" href="{{route('admin.tokenbuyhistory')}}">
              <i class="icon ion-ios-book-outline"></i>
              <span>Transactions</span>
            </a>
          </li>
          <li class="nav-item with-sub {{Request::is('admin/prizewinners')?'active':''}}">
            <a class="nav-link" href="{{route('admin.prizewinners')}}">
              <i class="icon ion-flag"></i>
              <span>Prize Winners</span>
            </a>
          </li>
          <!--<li class="nav-item with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="icon ion-ios-gear-outline"></i>
              <span>Forms</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="form-elements.html">Form Elements</a></li>
                <li><a href="form-layouts.html">Form Layouts</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="page-messages.html">
              <i class="icon ion-ios-chatboxes-outline"></i>
              <span>Messages</span>
              <span class="square-8"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="widgets.html">
              <i class="icon ion-ios-analytics-outline"></i>
              <span>Widgets</span>
            </a>
          </li>-->
        </ul>
      </div><!-- container -->
    </div><!-- slim-navbar -->

    <div class="slim-mainpanel">
        @yield('content')

    </div><!-- slim-mainpanel -->

    <div class="slim-footer">
      <div class="container">
        <p>Copyright 2018 &copy; All Rights Reserved. Playthriftgift</p>
        <p>Developed by: <a href="mailto:dongjin84229@gmail.com">dongjin84229@gmail.com</a></p>
      </div><!-- container -->
    </div><!-- slim-footer -->


  <div id="modaleditadmin" class="modal fade">
      <div class="modal-dialog modal-dialog-vertical-center" role="document">
        <div class="modal-content bd-0 tx-14">
          <div class="modal-header">
            <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">admin Info</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body pd-25">
            <div class="col-lg-12 mg-t-20 mg-lg-t-0">
            <div class="section-wrapper">
              <div class="form-layout form-layout-5">
                <div class="row">
                  <label class="col-sm-4 form-control-label">admin ID<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="admin_id" value="{{Session::get('admin_id')}}">
                  </div>
                </div><!-- row -->
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">admin name:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="email"  class="form-control" id="admin_name" value="{{Session::get('admin_name')}}">
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">admin email:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="text" class="form-control" id="admin_email" value="{{Session::get('admin_email')}}">
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">old password<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                    <input type="password" class="form-control" id="old_password" >
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">new password<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="password" class="form-control"  id="new_password" >
                  </div>
                </div>
                <div class="row mg-t-20">
                  <label class="col-sm-4 form-control-label">confirm password<span class="tx-danger">*</span>:</label>
                  <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                      <input type="password" class="form-control"  id="confirm_password" >
                  </div>
                </div>
              </div><!-- form-layout -->
            </div><!-- section-wrapper -->
          </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-primary" onclick="admineditaction()">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <div id="adminsuccessmodal" class="modal fade">
      <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
          <div class="modal-body tx-center pd-y-20 pd-x-20">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
            <h4 class="tx-success tx-semibold mg-b-20">The admin information is registered successfully.</h4>
            <p class="mg-b-20 mg-x-20">Saving Changes</p>
            <button type="button" class="btn btn-success pd-x-25"  data-dismiss="modal">OK</button>
          </div><!-- modal-body -->
        </div><!-- modal-content -->
      </div><!-- modal-dialog -->
    </div><!-- modal -->
    <!-- MODAL ALERT MESSAGE -->
    <div id="adminerrormodal" class="modal fade">
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
    <script>
    function admineditaction (){
        if($('#new_password').val()!=$('#confirm_password').val()){
            $('#adminerrormodal').modal('show');
            return;
        }
        $.ajaxSetup({
           headers: {
               'X-CSRF-Token': $('meta[name="csrf_token"]').attr('content')
           }
       });
        $.post("{{route('admin.passwordchange')}}",{
            _token:'{{ csrf_token() }}',
            admin_id:$('#admin_id').val(),
            admin_email:$('#admin_email').val(),
            admin_name:$('#admin_name').val(),
            old_password:$('#old_password').val(),
            new_password:$('#new_password').val(),
        },function(data){
            if(data=="success"){
                $('#span_admin_name').html($('#admin_name').val());
                $('#modaleditadmin').modal('hide');
                $('#adminsuccessmodal').modal('show');
            }else{
                $('#adminerrormodal').modal('show');
            }
        });
    }
    </script>
  </body>
</html>

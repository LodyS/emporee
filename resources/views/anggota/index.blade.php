<!DOCTYPE html>
<html lang="en">

<meta name="csrf-token" content="{{ csrf_token() }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Emporee</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('otika/assets/css/app.min.css') }}">
    <link rel="stylesheet" href="{{ asset('otika/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('otika/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('otika/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('otika/assets/css/components.css') }}">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('otika/assets/css/custom.css') }}">
</head>

<body>
    <div class="loader"></div>
        <div id="app">

        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
                <nav class="navbar navbar-expand-lg main-navbar sticky">

                <div class="form-inline mr-auto"></div>

        <ul class="navbar-nav navbar-right">

            <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="{{ asset('otika/assets/img/user.png') }}"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
                <div class="dropdown-menu dropdown-menu-right pullDown">
                    <div class="dropdown-title">Hello {{ Auth::guard('admin')->user()->username }}</div>

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i>Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </div>
            </li>
        </ul>
    </nav>

    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">

          <ul class="sidebar-menu">
            <li class="menu-header">Admin</li>
                <li class="dropdown">
                <a href="{{ url('anggota/index') }}" class="nav-link"><i data-feather="user"></i><span>Anggota</span></a>
                <a href="{{ url('buku/index') }}" class="nav-link"><i data-feather="book"></i><span>Buku</span></a>
                <a href="{{ url('pinjam-buku/index') }}" class="nav-link"><i data-feather="archive"></i><span>Pengajuan Pinjam Buku</span></a>
                <a href="{{ url('pinjam-buku/pengembalian-pinjam-buku')}}" class="nav-link"><i data-feather="monitor"></i><span>Pengembalian Buku</span></a>
            </li>
        </ul>
    </aside>
</div>
      <!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">


                <div class="card">

                    <div class="pull-right mb-2" align="right">
                        <a class="btn btn-success" onClick="add()" href="javascript:void(0)" align="right">Tambah Anggota</a>
                    </div>

                    <div class="card-header"><h4>Data Anggota</h4></div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="anggota">
                                    <thead>
                                        <tr>
                                            <th>Kode Anggota</th>
                                            <th>Username</th>
                                            <th>No Telepon</th>
                                            <th>Email</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title" id="form-Modal"></h4>
        </div>

            <div class="modal-body">
                <form action="javascript:void(0)" id="form" name="form" class="form-horizontal needs-validation" novalidate="" method="POST">
                    <input type="hidden" name="id" id="id">

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Kode Anggota</label>
                                    <div class="col-sm-12">
                                    <input type="text" class="form-control" id="kode_anggota" name="kode_anggota" value="{{ $kode_anggota }}" maxlength="50" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-12">
                                    <input type="text" class="form-control" id="username" name="username" maxlength="50" required="">
                                    <div class="invalid-feedback">Username Wajib diisi</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telepon</label>
                                    <div class="col-sm-12">
                                    <input type="number" class="form-control" id="no_telepon" name="no_telepon" required="">
                                    <div class="invalid-feedback">Telepon Wajib diisi</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">E-mail</label>
                                    <div class="col-sm-12">
                                    <input type="email" class="form-control" id="email" name="email" maxlength="50" required="">
                                    <div class="invalid-feedback">E-mail Wajib diisi</div>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                            </div>

                        </form>
                    </div>
                <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- General JS Scripts -->
<script src="{{ asset('otika/assets/js/app.min.js') }}"></script>
<!-- JS Libraies -->
<script src="{{ asset('otika/assets/bundles/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('otika/assets/js/page/datatables.js') }}"></script>
<!-- Template JS File -->
<script src="{{ asset('otika/assets/js/scripts.js') }}"></script>
<!-- Custom JS File -->
<script src="{{ asset('otika/assets/js/custom.js') }}"></script>
<script src="{{ asset('otika/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
</body>



</html>

<script type="text/javascript">
$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#anggota').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('anggota/index') }}",
            columns: [
                { data: 'kode_anggota', name: 'kode_anggota' },
                { data: 'username', name: 'username' },
                { data: 'no_telepon', name: 'no_telepon' },
                { data: 'email', name: 'email' },
                { data: 'action', name: 'action', orderable: false},
            ],
        order: [[0, 'asc']]
    });
});

function add(){
    $('#form').trigger("reset");
    $('#form-Modal').html("Tambah Anggota");
    $('#modal').modal('show');
    $('#id').val('');
}

$('#form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ url('simpan-anggota')}}",
        data: formData,
        cache : false,
        contentType : false,
        processData : false,
        success: (data) => {
            $("#modal").modal('hide');
                var oTable = $('#anggota').dataTable();
                oTable.fnDraw(false);
                $("#btn-save").html('Submit');
                $("#btn-save"). attr("disabled", false);
            },

        error: function(data){
            console.log(data);
        }
    });
});

function edit(id){
    $.ajax({
        type:"POST",
        url: "{{ url('edit-anggota') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){
            $('#form-Modal').html("Edit Anggota");
            $('#modal').modal('show');
            $('#id').val(res.id);
            $('#kode_anggota').val(res.kode_anggota);
            $('#username').val(res.username);
            $('#no_telepon').val(res.no_telepon);
            $('#email').val(res.email);
        }
    });
}

function hapus(id){

    if (confirm("Apakah Anda yakin akan hapus anggota ini ?") == true) {
    var id = id;

    $.ajax({
        type:"POST",
        url: "{{ url('hapus-anggota') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){

            var oTable = $('#anggota').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}

</script>

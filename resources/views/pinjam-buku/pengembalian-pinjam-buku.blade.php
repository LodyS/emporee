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
            <li class="menu-header"><b>Admin</b></li>
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
                    <div class="card-header"><h4>Peminjaman Buku</h4></div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="buku">
                                    <thead>
                                        <tr>
                                            <th>Peminjam</th>
                                            <th>Judul Buku</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>
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
</body>

</html>

<script type="text/javascript">
$(document).ready( function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#buku').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('list-pinjam-buku') }}",
            columns: [
                { data: 'username', name: 'anggota.username' },
                { data: 'judul_buku', name: 'buku.judul_buku' },
                { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                { data: 'tanggal_pengembalian', name: 'tanggal_pengembalian' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false},
            ],
        order: [[0, 'asc']]
    });
});

function pengembalianBuku(id){

    if (confirm("Anda yakin buku sudah dikembalikan ?") == true) {
    var id = id;

    $.ajax({
        type:"POST",
        url: "{{ url('pengembalian-buku') }}",
        data: { id: id },
        dataType: 'json',
        success: function(res){

            var oTable = $('#buku').dataTable();
                oTable.fnDraw(false);
            }
        });
    }
}
</script>

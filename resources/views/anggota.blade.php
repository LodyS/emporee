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
                    <div class="dropdown-title">Hello {{ Auth::guard('anggota')->user()->username }}</div>

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
            <li class="menu-header"><b>Anggota</b></li>
                <li class="dropdown">
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
                        <a class="btn btn-info" onClick="add()" href="javascript:void(0)" align="right">Pengajuan pinjam Buku</a>
                    </div>

                    <div class="card-header"><h4>List Peminjaman Buku</h4></div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="buku">
                                    <thead>
                                        <tr>
                                            <th>Judul Buku</th>
                                            <th>Jumlah</th>
                                            <th>Tanggal Pinjam</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status</th>

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
                <form action="javascript:void(0)" id="form" name="form" class="form-horizontal" method="POST">
                    <input type="hidden" name="anggota_id" id="anggota_id" value="{{ Auth::guard('anggota')->user()->id }}">

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Buku</label>
                                    <div class="col-sm-12">
                                    <?php $buku = \App\Models\Buku::where('stok_buku', '<>', '0')->get(['id', 'judul_buku']); ?>
                                    <select name="buku_id" id="buku_id" class="form-control" required>
                                        <option value="">Pilih Buku</option>
                                        @foreach($buku as $b)
                                        <option value="{{ $b->id }}">{{ $b->judul_buku }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Stok Buku</label>
                                    <div class="col-sm-12">
                                    <input type="text" class="form-control" id="stok_buku" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Jumlah</label>
                                    <div class="col-sm-12">
                                    <input type="number" class="form-control" id="jumlah_buku" value="1" name="jumlah_buku" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Tanggal Pinjam</label>
                                    <div class="col-sm-12">
                                    <input type="date" class="form-control" id="tanggal_pinjam" value="{{ date('Y-m-d') }}" name="tanggal_pinjam">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Tanggal Pengembalian</label>
                                    <div class="col-sm-12">
                                    <input type="date" class="form-control" id="tanggal_pengembalian" value="{{ date('Y-m-d')}}" name="tanggal_pengembalian">
                                    <div class="invalid-feedback">Tanggal Pengembalian Wajib diisi</div>
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save">Pengajuan</button>
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

<script src="{{ asset('otika/assets/bundles/sweetalert/sweetalert.min.js') }}"></script>
  <!-- Page Specific JS File -->
<script src="{{ asset('otika/assets/js/page/sweetalert.js') }}"></script>
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
        ajax: "{{ url('list-buku') }}",
            columns: [
                { data: 'judul_buku', name: 'buku.judul_buku' },
                { data: 'jumlah_buku', name : 'jumlah_buku' },
                { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                { data: 'tanggal_pengembalian', name: 'tanggal_pengembalian' },
                { data: 'status', name: 'status' },
            ],
        order: [[0, 'asc']]
    });
});

function add(){
    $('#form').trigger("reset");
    $('#form-Modal').html("Pengajuan peminjaman buku");
    $('#modal').modal('show');
    $('#id').val('');
}

$('#form').submit(function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type:'POST',
        url: "{{ url('simpan-pengajuan-buku')}}",
        data: formData,
        cache : false,
        contentType : false,
        processData : false,
        success: (data) => {

            var stok_buku = $('#stok_buku').val();
            var jumlah_buku = $('#jumlah_buku').val();

            if (jumlah_buku > stok_buku){
                swal('Warning','Gagal simpan karena stok buku tidak cukup','warning')
            } else {
                swal('Success','Berhasil pinjam buku','success')
            }

            $("#modal").modal('hide');
            var oTable = $('#buku').dataTable();

            oTable.fnDraw(false);

            $("#btn-save").html('Submit');
            $("#btn-save"). attr("disabled", false);
        },

        error: function(data){
            console.log(data);
        }
    });
});

$('#buku_id').change(function(){
    var buku_id = $(this).val();
    var url = '{{ route("cari-stok-buku", ":buku_id") }}';
    url = url.replace(':buku_id', buku_id);

    $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',

        success: function(response){
        if(response != null){
            $('#stok_buku').val(response.stok_buku);
        }}
    });
});
</script>

@extends('welcome')
@section('content')

<div class="">
    <a onclick="addForm()" class="btn btn-primary" style="color: #fff ;float: left;" name="button">Tambah</a>
</div>
<table id="datatable1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th style="width:10%">No #</th>
            <th style="width:15%">Nama</th>
            <th style="width:25%">Username</th>
            <th style="width:10%">Action</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@include('data_user.create')
@endsection

@section('js')
<script type="text/javascript">
    function check_pass() {
        if (document.getElementById('password1').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('btn_save').disabled = false;
            $('#message').html('Matching').css('color', 'green');
        } else {
            document.getElementById('btn_save').disabled = true;
            $('#message').html('Not Matching').css('color', 'red');
        }
    }

    var table, save_method;
    $(function() {
        table = $('.table').DataTable({
            "processing": true,
            "ajax": {
                "url": "{{ route('data_user') }}",
                "type": "GET"
            }
        });
        $('#modal-form form').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                console.log(save_method);
                if (save_method == "add") url = "{{ route('master_user.store') }}";
                else url = "master_user/" + id;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#modal-form form').serialize(),
                    success: function(data) {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menyimpan data!");
                    }
                });
                return false;
            }
        });

        // save change
        $('#modal-change form').validator().on('submit', function(e) {
            if (!e.isDefaultPrevented()) {
                var id = $('#id').val();
                url = "master_user/" + id;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: $('#modal-change form').serialize(),
                    success: function(data) {
                        $('#modal-change').modal('hide');
                        table.ajax.reload();
                    },
                    error: function() {
                        alert("Tidak dapat menyimpan data!");
                    }
                });
                return false;
            }
        });
    });

    function addForm() {
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Tambah Data User');
    }

    function editForm(id) {
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
            url: "master_user/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal-form').modal('show');
                $('.modal-title').text('Edit Data Menu');
                $('#id').val(data.id);
                $('#username').val(data.username);

                var element = document.getElementById("div1");
                var element2 = document.getElementById("div3");
                element.parentNode.removeChild(element);
                element2.parentNode.removeChild(element2);
            },
            error: function() {
                alert("Tidak dapat menampilkan data !!!");
            }
        });
    }

    function changePasswordForm(id) {
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#modal-change form')[0].reset();
        $.ajax({
            url: "master_user/" + id + "/edit",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#modal-change').modal('show');
                $('.modal-title').text('Edit Data Menu');
                $('#id').val(data.id);


            },
            error: function() {
                alert("Tidak dapat menampilkan data !!!");
            }
        });
    }

    function deleteData(id) {
        if (confirm("Apakah yakin data akan dihapus?")) {
            $.ajax({
                url: "master_user/" + id,
                type: "POST",
                data: {
                    '_method': 'DELETE',
                    '_token': $('meta[name=csrf-token]').attr('content')
                },
                success: function(data) {
                    table.ajax.reload();
                },
                error: function() {
                    alert("Tidak dapat menghapus data!");
                }
            });
        }
    }
</script>
@endsection

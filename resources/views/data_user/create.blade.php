<div class="modal fade" id="modal-form" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" data-toggle="validator" method="post">
        @csrf
        {{ method_field('POST') }}
        {{-- <input type="hidden" value="" name="crud" > --}}
        <input type="hidden" id="id" name="id">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            {{-- <h4 class="modal-title titleform">Form Barang</h4> --}}
          </div>
          <div class="modal-body">

            <div class="box-body" id="div0">

              <div class="form-group" id="div1">
               <label for="exampleInputPassword1">Nama Owner</label>
               <select name="o_id" id="o_id" class="form-control js-example-basic-single" style="width: 100%;">
                 @foreach ($owner as $list)
                 <option value="{{$list->o_id}}">{{$list->o_name}}</option>
                @endforeach 
                <!-- <option value="2">ds</option> -->
              </select>
            </div>
              <div class="form-group" id="div2">
               <label for="exampleInputPassword1"> Username</label>
               <input type="text" class="form-control" name="username" id="username" value="" required>
            </div>
            <div class="form-group" id="div3">
              <label for="exampleInputPassword1">Password</label>

              <input type="password" class="form-control" id="password" name="password" value="">
            </div>

          </div>
          <!-- /.box-body -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
          <button  type="submit" class="btn btn-success pull-right btn-save">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

{{-- Modal Change --}}

<div class="modal fade" id="modal-change" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="form-horizontal" data-toggle="validator" method="post">
        @csrf
        {{ method_field('POST') }}
        {{-- <input type="hidden" value="" name="crud" > --}}
        <input type="hidden" id="id" name="id">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            {{-- <h4 class="modal-title titleform">Form Barang</h4> --}}
          </div>
          <div class="modal-body">

            <div class="box-body" >

              <div class="form-group" >
               <label for="exampleInputPassword1">Password Lama</label>
              <input type="password" class="form-control" name="password_lama"  value="">
            </div>
              <div class="form-group" >
               <label for="exampleInputPassword1"> Password Baru</label>
               <input type="password" class="form-control" name="password1" id="password1" onchange="check_pass()">
            </div>
            <div class="form-group" >
              <label for="exampleInputPassword1">Confirm Password</label>
              <input type="password" class="form-control" id="confirm_password" onchange="check_pass()" name="confirm_password">
              <span id='message'></span>
            </div>

          </div>
          <!-- /.box-body -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
          <button id="btn_save"  type="submit" class="btn btn-success pull-right btn-save">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

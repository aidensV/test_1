<div class="modal fade" id="modal-form" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" action="javascript:;" method="post" class="form_barang">
        <input type="hidden" value="" name="crud" >
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
            {{-- <h4 class="modal-title titleform">Form Barang</h4> --}}
          </div>
          <div class="modal-body">

            <div class="box-body">

              <div class="form-group">
               <label for="exampleInputPassword1">Nama Barang</label>
               <select name="id_barang" id="id_barang" class="form-control" style="width: 100%;">
                 @foreach ($item as $list)
                 <option value="{{$list->i_id}}">{{$list->i_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Harga</label>

              <input type="text" class="form-control" id="barang_harga" name="barang_harga" value="">
            </div>

            <div class="row">

            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Qty</label>
              <input type="number" class="form-control text-right nocoma" value="0" name="jumlah">
              <label class="fmt-nominal pull-right">0</label>
            </div>

            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Total</label>
              <input type="number" class="form-control text-right money" readonly="" value="0" name="total" >
              <label class="fmt-nominal pull-right">0,00</label>
            </div>

            </div>
          </div>
          <!-- /.box-body -->

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success pull-right">Simpan</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

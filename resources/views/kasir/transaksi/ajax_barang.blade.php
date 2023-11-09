<?php
if(isset($detail_barang)){
    foreach($detail_barang as $barang){
?>
    <label for="harga">Harga</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend"><span class="input-group-text">Rp</span>
        </div>
        <input type="text" value="{{ number_format($barang->harga) }}" min="0" id="harga" name="harga" class="form-control" readonly required>
    </div>

    <label for="diskon">Diskon</label>
    <div class="input-group mb-3">
        <input type="text" value="{{ $barang->diskon }}" min="0" id="diskon" class="form-control" name="diskon" readonly required>
        <div class="input-group-append"><span class="input-group-text">%</span></div>
    </div>

    <label for="Stok">Stok</label>    
    <div class="input-group mb-3">
        <input type="text " value="{{ $barang->stok }}" min="0" id="stok" class="form-control" name="stok" readonly required>
        <div class="input-group-append"><span class="input-group-text">Pcs</span></div>
    </div>

    <label for="qty">Qty</label>
    <div class="input-group mb-3">
        <input type="number" min="0" id="stok" class="form-control" name="qty" placeholder="Qty..." required>
        <div class="input-group-append"><span class="input-group-text">Pcs</span></div>
    </div>
<?php
    }
}
?>
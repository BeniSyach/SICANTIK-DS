<!-- Modal -->
<div class="modal fade" id="tanda_tangan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tanda Tangan</h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="<?= base_url('assets/img/' . $gambar) ?>" width="100%" alt="...">
                        </div>
                        <div class="col-2">
                            <h5>Nama </h5>
                            <h5>NIP </h5>
                            <h5>Golongan </h5>
                            <h5>Jabatan </h5>
                        </div>
                        <div class="col-1">
                            <h5> : </h5>
                            <h5> : </h5>
                            <h5> : </h5>
                            <h5> : </h5>
                        </div>
                        <div class="col-5">
                            <h5> <?= $nama_tanda_tangan ?> </h5>
                            <h5> <?= $nip ?> </h5>
                            <h5> <?= $golongan ?> </h5>
                            <h5> <?= $jabatan ?> </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn_close" data-dismiss="modal">Kembali</button>
        </div> -->
    </div>
</div>


<script>
    $(document).ready(function() {
        $(".btn_close").click(function() {
            $('#tanda_tangan').modal('hide');
        })
    });
</script>
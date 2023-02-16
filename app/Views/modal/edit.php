<!-- Modal -->
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Surat</h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('surat/simpandata', ['class' => 'formsurat']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-8">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?= $id ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Naskah</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="tgl_naskah" name="tgl_naskah" placeholder="Tanggal Naskah...." value="<?= $tanggal_naskah ?>">
                                <div class="invalid-feedback errorTglNaskah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Dikirimkan Melalui</label>
                            <div class="col-sm-8">
                                <select id="dkrm_melalui" name="dkrm_melalui" class="form-control">
                                    <?php foreach ($dkrm_melalui as $dkrm) : ?>
                                        <?php if ($dkrm['nama_unit_kerja'] == $nama_unit_kerja) : ?>
                                            <option value="<?= $dkrm['id_unit_kerja'] ?>" selected><?= $dkrm['nama_unit_kerja'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $dkrm['id_unit_kerja'] ?>"><?= $dkrm['nama_unit_kerja'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorDkrmMelalui">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Jenis Naskah</label>
                            <div class="col-sm-8">
                                <select id="jenis_naskah" name="jenis_naskah" class="form-control">

                                    <?php foreach ($jns_naskah as $jns) : ?>
                                        <?php if ($jns['jenis_naskah'] == $jenis_naskah) : ?>
                                            <option value="<?= $jns['id_jenis_naskah'] ?>" selected><?= $jns['jenis_naskah'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $jns['id_jenis_naskah'] ?>"><?= $jns['jenis_naskah'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorJenisNaskah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Sifat Naskah</label>
                            <div class="col-sm-8">
                                <select id="sifat_naskah" name="sifat_naskah" class="form-control">
                                    <?php foreach ($sft_naskah as $sft) : ?>
                                        <?php if ($sft['sifat_naskah'] == $sifat_naskah) : ?>
                                            <option value="<?= $sft['id_sifat_naskah'] ?>" selected><?= $sft['sifat_naskah'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $sft['id_sifat_naskah'] ?>"><?= $sft['sifat_naskah'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorSifatNaskah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tingkat Urgensi</label>
                            <div class="col-sm-8">
                                <select id="tingkat_urgensi" name="tingkat_urgensi" class="form-control">
                                    <option>--pilih--</option>
                                    <?php foreach ($tngkt_urgen as $urgen) : ?>
                                        <?php if ($urgen['tingkat_urgensi'] == $tingkat_urgensi) : ?>
                                            <option value="<?= $urgen['id_tingkat_urgensi'] ?>" selected><?= $urgen['tingkat_urgensi'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $urgen['id_tingkat_urgensi'] ?>"><?= $urgen['tingkat_urgensi'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorTingkatUrgensi">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Klasifikasi</label>
                            <div class="col-sm-8">
                                <select id="klasifikasi" name="klasifikasi" class="form-control">
                                    <option>--pilih--</option>
                                    <?php foreach ($klasifikasi as $klsf) : ?>
                                        <?php if ($klsf['nama_klasifikasi'] == $nama_klasifikasi) : ?>
                                            <option value="<?= $klsf['id_klasifikasi'] ?>" selected><?= $klsf['nama_klasifikasi'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $klsf['id_klasifikasi'] ?>"><?= $klsf['nama_klasifikasi'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorKlasifikasi">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Nomor Naskah</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nomor_naskah" name="nomor_naskah" placeholder="Nomor Naskah...." value="<?= $nomor_naskah ?>">
                                <div class="invalid-feedback errorNomorNaskah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Lampiran Naskah</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="lampiran_naskah" name="lampiran_naskah">
                                <div class="invalid-feedback errorLampiranNaskah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Hal</label>
                            <div class="col-sm-8">
                                <input type="textarea" class="form-control" id="hal" name="hal" placeholder="Hal Naskah...." value="<?= $hal ?>">
                                <div class="invalid-feedback errorHal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">File Naskah (PDF)</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="file_naskah" name="file_naskah">
                                <div class="invalid-feedback errorFileNaskah">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tujuan Utama</label>
                            <div class="col-sm-8">
                                <input type="textarea" class="form-control" id="tujuan_naskah" name="tujuan_naskah" value="<?= $tujuan_utama ?>">
                                <div class="invalid-feedback errorTujuan_naskah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Pendata Tangan</label>
                            <div class="col-sm-8">
                                <select id="tujuan_utama" name="tujuan_utama" class="form-control">
                                    <option>--pilih--</option>
                                    <?php foreach ($dikirim as $krm) : ?>
                                        <?php if ($krm['nama_tanda_tangan'] == $nama_tanda_tangan) : ?>
                                            <option value="<?= $krm['id_tanda_tangan'] ?>" selected><?= $krm['nama_tanda_tangan'] ?></option>
                                        <?php else : ?>
                                            <option value="<?= $krm['id_tanda_tangan'] ?>"><?= $krm['nama_tanda_tangan'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback errorTandaTangan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>






            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btnsimpan mr-1">Simpan Data</button>
                <button type="button" class="btn btn-secondary btn_close" data-dismiss="modal">Close</button>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formsurat').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpan').attr('disable', 'disabled');
                    $('.btnsimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsimpan').removeAttr('disable');
                    $('.btnsimpan').html('Simpan');
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses
                    })

                    $('#modaledit').modal('hide');
                    tampilSurat();

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })

            return false;
        })
    })

    $(document).ready(function() {
        $(".btn_close").click(function() {
            $('#modaledit').modal('hide');
        })
    });
</script>
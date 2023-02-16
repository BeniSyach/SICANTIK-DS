<!-- Modal -->
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Surat</h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('surat/simpandata', ['class' => 'formsurat']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Tanggal Naskah</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="tgl_naskah" name="tgl_naskah" placeholder="Tanggal Naskah...." value="">
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
                                    <option value="">--pilih--</option>
                                    <?php foreach ($dkrm_melalui as $dkrm) : ?>
                                        <option value="<?= $dkrm['id_unit_kerja'] ?>"><?= $dkrm['nama_unit_kerja'] ?></option>
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
                                    <option value="">--pilih--</option>
                                    <?php foreach ($jns_naskah as $jns) : ?>
                                        <option value="<?= $jns['id_jenis_naskah'] ?>"><?= $jns['jenis_naskah'] ?></option>
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
                                    <option value="">--pilih--</option>
                                    <?php foreach ($sft_naskah as $sft) : ?>
                                        <option value="<?= $sft['id_sifat_naskah'] ?>"><?= $sft['sifat_naskah'] ?></option>
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
                                    <option value="">--pilih--</option>
                                    <?php foreach ($tngkt_urgen as $urgen) : ?>
                                        <option value="<?= $urgen['id_tingkat_urgensi'] ?>"><?= $urgen['tingkat_urgensi'] ?></option>
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
                                    <option value="">--pilih--</option>
                                    <?php foreach ($klasifikasi as $klsf) : ?>
                                        <option value="<?= $klsf['id_klasifikasi'] ?>"><?= $klsf['nama_klasifikasi'] ?></option>
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
                                <input type="text" class="form-control" id="nomor_naskah" name="nomor_naskah" placeholder="Nomor Naskah">
                                <div class="invalid-feedback errorNomorNaskah">
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
                            <label class="col-sm-4 col-form-label">Hal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="hal" name="hal" placeholder="Hal">
                                <div class="invalid-feedback errorHal">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Lampiran Naskah</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="lampiran_naskah" name="lampiran_naskah" placeholder="Lampiran Naskah">
                                <div class="invalid-feedback errorLampiranNaskah">
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
                                <input type="text" class="form-control" id="tujuan_naskah" name="tujuan_naskah" placeholder="Tujuan Naskah">
                                <div class="invalid-feedback errortujuan_naskah">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Penandatangan</label>
                            <div class="col-sm-8">
                                <select id="tujuan_utama" name="tujuan_utama" class="form-control">
                                    <option value="">--pilih--</option>
                                    <?php foreach ($dikirim as $krm) : ?>
                                        <option value="<?= $krm['id_tanda_tangan'] ?>"><?= $krm['nama_tanda_tangan'] ?></option>
                                    <?php endforeach; ?>
                                    <option value="tambah_tanda_tangan">Lainnya</option>
                                </select>
                                <div class="invalid-feedback errorTandaTangan">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none" id="form_tambah_tanda_tangan">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Nama Tanda Tangan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_tanda_tangan" name="nama_tanda_tangan" placeholder="Nama Tanda Tangan">
                                    <div class="invalid-feedback errornama_tanda_tangan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">NIP</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nip" name="nip" placeholder="NIP">
                                    <div class="invalid-feedback errornip">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Jabatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan">
                                    <div class="invalid-feedback errorjabatan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Golongan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="golongan" name="golongan" placeholder="Golongan">
                                    <div class="invalid-feedback errorgolongan">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Foto Penandatangan</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <div class="invalid-feedback errorfoto">
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
                        $('.btnsimpan').html('Simpan Data');
                    },
                    success: function(response) {
                        if (response.error) {
                            if (response.error.tgl_naskah) {
                                $('#tgl_naskah').addClass('is-invalid');
                                $('.errorTglNaskah').html(response.error.tgl_naskah);
                            } else {
                                $('#tgl_naskah').removeClass('is-invalid');
                                $('.errorTglNaskah').html('');
                            }
                            if (response.error.file_naskah) {
                                $('#file_naskah').addClass('is-invalid');
                                $('.errorFileNaskah').html(response.error.file_naskah);
                            } else {
                                $('#file_naskah').removeClass('is-invalid');
                                $('.errorFileNaskah').html('');
                            }
                            if (response.error.lampiran_naskah) {
                                $('#lampiran_naskah').addClass('is-invalid');
                                $('.errorLampiranNaskah').html(response.error.lampiran_naskah);
                            } else {
                                $('#tgl_naskah').removeClass('is-invalid');
                                $('.errorFileNaskah').html('');
                            }

                            if (response.error.dkrm_melalui) {
                                $('#dkrm_melalui').addClass('is-invalid');
                                $('.errorDkrmMelalui').html(response.error.dkrm_melalui);
                            } else {
                                $('#dkrm_melalui').removeClass('is-invalid');
                                $('.errorDkrmMelalui').html('');
                            }
                            if (response.error.jenis_naskah) {
                                $('#jenis_naskah').addClass('is-invalid');
                                $('.errorJenisNaskah').html(response.error.jenis_naskah);
                            } else {
                                $('#jenis_naskah').removeClass('is-invalid');
                                $('.errorJenisNaskah').html('');
                            }
                            if (response.error.sifat_naskah) {
                                $('#sifat_naskah').addClass('is-invalid');
                                $('.errorSifatNaskah').html(response.error.sifat_naskah);
                            } else {
                                $('#sifat_naskah').removeClass('is-invalid');
                                $('.errorSifatNaskah').html('');
                            }
                            if (response.error.tingkat_urgensi) {
                                $('#tingkat_urgensi').addClass('is-invalid');
                                $('.errorTingkatUrgensi').html(response.error.tingkat_urgensi);
                            } else {
                                $('#tingkat_urgensi').removeClass('is-invalid');
                                $('.errorTingkatUrgensi').html('');
                            }
                            if (response.error.klasifikasi) {
                                $('#klasifikasi').addClass('is-invalid');
                                $('.errorKlasifikasi').html(response.error.klasifikasi);
                            } else {
                                $('#klasifikasi').removeClass('is-invalid');
                                $('.errorKlasifikasi').html('');
                            }
                            if (response.error.nomor_naskah) {
                                $('#nomor_naskah').addClass('is-invalid');
                                $('.errorNomorNaskah').html(response.error.nomor_naskah);
                            } else {
                                $('#nomor_naskah').removeClass('is-invalid');
                                $('.errorNomorNaskah').html('');
                            }
                            if (response.error.hal) {
                                $('#hal').addClass('is-invalid');
                                $('.errorHal').html(response.error.hal);
                            } else {
                                $('#hal').removeClass('is-invalid');
                                $('.errorHal').html('');
                            }
                            if (response.error.tujuan_utama) {
                                $('#tujuan_utama').addClass('is-invalid');
                                $('.errorTandaTangan').html(response.error.tujuan_utama);
                            } else {
                                $('#tujuan_utama').removeClass('is-invalid');
                                $('.errorTandaTangan').html('');
                            }
                            if (response.error.tujuan_naskah) {
                                $('#tujuan_naskah').addClass('is-invalid');
                                $('.errortujuan_naskah').html(response.error.tujuan_naskah);
                            } else {
                                $('#tujuan_naskah').removeClass('is-invalid');
                                $('.errortujuan_naskah').html('');
                            }

                            if (response.error.nama_tanda_tangan) {
                                $('#nama_tanda_tangan').addClass('is-invalid');
                                $('.errornama_tanda_tangan').html(response.error.nama_tanda_tangan);
                            } else {
                                $('#nama_tanda_tangan').removeClass('is-invalid');
                                $('.errornama_tanda_tangan').html('');
                            }
                            if (response.error.nip) {
                                $('#nip').addClass('is-invalid');
                                $('.errornip').html(response.error.nip);
                            } else {
                                $('#nip').removeClass('is-invalid');
                                $('.errornip').html('');
                            }
                            if (response.error.jabatan) {
                                $('#jabatan').addClass('is-invalid');
                                $('.errorjabatan').html(response.error.jabatan);
                            } else {
                                $('#jabatan').removeClass('is-invalid');
                                $('.errorjabatan').html('');
                            }
                            if (response.error.golongan) {
                                $('#golongan').addClass('is-invalid');
                                $('.errorgolongan').html(response.error.golongan);
                            } else {
                                $('#golongan').removeClass('is-invalid');
                                $('.errorgolongan').html('');
                            }
                            if (response.error.foto) {
                                $('#foto').addClass('is-invalid');
                                $('.errorfoto').html(response.error.foto);
                            } else {
                                $('#foto').removeClass('is-invalid');
                                $('.errorfoto').html('');
                            }


                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses
                            })

                            $('#modaltambah').modal('hide');
                            tampilSurat();
                        }
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
                $('#modaltambah').modal('hide');
            })
        });

        $(document).ready(function() {
            $("select#tujuan_utama").change(function() {
                var hasil_select = $('#tujuan_utama').find(":selected").text();

                if (hasil_select == 'Lainnya') {
                    $("#form_tambah_tanda_tangan").removeClass("d-none");
                } else {
                    $("#form_tambah_tanda_tangan").addClass("d-none");
                }
            });
        });

        // $(document).ready(function() {
        //     $('select').niceSelect();
        // });
    </script>
<!-- Modal -->
<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                <button type="button" class="close btn_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open('user/proses_edit', ['class' => 'formEdit']) ?>
            <?= csrf_field(); ?>
            <div class="modal-body">
                <div class="form-group row">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id_users'] ?>">
                    <label class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
                        <div class="invalid-feedback errorUsername">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Masukkan Password Lama</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Password Lama">
                        <div class="invalid-feedback errorPasswordLama">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Masukkan Password Baru</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Password Baru">
                        <div class="invalid-feedback errorPasswordBaru">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Konfirmasi Password Baru</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="password_konfirmasi" name="password_konfirmasi" placeholder="Konfirmasi Password Baru">
                        <div class="invalid-feedback errorPasswordKonfirmasi">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary mr-1 btnsimpan">Update</button>
                    <button type="button" class="btn btn-secondary btn_close" data-dismiss="modal">Kembali</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.formEdit').submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
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
                    if (response.error) {
                        if (response.error.username) {
                            $('#username').addClass('is-invalid');
                            $('.errorUsername').html(response.error.username);
                        } else {
                            $('#username').removeClass('is-invalid');
                            $('.errorUsername').html('');
                        }
                        if (response.error.password_lama) {
                            $('#password_lama').addClass('is-invalid');
                            $('.errorPasswordLama').html(response.error.password_lama);
                        } else {
                            $('#password_lama').removeClass('is-invalid');
                            $('.errorPasswordLama').html('');
                        }
                        if (response.error.password_baru) {
                            $('#password_baru').addClass('is-invalid');
                            $('.errorPasswordBaru').html(response.error.password_baru);
                        } else {
                            $('#password_baru').removeClass('is-invalid');
                            $('.errorPasswordBaru').html('');
                        }
                        if (response.error.password_konfirmasi) {
                            $('#password_konfirmasi').addClass('is-invalid');
                            $('.errorPasswordKonfirmasi').html(response.error.password_konfirmasi);
                        } else {
                            $('#password_konfirmasi').removeClass('is-invalid');
                            $('.errorPasswordKonfirmasi').html('');
                        }
                        if (response.error.login) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Gagal',
                                text: response.error.login
                            })
                        }

                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses
                        })

                        $('#modalEditUser').modal('hide');
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
            $('#modalEditUser').modal('hide');
        })
    });
</script>
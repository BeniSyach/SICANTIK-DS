<?php $session = session(); ?>
<?php if ($session->get('username')) : ?>
    <form action="#" method="POST" class="search-box">
        <div class="card-body table-responsive p-4">
            <table class="table" id="datasurat">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tanggal Naskah</th>
                        <th scope="col">Bidang</th>
                        <th scope="col">Nomor Naskah</th>
                        <th scope="col">Hal</th>
                        <th scope="col">Asal Naskah</th>
                        <th scope="col">Tujuan Naskah</th>
                        <th scope="col">Tingkat Urgensi</th>
                        <th scope="col">Sifat Naskah</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>

        </div>
    <?php else : ?>
        <div class="container">
            <form action="<?= site_url('surat/cari_surat') ?>" class="search-box">
                <p class="text-center"> Cari Nomor Surat :</p>
                <div class="input-form mb-3">
                    <input type="text" class="form-control" id="input_nomor" name="input_nomor" autofocus required>
                </div>
                <div class="search-form mx-auto my-2">
                    <button type="submit" class="tombolcari">Cari</button>
                    <br>
                </div>
            </form>

            <div class="datatable mt-5"></div>
        </div>
    <?php endif; ?>


    <script>
        function listdatasurat() {
            var table = $('#datasurat').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "<?= site_url('surat/listdata') ?>",
                    type: "POST"
                },
                //optional
                "columnDefs": [{
                    "targets": 0,
                    "orderable": false,
                }],
            });
        }

        $(document).ready(function() {
            listdatasurat();
        });

        function edit(id) {
            $.ajax({
                type: "post",
                url: "<?= site_url('surat/formedit') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodal').html(response.sukses).show();
                        $('#modaledit').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        function hapus(id) {
            Swal.fire({
                title: 'Hapus Data',
                text: "Apakah Anda Yakin Menghapus Data Ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "<?= site_url('surat/hapus') ?>",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses,
                                });
                                tampilSurat();;
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                        }
                    });
                }
            })
        }


        function lihat(id) {
            $.ajax({
                type: "post",
                url: "<?= site_url('surat/tanda_tangan') ?>",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.viewmodal').html(response.sukses).show();
                        $('#tanda_tangan').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        $(document).ready(function() {

            $('.search-box').submit(function(e) {

                e.preventDefault();

                $.ajax({
                    type: "post",
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $('.tombolcari').attr('disable', 'disabled');
                        $('.tombolcari').html('<i class="fa fa-spin fa-spinner"></i>');
                    },
                    complete: function() {
                        $('.tombolcari').removeAttr('disable');
                        $('.tombolcari').html('Cari');
                    },
                    success: function(response) {
                        if (response.sukses) {
                            $('.datatable').html(response.sukses)
                        } else if (response.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Maaf...',
                                text: 'Naskah Tidak Ada'
                            })
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                })

            })
        })
    </script>
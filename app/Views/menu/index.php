<?= $this->extend('index'); ?>

<?= $this->section('content'); ?>

<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">

<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>

<main>
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active">
            <div class="single-slider hero-overly  slider-height d-flex align-items-center">
                <div class="container-fluid">
                    <div class="row justify-content-center">

                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">
                                <img src="<?= base_url('assets/img/SICANTIK1.png') ?>" width="20%" alt="gambar">
                            </div>
                            <div class="hero__caption">
                                <h1 class="text-center" style="color:black">SICANTIK</h1>
                                <p class="text-center" style="color:black">(SISTEM INFORMASI CHECK ARSIP OTENTIK)</p>
                            </div>
                        </div>
                    </div>
                    <!-- Search Box -->

                    <div class="row">
                        <div class="col-lg-12">
                            <!-- form -->
                            <?php $session = session(); ?>
                            <?php if (!$session->get('username')) : ?>

                            <?php else : ?>
                                <div class="mr-3 mb-1" style="float: left;">
                                    <button type="button" class="btn btn-primary btn-sm tomboltambah">Tambah Surat</button>
                                </div>
                                <div class="mr-3 mb-1" style="float: left;">
                                    <button type="button" class="btn btn-primary btn-sm tomboledit">Edit Profil</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary btn-sm tombolstatistik">Data Statistik Upload</button>
                                </div>
                            <?php endif; ?>

                            <p class="card-text mt-3 viewdata"></p>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<div class="viewmodal" style="display: none;"></div>


<script>
    function tampilSurat() {
        $.ajax({
            url: "<?= site_url('surat/ambildata') ?>",
            dataType: "json",
            success: function(response) {
                $('.viewdata').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    };

    $(document).ready(function() {
        tampilSurat();

        $('.tomboltambah').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= site_url('surat/formtambah') ?>",
                dataType: "json",
                success: function(response) {

                    $('.viewmodal').html(response.data).show();

                    $('#modaltambah').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.responseText);
                }
            });
        });

        $('.tombolLogin').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= site_url('auth/index') ?>",
                dataType: "json",
                success: function(response) {

                    $('.viewmodal').html(response.data).show();

                    $('#modalLogin').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.tombolstatistik').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= site_url('statistik/index') ?>",
                dataType: "json",
                success: function(response) {

                    $('.viewmodal').html(response.data).show();

                    $('#modalStatistik').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $('.tomboledit').click(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= site_url('user/index') ?>",
                dataType: "json",
                success: function(response) {

                    $('.viewmodal').html(response.data).show();

                    $('#modalEditUser').modal('show');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

    });
</script>

<?= $this->endSection(); ?>
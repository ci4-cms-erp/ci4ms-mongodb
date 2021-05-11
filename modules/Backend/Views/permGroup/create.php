<?= $this->extend('Modules\Backend\Views\base') ?>

<?= $this->section('title') ?>
Grup Yetkisi Ekleme
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Grup Yetkisi Ekleme</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <a href="<?= route_to('groupList',1) ?>" class="btn btn-outline-info"><i
                                class="fas fa-arrow-circle-left"></i> Listeye Dön</a>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card card-outline card-shl">
        <div class="card-header">
            <h3 class="card-title font-weight-bold">Yetki Grubu Oluştur</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <form action="<?=route_to('group_create')?>" method="post" class="form-row">
                <?= csrf_field() ?>
                <div class="col-6 col-md-6">
                    <label for="">Yetki Grubu Adı</label>
                    <input type="text" class="form-control" name="groupName" required>
                </div>
                <div class="col-6 col-md-6">
                    <label for="">Seflink</label>
                    <input type="text" class="form-control" name="seflink" required>
                </div>
                <div class="col-12 col-md-12">
                    <label for="">Grup Açıklaması</label>
                    <textarea name="description"cols="30" rows="10"
                                                        class="form-control" required></textarea>
                </div>
                <div class="col-12 col-md-12 mt-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td>Sayfa Adı</td>
                                <td>Açıklaması</td>
                                <td style="width: 200px">Yetkileri</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($pages as $page): ?>
                                <tr>
                                    <td><?= $page->pagename ?></td>
                                    <td><?= $page->description ?></td>
                                    <td>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-outline-secondary">
                                                <input type="checkbox" name="perms[<?=(string)$page->_id?>][c]"> Create
                                            </label>
                                            <label class="btn btn-outline-secondary">
                                                <input type="checkbox" name="perms[<?=(string)$page->_id?>][r]"> Read
                                            </label>
                                            <label class="btn btn-outline-secondary">
                                                <input type="checkbox" name="perms[<?=(string)$page->_id?>][u]"> Update
                                            </label>
                                            <label class="btn btn-outline-secondary">
                                                <input type="checkbox" name="perms[<?=(string)$page->_id?>][d]"> Delete
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-12 col-md-12">
                    <button class="btn btn-success float-right">Kaydet</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<?= $this->endSection() ?>

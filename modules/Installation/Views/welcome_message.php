<?= $this->extend('Modules\Installation\Views\base') ?>
<?= $this->section('title') ?>
Installation
<?= $this->endSection() ?>
<?= $this->section('head') ?>
<style>
    .login-page {
        margin-left: unset !important;
    }

    .login-box {
        margin-right: unset !important;
        width: auto !important;
    }

    .img-h-7 {
        height: 70px;
    }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="login-box container-fluid">
    <!-- Main content -->
    <div class="card card-outline card-success">
        <div class="card-header text-center">
            <img src="<?= base_url('be-assets/img/logo.jpg') ?>" alt="" class="img-fluid img-h-7">
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <form action="<?= route_to('install') ?>" method="post">
                <?= csrf_field() ?>
                <div class="bs-stepper">
                    <div class="bs-stepper-header" role="tablist">
                        <div class="step" data-target="#conf-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="conf-part"
                                    id="conf-part-trigger">
                                <span class="bs-stepper-circle bg-success"">1</span>
                                <span class="bs-stepper-label"><?=lang('Installation.conf')?></span>
                            </button>
                        </div>
                        <div class="line"></div>
                        <div class="step" data-target="#fin-part">
                            <button type="button" class="step-trigger" role="tab" aria-controls="fin-part"
                                    id="fin-part-trigger">
                                <span class="bs-stepper-circle bg-success"">2</span>
                                <span class="bs-stepper-label"><?=lang('Installation.fin')?></span>
                            </button>
                        </div>
                    </div>
                    <div class="bs-stepper-content">
                        <div id="conf-part" class="content" role="tabpanel" aria-labelledby="conf-part-trigger">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.rootUsername')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="rootUN" class="form-control" required></div>
                                        <div class="col-md-4 form-group"><?=lang('Installation.rootUsernameDesc') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.rootPwd')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="rootPwd" class="form-control" required></div>
                                        <div class="col-md-4 form-group"><?=lang('Installation.rootPwdDesc')?></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.dbName')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="dbname" class="form-control" required></div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.username')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="un" class="form-control" required>
                                        </div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.pwd')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="pwd" class="form-control" required>
                                        </div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.dbHost')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="host" class="form-control" required
                                                   value="127.0.0.1">
                                        </div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.dbPort')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="number" name="port" class="form-control" required value="27017"
                                                   min="0">
                                        </div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.pre')?></div>
                                        <div class="col-md-4 form-group">
                                            <input type="text" name="pre" class="form-control" required value="kun_">
                                        </div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-success float-right" type="button" onclick="stepper.next()">
                                        <?=lang('Installation.nextBtn')?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="fin-part" class="content" role="tabpanel"
                             aria-labelledby="fin-part-trigger">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.title')?></div>
                                        <div class="col-md-4 form-group"><input type="text" name="title" required
                                                                                class="form-control"></div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.adminU')?></div>
                                        <div class="col-md-4 form-group"><input type="text" name="username" required
                                                                                class="form-control"></div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.adminPwd')?></div>
                                        <div class="col-md-4 form-group"><input type="text" name="pass" required
                                                                                class="form-control"></div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.email')?></div>
                                        <div class="col-md-4 form-group"><input type="text" name="email" required
                                                                                class="form-control"></div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-4 form-group font-weight-bold"><?=lang('Installation.sev')?></div>
                                        <div class="col-md-4 form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="sev" id="sev">
                                                <label class="form-check-label" for="sev"><?=lang('Installation.sevCb')?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="float-right">
                                        <button class="btn btn-success" type="button" onclick="stepper.previous()">
                                            <?=lang('Installation.preBtn')?>
                                        </button>
                                        <button type="submit" class="btn btn-success"><?=lang('Installation.sbmtBtn')?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center">
            <strong>Copyright &copy; <?= date('Y') ?>.</strong> All rights reserved.
        </div>
    </div>
    <!-- /.content -->
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    });
</script>
<?= $this->endSection() ?>

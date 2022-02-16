<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noimageindex, nofollow, nosnippet">

<<<<<<< HEAD
    <link rel="shortcut icon" href="/be-assets/img/kunduz-yazilim-icon.png" type="image/x-icon">
=======
    <?=link_tag("be-assets/img/kunduz-yazilim-icon.png","shortcut icon", "image/x-icon")?>
>>>>>>> dev
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
<<<<<<< HEAD
    <link rel="stylesheet" href="/be-assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/be-assets/css/adminlte.min.css">
    <link rel="stylesheet" href="/be-assets/custom.css">
=======
    <?=link_tag("be-assets/plugins/fontawesome-free/css/all.min.css")?>
    <!-- Theme style -->
    <?=link_tag("be-assets/css/adminlte.min.css")?>
    <?=link_tag("be-assets/custom.css")?>
>>>>>>> dev

    <?= $this->renderSection('head') ?>
</head>
<body class="hold-transition login-page">
        <?= $this->renderSection('content') ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<<<<<<< HEAD
<script src="/be-assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/be-assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/be-assets/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/be-assets/js/demo.js"></script>
=======
<?=script_tag("be-assets/plugins/jquery/jquery.min.js")?>
<!-- Bootstrap 4 -->
<?=script_tag("be-assets/plugins/bootstrap/js/bootstrap.bundle.min.js")?>
<!-- AdminLTE App -->
<?=script_tag("be-assets/js/adminlte.min.js")?>
<!-- AdminLTE for demo purposes -->
<?=script_tag("be-assets/js/demo.js")?>
>>>>>>> dev

<?= $this->renderSection('javascript') ?>
</body>
</html>

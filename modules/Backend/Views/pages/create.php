<?= $this->extend('Modules\Backend\Views\base') ?>
<?= $this->section('title') ?>
<?= lang('Backend.' . $title->pagename) ?>
<?= $this->endSection() ?>
<?= $this->section('head') ?>
<link rel="stylesheet" href="<?= site_url("be-assets/node_modules/@yaireo/tagify/dist/tagify.css") ?>">
<link rel="stylesheet" href="<?= site_url("be-assets/plugins/summernote/summernote-bs4.css") ?>">
<link rel="stylesheet" href="<?= site_url("be-assets/plugins/jquery-ui/jquery-ui.css") ?>">
<link rel="stylesheet" type="text/css"
      href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="<?= site_url("be-assets/plugins/elFinder/css/elfinder.full.css") ?>">
<link rel="stylesheet" href="<?= site_url("be-assets/plugins/elFinder/css/theme.css") ?>">
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1><?= lang('Backend.' . $title->pagename) ?></h1>
            </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <a href="<?= route_to('pages',1) ?>" class="btn btn-outline-info"><i
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
            <h3 class="card-title font-weight-bold">Sayfa Oluşur</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= view('Modules\Auth\Views\_message_block') ?>
            <form action="<?= route_to('pageCreate') ?>" class="form-row" method="post">
                <div class="col-md-8 form-group row">
                    <div class="form-group col-md-12">
                        <label for="">Sayfa Başlığı</label>
                        <input type="text" name="title" class="form-control" placeholder="Sayfa Başlığı" required>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Sayfa URL</label>
                        <input type="text" class="form-control" name="seflink" readonly>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">İçerik</label>
                        <textarea name="content" rows="60" class="form-control editor" required></textarea>
                    </div>
                </div>
                <div class="col-md-4 form-group row">
                    <div class="form-group col-md-12">
                        <label for="">Sayfa Görseli</label>
                        <img src="" alt="" class="pageimg img-fluid">
                        <label for="">Görsel URL</label>
                        <input type="text" name="pageimg" class="form-control pageimg-input" placeholder="Görsel URL">
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="">Görsel Genişliği</label>
                                <input type="number" name="pageIMGWidth" class="form-control" id="pageIMGWidth" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Görsel Yüksekliği</label>
                                <input type="number" name="pageIMGHeight" class="form-control" id="pageIMGHeight" readonly>
                            </div>
                        </div>
                        <button type="button" class="pageIMG btn btn-info w-100">Görsel Seçiniz</button>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Seo Açıklaması</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="">Seo Anahtar Kelimeleri</label>
                        <textarea data-blacklist='<,>,;,.,"' name="keywords"></textarea>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button class="btn btn-success float-right">Ekle</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
<?= $this->endSection() ?>
<?= $this->section('javascript') ?>
<script src="<?= site_url('be-assets/plugins/jquery-ui/jquery-ui.js') ?>"></script>
<script src="<?= site_url("be-assets/node_modules/@yaireo/tagify/dist/jQuery.tagify.min.js") ?>"></script>
<script src="<?= site_url("be-assets/plugins/summernote/summernote-bs4.js") ?>"></script>
<script src="<?= site_url("be-assets/plugins/elFinder/js/elfinder.min.js") ?>"></script>
<script src="<?= site_url("be-assets/plugins/elFinder/js/extras/editors.default.js") ?>"></script>
<script src="<?= site_url("be-assets/plugins/summernote/plugin/elfinder/summernote-ext-elfinder.js") ?>"></script>
<script src="<?= site_url("be-assets/js/ci4ms.js")?>"></script>
<script>
    //tagify
    var input = $('textarea[name=keywords]')
        .tagify({
            enforceWhitelist: true,
            delimiters: null,
            whitelist: ["A# .NET", "A# (Axiom)", "A-0 System", "A+", "A++", "ABAP", "ABC", "ABC ALGOL", "ABSET", "ABSYS", "ACC", "Accent", "Ace DASL", "ACL2", "Avicsoft", "ACT-III", "Action!", "ActionScript", "Ada", "Adenine", "Agda", "Agilent VEE", "Agora", "AIMMS", "Alef", "ALF", "ALGOL 58", "ALGOL 60", "ALGOL 68", "ALGOL W", "Alice", "Alma-0", "AmbientTalk", "Amiga E", "AMOS", "AMPL", "Apex (Salesforce.com)", "APL", "AppleScript", "Arc", "ARexx", "Argus", "AspectJ", "Assembly language", "ATS", "Ateji PX", "AutoHotkey", "Autocoder", "AutoIt", "AutoLISP / Visual LISP", "Averest", "AWK", "Axum", "Active Server Pages", "ASP.NET", "B", "Babbage", "Bash", "BASIC", "bc", "BCPL", "BeanShell", "Batch (Windows/Dos)", "Bertrand", "BETA", "Bigwig", "Bistro", "BitC", "BLISS", "Blockly", "BlooP", "Blue", "Boo", "Boomerang", "Bourne shell (including bash and ksh)", "BREW", "BPEL", "B", "C--", "C++ – ISO/IEC 14882", "C# – ISO/IEC 23270", "C/AL", "Caché ObjectScript", "C Shell", "Caml", "Cayenne", "CDuce", "Cecil", "Cesil", "Céu", "Ceylon", "CFEngine", "CFML", "Cg", "Ch", "Chapel", "Charity", "Charm", "Chef", "CHILL", "CHIP-8", "chomski", "ChucK", "CICS", "Cilk", "Citrine (programming language)", "CL (IBM)", "Claire", "Clarion", "Clean", "Clipper", "CLIPS", "CLIST", "Clojure", "CLU", "CMS-2", "COBOL – ISO/IEC 1989", "CobolScript – COBOL Scripting language", "Cobra", "CODE", "CoffeeScript", "ColdFusion", "COMAL", "Combined Programming Language (CPL)", "COMIT", "Common Intermediate Language (CIL)", "Common Lisp (also known as CL)", "COMPASS", "Component Pascal", "Constraint Handling Rules (CHR)", "COMTRAN", "Converge", "Cool", "Coq", "Coral 66", "Corn", "CorVision", "COWSEL", "CPL", "CPL", "Cryptol", "csh", "Csound", "CSP", "CUDA", "Curl", "Curry", "Cybil", "Cyclone", "Cython", "Java", "Javascript", "M2001", "M4", "M#", "Machine code", "MAD (Michigan Algorithm Decoder)", "MAD/I", "Magik", "Magma", "make", "Maple", "MAPPER now part of BIS", "MARK-IV now VISION:BUILDER", "Mary", "MASM Microsoft Assembly x86", "MATH-MATIC", "Mathematica", "MATLAB", "Maxima (see also Macsyma)", "Max (Max Msp – Graphical Programming Environment)", "Maya (MEL)", "MDL", "Mercury", "Mesa", "Metafont", "Microcode", "MicroScript", "MIIS", "Milk (programming language)", "MIMIC", "Mirah", "Miranda", "MIVA Script", "ML", "Model 204", "Modelica", "Modula", "Modula-2", "Modula-3", "Mohol", "MOO", "Mortran", "Mouse", "MPD", "Mathcad", "MSIL – deprecated name for CIL", "MSL", "MUMPS", "Mystic Programming L"],
            dropdown: {
                maxItems: 20,           // <- mixumum allowed rendered suggestions
                classname: "tags-look", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0,             // <- show suggestions on focus
                closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
            }

        })
        .on('add', function (e, tagName) {
            console.log('JQEURY EVENT: ', 'added', tagName)
        })
        .on("invalid", function (e, tagName) {
            console.log('JQEURY EVENT: ', "invalid", e, ' ', tagName);
        });
</script>
<?= $this->endSection() ?>

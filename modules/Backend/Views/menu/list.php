<h4><strong>Sayfalar</strong></h4>
<?= empty($pages) ? '<strong>Menüye eklenebilecek sayfa bulunamadı !</strong>':''?>
<form class="list-group" id="addCheckedPages">
    <?php foreach ($pages as $page): ?>
        <div class="list-group-item" id="page-<?= $page->_id ?>">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-xs-8">
                    <label class="ml-3">
                        <input class="form-check-input me-1" type="checkbox" name="pageChecked[]"
                               value="<?= $page->_id ?>">
                        <?= $page->title ?>
                    </label>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-success addPages" type="button" onclick="addPages('<?= $page->_id ?>')">
                        Ekle
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; if(!empty($pages)): ?>
    <div class="list-group-item">
        <button class="btn btn-success float-right" type="button" onclick="addCheckedPages()">Seçilenleri
            ekle
        </button>
    </div>
    <?php endif; ?>
</form>
<hr>
<h4><strong>Yazılar</strong></h4>
<?= empty($blogs) ? '<strong>Menüye eklenebilecek yazı bulunamadı !</strong>':''?>
<form class="list-group" id="addCheckedBlog">
    <?php foreach ($blogs as $blog): ?>
        <div class="list-group-item" id="blog-<?= $blog->_id ?>">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-xs-8">
                    <label class="ml-3">
                        <input class="form-check-input me-1" type="checkbox" name="pageChecked[]"
                               value="<?= $blog->_id ?>">
                        <?= $blog->title ?>
                    </label>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-success" type="button" onclick="addBlog('<?= $blog->_id ?>')">
                        Ekle
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; if(!empty($blogs)): ?>
    <div class="list-group-item">
        <button class="btn btn-success float-right" type="button" onclick="addCheckedBlog()">Seçilenleri
            ekle
        </button>
    </div>
    <?php endif; ?>
</form>
<hr>
<form id="addUrls" method="post" class="form-row mt-2">
    <div class="col-md-5 form-group">
        <input type="text" class="form-control" placeholder="Başlık Giriniz" name="URLname">
    </div>
    <div class="col-md-5 form-group">
        <input type="text" class="form-control" placeholder="URL giriniz" name="URL">
    </div>
    <div class="col-md-5 form-group">
        <select class="form-control" name="target">
            <option value="">lütfen link target seçin</option>
            <option value="_blank">_blank</option>
            <option value="_self">_self</option>
            <option value="_parent">_parent</option>
            <option value="_top">_top</option>
        </select>
    </div>
    <div class="col-md-2 form-group">
        <button class="btn btn-success w-100" type="button" onclick="addURL()">URL ekle</button>
    </div>
</form>
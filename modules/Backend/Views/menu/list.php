<h4><strong>Sayfalar</strong></h4>
<form class="list-group">
    <?php foreach ($pages as $page): ?>
        <div class="list-group-item" id="page-<?= $page->_id ?>">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="col-xs-8">
                    <label class="ml-3">
                        <input class="form-check-input me-1" type="checkbox"
                               value="<?= $page->_id ?>">
                        <?= $page->title ?>
                    </label>
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-success addPages" type="button"
                            data-id="<?= $page->_id ?>">Ekle
                    </button>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="list-group-item">
        <button class="btn btn-success float-right" type="button" id="addCheckedPages">Seçilenleri
            ekle
        </button>
    </div>
</form>
<hr>
<h4><strong>Yazılar</strong></h4>
<form class="list-group">
    <div class="list-group-item">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-xs-8">
                <label class="ml-3">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    An item
                </label>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-xs-8">
                <label class="ml-3">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    A second item
                </label>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-xs-8 ">
                <label class="ml-3">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    A third item
                </label>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-xs-8">
                <label class="ml-3">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    A fourth item
                </label>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-xs-8">
                <label class="ml-3">
                    <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                    And a fifth one
                </label>
            </div>
            <div class="col-xs-4">
                <button class="btn btn-success addBlog" type="button" data-id="">Ekle</button>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <button class="btn btn-success float-right" type="button" id="addCheckedBlog">Seçilenleri
            ekle
        </button>
    </div>
</form>

<form action="" method="post" class="form-row mt-2">
    <div class="col-md-10 form-group">
        <input type="text" class="form-control" placeholder="URL giriniz" id="URL">
    </div>
    <div class="col-md-2 form-group">
        <button class="btn btn-success w-100" type="button" id="addURL">URL ekle</button>
    </div>
</form>
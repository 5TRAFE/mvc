<? Page::render('/layouts/admin.header') ?>

            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Категории <small>управление категориями</small>
                    </h1>
                </div>
            </div>
            <!-- /. ROW  -->
         <?php foreach ($categories as $category): ?>
            <div class="col-md-4 col-sm-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                      <?=$category['category_name'] ?>
                    </div>
                    <div class="panel-body">
                        <p><?=$category['category_description'] ?></p>
                        <a href="/admin/categories/edit/<?=$category['id'] ?>" class="btn btn-primary">Редактировать</a>
                    </div>
                    <div class="panel-footer">
                       Товаров в категории: <?=$category['count_goods'] ?>
                    </div>
                </div>
            </div>
    <? endforeach; ?>
    <div class="col-md-12 col-sm-12">
<?=$pagination ?>
    </div>
<?= Page::render('/layouts/admin.footer') ?>
<?php Page::render('/layouts/admin.header') ?><div class="row">
                <div class="col-md-12">
                    <h1 class="page-header">
                        Категории <small>управление категориями</small>
                    </h1>
                </div>
            </div>
            <!-- /. ROW  -->

            <div class="col-lg-12 col-sm-12">
                <div class="panel panel-primary">
                    <?php foreach ($category as $item): ?>
                    <div class="panel-heading">
                      <?=$item['category_name'] ?>

                    </div>
                    <div class="panel-body">


                        <form role="form" action="/admin/category/update" method="post">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Название категории</label>
                                    <input class="form-control" name="category_name" type="text" value="<?=$item['category_name'] ?>">

                                </div>
                                <div class="form-group">
                                    <label>Алиас</label>
                                    <input class="form-control" name="url" placeholder="Алиас категории" value="<?=$item['url'] ?>">
                                    <p class="text-danger">Алиас должен быть уникален для своей группы категорий.</p>
                                </div>
                               <p class="text-primary">Товаров в категории: <?=$item['count_goods'] ?></p>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Перенести категорию</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="0">Без категории</option>
                                        <?=$array ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea class="form-control" name="category_description" rows="3"><?=$item['category_description'] ?></textarea>
                                </div>
                            </div>


                    </div>
                    <div class="panel-footer">
                        <input type="hidden" name="id" value="<?=$item['id'] ?>">
                        <input type="hidden" name="redirect" value="/<?=Storage::get('uri')?>">
                        <button type="submit" class="btn btn-primary">Сохранить</button>


                    </div>
                        </form>
                    <? endforeach; ?>




                </div>
            </div>


        </div>
        <!-- /. PAGE INNER  -->
    </div>
    <!-- /. PAGE WRAPPER  -->
<?= Page::render('/layouts/admin.footer') ?>
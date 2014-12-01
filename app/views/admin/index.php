<form action="/admin/search" class="form-inline form-group">
    <div class="form-group">
        <input class="form-control" type="text" name="search"/>
    </div>
    <div class="form-group">
        <input class="btn" type="submit" value="Поиск"/>
    </div>
</form>

<form id="new-item" action="/admin/trans-new" class="form-group" method="post" accept-charset="utf-8">

        <div class="key form-group"><strong>Key : <input type="text" class="form-control" name="key" value=""/></strong></div>

    <div class="col-md-6 form-group">
        <div class="value">Language : en</div>
        <div class="value">Value : <textarea rows="5" name="item[en][value]" class="form-control" type="text" ></textarea></div>
    </div>
    <div class="col-md-6 form-group">
        <div class="value">Language : ru</div>
        <div class="value">Value : <textarea rows="5" name="item[ru][value]" class="form-control" type="text" ></textarea></div>
    </div>
        <div class="submit col-md-12"><input class="btn" type="submit"/></div>

</form>

<?php foreach ($trans as $key => $item) { ?>

    <div class="item form-group" >
        <form action="/admin/trans" method="post" accept-charset="utf-8">
            <div class="key"><strong>Key : <?= $key ?></strong></div>
            <input type="hidden" name="<?= $key ?>"/>
            <?php foreach($item as $value){ ?>
                <div class="col-md-6 form-group">
                    <div class="value">Language : <?= $value['lng'] ?></div>
                    <div class="value">Value :
                        <textarea rows="5" name="item[<?= $key ?>][<?= $value['lng'] ?>][value]" type="text"
                                  class="form-control <?= ($key == 'page.about.content')?'ckeditor':'' ?>">
                                  <?= $value['value'] ?>
                        </textarea>
                    </div>
                </div>

            <?php } ?>
            <div class="submit col-md-12"><input class="btn" type="submit"/></div>
        </form>
    </div>

<?php } ?>
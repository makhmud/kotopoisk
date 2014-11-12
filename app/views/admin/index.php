<form id="new-item" action="/admin/trans-new" method="post" accept-charset="utf-8">

        <div class="key"><strong>Key : <input type="text" name="key" value=""/></strong></div>

        <div class="value">Language : en</div>
        <div class="value">Value : <input name="item[en][value]" type="text" value=""/></div>
        <div class="value">Language : ru</div>
        <div class="value">Value : <input name="item[ru][value]" type="text" value=""/></div>
        <div class="submit"><input type="submit"/></div>

</form>

<?php foreach ($trans as $key => $item) { ?>

    <div class="item">
        <form action="/admin/trans" method="post" accept-charset="utf-8">
            <div class="key"><strong>Key : <?= $key ?></strong></div>
            <input type="hidden" name="<?= $key ?>"/>
            <?php foreach($item as $value){ ?>
                <div class="value">Language : <?= $value['lng'] ?></div>
                <div class="value">Value : <input name="item[<?= $key ?>][<?= $value['lng'] ?>][value]" type="text" value="<?= $value['value'] ?>"/></div>

            <?php } ?>
            <div class="submit"><input type="submit"/></div>
        </form>
    </div>

<?php } ?>
<?php
/**
 * @var array $elements
 * @var string $title
 */
?>

<h1 class="title">
    <?= esc($title) ?>
</h1>

<div class="page-actions">
    <a href="javascript:void(0)" class="btn btn-primary" title="<?= esc(lang('App.DE.Actions.New')) ?>">
        <?= esc(lang('App.DE.Actions.New')) ?>
    </a>
</div>

<table class="default-table">
    <thead>
        <tr>
            <th><?= esc(lang('App.DE.Modules.Attributes.Name')) ?></th>
            <th><?= esc(lang('App.DE.Modules.Attributes.Description')) ?></th>
            <th><?= esc(lang('App.DE.Modules.Attributes.Enabled')) ?></th>
            <th><?= esc(lang('App.DE.Modules.Attributes.CreatedAt')) ?></th>
            <th><?= esc(lang('App.DE.Modules.Attributes.UpdatedAt')) ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($elements as $e) : ?>
            <tr>
                <td><?= esc($e['Name']) ?></td>
                <td><?= esc($e['Description']) ?></td>
                <td><?= $e['Enabled'] ? esc(lang('App.DE.Yes')) : esc(lang('App.DE.No')) ?></td>
                <td><?= formatTimestampAsDate($e['CreatedAt']) ?></td>
                <td><?= formatTimestampAsDate($e['UpdatedAt']) ?></td>
                <td class="table-actions">
                    <!-- Edit -->
                    <a href="javascript:void(0)" title="<?= esc(lang('App.DE.Actions.Edit')) ?>" class="btn btn-success">
                        <?= esc(lang('App.DE.Actions.Edit')) ?>
                    </a>

                    <!-- Delete -->
                    <a href="javascript:void(0)" title="<?= esc(lang('App.DE.Actions.Delete')) ?>" class="btn btn-danger">
                        <?= esc(lang('App.DE.Actions.Delete')) ?>
                    </a>
                </td>
            </tr>
        <?php endforeach  ?>
    </tbody>
</table>

<script>
    $(() => {
        $('.default-table').DataTable({
            lengthChange: false,
            info: false,
            ordering: false,
            pagingType: 'simple_numbers',
            language: {
                emptyTable: lang['DataTableTexts']['NoData'],
                search: lang['DataTableTexts']['Search']
            }
        });
    });
</script>
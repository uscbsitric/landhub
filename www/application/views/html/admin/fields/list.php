<div class="page-header page-header-with-buttons">
    <h1 class="pull-left"><span>Custom Fields</span></h1>
</div>

<div class="box bordered-box" style="margin-bottom:0;">
    <div class="text-right" style="margin-bottom:12px;">
        <a href="/admin/fields/new" class="btn btn-primary">New Field</a>
    </div>
    <div class="box-content box-no-padding">
        <div class="responsive-table">
            <div class="scrollable-area">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Slug</th>
                        <th>Label</th>
                        <th>Type</th>
                        <th>Required</th>
                        <th>Visibility</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $item): ?>
                        <tr>
                            <td><?php echo $item->name;?></td>
                            <td><?php echo $item->label;?></td>
                            <td><?php echo $item->field_type; ?></td>
                            <td><?php echo ($item->is_required == 1) ? '<span class="label label-success">required</span>' : '<span class="label label-danger">not required</span>'; ?></td>
                            <td><?php echo ($item->is_visible == 1) ? '<span class="label label-success">visible</span>' : '<span class="label label-danger">invisible</span>'; ?></td>
                            <td>
                                <div class="text-right">
                                    <a class="btn btn-mini btn-inverse" href="/admin/fields/edit/<?php echo $item->id; ?>">Edit</a>
                                    <a onclick="return confirm('Are you sure? This action is NOT reversible!');" class="btn btn-mini btn-danger" href="/admin/fields/delete/<?php echo $item->id; ?>">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?php blocks::open(); ?>
<?php blocks::title(Kohana::lang('ui_main.incidents_listed')); ?>
<table class="table-list">
    <thead>
        <tr>
            <th scope="col" class="title"><?php echo Kohana::lang('ui_main.incident'); ?></th>
            <th scope="col" class="location"><?php echo Kohana::lang('ui_main.location'); ?></th>
            <th scope="col" class="date"><?php echo Kohana::lang('ui_main.date'); ?></th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($total_items == 0) {
            ?>
            <tr><td colspan="3"><?php echo Kohana::lang('ui_main.no_reports'); ?></td></tr>
            <?php
        }
        foreach ($incidents as $incident) {
                    // Get all active top level categories
        $parent_categories = array();
        $incident_category = ORM::factory('incident_category', $incident->id);
        $category = ORM::factory('category', $incident_category->category_id);
            
            $incident_id = $incident->id;
            $incident_title = $category->category_title.'  '.$incident->incident_NoOfTrees;
            $incident_remarks = text::limit_chars($incident->incident_remarks, 150, '...', True);
            $incident_date = $incident->incident_date;
            $incident_date = date('M j Y', strtotime($incident->incident_date));
            $incident_location = $incident->location->location_name;
            ?>
            <tr>
                <td>
                    <a href="<?php echo url::site() . 'reports/view/' . $incident_id; ?>"> <?php echo $incident_title ?></a><br />
                    <?php echo $incident_remarks ?>
                </td>
                <td><?php echo $incident_location ?></td>
                <td><?php echo $incident_date; ?></td>
            </tr>
    <?php
}
?>
    </tbody>
</table>
<a class="more" href="<?php echo url::site() . 'reports/' ?>"><?php echo Kohana::lang('ui_main.view_more'); ?></a>
<div style="clear:both;"></div>
<?php blocks::close(); ?>
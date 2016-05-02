<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 main">

            <?php
            if ($this->session->flashdata('message') != '') {
                echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
            } ?>

            <div class="col-sm-12">
                <h3>Symptoms List</h3>
                <?php if (!empty($symptoms)) { ?>

                    <table class="table table-striped table-responsive table-hover table-bordered">
                        <tr>
                            <th><?php echo $this->lang->line("label_symptom_name"); ?></th>
                            <th><?php echo $this->lang->line("label_description"); ?></th>
                            <th><?php echo $this->lang->line("label_action"); ?></th>
                        </tr>

                        <?php
                        $serial = 1;
                        foreach ($symptoms as $symptom) { ?>
                            <tr>
                                <td><?php echo $symptom->name; ?></td>
                                <td><?php echo $symptom->description; ?></td>
                                <td>
                                    <?php echo anchor("ohkr/edit_symptom/" . $symptom->id, "Edit"); ?> |
                                    <?php echo anchor("ohkr/delete_symptom/" . $symptom->id, "Delete", "class='delete'"); ?>
                                </td>
                            </tr>
                            <?php $serial++;
                        } ?>
                    </table>
                    <?php if (!empty($links)): ?>
                        <div class="widget-foot">
                            <?= $links ?>
                            <div class="clearfix"></div>
                        </div>
                    <?php endif; ?>
                <?php } else { ?>
                    <div class="fail_message">No symptom has been added</div>
                <?php } ?>
            </div>
        </div>
    </div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 main">
            <div id="header-title">
                <h3 class="title">List Disease</h3>
            </div>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="active">List diseases</li>
            </ol>

            <?php
            if ($this->session->flashdata('message') != '') {
                echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
            } ?>

            <div class="row">
                <div class="col-sm-12">
                    <?php if (!empty($disease_list)) { ?>

                        <table class="table table-striped table-responsive table-hover">
                            <tr>
                                <th><?php echo $this->lang->line("label_disease_name"); ?></th>
                                <th><?php echo $this->lang->line("label_specie_name"); ?></th>
                                <th><?php echo $this->lang->line("label_action"); ?></th>
                            </tr>

                            <?php
                            foreach ($disease_list as $disease) { ?>
                                <tr>
                                    <td><?php echo $disease->disease_title; ?></td>
                                    <td><?php echo $disease->specie_title; ?></td>
                                    <td>
                                        <?php echo anchor("ohkr/edit_disease/" . $disease->id, "Edit"); ?> |
                                        <?php echo anchor("ohkr/delete_disease/" . $disease->id, "Delete", "class='delete'"); ?>
                                        |
                                        <?php echo anchor("ohkr/disease_symptoms_list/" . $disease->id, "Symptoms"); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                        <?php if (!empty($links)): ?>
                            <div class="widget-foot">
                                <?= $links ?>
                                <div class="clearfix"></div>
                            </div>
                        <?php endif; ?>
                    <?php } else { ?>
                        <div class="fail_message">No disease has been found</div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</div>

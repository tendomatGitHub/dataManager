<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <div id="header-title">
                <h3 class="title">Edit form</h3>
            </div>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="active">Edit form</li>
            </ol>

            <?php
            if ($this->session->flashdata('message') != '') {
                echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
            }
            ?>
            <?php echo form_open_multipart('xform/edit_form/' . $form->id, 'class="form-vertical" role="form"'); ?>
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#form-details">Edit form details</a></li>
                <li><a data-toggle="tab" href="#access-permissions">Manage Access Permissions</a></li>
                <li><a data-toggle="tab" href="#map-columns"><?php echo "Map columns" ?></a></li>
                <li><a data-toggle="tab" href="#dhis2"><?php echo "Dhis2" ?></a></li>
            </ul>

            <div class="tab-content">
                <br/>
                <div id="form-details" class="tab-pane fade in active">
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="">Edit form details</h3>
                            </div>
                            <div class="panel-body">

                                <div class="form-group">
                                    <?php echo form_label($this->lang->line("label_form_title"), " <span>*</span>"); ?>
                                    <input type="text" name="title" placeholder="Enter form title"
                                           class="form-control"
                                           value="<?php echo set_value('title', $form->title); ?>">
                                </div>
                                <div class=""><?php echo form_error('title'); ?></div>

                                <div class="form-group">
                                    <label for="campus"><?php echo $this->lang->line("label_description") ?>:</label>
                                    <textarea class="form-control" name="description" rows="5"
                                              id="description"><?php echo set_value('description', $form->description); ?></textarea>
                                </div>
                                <div class=""><?php echo form_error('description'); ?></div>

                                <div class="form-group">
                                    <label for="campus"><?php echo $this->lang->line("label_access") ?> :</label>
                                    <?php echo form_dropdown("access", array("private" => "Private", "public" => "Public"),
                                        set_value("access", $form->access), 'class="form-control"'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="access-permissions" class="tab-pane fade">
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="">Manage Access Permissions</h3>
                            </div>
                            <div class="panel-body">

                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <h4>Group Permissions</h4>
                                    <?php
                                    foreach ($group_perms as $key => $value) {
                                        echo form_checkbox("perms[]", $key, (in_array($key, $current_perms)) ? TRUE : FALSE);
                                        echo ucfirst($value) . "</br>";
                                    } ?>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                                    <h4>User Permissions</h4>
                                    <?php
                                    foreach ($user_perms as $key => $value) {
                                        echo form_checkbox("perms[]", $key, (in_array($key, $current_perms)) ? TRUE : FALSE);
                                        echo ucfirst($value) . "</br>";
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="map-columns" class="tab-pane fade">
                    <div class="">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="">Map columns</h3>
                            </div>
                            <div class="panel-body">

                                <table class="table table-responsive table-bordered table-striped">
                                    <tr>
                                        <th class="text-center">Hide</th>
                                        <th class="text-center">Mapping To</th>
                                        <?php if ($form->allow_dhis == 1): ?>
                                            <th class="text-center">Dhis2 Data Element</th>
                                        <?php endif; ?>
                                        <th class="text-center">Question/Label</th>
                                        <th class="text-center">Field Type</th>
                                        <th class="text-center">Chart use</th>
                                        <th class="text-center">Option</th>
                                    </tr>
                                    <?php

                                    $form_specific_options = [
                                        ''             => "Select Option",
                                        'male case'    => "Male Case",
                                        'male death'   => "Male Death",
                                        'female case'  => "Female Case",
                                        'female death' => "Female Death"
                                    ];

                                    $field_type_options = ['TEXT'     => "Text", 'INT' => "Number",
                                                           "GPS"      => "GPS Location", "DATE" => "DATE", "DALILI" => 'Dalili',
                                                           "LAT"      => "Latitude", "LONG" => "Longitude",
                                                           "IDENTITY" => "Username/Identity", "IMAGE" => "Image"];

                                    $use_in_chart_options = [1 => 'Yes', 0 => 'No'];


                                    foreach ($table_fields as $tf) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . form_checkbox("hide[]", $tf['id'], ($tf['hide'] == 1)) . "</td>";
                                        echo "<td><em>{$tf['col_name']}</em></td>";
                                        if ($form->allow_dhis == 1) {
                                            echo "<td>" . form_input("data_element[]", (!empty($tf['dhis_data_element']) ? $tf['dhis_data_element'] : null), 'class="form-control"') . "</td>";
                                        }
                                        echo "<td>" . form_hidden("ids[]", $tf['id']) . " " . form_input("label[]", (!empty($tf['field_label']) ? $tf['field_label'] : $tf['field_name']), 'class="form-control"') . "</td>";
                                        echo "<td>" . form_dropdown("field_type[]", $field_type_options, $tf['field_type']) . "</td>";
                                        echo "<td>" . form_dropdown("chart_use[]", $use_in_chart_options, $tf['chart_use']) . "</td>";
                                        echo "<td>" . form_dropdown("type[]", $form_specific_options, $tf['type']) . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="dhis2" class="tab-pane fade">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="">Dhis2</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="Allow Dhis2 Integration"><?php echo $this->lang->line("label_allow_dhis2") ?>
                                    :</label>
                                <?php echo form_checkbox("allow_dhis2", null, set_value("allow_dhis2", $form->allow_dhis), 'id="allowDhis2"'); ?>
                            </div>

                            <div id="dhis2Fields">
                                <div class="form-group">
                                    <?php echo form_label($this->lang->line("label_data_set"), " <span>*</span>"); ?>
                                    <input type="text" name="data_set"
                                           placeholder="<?= $this->lang->line("label_data_set") ?>"
                                           class="form-control"
                                           value="<?php echo set_value('data_set', $form->dhis_data_set); ?>">
                                </div>
                                <div class=""><?php echo form_error('data_set'); ?></div>

                                <div class="form-group">
                                    <?php echo form_label($this->lang->line("label_org_unit_id"), " <span>*</span>"); ?>
                                    <input type="text" name="org_unit_id"
                                           placeholder="<?= $this->lang->line("label_org_unit_id") ?>"
                                           class="form-control"
                                           value="<?php echo set_value('org_unit_id', $form->org_unit_id); ?>">
                                </div>
                                <div class=""><?php echo form_error('org_unit_id'); ?></div>

                                <div class="form-group">
                                    <label for="periodType"><?php echo $this->lang->line("label_period_type") ?>
                                        :</label>
                                    <?php echo form_dropdown("period_type", array("daily" => "Daily", "weekly" => "Weekly", "monthly" => "Monthly"),
                                        set_value("period_type", $form->period_type), 'class="form-control"'); ?>
                                </div>
                                <div class=""><?php echo form_error('period_type'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg">Save changes</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>

        <script type="text/javascript">

            $(document).ready(function () {

                $("#dhis2Fields").hide();

                $("#allowDhis2").is(":checked")
                {
                    $("#dhis2Fields").toggle();
                }

            });
        </script>
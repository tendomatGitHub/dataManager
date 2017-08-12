<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 main">
            <div id="header-title">
                <h3 class="title">List Projects</h3>
            </div>

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <li class="active">List projects</li>
            </ol>

            <div class="row">
                <?php
                if ($this->session->flashdata('message') != '') {
                    echo '<div class="col-sm-12 col-md-12 col-lg-12">';
                    echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
                    echo '</div>';
                }
                ?>
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <?php if (count($project_list) > 0) { ?>
                        <table class="table table-responsive table-hover table-bordered">
                            <tr>
                                <th width="12%">Title</th>
                                <th width="65%">Description</th>
                                <th width="15%">Created date</th>
                                <th width="8%" colspan="2">Action</th>
                            </tr>

                            <?php
                            $serial = 1;
                            foreach ($project_list as $project) { ?>
                                <tr class="projectRow" id="<?= $project->id ?>">
                                    <td><?php echo $project->title; ?></td>
                                    <td><?php echo $project->description; ?></td>
                                    <td><?php echo date('d-m-Y H:i:s', strtotime($project->created_at)); ?></td>
                                    <td><?php echo anchor("projects/edit/" . $project->id, "Edit"); ?></td>
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
                        <div class="fail_message">You don't have any project</div>
                    <?php } ?>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div id="notificationBar">Select project to see forms</div>
                    <div id="formsListArea"></div>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('tr.projectRow').on('click', function () {
            var projectId = $(this).attr('id');
            console.log("project id is " + projectId);

            $.ajax({
                url: "<?= base_url("projects/forms") ?>/" + projectId,
                type: "post",
                dataType: 'json',
                data: {
                    project_id: projectId
                },
                success: function (data) {
                    $("#notificationBar").html("");
                    var html = '<h3 class="title">Project forms <span class="small pull-right"><a href="<?= base_url('xform/add_new')?>/' + projectId + '">Upload new form</a></span></h3>';

                    if (data.status == "success" && data.forms_count > 0) {
                        var forms = data.forms;

                        $.each(forms, function (i, form) {

                            var form_status = null;
                            if (form.access == "private") {
                                form_status = "<span class='label label-warning pull-right small text-white'>" + form.access + "</span>";
                            } else {
                                form_status = "<span class='label label-success pull-right small text-white'>" + form.access + "</span>";
                            }

                            html += "<div><h4>" + form.title + form_status + "</h4><span class='small'>" + form.description
                                    + "</span><span class='pull-right'><a href='<?= base_url('xform/edit_form/')?>/" + form.id + "'>Edit</a></span>"
                                    + "<p>" +
                                    "<a href='<?=base_url("xform/form_overview")?>/" + form.form_id + "' class='mr-3'>Overview</a>&nbsp;&nbsp;" +
                                    "<a href='<?=base_url("xform/form_data")?>/" + form.id + "' target='_blank' class='mr-3'>Form Data</a>&nbsp;&nbsp;" +
                                    "<a href='<?=base_url("Form_Visualization/chart")?>/" + form.form_id + "' target='_blank' class='mr-3'>Chart</a>&nbsp;&nbsp;" +
                                    "<a href='<?=base_url("Form_Visualization/map")?>/" + form.form_id + "' target='_blank' >Map</a>" +
                                    "</p></div>";
                        });
                    }

                    if (data.status == "success" && data.forms_count == 0) {
                        $("#notificationBar").html('<?=display_message("This project does not have any form", "info")?>');
                        html = "<div><a href='<?= base_url('xform/add_new')?>/" + projectId + "'>Upload new form</a></div>";
                    }
                    $("#formsListArea").html(html);
                },
                beforeSend(){
                    $("#formsListArea").html("");
                    $("#notificationBar").html('<?=display_message("<i class=\"fa fa-spinner fa-refresh fa-spin fa-1x\" aria-hidden=\"true\"></i> Getting forms, Please wait... ")?>');
                },
                error(){}
            });
        });
    });
</script>
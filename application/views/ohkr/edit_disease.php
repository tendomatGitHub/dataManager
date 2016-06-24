<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 main">
            <h3>Edit Disease Details</h3>

            <?php
            if ($this->session->flashdata('message') != '') {
                echo '<div class="success_message">' . $this->session->flashdata('message') . '</div>';
            } ?>

            <div class="col-sm-8">
                <?php echo form_open('ohkr/edit_disease/' . $disease->id, 'class="form-horizontal" role="form"'); ?>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_disease_name") ?> <span>*</span></label>
                    <input type="text" name="name" placeholder="Enter disease name" class="form-control"
                           value="<?php echo $disease->d_title; ?>">
                </div>
                <div class="error" style="color: red"><?php echo form_error('name'); ?></div>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_specie_name") ?> <span>*</span></label>
                    <select name="specie" id="specie" class="form-control">
                        <option value="<?= $disease->s_id ?>"><?= $disease->s_title ?></option>
                        <?php foreach ($species as $specie) { ?>
                            <option value="<?php echo $specie->id; ?>"><?php echo $specie->title; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="error" style="color: red"><?php echo form_error('specie'); ?></div>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_description") ?> :</label>
                        <textarea class="form-control" name="description"
                                  id="description"><?php echo $disease->description; ?></textarea>
                </div>
                <div class="error" style="color: red"><?php echo form_error('description'); ?></div>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_cause") ?> :</label>
                        <textarea class="form-control" name="cause"
                                  id="cause"><?php echo $disease->cause; ?></textarea>
                </div>
                <div class="error" style="color: red"><?php echo form_error('cause'); ?></div>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_symptoms") ?> :</label>
                        <textarea class="form-control" name="symptoms"
                                  id="symptoms"><?php echo $disease->symptoms; ?></textarea>
                </div>
                <div class="error" style="color: red"><?php echo form_error('symptoms'); ?></div>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_diagnosis") ?> :</label>
                        <textarea class="form-control" name="diagnosis"
                                  id="diagnosis"><?php echo $disease->diagnosis; ?></textarea>
                </div>
                <div class="error" style="color: red"><?php echo form_error('diagnosis'); ?></div>

                <div class="form-group">
                    <label><?php echo $this->lang->line("label_treatment") ?> :</label>
                        <textarea class="form-control" name="treatment"
                                  id="treatment"><?php echo $disease->treatment; ?></textarea>
                </div>
                <div class="error" style="color: red"><?php echo form_error('treatment'); ?></div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>

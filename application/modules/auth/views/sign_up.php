<!-- Page Content -->
<section class="page-wrapper">
    <div class="container">
        <div class="sign-up row">

            <div class="left-col col-lg-7">
                <h2>AFYADATA - Taarifa kwa wakati!</h2>

                <p>Afyadata Manager is a tool that analyzes all the data collected from the field
                    and intelligently sends feedback to the data collector and sends an alert to higher authority
                    officials if any abnormal pattern is discovered in the data collected.</p>
                <p>This tool provides a graphical
                    user interface for involved health stakeholders to analyze and visualizing data collected via
                    Afyadata
                    mobile app for android.</p>
            </div>

            <div class="right-col col-lg-5">
                <form action="<?php echo site_url('auth/sign_up'); ?>" class="form-horizontal" role="form"
                      method="post" accept-charset="utf-8">
                    <div class="pure-form">
                        <h2>Sign up to Afyadata</h2>

                        <?php if ($message != "") {
                            echo '<div style="color: red; font-size: 11px;">' . $message . '</div>';
                        } ?>

                        <div class="col-lg-12" style="margin-top: 10px;">
                            <div class="form-group">
                                <?php echo form_input($first_name); ?>
                            </div> <!-- /form-group -->

                            <div class="form-group">
                                <?php echo form_input($last_name); ?>
                            </div> <!-- /form-group -->

                            <div class="form-group">
                                <?= form_input($organization) ?>
                            </div>

                            <div class="form-group">
                                <?= form_input($email) ?>
                            </div>

                            <div class="form-group">
                                <?= form_input($phone) ?>
                            </div>

                            <div class="form-group">
                                <?= form_password($password) ?>
                            </div>

                            <div class="form-group">
                                <?= form_password($password_confirm) ?>
                            </div>

                            <?php echo form_hidden('group[]', '8'); ?>

                            <div class="form-group last">
                                <?php echo form_submit('submit', 'Sign up', array('class' => "btn btn-maroon")); ?>
                            </div>
                        </div>
                        <div class="form-group"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- /.container -->
</section>

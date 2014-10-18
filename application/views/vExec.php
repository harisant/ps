<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Executor</title>
        <link href="<?php echo base_url(); ?>globals/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>globals/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
            echo heading('Missions Executor',2);
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mission</th>
                    <th>Interval</th>
                    <th>Count</th>
                    <th>Email Sent</th>
                    <th>Progress</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 1;
                foreach($missions->result() as $mission){
                ?>
                <tr>
                    <td><?php echo $n; ?></td>
                    <td><?php echo $mission->name; ?></td>
                    <td><input class="form-input" type="text" value="10" name="interval"></td>
                    <td><input class="form-input" type="text" value="50" name="count"></td>
                    <td><label class="email-sent"><label></td>
                    <td><label class="progress"></label></td>
                    <td><?php echo status_button($mission->id, $mission->status); ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        
        <script src="<?php echo base_url(); ?>globals/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>globals/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $('.mission-status').click(function(){
                btn = $(this);
                data = [{name: 'id', value: btn.attr('var')},{name: 'status', value: btn.attr('stat')}];
                url  = '<?php echo site_url(); ?>/mission/change_status';
                post = $.post(url,data);
                post.done(function(result){
                    var res = $.parseJSON(result);
                    if(res['status']==='success'){
                        dat = res['data'];
                        switch(dat){
                            case 0:
                                btn.attr('stat',dat);
                                btn.removeClass('btn-success').addClass('btn-warning');
                                btn.html('off');
                                break;
                            case 1:
                                btn.attr('stat',dat);
                                btn.removeClass('btn-warning').addClass('btn-success');
                                btn.html('on');
                                break;
                            default:
                                break;
                        }
                    }
                });
            });
        </script>
    </body>
</html>
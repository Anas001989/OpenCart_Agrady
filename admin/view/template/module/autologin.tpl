<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="setting-form" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <button id="apply" data-toggle="tooltip" title="<?php echo $button_apply; ?>" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $button_apply; ?></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i><?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="setting-form" class="form-horizontal">
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo $entry_status; ?></label>
              <div class="col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                  <?php if ($status === '1') { ?>
                  <label class="btn btn-success md-btn active"><input type="radio" name="status" value="1" checked="checked" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-danger md-btn"><input type="radio" name="status" value="0" /> <?php echo $text_disabled; ?></label>
                  <?php } else { ?>
                  <label class="btn btn-success md-btn"><input type="radio" name="status" value="1" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-danger md-btn active"><input type="radio" name="status" value="0" checked="checked" /> <?php echo $text_disabled; ?></label>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="expiration-time"><?php echo $entry_expiration_time; ?></label>
              <div class="col-sm-4">
                <input type="number" name="expiration_time" value="<?php echo $expiration_time; ?>" id="expiration-time" class="form-control" placeholder="<?php echo $entry_expiration_time; ?>" min="1">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo $entry_check_user_agent; ?></label>
              <div class="col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                  <?php if ($check_user_agent === '1') { ?>
                  <label class="btn btn-success md-btn active"><input type="radio" name="check_user_agent" value="1" checked="checked" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-default md-btn"><input type="radio" name="check_user_agent" value="0" /> <?php echo $text_disabled; ?></label>
                  <?php } else { ?>
                  <label class="btn btn-success md-btn"><input type="radio" name="check_user_agent" value="1" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-default md-btn active"><input type="radio" name="check_user_agent" value="0" checked="checked" /> <?php echo $text_disabled; ?></label>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo $entry_check_ip; ?></label>
              <div class="col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                  <?php if ($check_ip === '1') { ?>
                  <label class="btn btn-success md-btn active"><input type="radio" name="check_ip" value="1" checked="checked" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-default md-btn"><input type="radio" name="check_ip" value="0" /> <?php echo $text_disabled; ?></label>
                  <?php } else { ?>
                  <label class="btn btn-success md-btn"><input type="radio" name="check_ip" value="1" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-default md-btn active"><input type="radio" name="check_ip" value="0" checked="checked" /> <?php echo $text_disabled; ?></label>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo $entry_show_checkbox; ?></label>
              <div class="col-sm-9">
                <div class="btn-group" data-toggle="buttons">
                  <?php if ($show_checkbox === '1') { ?>
                  <label class="btn btn-success md-btn active"><input type="radio" name="show_checkbox" value="1" checked="checked" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-default md-btn"><input type="radio" name="show_checkbox" value="0" /> <?php echo $text_disabled; ?></label>
                  <?php } else { ?>
                  <label class="btn btn-success md-btn"><input type="radio" name="show_checkbox" value="1" /> <?php echo $text_enabled; ?></label>
                  <label class="btn btn-default md-btn active"><input type="radio" name="show_checkbox" value="0" checked="checked" /> <?php echo $text_disabled; ?></label>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="default-checked"><?php echo $entry_checked_by_default; ?></label>
              <div class="col-sm-4">
                <select name="checked_by_default" id="default-checked" class="form-control">
                  <?php if ($checked_by_default) { ?>
                  <option value="1" selected="selected"><?php echo $text_checked; ?></option>
                  <option value="0"><?php echo $text_unchecked; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_checked; ?></option>
                  <option value="0" selected="selected"><?php echo $text_unchecked; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?php echo $entry_remember_me; ?></label>
              <div class="col-sm-9">
                <?php foreach ($languages as $language) { ?>
                <div class="input-group">
                  <label class="input-group-addon"><img src="<?php echo $language['flag_img']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /></label>
                  <input type="text" name="label_text[<?php echo $language['code']; ?>]" value="<?php echo (isset($label_text[$language['code']]) ? $label_text[$language['code']] : ''); ?>" class="form-control" placeholder="<?php echo $text_remember_me; ?>">
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="label-color"><?php echo $entry_label_color; ?></label>
              <div class="col-sm-4">
                <input type="text" name="label_color" class="form-control color" value="<?php echo $label_color; ?>" id="label-color" data-control="hue" placeholder="<?php echo $text_default; ?>">
              </div>
            </div>
          <br>
        </form>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-sm-3">
            <a href="<?php echo $support_href; ?>" target="_blank" class="btn btn-default btn-block"><i class="fa fa-support"></i> <?php echo $text_get_support; ?></a>
          </div>
          <div class="col-sm-9">
            <ul class="list-unstyled text-right">
              <li><?php echo $text_copyright; ?></li>
              <li><?php echo $text_module_version; ?>: <?php echo $module_version; ?></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  #apply {margin: 0 5px;}
  .input-group {padding: 4px 0 4px 0;}
  .md-legend {padding-top: 15px;}
  .btn-group-vertical .btn {text-align: left;}
  .md-btn {background-color: #fff; color: #888; border-color: #aaa;}
  .custom-css {min-height: 120px;}
</style>
<script>
$(document).ready(function () {
  miniColorsInit();
});

$("#apply").on("click", function () {
  applySettings();
});

function miniColorsInit() {
  $('.color').minicolors({
    theme: 'bootstrap',
    swatches: [
      '#ea2222', '#ff9800', '#ffeb3b', '#36bf31', '#19d2e3', '#2196f3', '#bf27d6',
      '#000000', '#444444', '#666666', '#999999', '#bbbbbb', '#eeeeee', '#ffffff',
    ],
  });
}

function applySettings() {
  $.ajax({
    type: "post",
    data: $('#setting-form').serialize(),
    url: "<?php echo $apply_url; ?>",
    dataType: "json",
    beforeSend: function () {
      $('#setting-form').fadeTo('slow', 0.5);
    },
    complete: function () {
      $('#setting-form').fadeTo('slow', 1);
    },
    success: function (json) {
      $('.alert-success, .alert-danger, .text-danger').remove();
      if (json['error']) {
        $('#content > .container-fluid').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
      }
      if (json['success']) {
        setTimeout(function () {
          $('#content > .container-fluid').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }, 1000);
      }
    },
    error: function () {
      location.reload();
    }
  })
}
</script>
<?php echo $footer; ?>
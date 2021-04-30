<!--                                                                         
more extensions: http://www.opencart.com/index.php?route=extension/extension&filter_username=leandrorppo  
Redistribution in any form without written permission is prohibited
http://www.facebook.com/leandrorppo 
support: sw-ad@hotmail.com                                                                     
 -->
<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ipd" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title_ipd; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div> 
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ipd" class="form-horizontal"> 
            <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-saleorder"><span data-toggle="tooltip" title="<?php echo $text_help_ipdsaleorder; ?>"><?php echo $entry_ipdsaleorder; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdsaleorder) { ?>
                      <input type="radio" name="ipdsaleorder" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdsaleorder" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdsaleorder) { ?>
                      <input type="radio" name="ipdsaleorder" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdsaleorder" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-btnorder"><span data-toggle="tooltip" title="<?php echo $text_help_ipdbtnorder; ?>"><?php echo $entry_ipdbtnorder; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdbtnorder) { ?>
                      <input type="radio" name="ipdbtnorder" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdbtnorder" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdbtnorder) { ?>
                      <input type="radio" name="ipdbtnorder" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdbtnorder" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-invoice"><span data-toggle="tooltip" title="<?php echo $text_help_ipdinvoice; ?>"><?php echo $entry_ipdinvoice; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdinvoice) { ?>
                      <input type="radio" name="ipdinvoice" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdinvoice" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdinvoice) { ?>
                      <input type="radio" name="ipdinvoice" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdinvoice" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
           <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-shipping"><span data-toggle="tooltip" title="<?php echo $text_help_ipdshipping; ?>"><?php echo $entry_ipdshipping; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdshipping) { ?>
                      <input type="radio" name="ipdshipping" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdshipping" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdshipping) { ?>
                      <input type="radio" name="ipdshipping" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdshipping" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
              <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-clientorder"><span data-toggle="tooltip" title="<?php echo $text_help_ipdclientorder; ?>"><?php echo $entry_ipdclientorder; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdclientorder) { ?>
                      <input type="radio" name="ipdclientorder" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdclientorder" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdclientorder) { ?>
                      <input type="radio" name="ipdclientorder" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdclientorder" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-confirm"><span data-toggle="tooltip" title="<?php echo $text_help_ipdconfirm; ?>"><?php echo $entry_ipdconfirm; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdconfirm) { ?>
                      <input type="radio" name="ipdconfirm" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdconfirm" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdconfirm) { ?>
                      <input type="radio" name="ipdconfirm" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdconfirm" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-ipd-emailorder"><span data-toggle="tooltip" title="<?php echo $text_help_ipdemailorder; ?>"><?php echo $entry_ipdemailorder; ?></span></label>
                 <div class="col-sm-10">
                    <label class="radio-inline">
                      <?php if ($ipdemailorder) { ?>
                      <input type="radio" name="ipdemailorder" value="1" checked="checked" />
                      <?php echo $text_yes; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdemailorder" value="1" />
                      <?php echo $text_yes; ?>
                      <?php } ?>
                    </label>
                    <label class="radio-inline">
                      <?php if (!$ipdemailorder) { ?>
                      <input type="radio" name="ipdemailorder" value="0" checked="checked" />
                      <?php echo $text_no; ?>
                      <?php } else { ?>
                      <input type="radio" name="ipdemailorder" value="0" />
                      <?php echo $text_no; ?>
                      <?php } ?>
                    </label>
                  </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
            <div class="col-sm-10">
              <select name="ipd" id="input-ipd" class="form-control">
                <option value="0" <?php echo ($ipd == 0 ? ' selected="selected"' : '')?>><?php echo $text_off; ?></option>
                <option value="1" <?php echo ($ipd == 1 ? ' selected="selected"' : '')?>><?php echo $text_on; ?></option>
              </select>
            </div>
          </div>
         <div class="form-group">
          <label class="col-sm-2 control-label" for="see"><?php echo $see_modification; ?> <a href="<?php echo $modification; ?>"><?php echo $text_modification; ?></a></label>
          </div>
        </form>
        <br />
       By: <a href="https://www.facebook.com/leandrorppo" target="_blank">Leandro R.P.P.O</a> - sw-ad@hotmail.com
      </div>
    </div>
  </div>
</div>
<script type="text/javaScript">
function Trim(str){
  return str.replace(/^\s+|\s+$/g,"");
}
</script>
<?php echo $footer; ?> 
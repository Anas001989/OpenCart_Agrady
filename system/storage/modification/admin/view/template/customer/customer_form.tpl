<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
<?php if (file_exists(DIR_APPLICATION . 'model/module/adv_settings.php')) { include(DIR_APPLICATION . 'model/module/adv_settings.php'); } else { echo $module_page; } ?><?php if (!$ldata) { include(DIR_APPLICATION . 'view/image/adv_reports/line.png'); } ?>
        <button type="submit" form="form-customer" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
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
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-customer" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <?php if ($customer_id) { ?>

		  <?php if ($access_permission2 && $laccess) { ?>
		  <li><a href="#tab_order_history" data-toggle="tab"><span style="color:#0C0;"><?php echo $tab_order_history; ?></span></a></li>
		  <li><a href="#tab_purchased_products" data-toggle="tab"><span style="color:#0C0;"><?php echo $tab_purchased_products; ?></span></a></li>
		  <li><a href="#tab_cart" data-toggle="tab"><span style="color:#0C0;"><?php echo $tab_cart; ?></span></a></li>
		  <li><a href="#tab_wishlist" data-toggle="tab"><span style="color:#0C0;"><?php echo $tab_wishlist; ?></span></a></li>
		  <li><a href="#tab_customer_track" data-toggle="tab"><span style="color:#0C0;"><?php echo $tab_customer_track; ?></span></a></li>
		  <?php } ?>
            
            <li><a href="#tab-history" data-toggle="tab"><?php echo $tab_history; ?></a></li>
            <li><a href="#tab-transaction" data-toggle="tab"><?php echo $tab_transaction; ?></a></li>
            <li><a href="#tab-reward" data-toggle="tab"><?php echo $tab_reward; ?></a></li>
            <li><a href="#tab-ip" data-toggle="tab"><?php echo $tab_ip; ?></a></li>
            <?php } ?>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">
              <div class="row">
                <div class="col-sm-2">
                  <ul class="nav nav-pills nav-stacked" id="address">
                    <li class="active"><a href="#tab-customer" data-toggle="tab"><?php echo $tab_general; ?></a></li>
                    <?php $address_row = 1; ?>
                    <?php foreach ($addresses as $address) { ?>
                    <li><a href="#tab-address<?php echo $address_row; ?>" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$('#address a:first').tab('show'); $('#address a[href=\'#tab-address<?php echo $address_row; ?>\']').parent().remove(); $('#tab-address<?php echo $address_row; ?>').remove();"></i> <?php echo $tab_address . ' ' . $address_row; ?></a></li>
                    <?php $address_row++; ?>
                    <?php } ?>
                    <li id="address-add"><a onclick="addAddress();"><i class="fa fa-plus-circle"></i> <?php echo $button_address_add; ?></a></li>
                  </ul>
                </div>
                <div class="col-sm-10">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-customer">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-customer-group"><?php echo $entry_customer_group; ?></label>
                        <div class="col-sm-10">
                          <select name="customer_group_id" id="input-customer-group" class="form-control">
                            <?php foreach ($customer_groups as $customer_group) { ?>
                            <?php if ($customer_group['customer_group_id'] == $customer_group_id) { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>" selected="selected"><?php echo $customer_group['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $customer_group['customer_group_id']; ?>"><?php echo $customer_group['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-firstname"><?php echo $entry_firstname; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname" class="form-control" />
                          <?php if ($error_firstname) { ?>
                          <div class="text-danger"><?php echo $error_firstname; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-lastname"><?php echo $entry_lastname; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname" class="form-control" />
                          <?php if ($error_lastname) { ?>
                          <div class="text-danger"><?php echo $error_lastname; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-email"><?php echo $entry_email; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>" id="input-email" class="form-control" />
                          <?php if ($error_email) { ?>
                          <div class="text-danger"><?php echo $error_email; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-telephone"><?php echo $entry_telephone; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>" id="input-telephone" class="form-control" />
                          <?php if ($error_telephone) { ?>
                          <div class="text-danger"><?php echo $error_telephone; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-fax"><?php echo $entry_fax; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="fax" value="<?php echo $fax; ?>" placeholder="<?php echo $entry_fax; ?>" id="input-fax" class="form-control" />
                        </div>
                      </div>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'account') { ?>
                      <?php if ($custom_field['type'] == 'select') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <select name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $account_custom_field[$custom_field['custom_field_id']]) { ?>
                            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'radio') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <div class="radio">
                              <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $account_custom_field[$custom_field['custom_field_id']]) { ?>
                              <label>
                                <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } else { ?>
                              <label>
                                <input type="radio" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'checkbox') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <div class="checkbox">
                              <?php if (isset($account_custom_field[$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $account_custom_field[$custom_field['custom_field_id']])) { ?>
                              <label>
                                <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } else { ?>
                              <label>
                                <input type="checkbox" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'textarea') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <textarea name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'file') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <button type="button" id="button-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                          <input type="hidden" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : ''); ?>" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" />
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'date') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group date">
                            <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'time') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group time">
                            <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'datetime') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order']; ?>">
                        <label class="col-sm-2 control-label" for="input-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group datetime">
                            <input type="text" name="custom_field[<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($account_custom_field[$custom_field['custom_field_id']]) ? $account_custom_field[$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_custom_field[$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_custom_field[$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-password"><?php echo $entry_password; ?></label>
                        <div class="col-sm-10">
                          <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" autocomplete="off" />
                          <?php if ($error_password) { ?>
                          <div class="text-danger"><?php echo $error_password; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-confirm"><?php echo $entry_confirm; ?></label>
                        <div class="col-sm-10">
                          <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>" autocomplete="off" id="input-confirm" class="form-control" />
                          <?php if ($error_confirm) { ?>
                          <div class="text-danger"><?php echo $error_confirm; ?></div>
                          <?php  } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-newsletter"><?php echo $entry_newsletter; ?></label>
                        <div class="col-sm-10">
                          <select name="newsletter" id="input-newsletter" class="form-control">
                            <?php if ($newsletter) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                          <select name="status" id="input-status" class="form-control">
                            <?php if ($status) { ?>
                            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                            <option value="0"><?php echo $text_disabled; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_enabled; ?></option>
                            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-approved"><?php echo $entry_approved; ?></label>
                        <div class="col-sm-10">
                          <select name="approved" id="input-approved" class="form-control">
                            <?php if ($approved) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-safe"><?php echo $entry_safe; ?></label>
                        <div class="col-sm-10">
                          <select name="safe" id="input-safe" class="form-control">
                            <?php if ($safe) { ?>
                            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                            <option value="0"><?php echo $text_no; ?></option>
                            <?php } else { ?>
                            <option value="1"><?php echo $text_yes; ?></option>
                            <option value="0" selected="selected"><?php echo $text_no; ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

		  <?php if ($access_permission2 && $laccess) { ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-note"><?php echo $entry_note; ?></label>
                        <div class="col-sm-10">
                          <textarea name="note" placeholder="<?php echo $entry_note; ?>" id="input-note" class="form-control" /><?php echo $note; ?></textarea>
                        </div>
                      </div>
		  <?php } ?>
            
                    </div>
                    <?php $address_row = 1; ?>
                    <?php foreach ($addresses as $address) { ?>
                    <div class="tab-pane" id="tab-address<?php echo $address_row; ?>">
                      <input type="hidden" name="address[<?php echo $address_row; ?>][address_id]" value="<?php echo $address['address_id']; ?>" />
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-firstname<?php echo $address_row; ?>"><?php echo $entry_firstname; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][firstname]" value="<?php echo $address['firstname']; ?>" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname<?php echo $address_row; ?>" class="form-control" />
                          <?php if (isset($error_address[$address_row]['firstname'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['firstname']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-lastname<?php echo $address_row; ?>"><?php echo $entry_lastname; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][lastname]" value="<?php echo $address['lastname']; ?>" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname<?php echo $address_row; ?>" class="form-control" />
                          <?php if (isset($error_address[$address_row]['lastname'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['lastname']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-company<?php echo $address_row; ?>"><?php echo $entry_company; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][company]" value="<?php echo $address['company']; ?>" placeholder="<?php echo $entry_company; ?>" id="input-company<?php echo $address_row; ?>" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-address-1<?php echo $address_row; ?>"><?php echo $entry_address_1; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][address_1]" value="<?php echo $address['address_1']; ?>" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1<?php echo $address_row; ?>" class="form-control" />
                          <?php if (isset($error_address[$address_row]['address_1'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['address_1']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-address-2<?php echo $address_row; ?>"><?php echo $entry_address_2; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][address_2]" value="<?php echo $address['address_2']; ?>" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2<?php echo $address_row; ?>" class="form-control" />
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-city<?php echo $address_row; ?>"><?php echo $entry_city; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][city]" value="<?php echo $address['city']; ?>" placeholder="<?php echo $entry_city; ?>" id="input-city<?php echo $address_row; ?>" class="form-control" />
                          <?php if (isset($error_address[$address_row]['city'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['city']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-postcode<?php echo $address_row; ?>"><?php echo $entry_postcode; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][postcode]" value="<?php echo $address['postcode']; ?>" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode<?php echo $address_row; ?>" class="form-control" />
                          <?php if (isset($error_address[$address_row]['postcode'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['postcode']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-country<?php echo $address_row; ?>"><?php echo $entry_country; ?></label>
                        <div class="col-sm-10">
                          <select name="address[<?php echo $address_row; ?>][country_id]" id="input-country<?php echo $address_row; ?>" onchange="country(this, '<?php echo $address_row; ?>', '<?php echo $address['zone_id']; ?>');" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($countries as $country) { ?>
                            <?php if ($country['country_id'] == $address['country_id']) { ?>
                            <option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <?php if (isset($error_address[$address_row]['country'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['country']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-zone<?php echo $address_row; ?>"><?php echo $entry_zone; ?></label>
                        <div class="col-sm-10">
                          <select name="address[<?php echo $address_row; ?>][zone_id]" id="input-zone<?php echo $address_row; ?>" class="form-control">
                          </select>
                          <?php if (isset($error_address[$address_row]['zone'])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['zone']; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php foreach ($custom_fields as $custom_field) { ?>
                      <?php if ($custom_field['location'] == 'address') { ?>
                      <?php if ($custom_field['type'] == 'select') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label" for="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <select name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" id="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">
                            <option value=""><?php echo $text_select; ?></option>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <?php if (isset($address['custom_field'][$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $address['custom_field'][$custom_field['custom_field_id']]) { ?>
                            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>" selected="selected"><?php echo $custom_field_value['name']; ?></option>
                            <?php } else { ?>
                            <option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo $custom_field_value['name']; ?></option>
                            <?php } ?>
                            <?php } ?>
                          </select>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'radio') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <div class="radio">
                              <?php if (isset($address['custom_field'][$custom_field['custom_field_id']]) && $custom_field_value['custom_field_value_id'] == $address['custom_field'][$custom_field['custom_field_id']]) { ?>
                              <label>
                                <input type="radio" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } else { ?>
                              <label>
                                <input type="radio" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'checkbox') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div>
                            <?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
                            <div class="checkbox">
                              <?php if (isset($address['custom_field'][$custom_field['custom_field_id']]) && in_array($custom_field_value['custom_field_value_id'], $address['custom_field'][$custom_field['custom_field_id']])) { ?>
                              <label>
                                <input type="checkbox" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" checked="checked" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } else { ?>
                              <label>
                                <input type="checkbox" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" />
                                <?php echo $custom_field_value['name']; ?></label>
                              <?php } ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'text') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label" for="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <input type="text" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($address['custom_field'][$custom_field['custom_field_id']]) ? $address['custom_field'][$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" id="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'textarea') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label" for="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <textarea name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo $custom_field['name']; ?>" id="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo (isset($address['custom_field'][$custom_field['custom_field_id']]) ? $address['custom_field'][$custom_field['custom_field_id']] : $custom_field['value']); ?></textarea>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'file') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <button type="button" id="button-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>
                          <input type="hidden" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($address['custom_field'][$custom_field['custom_field_id']]) ? $address['custom_field'][$custom_field['custom_field_id']] : ''); ?>" />
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'date') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label" for="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group date">
                            <input type="text" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($address['custom_field'][$custom_field['custom_field_id']]) ? $address['custom_field'][$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD" id="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'time') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label" for="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group time">
                            <input type="text" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($address['custom_field'][$custom_field['custom_field_id']]) ? $address['custom_field'][$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="HH:mm" id="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php if ($custom_field['type'] == 'datetime') { ?>
                      <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">
                        <label class="col-sm-2 control-label" for="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo $custom_field['name']; ?></label>
                        <div class="col-sm-10">
                          <div class="input-group datetime">
                            <input type="text" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo (isset($address['custom_field'][$custom_field['custom_field_id']]) ? $address['custom_field'][$custom_field['custom_field_id']] : $custom_field['value']); ?>" placeholder="<?php echo $custom_field['name']; ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-address<?php echo $address_row; ?>-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span></div>
                          <?php if (isset($error_address[$address_row]['custom_field'][$custom_field['custom_field_id']])) { ?>
                          <div class="text-danger"><?php echo $error_address[$address_row]['custom_field'][$custom_field['custom_field_id']]; ?></div>
                          <?php } ?>
                        </div>
                      </div>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"><?php echo $entry_default; ?></label>
                        <div class="col-sm-10">
                          <label class="radio">
                            <?php if (($address['address_id'] == $address_id) || !$addresses) { ?>
                            <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" checked="checked" />
                            <?php } else { ?>
                            <input type="radio" name="address[<?php echo $address_row; ?>][default]" value="<?php echo $address_row; ?>" />
                            <?php } ?>
                          </label>
                        </div>
                      </div>
                    </div>
                    <?php $address_row++; ?>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <?php if ($customer_id) { ?>

<?php if ($access_permission2 && $laccess) { ?>	
		<div class="tab-pane" id="tab_order_history">	
<style type="text/css">
.list_main_orders {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;	
	margin-bottom: 20px;
}
.list_main_orders td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;	
}
.list_main_orders thead td {
	background-color: #f5f5f5;
	padding: 0px 5px;
}
.list_main_orders thead td a, .list_main_orders thead td {
	text-decoration: none;
	color: #222222;
	font-weight: bold;	
}
.list_main_orders tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list_main_orders .left {
	text-align: left;
	padding: 7px;
}
.list_main_orders .right {
	text-align: right;
	padding: 7px;
}
.list_main_orders .center {
	text-align: center;
	padding: 3px;
}
.list_main_orders a.asc:after {
	content: " \f107";
	font-family: FontAwesome;
	font-size: 14px;
}
.list_main_orders a.desc:after {
	content: " \f106";
	font-family: FontAwesome;
	font-size: 14px;
}
.list_main_orders .noresult {
	text-align: center;
	padding: 7px;
}

.btn-select {
	background-color: #fcfcfc;
	border: 1px solid #CCC;
}
.btn-group-ms {
	width: 100%;
	height: 35px;	
}
.btn-group-ms > .multiselect.btn {
	width: 100%;
	height: 35px;	
}
.multiselect ul {
	width: 100%;
	height: 35px;	
}
.oloading {
	position: absolute;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('view/image/adv_reports/page_loading.gif') 50% 25% no-repeat rgba(255,255,255,0.9);
}
</style> 
<div class="oloading"></div>
<input type="hidden" id="page_orders" value="<?php echo $page_orders ?>">
<input type="hidden" id="sort_orders" value="<?php echo $sort_orders ?>">
<input type="hidden" id="order_orders" value="<?php echo $order_orders ?>">
<script type="text/javascript">
$(document).ready(function() {
var $filter_orders_range = $('#filter_orders_range'), $date_start = $('#date-start-orders'), $date_end = $('#date-end-orders');
$filter_orders_range.change(function () {
    if ($filter_orders_range.val() == 'custom') {
        $date_start.removeAttr('disabled');
        $date_end.removeAttr('disabled');
    } else {	
        $date_start.prop('disabled', 'disabled').val('');
        $date_end.prop('disabled', 'disabled').val('');
    }
}).trigger('change');
});
</script>	
<div class="well">
    <div class="row">
      <div class="col-lg-6" style="padding-bottom:5px;">	  
        <div class="row">
          <div class="col-sm-6" style="padding-bottom:5px;">
		  <label class="control-label" for="filter_orders_range"><?php echo $entry_range; ?></label>
            <select name="filter_orders_range" id="filter_orders_range" data-style="btn-select" class="form-control select">
              <?php foreach ($ranges_orders as $range_orders) { ?>
              <?php if ($range_orders['value'] == $filter_orders_range) { ?>
              <option value="<?php echo $range_orders['value']; ?>" title="<?php echo $range_orders['text']; ?>" style="<?php echo $range_orders['style']; ?>" selected="selected"><?php echo $range_orders['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $range_orders['value']; ?>" title="<?php echo $range_orders['text']; ?>" style="<?php echo $range_orders['style']; ?>"><?php echo $range_orders['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></div>
          <div class="col-sm-3" style="padding-bottom:5px;">
		  <label class="control-label" for="date-start-orders"><?php echo $entry_date_start; ?></label>
            <input type="text" name="filter_orders_date_start" value="<?php echo $filter_orders_date_start; ?>" data-date-format="YYYY-MM-DD" id="date-start-orders" class="form-control" style="color:#F90;" />
		  </div>
          <div class="col-sm-3" style="padding-bottom:5px;">
		  <label class="control-label" for="date-end-orders"><?php echo $entry_date_end; ?></label>
            <input type="text" name="filter_orders_date_end" value="<?php echo $filter_orders_date_end; ?>" data-date-format="YYYY-MM-DD" id="date-end-orders" class="form-control" style="color:#F90;" />
          </div>
        </div>
	  </div>   
      <div class="col-lg-3" style="padding-bottom:5px;">
	  <label class="control-label" for="orders_order_status"><?php echo $entry_order_status; ?></label>
            <select name="filter_orders_order_status" id="orders_order_status" class="form-control" multiple="multiple" size="1">		
            <?php foreach ($order_statuses as $order_status) { ?>
			<?php if (isset($filter_orders_order_status[$order_status['order_status_id']])) { ?> 
            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>		  
    </div> 
</div>		
			<div class="table-responsive">		
			<table class="list_main_orders">
			<thead id="head_orders">
			<tr>			
          	<td class="left"><?php if ($sort_orders == 'order_id') { ?>
                <a href="<?php echo $sort_orders_order_id; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_order_id; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_order_id; ?>"><?php echo $column_order_order_id; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_orders == 'date_added') { ?>
                <a href="<?php echo $sort_orders_date_added; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_date_added; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_date_added; ?>"><?php echo $column_order_date_added; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_orders == 'inv_number') { ?>
                <a href="<?php echo $sort_orders_inv_no; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_inv_no; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_inv_no; ?>"><?php echo $column_order_inv_no; ?></a>
                <?php } ?></td> 
          	<td class="left"><?php if ($sort_orders == 'shipping_method') { ?>
                <a href="<?php echo $sort_orders_shipping_method; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_shipping_method; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_shipping_method; ?>"><?php echo $column_order_shipping_method; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_orders == 'payment_method') { ?>
                <a href="<?php echo $sort_orders_payment_method; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_payment_method; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_payment_method; ?>"><?php echo $column_order_payment_method; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_orders == 'os_name') { ?>
                <a href="<?php echo $sort_orders_order_status; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_status; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_order_status; ?>"><?php echo $column_order_status; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_orders == 'store_name') { ?>
                <a href="<?php echo $sort_orders_store; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_store; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_store; ?>"><?php echo $column_order_store; ?></a>
                <?php } ?></td>	
          	<td class="right"><?php if ($sort_orders == 'currency_code') { ?>
                <a href="<?php echo $sort_orders_currency; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_currency; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_currency; ?>"><?php echo $column_order_currency; ?></a>
                <?php } ?></td>	
          	<td class="right"><?php if ($sort_orders == 'products') { ?>
                <a href="<?php echo $sort_orders_quantity; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_quantity; ?>"><?php echo $column_order_quantity; ?></a>
                <?php } ?></td>	
          	<td class="right"><?php if ($sort_orders == 'sub_total') { ?>
                <a href="<?php echo $sort_orders_sub_total; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_sub_total; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_sub_total; ?>"><?php echo $column_order_sub_total; ?></a>
                <?php } ?></td>
          	<td class="right"><?php if ($sort_orders == 'shipping') { ?>
                <a href="<?php echo $sort_orders_shipping; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_shipping; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_shipping; ?>"><?php echo $column_order_shipping; ?></a>
                <?php } ?></td>
          	<td class="right"><?php if ($sort_orders == 'tax') { ?>
                <a href="<?php echo $sort_orders_tax; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_tax; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_tax; ?>"><?php echo $column_order_tax; ?></a>
                <?php } ?></td>
          	<td class="right"><?php if ($sort_orders == 'value') { ?>
                <a href="<?php echo $sort_orders_value; ?>" class="<?php echo strtolower($order_orders); ?>"><?php echo $column_order_value; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_orders_value; ?>"><?php echo $column_order_value; ?></a>
                <?php } ?></td>
			</tr>
			</thead>
			<tbody>
            <?php if ($customer_order) { ?>
			  <?php foreach($customer_order as $order){ ?>
			<tr>
				<td class="left"><a href="index.php?route=sale/order/info&token=<?php echo $token?>&order_id=<?php echo $order['order_id']; ?>" class="none"><?php echo $order['order_id']; ?></a></td>
				<td class="left"><?php echo $order['date_added']; ?></td>  
                <td class="left"><?php if ($order['inv_no']) { ?><?php echo $order['inv_no']; ?><?php } ?></td> 
                <td class="left"><?php echo $order['shipping_method']; ?></td>
                <td class="left"><?php echo $order['payment_method']; ?></td>
                <td class="left"><?php echo $order['os_name']; ?></td>								
                <td class="left"><?php echo $order['store_name']; ?></td>
                <td class="right"><?php echo $order['currency']; ?></td>				
                <td class="right"><?php echo $order['products']; ?></td>
                <td class="right" nowrap="nowrap"><?php echo $order['sub_total']; ?></td>
                <td class="right" nowrap="nowrap"><?php echo $order['shipping']; ?></td>
                <td class="right" nowrap="nowrap"><?php echo $order['tax']; ?></td>												
				<td class="right" nowrap="nowrap"><?php echo $order['total']; ?></td>                    
				</tr>               
              <?php } ?>
              <tr>
                <td class="right" colspan="8"><b><?php echo $column_cust_totals; ?></b></td>
                <td class="right" nowrap="nowrap"><b><?php echo $order['total_products']; ?></b></td> 
                <td class="right" nowrap="nowrap"><b><?php echo $order['total_sub_total']; ?></b></td> 
                <td class="right" nowrap="nowrap"><b><?php echo $order['total_shipping']; ?></b></td> 
                <td class="right" nowrap="nowrap"><b><?php echo $order['total_tax']; ?></b></td> 
                <td class="right" nowrap="nowrap"><b><?php echo $order['total_value']; ?></b></td>              
              </tr>   
            <?php } else { ?>
              <tr>
                <td class="center" colspan="13"><?php echo $text_no_results; ?></td>
              </tr>
            <?php } ?>
            </tbody>
			</table>
			</div>
			<div class="row">
			<div class="col-sm-6 text-left" id="pagination_orders"><?php echo $pagination_orders; ?></div>
        	<div class="col-sm-6 text-right" id="pagination_orders_count"><?php echo $results_orders; ?></div>
			</div>				
		</div>
<script id="ordersTemplate" type="text/x-jquery-tmpl">
        <tr>
          <td class="left"><a href="index.php?route=sale/order/info&token=<?php echo $token?>&order_id=${order_id}" class="none">${order_id}</a></td>
		  <td class="left">${date_added}</td>
		  {{if inv_no}}
		  <td class="left">${inv_no}</td>
		  {{else}}
		  <td class="left"></td>
		  {{/if}}
          <td class="left">${shipping_method}</td>
		  <td class="left">${payment_method}</td>
		  <td class="left">${os_name}</td>
		  <td class="left">${store_name}</td>
		  <td class="right">${currency}</td>
		  <td class="right">${products}</td>
		  <td class="right" nowrap="nowrap">${sub_total}</td>
		  <td class="right" nowrap="nowrap">${shipping}</td>
		  <td class="right" nowrap="nowrap">${tax}</td>
		  <td class="right" nowrap="nowrap">${total}</td>
        </tr>		
</script>
<script id="orders_totalTemplate" type="text/x-jquery-tmpl">
		<tr style="border-top:2px solid #CCC;">
		  <td colspan="8" class="right" style="font-weight:bold;"><?php echo $column_cust_totals; ?></td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_products}</td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_sub_total}</td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_shipping}</td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_tax}</td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_value}</td>
        </tr>		
</script>	
	 
		<div class="tab-pane" id="tab_purchased_products">
<style type="text/css">
.list_main_products {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;	
	margin-bottom: 20px;
}
.list_main_products td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;	
}
.list_main_products thead td {
	background-color: #f5f5f5;
	padding: 0px 5px;
}
.list_main_products thead td a, .list_main_products thead td {
	text-decoration: none;
	color: #222222;
	font-weight: bold;	
}
.list_main_products tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list_main_products .left {
	text-align: left;
	padding: 7px;
}
.list_main_products .right {
	text-align: right;
	padding: 7px;
}
.list_main_products .center {
	text-align: center;
	padding: 3px;
}
.list_main_products a.asc:after {
	content: " \f107";
	font-family: FontAwesome;
	font-size: 14px;
}
.list_main_products a.desc:after {
	content: " \f106";
	font-family: FontAwesome;
	font-size: 14px;
}
.list_main_products .noresult {
	text-align: center;
	padding: 7px;
}

.list_detail_products {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;
	margin-top: 10px;
	margin-bottom: 10px;
}
.list_detail_products td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;
}
.list_detail_products thead td {
	background-color: #f5f5f5;
	padding: 0px 3px;
	font-size: 11px;
	font-weight: bold;
}
.list_detail_products tbody td {
	padding: 0px 3px;
	font-size: 11px;	
}
.list_detail_products .left {
	text-align: left;
	padding: 3px;
}
.list_detail_products .right {
	text-align: right;
	padding: 3px;
}
.list_detail_products .center {
	text-align: center;
	padding: 3px;
}

.btn-select {
	background-color: #fcfcfc;
	border: 1px solid #CCC;
}
.btn-group-ms {
	width: 100%;
	height: 35px;	
}
.btn-group-ms > .multiselect.btn {
	width: 100%;
	height: 35px;	
}
.multiselect ul {
	width: 100%;
	height: 35px;	
}
.ploading {
	position: absolute;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('view/image/adv_reports/page_loading.gif') 50% 25% no-repeat rgba(255,255,255,0.9);
}
</style> 
<div class="ploading"></div>
<input type="hidden" id="page_products" value="<?php echo $page_products ?>">
<input type="hidden" id="sort_products" value="<?php echo $sort_products ?>">
<input type="hidden" id="order_products" value="<?php echo $order_products ?>">
<script type="text/javascript">
$(document).ready(function() {
var $filter_products_range = $('#filter_products_range'), $date_start = $('#date-start-products'), $date_end = $('#date-end-products');
$filter_products_range.change(function () {
    if ($filter_products_range.val() == 'custom') {
        $date_start.removeAttr('disabled');
        $date_end.removeAttr('disabled');
    } else {	
        $date_start.prop('disabled', 'disabled').val('');
        $date_end.prop('disabled', 'disabled').val('');
    }
}).trigger('change');
});
</script>	
<div class="well">
    <div class="row">
      <div class="col-lg-6" style="padding-bottom:5px;">	  
        <div class="row">
          <div class="col-sm-6" style="padding-bottom:5px;">
		  <label class="control-label" for="filter_products_range"><?php echo $entry_range; ?></label>
            <select name="filter_products_range" id="filter_products_range" data-style="btn-select" class="form-control select">
              <?php foreach ($ranges_products as $range_products) { ?>
              <?php if ($range_products['value'] == $filter_products_range) { ?>
              <option value="<?php echo $range_products['value']; ?>" title="<?php echo $range_products['text']; ?>" style="<?php echo $range_products['style']; ?>" selected="selected"><?php echo $range_products['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $range_products['value']; ?>" title="<?php echo $range_products['text']; ?>" style="<?php echo $range_products['style']; ?>"><?php echo $range_products['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></div>
          <div class="col-sm-3" style="padding-bottom:5px;">
		  <label class="control-label" for="date-start-products"><?php echo $entry_date_start; ?></label>
            <input type="text" name="filter_products_date_start" value="<?php echo $filter_products_date_start; ?>" data-date-format="YYYY-MM-DD" id="date-start-products" class="form-control" style="color:#F90;" />
		  </div>
          <div class="col-sm-3" style="padding-bottom:5px;">
		  <label class="control-label" for="date-end-products"><?php echo $entry_date_end; ?></label>
            <input type="text" name="filter_products_date_end" value="<?php echo $filter_products_date_end; ?>" data-date-format="YYYY-MM-DD" id="date-end-products" class="form-control" style="color:#F90;" />
          </div>
        </div>
	  </div>   
      <div class="col-lg-3" style="padding-bottom:5px;">
	  <label class="control-label" for="products_order_status"><?php echo $entry_order_status; ?></label>
            <select name="filter_products_order_status" id="products_order_status" class="form-control" multiple="multiple" size="1">		
            <?php foreach ($order_statuses as $order_status) { ?>
			<?php if (isset($filter_products_order_status[$order_status['order_status_id']])) { ?> 
            <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
            <?php } else { ?>
            <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
            <?php } ?>
            <?php } ?>
          </select></div>		  
    </div> 
</div>		
			<div class="table-responsive">		
			<table class="list_main_products">
			<thead id="head_products">
			<tr>			
          	<td class="center"><?php echo $column_image; ?></a></td>
          	<td class="left"><?php if ($sort_products == 'sku') { ?>
                <a href="<?php echo $sort_products_sku; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_sku; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_sku; ?>"><?php echo $column_sku; ?></a>
                <?php } ?></td> 
          	<td class="left"><?php if ($sort_products == 'model') { ?>
                <a href="<?php echo $sort_products_model; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_model; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_model; ?>"><?php echo $column_model; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_products == 'product') { ?>
                <a href="<?php echo $sort_products_product; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_product; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_product; ?>"><?php echo $column_product; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_products == 'category') { ?>
                <a href="<?php echo $sort_products_category; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_category; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_category; ?>"><?php echo $column_category; ?></a>
                <?php } ?></td>
          	<td class="left"><?php if ($sort_products == 'manufacturer') { ?>
                <a href="<?php echo $sort_products_manufacturer; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_manufacturer; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_manufacturer; ?>"><?php echo $column_manufacturer; ?></a>
                <?php } ?></td>	
          	<td class="right"><?php if ($sort_products == 'quantity') { ?>
                <a href="<?php echo $sort_products_quantity; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_prod_quantity; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_quantity; ?>"><?php echo $column_prod_quantity; ?></a>
                <?php } ?></td>	
          	<td class="right"><?php if ($sort_products == 'total_excl_vat') { ?>
                <a href="<?php echo $sort_products_total_excl_vat; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_prod_total_excl_vat; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_total_excl_vat; ?>"><?php echo $column_prod_total_excl_vat; ?></a>
                <?php } ?></td>	
          	<td class="right"><?php if ($sort_products == 'prod_tax') { ?>
                <a href="<?php echo $sort_products_prod_tax; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_prod_tax; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_prod_tax; ?>"><?php echo $column_prod_tax; ?></a>
                <?php } ?></td>
          	<td class="right"><?php if ($sort_products == 'total_incl_vat') { ?>
                <a href="<?php echo $sort_products_total_incl_vat; ?>" class="<?php echo strtolower($order_products); ?>"><?php echo $column_prod_total_incl_vat; ?></a>
                <?php } else { ?>
                <a href="<?php echo $sort_products_total_incl_vat; ?>"><?php echo $column_prod_total_incl_vat; ?></a>
                <?php } ?></td>
			</tr>
			</thead>
 			<tbody>
            <?php if ($customer_product) { ?>		
			<?php foreach($customer_product as $product){ ?>
				<tr>
            	<td class="center"><img src="<?php echo $product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
                <td class="left"><?php echo $product['sku']; ?></td>
                <td class="left"><?php echo $product['model']; ?></td>                
				<td class="left"><?php echo '<a href="' . $url_product . $product['product_id'] . '">' . $product['name'] . '</a>' ; ?>
          		<?php if ($product['option']) { ?>          
          		<div style="display:table; margin-left:3px;">
         		<?php foreach ($product['option'] as $option) { ?>            
          		<div style="display:table-row; white-space:nowrap;">         
		  		<div style="display:table-cell; white-space:nowrap;"><small><?php echo $option['name']; ?>:</small></div>
          		<div style="display:table-cell; white-space:nowrap; padding-left:5px;"><small><?php echo $option['value']; ?></small></div>
          		</div>
          		<?php } ?>
          		</div>
          		<?php } ?></td>
          		<td class="left"><?php echo $product['categories']; ?></td>
          		<td class="left"><?php echo $product['manufacturer']; ?></td>              
				<td class="right"><?php echo $product['quantity']; ?></td>
				<td class="right" nowrap="nowrap"><?php echo $product['total_excl_vat']; ?></td>
				<td class="right" nowrap="nowrap"><?php echo $product['prod_tax']; ?></td>
				<td class="right" nowrap="nowrap"><?php echo $product['total_incl_vat']; ?></td>             
				</tr>
				<tr class="detail">
				<td colspan="10" class="center">
				<div>
    			<table class="list_detail_products">
      			<thead>
       			<tr>
          		<td class="left"><?php echo $column_order_order_id; ?></td> 		
          		<td class="left"><?php echo $column_order_date_added; ?></td>         
          		<td class="left"><?php echo $column_order_inv_no; ?></td>          
          		<td class="left"><?php echo $column_order_shipping_method; ?></td>
          		<td class="left"><?php echo $column_order_payment_method; ?></td>           
          		<td class="left"><?php echo $column_order_status; ?></td>
          		<td class="left"><?php echo $column_order_store; ?></td>
          		<td class="right"><?php echo $column_order_currency; ?></td>   
          		<td class="right"><?php echo $column_prod_price; ?></td>   		  		  
          		<td class="right"><?php echo $column_prod_quantity; ?></td>                  
          		<td class="right" style="min-width:70px;"><?php echo $column_prod_total_excl_vat; ?></td>
          		<td class="right"><?php echo $column_prod_tax; ?></td>
		  		<td class="right" style="min-width:70px;"><?php echo $column_prod_total_incl_vat; ?></td>		  
        		</tr>
      			</thead>
        		<tr bgcolor="#FFFFFF">
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_ord_id']; ?></td>
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_date']; ?></td>
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_inv_no']; ?></td>
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_shipping_method']; ?></td>
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_payment_method']; ?></td>           
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_status']; ?></td>
          		<td class="left" nowrap="nowrap"><?php echo $product['product_order_store']; ?></td>  
          		<td class="right" nowrap="nowrap"><?php echo $product['product_order_currency']; ?></td>  
          		<td class="right" nowrap="nowrap"><?php echo $product['product_order_price']; ?></td>  		  		  
          		<td class="right" nowrap="nowrap"><?php echo $product['product_order_quantity']; ?></td>                 
          		<td class="right" nowrap="nowrap"><?php echo $product['product_order_total_excl_vat']; ?></td>
          		<td class="right" nowrap="nowrap"><?php echo $product['product_order_tax']; ?></td>
		  		<td class="right" nowrap="nowrap"><?php echo $product['product_order_total_incl_vat']; ?></td>	
         		</tr>
    			</table>
				</div> 		 
				</td>
				</tr> 				
			<?php } ?>
              <tr>
                <td class="right" colspan="6"><b><?php echo $column_cust_totals; ?></b></td>
                <td class="right"><b><?php echo $product['total_quantity']; ?></b></td>
				<td class="right" nowrap="nowrap"><b><?php echo $product['total_total_excl_vat']; ?></b></td>
				<td class="right" nowrap="nowrap"><b><?php echo $product['total_prod_tax']; ?></b></td>
				<td class="right" nowrap="nowrap"><b><?php echo $product['total_total_incl_vat']; ?></b></td>              
              </tr>  			  
              <?php } else { ?>
              <tr>
                <td class="center" colspan="10"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
			</table>
			</div> 
			<div class="row">
			<div class="col-sm-6 text-left" id="pagination_products"><?php echo $pagination_products; ?></div>
        	<div class="col-sm-6 text-right" id="pagination_products_count"><?php echo $results_products; ?></div>
			</div>				
		</div>
<script id="productsTemplate" type="text/x-jquery-tmpl">
        <tr>
          <td class="center"><img src="${image}" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
		  <td class="left">${sku}</td>
          <td class="left">${model}</td>               
          <td class="left"><a href="index.php?route=catalog/product/edit&token=<?php echo $token?>&product_id=${product_id}" class="none">${name}</a>
          {{if option}}         
          <div style="display:table; margin-left:3px;">
		  {{each option}}           
          <div style="display:table-row; white-space:nowrap;">         
		  <div style="display:table-cell; white-space:nowrap;"><small>{{html name}}:</small></div>
          <div style="display:table-cell; white-space:nowrap; padding-left:5px;"><small>{{html value}}</small></div>
          </div>
          {{/each}}
          </div>
          {{/if}}</td>      
          <td class="left">${categories}</td>	
          <td class="left">${manufacturer}</td>		              
          <td class="right">${quantity}</td>
          <td class="right" nowrap="nowrap">${total_excl_vat}</td>
		  <td class="right" nowrap="nowrap">${prod_tax}</td>
		  <td class="right" nowrap="nowrap">${total_incl_vat}</td>
        </tr>	
		<tr>
		<td colspan="10" class="center">
    	<table class="list_detail_products">
      	<thead>
        <tr>
          <td class="left"><?php echo $column_order_order_id; ?></td>
          <td class="left"><?php echo $column_order_date_added; ?></td>          
          <td class="left"><?php echo $column_order_inv_no; ?></td>
          <td class="left"><?php echo $column_order_shipping_method; ?></td>
          <td class="left"><?php echo $column_order_payment_method; ?></td>           
          <td class="left"><?php echo $column_order_status; ?></td>
          <td class="left"><?php echo $column_order_store; ?></td>
          <td class="right"><?php echo $column_order_currency; ?></td>   
          <td class="right"><?php echo $column_prod_price; ?></td>   		  		  
          <td class="right"><?php echo $column_prod_quantity; ?></td>                  
          <td class="right" style="min-width:70px;"><?php echo $column_prod_total_excl_vat; ?></td>
          <td class="right"><?php echo $column_prod_tax; ?></td>
		  <td class="right" style="min-width:70px;"><?php echo $column_prod_total_incl_vat; ?></td>		  
        </tr>
        </thead>
        <tr bgcolor="#FFFFFF">
          <td class="left" nowrap="nowrap">{{html product_order_ord_id}}</td>
          <td class="left" nowrap="nowrap">{{html product_order_date}}</td>
          <td class="left" nowrap="nowrap">{{html product_order_inv_no}}</td>
          <td class="left" nowrap="nowrap">{{html product_order_shipping_method}}</td>
          <td class="left" nowrap="nowrap">{{html product_order_payment_method}}</td>           
          <td class="left" nowrap="nowrap">{{html product_order_status}}</td>
          <td class="left" nowrap="nowrap">{{html product_order_store}}</td>  
          <td class="right" nowrap="nowrap">{{html product_order_currency}}</td>  
          <td class="right" nowrap="nowrap">{{html product_order_price}}</td>  		  		  
          <td class="right" nowrap="nowrap">{{html product_order_quantity}}</td>                 
          <td class="right" nowrap="nowrap">{{html product_order_total_excl_vat}}</td>
          <td class="right" nowrap="nowrap">{{html product_order_tax}}</td>
		  <td class="right" nowrap="nowrap">{{html product_order_total_incl_vat}}</td>	
		</tr>
		</table>
		</td>
		</tr>				
</script>
<script id="products_totalTemplate" type="text/x-jquery-tmpl">
		<tbody class="list_total_products"> 
		<tr style="border-top:2px solid #CCC;">
		  <td colspan="6" class="right" style="font-weight:bold;"><?php echo $column_cust_totals; ?></td>
          <td class="right" style="font-weight:bold;">${total_quantity}</td>       
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_total_excl_vat}</td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_prod_tax}</td>
          <td class="right" nowrap="nowrap" style="font-weight:bold;">${total_total_incl_vat}</td>			  
        </tr>
		</tbody>		
</script>	
		
		<div class="tab-pane" id="tab_cart">
			<div class="table-responsive">	
			<table class="table table-bordered table-hover">
			<thead style="background-color: #f5f5f5;">
              <tr>
		      <td class="text-center" style="width:5%;"><?php echo $column_image; ?></td>
		      <td class="text-left" style="width:10%;"><?php echo $column_sku; ?></td>               
		      <td class="text-left" style="width:10%;"><?php echo $column_model; ?></td>                           
		      <td class="text-left" style="width:30%;"><?php echo $column_product; ?></td>
		      <td class="text-left" style="width:20%;"><?php echo $column_product_options; ?></td>
		      <td class="text-center" style="width:5%;"><?php echo $column_prod_quantity; ?></td>
		      <td class="text-right" style="width:5%;"><?php echo $column_unit_price; ?></td>
		      <td class="text-right" style="width:5%;"><?php echo $column_prod_total; ?></td>			  			                
              </tr>
            </thead>
            <tbody>
            <?php if ($cart_products) { ?>
              <?php foreach ($cart_products as $cart_product){ ?>
		        <tr>
		          <td class="text-center" style="width:5%;"><img src="<?php echo $cart_product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
                  <td class="text-left" style="width:10%;"><?php echo $cart_product['product_sku']; ?></td>
                  <td class="text-left" style="width:10%;"><?php echo $cart_product['product_model']; ?></td>                  
		          <td class="text-left" style="width:30%;"><?php echo '<a href="' . $url_product . $cart_product['product_id'] . '">' . $cart_product['product_name'] . '</a>' ; ?></td>
		          <td class="text-left" style="width:20%;">
				    <?php if ($cart_product['product_options']) { ?>
				      <?php foreach ($cart_product['product_options'] as $product_option) { ?>
					    <?php if ($product_option['name'] != "") { ?>
				          <?php echo $product_option['name']; ?>:&nbsp;<?php echo $product_option['option_value']; ?><br />
					    <?php } else { ?>
				          <?php echo $product_option['name']; ?>
					    <?php } ?>
					  <?php } ?>
				    <?php } ?>
				  </td>
		          <td class="text-center" style="width:5%;"><?php echo $cart_product['quantity']; ?></td> 
				  <td class="text-right" style="width:5%;"><?php echo $cart_product['price']; ?></td> 
				  <td class="text-right" style="width:5%;"><?php echo $cart_product['total']; ?></td>                  
		        </tr>
			  <?php } ?>
			<?php } else { ?>
			  <tr>
			      <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
			  </tr>
			<?php } ?>
		  </tbody>
		</table>
		</div>
        <?php if ($cart_products) { ?>
			<table width="100%" cellspacing="0" cellpadding="6">
				<tr>
					<td>
                    <?php foreach ($cart_product['clear_cart'] as $clear_cart) { ?>
			  		<?php if ($access_permission1) { ?>
						<button type="button" onclick="location = '<?php echo $clear_cart['href']; ?>';" class="btn btn-danger"><i class="fa fa-eraser"></i> <?php echo $clear_cart['text']; ?></button>
					<?php } else { ?>
						<button type="button" onclick="alert('You do not have permission to clear the cart!');" class="btn btn-danger"><i class="fa fa-eraser"></i> <?php echo $clear_cart['text']; ?></button>
					<?php } ?>
                    <?php } ?>
					</td>
				</tr>
			</table>
        <?php } ?> 
        </div>   
		      
		<div class="tab-pane" id="tab_wishlist">
			<div class="table-responsive">	
			<table class="table table-bordered table-hover">
			<thead style="background-color: #f5f5f5;">
              <tr>
		      	<td class="text-center" style="width:5%;"><?php echo $column_image; ?></td>
		      	<td class="text-left" style="width:10%;"><?php echo $column_sku; ?></td>  
		      	<td class="text-left" style="width:10%;"><?php echo $column_model; ?></td>                  
                <td class="text-left" style="width:65%;"><?php echo $column_product; ?></td>
				<td class="text-right" style="width:10%;"><?php echo $column_unit_price; ?></td>              
              </tr>
            </thead>
            <tbody>
            <?php if ($wishlist_products) { ?>
              <?php foreach ($wishlist_products as $wishlist_product){ ?>
              <tr>
                <td class="text-center" style="width:5%;"><img src="<?php echo $wishlist_product['image']; ?>" style="padding: 1px; border: 1px solid #DDDDDD;" /></td>
                <td class="text-left" style="width:10%;"><?php echo $wishlist_product['product_sku']; ?></td>
                <td class="text-left" style="width:10%;"><?php echo $wishlist_product['product_model']; ?></td>                   
                <td class="text-left" style="width:65%;"><?php echo '<a href="' . $url_product . $wishlist_product['product_id'] . '">' . $wishlist_product['product_name'] . '</a>' ; ?></td>
				<td class="text-right" style="width:10%;"><?php if ($wishlist_product['product_special']) { ?>
                    <span style="text-decoration: line-through;"><?php echo $wishlist_product['product_price']; ?></span><br/>
                    <div class="text-danger"><?php echo $wishlist_product['product_special']; ?></div>
                    <?php } else { ?>
                    <?php echo $wishlist_product['product_price']; ?>
                    <?php } ?></td>             
              </tr>
              <?php } ?>
              <?php } else { ?>
              <tr>
                <td class="text-center" colspan="5"><?php echo $text_no_results; ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
		  </div>
        <?php if ($wishlist_products) { ?>
			<table width="100%" cellspacing="0" cellpadding="6">
				<tr>
					<td>
                    <?php foreach ($wishlist_product['delete_wishlist'] as $delete_wishlist) { ?>
			  		<?php if ($access_permission1) { ?>
						<button type="button" onclick="location = '<?php echo $delete_wishlist['href']; ?>';" class="btn btn-danger"><i class="fa fa-eraser"></i> <?php echo $delete_wishlist['text']; ?></button>
					<?php } else { ?>
						<button type="button" onclick="alert('You do not have permission to clear the wishlist!');" class="btn btn-danger"><i class="fa fa-eraser"></i> <?php echo $delete_wishlist['text']; ?></button>
                    <?php } ?>
					<?php } ?>
					</td>
				</tr>
			</table>
        <?php } ?>           
        </div> 
		
		<div class="tab-pane" id="tab_customer_track">
<style type="text/css">
.list_main_track {
	border-collapse: collapse;
	width: 100%;
	border-top: 1px solid #DDDDDD;
	border-left: 1px solid #DDDDDD;	
	margin-bottom: 20px;
}
.list_main_track td {
	border-right: 1px solid #DDDDDD;
	border-bottom: 1px solid #DDDDDD;	
}
.list_main_track thead td {
	background-color: #f5f5f5;
	padding: 0px 5px;
}
.list_main_track thead td a, .list_main_track thead td {
	text-decoration: none;
	color: #222222;
	font-weight: bold;	
}
.list_main_track tbody td {
	vertical-align: middle;
	padding: 0px 5px;
}
.list_main_track .left {
	text-align: left;
	padding: 7px;
}
.list_main_track .right {
	text-align: right;
	padding: 7px;
}
.list_main_track .center {
	text-align: center;
	padding: 3px;
}
.list_main_track a.asc:after {
	content: " \f107";
	font-family: FontAwesome;
	font-size: 14px;
}
.list_main_track a.desc:after {
	content: " \f106";
	font-family: FontAwesome;
	font-size: 14px;
}
.list_main_track .noresult {
	text-align: center;
	padding: 7px;
}

.btn-select {
	background-color: #fcfcfc;
	border: 1px solid #CCC;
}
.tloading {
	position: absolute;
	width: 100%;
	height: 100%;
	z-index: 9999;
	background: url('view/image/adv_reports/page_loading.gif') 50% 25% no-repeat rgba(255,255,255,0.9);
}
</style> 
<div class="tloading"></div>
<input type="hidden" id="page_track" value="<?php echo $page_track ?>">
<input type="hidden" id="sort_track" value="<?php echo $sort_track ?>">
<input type="hidden" id="order_track" value="<?php echo $order_track ?>">		
<script type="text/javascript">
$(document).ready(function() {
var $filter_range = $('#filter_range'), $date_start = $('#filter_start_date'), $date_end = $('#filter_end_date');
$filter_range.change(function () {
    if ($filter_range.val() == 'custom') {
        $date_start.removeAttr('disabled');
        $date_end.removeAttr('disabled');
    } else {	
        $date_start.prop('disabled', 'disabled').val('');
        $date_end.prop('disabled', 'disabled').val('');
    }
}).trigger('change');
});
</script>
<div align="right">
<?php if ($access_permission1) { ?>
	<button type="button" onclick="track_reset();" class="btn btn-danger" style="margin-bottom:10px;"><i class="fa fa-eraser"></i> <?php echo $button_delete_track;?></button>
<?php } else { ?>
	<button type="button" onclick="alert('You do not have permission to delete customer track!');" class="btn btn-danger" style="margin-bottom:10px;"><i class="fa fa-eraser"></i> <?php echo $button_delete_track;?></button>
<?php } ?>
</div> 
<div class="well">
    <div class="row">
      <div class="col-lg-6">	  
        <div class="row">
          <div class="col-sm-6" style="padding-bottom:5px;">
		  <label class="control-label" for="filter_range"><?php echo $entry_range; ?></label>
            <select name="filter_range" id="filter_range" data-style="btn-select" class="form-control select">
              <?php foreach ($ranges as $range) { ?>
              <?php if ($range['value'] == $filter_range) { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>" selected="selected"><?php echo $range['text']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $range['value']; ?>" title="<?php echo $range['text']; ?>" style="<?php echo $range['style']; ?>"><?php echo $range['text']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></div>
          <div class="col-sm-3" style="padding-bottom:5px;">
		  <label class="control-label" for="filter_start_date"><?php echo $entry_date_start; ?></label>
            <input type="text" name="filter_start_date" value="<?php echo $filter_start_date; ?>" data-date-format="YYYY-MM-DD" id="filter_start_date" class="form-control" style="color:#F90;" />
		  </div>
          <div class="col-sm-3" style="padding-bottom:5px;">
		  <label class="control-label" for="filter_end_date"><?php echo $entry_date_end; ?></label>
            <input type="text" name="filter_end_date" value="<?php echo $filter_end_date; ?>" data-date-format="YYYY-MM-DD" id="filter_end_date" class="form-control" style="color:#F90;" />
          </div>
        </div>
	  </div>
    </div> 
</div>	
		<div class="table-responsive">	
		<table class="list_main_track">
			<thead id="head_track">
				<tr>
                	<td width="9%" class="left" nowrap="nowrap"><?php echo $column_ip_address; ?></td>
					<td class="left"><?php if ($sort_track == 'route') { ?>
                		<a href="<?php echo $sort_track_page; ?>" class="<?php echo strtolower($order_track); ?>"><?php echo $column_route; ?></a>
	                	<?php } else { ?>
    	            	<a href="<?php echo $sort_track_page; ?>"><?php echo $column_route; ?></a>
        	        	<?php } ?></td>
					<td class="left"><?php if ($sort_track == 'current_url') { ?>
	               	 	<a href="<?php echo $sort_track_url; ?>" class="<?php echo strtolower($order_track); ?>"><?php echo $column_current_url; ?></a>
	                	<?php } else { ?>
	                	<a href="<?php echo $sort_track_url; ?>"><?php echo $column_current_url; ?></a>
	                	<?php } ?><br />
						<?php if ($sort_track == 'referrer') { ?>
	                	<a href="<?php echo $sort_track_referrer; ?>" class="<?php echo strtolower($order_track); ?>"><?php echo $column_referrer; ?></a>
	                	<?php } else { ?>
	                	<a href="<?php echo $sort_track_referrer; ?>"><?php echo $column_referrer; ?></a>
	                	<?php } ?></td>
					<td width="7%" class="center" nowrap="nowrap"><?php if ($sort_track == 'access_time') { ?>
    	            	<a href="<?php echo $sort_track_visit; ?>" class="<?php echo strtolower($order_track); ?>"><?php echo $column_access_date; ?></a>
	                	<?php } else { ?>
	                	<a href="<?php echo $sort_track_visit; ?>"><?php echo $column_access_date; ?></a>
	                	<?php } ?></td>
                    <td width="7%" class="center" nowrap="nowrap"><?php echo $column_access_time; ?></td>
				</tr>
			</thead>
			<tbody>
				<?php if ($customer_track) { ?>
				<?php foreach ($customer_track as $track) { ?>
				<tr>
					<td class="left" nowrap="nowrap">
						<a onclick="window.open('https://www.ip-tracker.org/locator/ip-lookup.php?ip=<?php echo $track['ip_address']; ?>');"><?php echo $track['ip_address']; ?></a><br />
                        <span style="font-size:10px;">(<?php echo $track['agent_type']; ?>)</span>
					</td>
					<td class="left"><?php echo $track['route']; ?>
					</td>
					<td class="left">
						<a href="<?php echo str_replace('&amp;', '&',html_entity_decode($track['current_url'])); ?>" target="_blank">
							<?php echo $track['current_url']; ?></a>
						<?php if($track['referrer'] != ""){ ?><br />
						<a href="<?php echo str_replace('&amp;', '&',html_entity_decode($track['referrer'])); ?>" title="<?php echo str_replace('&amp;', '&',html_entity_decode($track['referrer'])); ?>" target="_blank">
							<span style="color:#666;"><?php echo $track['referrer']; ?></span></a>
						<?php } ?>
					</td>
					<td class="center" nowrap="nowrap"><?php echo $track['visit_date']; ?></td>
					<td class="center" nowrap="nowrap"><?php echo $track['visit_time']; ?></td>                    
				</tr>
				<?php } ?>
				<?php } else { ?>
				<tr>
					<td class="center" colspan="5"><?php echo $text_no_results; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		</div>
		<div class="row">
		<div class="col-sm-6 text-left" id="pagination_track"><?php echo $pagination_track; ?></div>
        <div class="col-sm-6 text-right" id="pagination_count"><?php echo $results_track; ?></div>
		</div>
<script id="trackTemplate" type="text/x-jquery-tmpl"> 
        <tr>
          <td class="left" nowrap="nowrap"><a onclick="window.open('https://www.ip-tracker.org/locator/ip-lookup.php?ip=${ip_address}');">${ip_address}</a>
		  <br><span style="font-size:10px;">{{html agent_type}}</span></td>
		  <td class="left">${route}</td>
		  <td class="left"><a href="${current_url}" target="_blank">${current_url}</a>
		  {{if referrer != ""}}<br>
		  <a href="${referrer}" target="_blank"><span style="color:#666;">${referrer}</span>
		  {{/if}}
		  </td>
		  <td class="center">${visit_date}</td>
		  <td class="center">${visit_time}</td>
        </tr>		
</script>
		</div>
<?php } ?>		
		
            <div class="tab-pane" id="tab-history">
              <div id="history"></div>
              <br />
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-comment"><?php echo $entry_comment; ?></label>
                <div class="col-sm-10">
                  <textarea name="comment" rows="8" placeholder="<?php echo $entry_comment; ?>" id="input-comment" class="form-control"></textarea>
                </div>
              </div>
              <div class="text-right">
                <button id="button-history" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_history_add; ?></button>
              </div>
            </div>
            <div class="tab-pane" id="tab-transaction">
              <div id="transaction"></div>
              <br />
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-transaction-description"><?php echo $entry_description; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="description" value="" placeholder="<?php echo $entry_description; ?>" id="input-transaction-description" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-amount"><?php echo $entry_amount; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="amount" value="" placeholder="<?php echo $entry_amount; ?>" id="input-amount" class="form-control" />
                </div>
              </div>
              <div class="text-right">
                <button type="button" id="button-transaction" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_transaction_add; ?></button>
              </div>
            </div>
            <div class="tab-pane" id="tab-reward">
              <div id="reward"></div>
              <br />
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-reward-description"><?php echo $entry_description; ?></label>
                <div class="col-sm-10">
                  <input type="text" name="description" value="" placeholder="<?php echo $entry_description; ?>" id="input-reward-description" class="form-control" />
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label" for="input-points"><span data-toggle="tooltip" title="<?php echo $help_points; ?>"><?php echo $entry_points; ?></span></label>
                <div class="col-sm-10">
                  <input type="text" name="points" value="" placeholder="<?php echo $entry_points; ?>" id="input-points" class="form-control" />
                </div>
              </div>
              <div class="text-right">
                <button type="button" id="button-reward" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i> <?php echo $button_reward_add; ?></button>
              </div>
            </div>
            <?php } ?>
            <div class="tab-pane" id="tab-ip">
              <div id="ip"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript"><!--
$('select[name=\'customer_group_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=customer/customer/customfield&token=<?php echo $token; ?>&customer_group_id=' + this.value,
		dataType: 'json',
		success: function(json) {
			$('.custom-field').hide();
			$('.custom-field').removeClass('required');

			for (i = 0; i < json.length; i++) {
				custom_field = json[i];

				$('.custom-field' + custom_field['custom_field_id']).show();

				if (custom_field['required']) {
					$('.custom-field' + custom_field['custom_field_id']).addClass('required');
				}
			}
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

$('select[name=\'customer_group_id\']').trigger('change');
//--></script>
  <script type="text/javascript"><!--
var address_row = <?php echo $address_row; ?>;

function addAddress() {
	html  = '<div class="tab-pane" id="tab-address' + address_row + '">';
	html += '  <input type="hidden" name="address[' + address_row + '][address_id]" value="" />';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-firstname' + address_row + '"><?php echo $entry_firstname; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][firstname]" value="" placeholder="<?php echo $entry_firstname; ?>" id="input-firstname' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-lastname' + address_row + '"><?php echo $entry_lastname; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][lastname]" value="" placeholder="<?php echo $entry_lastname; ?>" id="input-lastname' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group">';
	html += '    <label class="col-sm-2 control-label" for="input-company' + address_row + '"><?php echo $entry_company; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][company]" value="" placeholder="<?php echo $entry_company; ?>" id="input-company' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-address-1' + address_row + '"><?php echo $entry_address_1; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][address_1]" value="" placeholder="<?php echo $entry_address_1; ?>" id="input-address-1' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group">';
	html += '    <label class="col-sm-2 control-label" for="input-address-2' + address_row + '"><?php echo $entry_address_2; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][address_2]" value="" placeholder="<?php echo $entry_address_2; ?>" id="input-address-2' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-city' + address_row + '"><?php echo $entry_city; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][city]" value="" placeholder="<?php echo $entry_city; ?>" id="input-city' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-postcode' + address_row + '"><?php echo $entry_postcode; ?></label>';
	html += '    <div class="col-sm-10"><input type="text" name="address[' + address_row + '][postcode]" value="" placeholder="<?php echo $entry_postcode; ?>" id="input-postcode' + address_row + '" class="form-control" /></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-country' + address_row + '"><?php echo $entry_country; ?></label>';
	html += '    <div class="col-sm-10"><select name="address[' + address_row + '][country_id]" id="input-country' + address_row + '" onchange="country(this, \'' + address_row + '\', \'0\');" class="form-control">';
    html += '         <option value=""><?php echo $text_select; ?></option>';
    <?php foreach ($countries as $country) { ?>
    html += '         <option value="<?php echo $country['country_id']; ?>"><?php echo addslashes($country['name']); ?></option>';
    <?php } ?>
    html += '      </select></div>';
	html += '  </div>';

	html += '  <div class="form-group required">';
	html += '    <label class="col-sm-2 control-label" for="input-zone' + address_row + '"><?php echo $entry_zone; ?></label>';
	html += '    <div class="col-sm-10"><select name="address[' + address_row + '][zone_id]" id="input-zone' + address_row + '" class="form-control"><option value=""><?php echo $text_none; ?></option></select></div>';
	html += '  </div>';

	// Custom Fields
	<?php foreach ($custom_fields as $custom_field) { ?>
	<?php if ($custom_field['location'] == 'address') { ?>
	<?php if ($custom_field['type'] == 'select') { ?>

	html += '  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '  		<label class="col-sm-2 control-label" for="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '  		<div class="col-sm-10">';
	html += '  		  <select name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control">';
	html += '  			<option value=""><?php echo $text_select; ?></option>';

	<?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
	html += '  			<option value="<?php echo $custom_field_value['custom_field_value_id']; ?>"><?php echo addslashes($custom_field_value['name']); ?></option>';
	<?php } ?>

	html += '  		  </select>';
	html += '  		</div>';
	html += '  	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'radio') { ?>
	html += '  	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>">';
	html += '  		<label class="col-sm-2 control-label"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '  		<div class="col-sm-10">';
	html += '  		  <div>';

	<?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
	html += '  			<div class="radio"><label><input type="radio" name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" /> <?php echo addslashes($custom_field_value['name']); ?></label></div>';
	<?php } ?>

	html += '		  </div>';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'checkbox') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <div>';

	<?php foreach ($custom_field['custom_field_value'] as $custom_field_value) { ?>
	html += '			<div class="checkbox"><label><input type="checkbox" name="address[<?php echo $address_row; ?>][custom_field][<?php echo $custom_field['custom_field_id']; ?>][]" value="<?php echo $custom_field_value['custom_field_value_id']; ?>" /> <?php echo addslashes($custom_field_value['name']); ?></label></div>';
	<?php } ?>

	html += '		  </div>';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'text') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label" for="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <input type="text" name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo addslashes($custom_field['value']); ?>" placeholder="<?php echo addslashes($custom_field['name']); ?>" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" />';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'textarea') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label" for="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <textarea name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" rows="5" placeholder="<?php echo addslashes($custom_field['name']); ?>" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control"><?php echo addslashes($custom_field['value']); ?></textarea>';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'file') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <button type="button" id="button-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" data-loading-text="<?php echo $text_loading; ?>" class="btn btn-default"><i class="fa fa-upload"></i> <?php echo $button_upload; ?></button>';
	html += '		  <input type="hidden" name="address[' + address_row + '][<?php echo $custom_field['custom_field_id']; ?>]" value="" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" />';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'date') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label" for="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <div class="input-group date"><input type="text" name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo addslashes($custom_field['value']); ?>" placeholder="<?php echo addslashes($custom_field['name']); ?>" data-date-format="YYYY-MM-DD" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div>';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'time') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label" for="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <div class="input-group time"><input type="text" name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo $custom_field['value']; ?>" placeholder="<?php echo addslashes($custom_field['name']); ?>" data-date-format="HH:mm" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div>';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php if ($custom_field['type'] == 'datetime') { ?>
	html += '	  <div class="form-group custom-field custom-field<?php echo $custom_field['custom_field_id']; ?>" data-sort="<?php echo $custom_field['sort_order'] + 1; ?>">';
	html += '		<label class="col-sm-2 control-label" for="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>"><?php echo addslashes($custom_field['name']); ?></label>';
	html += '		<div class="col-sm-10">';
	html += '		  <div class="input-group datetime"><input type="text" name="address[' + address_row + '][custom_field][<?php echo $custom_field['custom_field_id']; ?>]" value="<?php echo addslashes($custom_field['value']); ?>" placeholder="<?php echo addslashes($custom_field['name']); ?>" data-date-format="YYYY-MM-DD HH:mm" id="input-address' + address_row + '-custom-field<?php echo $custom_field['custom_field_id']; ?>" class="form-control" /><span class="input-group-btn"><button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button></span></div>';
	html += '		</div>';
	html += '	  </div>';
	<?php } ?>

	<?php } ?>
	<?php } ?>

	html += '  <div class="form-group">';
	html += '    <label class="col-sm-2 control-label"><?php echo $entry_default; ?></label>';
	html += '    <div class="col-sm-10"><label class="radio"><input type="radio" name="address[' + address_row + '][default]" value="1" /></label></div>';
	html += '  </div>';

    html += '</div>';

	$('#tab-general .tab-content').append(html);

	$('select[name=\'customer_group_id\']').trigger('change');

	$('select[name=\'address[' + address_row + '][country_id]\']').trigger('change');

	$('#address-add').before('<li><a href="#tab-address' + address_row + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#address a:first\').tab(\'show\'); $(\'a[href=\\\'#tab-address' + address_row + '\\\']\').parent().remove(); $(\'#tab-address' + address_row + '\').remove();"></i> <?php echo $tab_address; ?> ' + address_row + '</a></li>');

	$('#address a[href=\'#tab-address' + address_row + '\']').tab('show');

	$('.date').datetimepicker({
		pickTime: false
	});

	$('.datetime').datetimepicker({
		pickDate: true,
		pickTime: true
	});

	$('.time').datetimepicker({
		pickDate: false
	});

	$('#tab-address' + address_row + ' .form-group[data-sort]').detach().each(function() {
		if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-address' + address_row + ' .form-group').length) {
			$('#tab-address' + address_row + ' .form-group').eq($(this).attr('data-sort')).before(this);
		}

		if ($(this).attr('data-sort') > $('#tab-address' + address_row + ' .form-group').length) {
			$('#tab-address' + address_row + ' .form-group:last').after(this);
		}

		if ($(this).attr('data-sort') < -$('#tab-address' + address_row + ' .form-group').length) {
			$('#tab-address' + address_row + ' .form-group:first').before(this);
		}
	});

	address_row++;
}
//--></script>
  <script type="text/javascript"><!--
function country(element, index, zone_id) {
	$.ajax({
		url: 'index.php?route=localisation/country/country&token=<?php echo $token; ?>&country_id=' + element.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'address[' + index + '][country_id]\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'address[' + index + '][postcode]\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'address[' + index + '][postcode]\']').parent().parent().removeClass('required');
			}

			html = '<option value=""><?php echo $text_select; ?></option>';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == zone_id) {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			} else {
				html += '<option value="0"><?php echo $text_none; ?></option>';
			}

			$('select[name=\'address[' + index + '][zone_id]\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
}

$('select[name$=\'[country_id]\']').trigger('change');
//--></script>
  <script type="text/javascript"><!--
$('#history').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();

	$('#history').load(this.href);
});

$('#history').load('index.php?route=customer/customer/history&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-history').on('click', function(e) {
	e.preventDefault();

	$.ajax({
		url: 'index.php?route=customer/customer/addhistory&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'comment=' + encodeURIComponent($('#tab-history textarea[name=\'comment\']').val()),
		beforeSend: function() {
			$('#button-history').button('loading');
		},
		complete: function() {
			$('#button-history').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				 $('#tab-history').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div></div>');
			}

			if (json['success']) {
				$('#tab-history').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div></div>');

				$('#history').load('index.php?route=customer/customer/history&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

				$('#tab-history textarea[name=\'comment\']').val('');
			}
		}
	});
});
//--></script>
  <script type="text/javascript"><!--
$('#transaction').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();

	$('#transaction').load(this.href);
});

$('#transaction').load('index.php?route=customer/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-transaction').on('click', function(e) {
  e.preventDefault();

  $.ajax({
		url: 'index.php?route=customer/customer/addtransaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'description=' + encodeURIComponent($('#tab-transaction input[name=\'description\']').val()) + '&amount=' + encodeURIComponent($('#tab-transaction input[name=\'amount\']').val()),
		beforeSend: function() {
			$('#button-transaction').button('loading');
		},
		complete: function() {
			$('#button-transaction').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				 $('#tab-transaction').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div></div>');
			}

			if (json['success']) {
				$('#tab-transaction').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div></div>');

				$('#transaction').load('index.php?route=customer/customer/transaction&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

				$('#tab-transaction input[name=\'amount\']').val('');
				$('#tab-transaction input[name=\'description\']').val('');
			}
		}
	});
});
//--></script>
  <script type="text/javascript"><!--
$('#reward').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();

	$('#reward').load(this.href);
});

$('#reward').load('index.php?route=customer/customer/reward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#button-reward').on('click', function(e) {
	e.preventDefault();

	$.ajax({
		url: 'index.php?route=customer/customer/addreward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>',
		type: 'post',
		dataType: 'json',
		data: 'description=' + encodeURIComponent($('#tab-reward input[name=\'description\']').val()) + '&points=' + encodeURIComponent($('#tab-reward input[name=\'points\']').val()),
		beforeSend: function() {
			$('#button-reward').button('loading');
		},
		complete: function() {
			$('#button-reward').button('reset');
		},
		success: function(json) {
			$('.alert').remove();

			if (json['error']) {
				 $('#tab-reward').prepend('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div></div>');
			}

			if (json['success']) {
				$('#tab-reward').prepend('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div></div>');

				$('#reward').load('index.php?route=customer/customer/reward&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

				$('#tab-reward input[name=\'points\']').val('');
				$('#tab-reward input[name=\'description\']').val('');
			}
		}
	});
});

$('#ip').delegate('.pagination a', 'click', function(e) {
	e.preventDefault();

	$('#ip').load(this.href);
});

$('#ip').load('index.php?route=customer/customer/ip&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>');

$('#content').delegate('button[id^=\'button-custom-field\'], button[id^=\'button-address\']', 'click', function() {
	var node = this;

	$('#form-upload').remove();

	$('body').prepend('<form enctype="multipart/form-data" id="form-upload" style="display: none;"><input type="file" name="file" /></form>');

	$('#form-upload input[name=\'file\']').trigger('click');

	if (typeof timer != 'undefined') {
    	clearInterval(timer);
	}

	timer = setInterval(function() {
		if ($('#form-upload input[name=\'file\']').val() != '') {
			clearInterval(timer);

			$.ajax({
				url: 'index.php?route=tool/upload/upload&token=<?php echo $token; ?>',
				type: 'post',
				dataType: 'json',
				data: new FormData($('#form-upload')[0]),
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					$(node).button('loading');
				},
				complete: function() {
					$(node).button('reset');
				},
				success: function(json) {
					$(node).parent().find('.text-danger').remove();

					if (json['error']) {
						$(node).parent().find('input[type=\'hidden\']').after('<div class="text-danger">' + json['error'] + '</div>');
					}

					if (json['success']) {
						alert(json['success']);
					}

					if (json['code']) {
						$(node).parent().find('input[type=\'hidden\']').attr('value', json['code']);
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}, 500);
});

$('.date').datetimepicker({
	pickTime: false
});

$('.datetime').datetimepicker({
	pickDate: true,
	pickTime: true
});

$('.time').datetimepicker({
	pickDate: false
});

// Sort the custom fields
<?php $address_row = 1; ?>
<?php foreach ($addresses as $address) { ?>
$('#tab-address<?php echo $address_row ?> .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-address<?php echo $address_row ?> .form-group').length) {
		$('#tab-address<?php echo $address_row ?> .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#tab-address<?php echo $address_row ?> .form-group').length) {
		$('#tab-address<?php echo $address_row ?> .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#tab-address<?php echo $address_row ?> .form-group').length) {
		$('#tab-address<?php echo $address_row ?> .form-group:first').before(this);
	}
});
<?php $address_row++; ?>
<?php } ?>


<?php foreach ($addresses as $address) { ?>
$('#tab-customer .form-group[data-sort]').detach().each(function() {
	if ($(this).attr('data-sort') >= 0 && $(this).attr('data-sort') <= $('#tab-customer .form-group').length) {
		$('#tab-customer .form-group').eq($(this).attr('data-sort')).before(this);
	}

	if ($(this).attr('data-sort') > $('#tab-customer .form-group').length) {
		$('#tab-customer .form-group:last').after(this);
	}

	if ($(this).attr('data-sort') < -$('#tab-customer .form-group').length) {
		$('#tab-customer .form-group:first').before(this);
	}
});
<?php } ?>
//--></script></div>
			
<?php if ($customer_id) { ?>	
<?php if ($access_permission2 && $laccess) { ?>			
<script type="text/javascript">
$('#date-start-orders').datetimepicker({
	pickTime: false
});
$('#date-end-orders').datetimepicker({
	pickTime: false
});

$('#date-start-products').datetimepicker({
	pickTime: false
});
$('#date-end-products').datetimepicker({
	pickTime: false
});

$('#filter_start_date').datetimepicker({
	pickTime: false
});
$('#filter_end_date').datetimepicker({
	pickTime: false
});

$('.select').selectpicker();
</script> 
<script type="text/javascript">
function filter_orders() {
	url = 'index.php?route=customer/customer/filter_orders&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>';

	url += '&page_orders=' + $('#page_orders').val();

	if ($('#sort_orders').val()) {
		url += '&sort_orders=' + $('#sort_orders').val();
	}
	if ($('#order_orders').val()) {
		url += '&order_orders=' + $('#order_orders').val();
	}
			
	var filter_orders_date_start = $('input[name=\'filter_orders_date_start\']').val();
	
	if (filter_orders_date_start) {
		url += '&filter_orders_date_start=' + encodeURIComponent(filter_orders_date_start);
	}

	var filter_orders_date_end = $('input[name=\'filter_orders_date_end\']').val();
	
	if (filter_orders_date_end) {
		url += '&filter_orders_date_end=' + encodeURIComponent(filter_orders_date_end);
	}
		
	var filter_orders_range = $('select[name=\'filter_orders_range\']').val();
	
	if (filter_orders_range) {
		url += '&filter_orders_range=' + encodeURIComponent(filter_orders_range);
	}

	var orders_order_statuses = [];
	$('#orders_order_status option:selected').each(function() {
		orders_order_statuses.push($(this).val());
	});
	
	var filter_orders_order_status = orders_order_statuses.join('_');
	
	if (filter_orders_order_status) {
		url += '&filter_orders_order_status=' + encodeURIComponent(filter_orders_order_status);
	}

	$.ajax({
		url: url,
		dataType: 'json',
    	beforeSend: function(){$( ".oloading" ).show();},
		cache: false,
		success: function(json) {		
				  $('table.list_main_orders tr:gt(0)').empty();				  
				  $("#ordersTemplate").tmpl(json.customer_order).appendTo("table.list_main_orders");	
				  $("#orders_totalTemplate").tmpl(json.customer_order).appendTo("table.list_main_orders");
				  var seen = {};
					$('table.list_main_orders tr').each(function() {
    				var txt = $(this).text();
    				if (seen[txt])
        				$(this).remove();
    				else
        				seen[txt] = true;
				  });
				  $('#pagination_orders_count').html(json.results_orders);
				  $('#pagination_orders').html(json.pagination_orders);
				  $('#page_orders').val(1);
				  $( ".oloading" ).hide();			  
			  }
	});	
} 

function filter_products() {
	url = 'index.php?route=customer/customer/filter_products&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>';

	url += '&page_products=' + $('#page_products').val();

	if ($('#sort_products').val()) {
		url += '&sort_products=' + $('#sort_products').val();
	}
	if ($('#order_products').val()) {
		url += '&order_products=' + $('#order_products').val();
	}
			
	var filter_products_date_start = $('input[name=\'filter_products_date_start\']').val();
	
	if (filter_products_date_start) {
		url += '&filter_products_date_start=' + encodeURIComponent(filter_products_date_start);
	}

	var filter_products_date_end = $('input[name=\'filter_products_date_end\']').val();
	
	if (filter_products_date_end) {
		url += '&filter_products_date_end=' + encodeURIComponent(filter_products_date_end);
	}
		
	var filter_products_range = $('select[name=\'filter_products_range\']').val();
	
	if (filter_products_range) {
		url += '&filter_products_range=' + encodeURIComponent(filter_products_range);
	}

	var products_order_statuses = [];
	$('#products_order_status option:selected').each(function() {
		products_order_statuses.push($(this).val());
	});
	
	var filter_products_order_status = products_order_statuses.join('_');
	
	if (filter_products_order_status) {
		url += '&filter_products_order_status=' + encodeURIComponent(filter_products_order_status);
	}

	$.ajax({
		url: url,
		dataType: 'json',
    	beforeSend: function(){$( ".ploading" ).show();},
		cache: false,
		success: function(json) {		
				  $('table.list_main_products tr:gt(0)').empty();				  
				  $("#productsTemplate").tmpl(json.customer_product).appendTo("table.list_main_products");	
				  $("#products_totalTemplate").tmpl(json.customer_product).appendTo("table.list_main_products");
				  var seen = {};
					$('tbody.list_total_products tr').each(function() {
    				var txt = $(this).text();
    				if (seen[txt])
        				$(this).remove();
    				else
        				seen[txt] = true;
				  });
				  $('#pagination_products_count').html(json.results_products);
				  $('#pagination_products').html(json.pagination_products);
				  $('#page_products').val(1);
				  $( ".ploading" ).hide();			  
			  }
	});	
} 
	
function filter_track() {
		furl = 'index.php?route=customer/customer/filter_track&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>';
		
		furl += '&page_track=' + $('#page_track').val();

		if ($('#sort_track').val()) {
			furl += '&sort_track=' + $('#sort_track').val();
		}
		if ($('#order_track').val()) {
			furl += '&order_track=' + $('#order_track').val();
		}
	
		var filter_start_date = $('input[name=\'filter_start_date\']').val();
	
		if (filter_start_date) {
			furl += '&filter_start_date=' + encodeURIComponent(filter_start_date);
		}

		var filter_end_date = $('input[name=\'filter_end_date\']').val();
	
		if (filter_end_date) {
			furl += '&filter_end_date=' + encodeURIComponent(filter_end_date);
		}
		
		var filter_range = $('select[name=\'filter_range\']').val();
	
		if (filter_range) {
			furl += '&filter_range=' + encodeURIComponent(filter_range);
		}

		$.ajax({
			url: furl,
			dataType: 'json',
    		beforeSend: function(){$( ".tloading" ).show();},
			cache: false,
			success: function(json) {		
					  $('table.list_main_track tr:gt(0)').empty();				  
					  $("#trackTemplate").tmpl(json.customer_track).appendTo("table.list_main_track");	
					  var seen = {};
						$('table.list_main_track tr').each(function() {
	    				var txt = $(this).text();
	    				if (seen[txt])
	        				$(this).remove();
	    				else
	        				seen[txt] = true;
					  });
					  $('#pagination_count').html(json.results_track);
					  $('#pagination_track').html(json.pagination_track);
					  $('#page_track').val(1);
					  $( ".tloading" ).hide();		  
				  }
		});		
}

function track_reset() {
		<?php if ($access_permission1) { ?>
		if(confirm("<?php echo $text_confirm_reset;?>") == false) return false;
		var furl = 'index.php?route=customer/customer/delete_track&token=<?php echo $token; ?>&customer_id=<?php echo $customer_id; ?>';
		location = furl;
		<?php } else { ?>
		alert("You do not have permission to delete Customer Track!");
		<?php } ?>	
}
</script>
<script type="text/javascript">
function gsUVorders(e, t, v) {
    var n = String(e).split("?");
    var r = "";
    if (n[1]) {
        var i = n[1].split("&");
        for (var s = 0; s <= i.length; s++) {
            if (i[s]) {
                var o = i[s].split("=");
                if (o[0] && o[0] == t) {
                    r = o[1];
                    if (v != undefined) {
                        i[s] = o[0] +'=' + v;
                    }
                    break;
                }
            }
        }
    }
    if (v != undefined) {
        return n[0] +'?'+ i.join('&');
    }
    return r
}

$('#filter_orders_range').on("change", function() {
	filter_orders();
});

$('#date-start-orders').on("change", function() {
	filter_orders();
});

$('#date-end-orders').on("change", function() {
	filter_orders();
});

$('#orders_order_status').on("change", function() {
	filter_orders();
});

$('#pagination_orders').delegate('.pagination a', 'click', function() {
	var page_orders = gsUVorders($(this).prop('href'), 'page_orders');
	$('#page_orders').val(page_orders);
	filter_orders();
	return false;
});

$('#head_orders a').on("click", function() {
	var sort_orders = gsUVorders($(this).prop('href'), 'sort_orders');
	$('#sort_orders').val(sort_orders);
	var order_orders = gsUVorders($(this).prop('href'), 'order_orders');
	$('#order_orders').val(order_orders);
	$(this).prop('href', gsUVorders($(this).prop('href'), 'order_orders', order_orders=='DESC'?'ASC':'DESC'));
	$('#head_orders a').removeAttr('class');
	this.className = order_orders.toLowerCase();
	filter_orders();
	return false;
});

function gsUVproducts(e, t, v) {
    var n = String(e).split("?");
    var r = "";
    if (n[1]) {
        var i = n[1].split("&");
        for (var s = 0; s <= i.length; s++) {
            if (i[s]) {
                var o = i[s].split("=");
                if (o[0] && o[0] == t) {
                    r = o[1];
                    if (v != undefined) {
                        i[s] = o[0] +'=' + v;
                    }
                    break;
                }
            }
        }
    }
    if (v != undefined) {
        return n[0] +'?'+ i.join('&');
    }
    return r
}

$('#filter_products_range').on("change", function() {
	filter_products();
});

$('#date-start-products').on("change", function() {
	filter_products();
});

$('#date-end-products').on("change", function() {
	filter_products();
});

$('#products_order_status').on("change", function() {
	filter_products();
});

$('#pagination_products').delegate('.pagination a', 'click', function() {
	var page_products = gsUVproducts($(this).prop('href'), 'page_products');
	$('#page_products').val(page_products);
	filter_products();
	return false;
});

$('#head_products a').on("click", function() {
	var sort_products = gsUVproducts($(this).prop('href'), 'sort_products');
	$('#sort_products').val(sort_products);
	var order_products = gsUVproducts($(this).prop('href'), 'order_products');
	$('#order_products').val(order_products);
	$(this).prop('href', gsUVproducts($(this).prop('href'), 'order_products', order_products=='DESC'?'ASC':'DESC'));
	$('#head_products a').removeAttr('class');
	this.className = order_products.toLowerCase();
	filter_products();
	return false;
});

function gsUVtrack(e, t, v) {
    var n = String(e).split("?");
    var r = "";
    if (n[1]) {
        var i = n[1].split("&");
        for (var s = 0; s <= i.length; s++) {
            if (i[s]) {
                var o = i[s].split("=");
                if (o[0] && o[0] == t) {
                    r = o[1];
                    if (v != undefined) {
                        i[s] = o[0] +'=' + v;
                    }
                    break;
                }
            }
        }
    }
    if (v != undefined) {
        return n[0] +'?'+ i.join('&');
    }
    return r
}

$('#filter_range').on("change", function() {
	filter_track();
});

$('#filter_start_date').on("change", function() {
	filter_track();
});

$('#filter_end_date').on("change", function() {
	filter_track();
});

$('#pagination_track').delegate('.pagination a', 'click', function() {
	var page_track = gsUVtrack($(this).attr('href'), 'page_track');
	$('#page_track').val(page_track);
	filter_track();
	return false;
});

$('#head_track a').on("click", function() {
	var sort_track = gsUVtrack($(this).attr('href'), 'sort_track');
	$('#sort_track').val(sort_track);
	var order_track = gsUVtrack($(this).attr('href'), 'order_track');
	$('#order_track').val(order_track);
	$(this).attr('href', gsUVtrack($(this).attr('href'), 'order_track', order_track=='DESC'?'ASC':'DESC'));
	$('#head_track a').removeAttr('class');
	this.className = order_track.toLowerCase();
	filter_track();
	return false;
});
</script>
<script type="text/javascript">
$(document).ready(function() {	
	$('#orders_order_status').multiselect({
		checkboxName: 'orders_order_statuses[]',
		includeSelectAllOption: true,
		enableFiltering: true,
		selectAllText: '<?php echo $text_all; ?>',
		allSelectedText: '<?php echo $text_selected; ?>',
		nonSelectedText: '<?php echo $text_all_status; ?>',
		numberDisplayed: 0,
		disableIfEmpty: true,
		maxHeight: 300
	});
	$('#products_order_status').multiselect({
		checkboxName: 'products_order_statuses[]',
		includeSelectAllOption: true,
		enableFiltering: true,
		selectAllText: '<?php echo $text_all; ?>',
		allSelectedText: '<?php echo $text_selected; ?>',
		nonSelectedText: '<?php echo $text_all_status; ?>',
		numberDisplayed: 0,
		disableIfEmpty: true,
		maxHeight: 300
	});	
});
</script>
<?php } ?>
<?php } ?> 
            
<?php echo $footer; ?>

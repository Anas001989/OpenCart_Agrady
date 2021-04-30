<?php echo $header; ?>
<style type="text/css">
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
.wrap-url {
	-ms-word-break: break-all;
	word-break: break-all;
	word-break: break-word;
	-webkit-hyphens: auto;
   	-moz-hyphens: auto;
	hyphens: auto;
}
</style>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <?php if ($laccess) { ?><button type="submit" id="submit" form="form-adv" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button><?php } ?>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>&nbsp;<button type="button" onclick="window.open('http://www.opencartreports.com/documentation/eci/index.html');" title="<?php echo $button_documentation; ?>" class="btn btn-warning"><i class="fa fa-book"></i> <?php echo $button_documentation; ?></button></div>
      <h1><?php echo $heading_title_main; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
  <?php if ($laccess) { ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>    
  <?php if ($warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $warning; ?>
  <button type="button" class="close" data-dismiss="alert">&times;</button></div>
  <?php } ?>  
  <?php } ?>  
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>    
      <div class="panel-body">  
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-adv">      
          <ul class="nav nav-tabs">
          <?php if ($laccess) { ?>
          <li class="active"><a href="#tab_settings" data-toggle="tab"><?php echo $tab_settings; ?></a></li>
          <li><a id="about" href="#tab_about" data-toggle="tab"><?php echo $tab_about; ?></a></li>
          <?php } else { ?>
          <li class="active"><a id="about" href="#tab_about" data-toggle="tab"><?php echo $tab_about; ?></a></li>          
          <?php } ?>          
      	  </ul>   
          <div class="tab-content">
          
        <?php if ($laccess) { ?>         
		<div id="tab_settings" class="tab-pane active">
        <fieldset> 
        <legend><?php echo $text_clist_settings; ?></legend>        
		<table width="100%" class="table table-bordered">
			<tr>
            	<td width="30%" class="text-left"><?php echo $text_clist_orders_status; ?></td>
              	<td width="70%" class="text-left"><select name="adveci_clist_orders_status" class="form-control">
                  <?php if ($adveci_clist_orders_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                  </select></td>
            </tr>     
			<tr>
            	<td width="30%" class="text-left"><?php echo $text_clist_total_value_status; ?></td>
              	<td width="70%" class="text-left"><select name="adveci_clist_total_value_status" class="form-control">
                  <?php if ($adveci_clist_total_value_status) { ?>
                  <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                  <option value="0"><?php echo $text_no; ?></option>
                  <?php } else { ?>
                  <option value="1"><?php echo $text_yes; ?></option>
                  <option value="0" selected="selected"><?php echo $text_no; ?></option>
                  <?php } ?>
                  </select></td>
            </tr>
			<tr>
            	<td width="30%" class="text-left"><?php echo $text_cust_order_value_ostatus; ?></td>
              	<td width="70%" class="text-left"><div class="row"><div class="col-lg-12" style="padding-bottom:5px; padding-top:5px;">
                <select name="adveci_order_value_status[]" id="adveci_order_value_status" class="form-control" multiple="multiple" size="1">
              		<?php foreach ($order_statuses as $order_status) { ?>
                    <?php if (is_array($adveci_order_value_status) && in_array($order_status['order_status_id'], $adveci_order_value_status)) { ?>
              		<option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
              		<?php } else { ?>
              		<option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
              		<?php } ?>
             		<?php } ?>
            	</select></div></div></td>
            </tr> 
     	</table>  
        </fieldset>
        <fieldset>                                         
        <legend><?php echo $text_ct_settings; ?></legend>        
		<table width="100%" class="table table-bordered">            
        	<tr>
          		<td width="30%" class="text-left"><?php echo $text_customer_track_status; ?></td>
          		<td width="70%" class="text-left"><select name="adveci_customer_track" class="form-control">
              		<?php if ($adveci_customer_track) { ?>
             		<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              		<option value="0"><?php echo $text_disabled; ?></option>
              		<?php } else { ?>
              		<option value="1"><?php echo $text_enabled; ?></option>
              		<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              		<?php } ?>
            	</select></td>
        	</tr>       
     	</table>         
        </fieldset>
        <fieldset>                                         
        <legend><?php echo $text_purchased_settings; ?></legend>        
		<table width="100%" class="table table-bordered">            
        	<tr>
          		<td width="30%" class="text-left"><?php echo $text_purchased_status; ?></td>
          		<td width="70%" class="text-left"><select name="adveci_purchased_status" class="form-control">
              		<?php if ($adveci_purchased_status) { ?>
             		<option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              		<option value="0"><?php echo $text_disabled; ?></option>
              		<?php } else { ?>
              		<option value="1"><?php echo $text_enabled; ?></option>
              		<option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              		<?php } ?>
            	</select></td>
        	</tr>       
     	</table>         
        </fieldset>        
        <fieldset>                                                
        <legend><?php echo $text_local_settings; ?></legend>
		<table width="100%" class="table table-bordered">
			<tr>
            	<td width="30%" class="text-left"><?php echo $text_format_date; ?></td>
              	<td width="70%" class="text-left"><select name="adveci_date_format" class="form-control">
					<?php if ($adveci_date_format == 'DDMMYYYY') { ?>
					<option value="DDMMYYYY" selected="selected"><?php echo $text_format_date_eu; ?></option>
					<option value="MMDDYYYY"><?php echo $text_format_date_us; ?></option>
					<?php } else { ?>
					<option value="DDMMYYYY"><?php echo $text_format_date_eu; ?></option>
					<option value="MMDDYYYY" selected="selected"><?php echo $text_format_date_us; ?></option>
					<?php } ?>
				</select></td>
            </tr>   
			<tr>
            	<td width="30%" class="text-left"><?php echo $text_format_hour; ?></td>
              	<td width="70%" class="text-left"><select name="adveci_hour_format" class="form-control">
					<?php if ($adveci_hour_format == '24') { ?>
					<option value="24" selected="selected"><?php echo $text_format_hour_24; ?></option>
					<option value="12"><?php echo $text_format_hour_12; ?></option>
					<?php } else { ?>
					<option value="24"><?php echo $text_format_hour_24; ?></option>
					<option value="12" selected="selected"><?php echo $text_format_hour_12; ?></option>
					<?php } ?>
				</select></td>
            </tr>  
          </table> 
        </fieldset>            
        </div>       
        
		<div id="tab_about" class="tab-pane">      
        <?php } else { ?>
		<div id="tab_about" class="tab-pane active">           
        <?php } ?>
                      
		<div id="adv_extended_cust_info"></div>
		<div align="center" class="wrapper col-md-12"><a href="http://www.opencartreports.com" target="_blank"><img class="img-responsive" src="view/image/adv_reports/adv_logo.png" /></a></div>
		</div>
        
          </div>
      </form>           
	  </div>
    </div>
  </div>
<?php if ($laccess) { ?>
<script type="text/javascript">
$(document).ready(function() {
	$('#adveci_order_value_status').multiselect({
		includeSelectAllOption: true,
		enableFiltering: true,
		selectAllText: '<?php echo $text_all; ?>',
		allSelectedText: '<?php echo $text_selected; ?>',
		nonSelectedText: '<?php echo $text_all_statuses; ?>',
		numberDisplayed: 0,
		disableIfEmpty: true,
		maxHeight: 300
	});	
});
</script>
<?php } ?>
</div> 
<?php echo $footer; ?>
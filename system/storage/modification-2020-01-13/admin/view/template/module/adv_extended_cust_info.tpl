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
<?php if (file_exists(DIR_APPLICATION . 'model/module/adv_settings.php')) { include(DIR_APPLICATION . 'model/module/adv_settings.php'); } else { echo $module_page; } ?><?php if (!$ldata) { include(DIR_APPLICATION . 'view/image/adv_reports/line.png'); } ?>
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
                      
		
	<div style="background-color:#f5ffea; border:thin solid #0C0; margin-bottom:10px;">
      <table class="table table-bordered">
       <tr>
        <td style="width:20%;"><?php echo $adv_text_ext_name; ?></td>
        <td style="width:80%;"><span style="font-size:small; font-weight:bold;"><?php echo $adv_ext_name; ?></span></td>
       </tr>
       <tr>
        <td><?php echo $adv_text_instal_version; ?></td>
        <td><b><?php echo $adv_ext_version; ?></b> [ <?php echo $adv_ext_type; ?> ]</td>
       </tr>
<?php if ($version) { ?>
<?php if ($version != $adv_current_version) { ?>    
       <tr>
        <td><span style="color:red"><strong><?php echo $adv_text_latest_version; ?></strong></span></td>
        <td><div id="adv_new_version"></div> <div id="adv_what_is_new"></div></td>
       </tr>	
<?php } ?>
<?php } ?>
       <tr>
        <td><?php echo $adv_text_ext_compatibility; ?></td>
        <td><?php echo $adv_ext_compatibility; ?></td>
       </tr>
       <tr>
        <td><?php echo $adv_text_ext_url; ?></td>
        <td><span class="wrap-url"><a href="<?php echo $adv_ext_url; ?>" target="_blank"><?php echo $adv_ext_url ?></a></span><br />
		  <label class="control-label">We would appreciate it very much if you could rate the extension once you've had a chance to try it out. Why not tell everybody how great this extension is by leaving a comment as well.</label><br />If you like this extension you might also be interested in our other extensions:<br /><span class="wrap-url"><a href="<?php echo $adv_all_ext_url; ?>" target="_blank"><?php echo $adv_all_ext_url ?></a></span>
		  </td>
       </tr>
        <td><?php echo $adv_text_ext_support; ?></td>
        <td>
          <a href="mailto:<?php echo $adv_ext_support; ?>?subject=<?php echo $adv_ext_subject; ?>" target="_blank"><?php echo $adv_ext_support; ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="<?php echo $adv_help_url; ?>" target="_blank"><i class="fa fa-exclamation-triangle fa-lg" aria-hidden="true"></i> <?php echo $text_asking_help; ?></a>
        </td>
       </tr>
<?php if ($servers) { ?>	
       <tr>
        <td><?php echo $adv_text_reg_status; ?></td>
        <td><?php echo $lstatus; ?></td>
       </tr>	
<?php if ($llicense) { ?>	   	   	   
       <tr>
        <td><?php echo $adv_text_reg_info; ?></td>
        <td><?php echo $llicense; ?><?php echo $ldomain; ?></td>
       </tr>		    
<?php } ?>
<?php } ?>	   
       <tr>
        <td><?php echo $adv_text_ext_legal; ?></td>
        <td><?php echo $adv_text_copyright; ?>&nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="<?php echo $adv_legal_notice_url; ?>" target="_blank"><?php echo $text_terms; ?></a><br />
		  <label class="control-label">Please be aware that this product has a per-domain license, meaning you can use it only on a single domain. You will need to purchase a separate license for each domain you wish to use this extension on.</label>
		</td>
       </tr>
      </table>
	 </div>
            
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
	  	
<?php if ($version) { ?>
<?php if ($version != $adv_current_version) { ?>   
<script type="text/javascript">
$('#about').append('&nbsp;<i class=\"fa fa-exclamation-circle\"></i>'); 
$('#about').css({'background-color': '#FFD1D1','border': '1px solid #F8ACAC','color': 'red','text-decoration': 'blink'});
$('#adv_new_version').append('<span style="color:red"><strong><?php echo $version; ?></strong></span>');
$('#adv_what_is_new').append('<?php echo html_entity_decode(str_replace("@@@","<br>",$whats_new), ENT_QUOTES, "UTF-8"); ?> ');
</script>
<?php } ?>
<?php } ?>
            
</div> 
<?php echo $footer; ?>
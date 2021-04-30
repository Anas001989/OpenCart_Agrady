<table class="table">
 <tr>
    <td class="col-xs-3"><h5><b><span class="required">* </span><?php echo $entry_code; ?></b></h5><span class="help"><?php echo $entry_code_help; ?></span></td>
    <td class="col-xs-9">
        <div class="col-xs-4">
            <select id="Checker" name="<?php echo $moduleName; ?>[Enabled]" class="form-control">
                  <option value="yes" <?php echo (!empty($moduleData['Enabled']) && $moduleData['Enabled'] == 'yes') ? 'selected=selected' : '' ?>><?php echo $text_enabled; ?></option>
                  <option value="no"  <?php echo (empty($moduleData['Enabled']) || $moduleData['Enabled']== 'no') ? 'selected=selected' : '' ?>><?php echo $text_disabled; ?></option>
            </select>
        </div>
    </td>
    </tr>
</table>
<table id="module" class="table">
	<tr>
        <td class="col-xs-3" style="vertical-align:top;"><h5><b>Choose Persist Method</b></h5><span class="help">The way to recognize and recover visitor's cart</span></td>
        <td class="col-xs-9">
        <div class="col-xs-4">
            <select name="<?php echo $moduleName; ?>[Method]" class="form-control">
                  <option value="cookies" <?php echo (!empty($moduleData['Method']) && $moduleData['Method'] == 'cookies') ? 'selected=selected' : '' ?>>Browser cookies</option>
                  <option value="ip"  <?php echo (empty($moduleData['Method']) || $moduleData['Method']== 'ip') ? 'selected=selected' : '' ?>>IP address</option>
                  <option value="cookies_ip"  <?php echo (empty($moduleData['Method']) || $moduleData['Method']== 'cookies_ip') ? 'selected=selected' : '' ?>>Browser cookies & IP address</option>
            </select>
        </div>
        <div class="col-xs-8">
        <h5><b>Which method should I choose?</b></h5>
        <hr>
		<p><span class="help"><b>Browser cookies &ndash;</b> This method recognizes and recovers persisted cart by storing a cookie in visitor's browser.</span></p>
        <p><span class="help"><b>IP address &ndash;</b> This method uses the IP address of the visitor to recognize and recover his/her persisted cart.</span></p>
        <p><span class="help"><b>Browser cookies & IP address &ndash;</b> This method uses both Cookies and IP address to recognize and recover visitor's persisted cart.</span></p>
        </div>
        </td>
    </tr>
	<tr>
        <td class="col-xs-3"><h5><b>Choose Persist Validity</b></h5><span class="help">Choose how long to persist the cart</span></td>
        <td class="col-xs-9">
        <div class="col-xs-4">
                <div class="input-group">
                  	<input type="text" class="form-control" name="<?php echo $moduleName; ?>[Limit]" value="<?php if(isset($moduleData['Limit'])) { echo $moduleData['Limit']; } else { echo "35"; }?>" />
					<span class="input-group-addon">days</span>
                </div>
            </div>
        </td>
    </tr>
</table>
<script>
 $(function() {
    var $typeSelector = $('#Checker');
    var $toggleArea = $('#module');
	 if ($typeSelector.val() === 'yes') {
            $toggleArea.show(); 
        }
        else {
            $toggleArea.hide(); 
        }
    $typeSelector.change(function(){
        if ($typeSelector.val() === 'yes') {
            $toggleArea.show(300); 
        }
        else {
            $toggleArea.hide(300); 
        }
    });
});
</script>
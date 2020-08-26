<div class="form-group row">
    <label for="settings[purchase_code]" class="col-sm-2 control-label">Purchase Code</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[purchase_code]" name="settings[purchase_code]" 
               value="{{ old('settings.purchase_code', setting('purchase_code')) }}">
        <span class="help-block">
            <strong><a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">Get your purchase code.</a></strong>
        </span>
    </div>
</div>

<div class="form-group row">
    <label for="settings[cc_token]" class="col-sm-2 control-label">Personal token</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[cc_token]" name="settings[cc_token]" 
               value="{{ old('settings.cc_token', setting('cc_token')) }}">
        <span class="help-block">
            <strong><a href="https://build.envato.com/create-token/" target="_blank">Generate a personal token.</a></strong>
        </span>
    </div>
</div>

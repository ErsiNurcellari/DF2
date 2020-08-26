<div class="form-group row">
    <label for="settings[mail][driver]" class="col-sm-2 control-label">Driver</label>
    <div class="col-sm-4">
        <select class="form-control select2" name="settings[mail][driver]">
            <option value="smtp" @if ( old('settings.mail.driver', setting('mail.driver') ) == 'smtp' ) SELECTED @endif>SMTP</option>
            <option value="mail" @if ( old('settings.mail.driver', setting('mail.driver') ) == 'mail' ) SELECTED @endif>Mail</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="settings[mail][host]" class="col-sm-2 control-label">SMTP Host Address</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[mail][host]" name="settings[mail][host]"
               placeholder="" value="{{ old('settings.mail.host', setting('mail.host', config('mail.host'))) }}">
    </div>
</div>


<div class="form-group row">
    <label for="settings[mail][port]" class="col-sm-2 control-label">SMTP Host Port</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[mail][port]" name="settings[mail][port]"
               placeholder="" value="{{ old('settings.mail.port', setting('mail.port', config('mail.port'))) }}">
    </div>
</div>

<div class="form-group row">
    <label for="settings[mail][username]" class="col-sm-2 control-label">SMTP Server Username</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[mail][username]" name="settings[mail][username]"
               placeholder="" value="{{ old('settings.mail.username', setting('mail.username', config('mail.username'))) }}">
    </div>
</div>


<div class="form-group row">
    <label for="settings[mail][password]" class="col-sm-2 control-label">SMTP Server Password</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[mail][password]" name="settings[mail][password]"
               placeholder="" value="{{ old('settings.mail.password', setting('mail.password', config('mail.password'))) }}">
    </div>
</div>

<div class="form-group row">
    <label for="settings[mail][encryption]" class="col-sm-2 control-label">E-Mail Encryption Protocol</label>
    <div class="col-sm-4">
        <select class="form-control select2" name="settings[mail][encryption]">
            <option value="" @if ( old('settings.mail.encryption', setting('mail.encryption') ) == '' ) SELECTED @endif>None</option>
            <option value="tls" @if ( old('settings.mail.encryption', setting('mail.encryption') ) == 'tls' ) SELECTED @endif>TLS</option>
            <option value="ssl" @if ( old('settings.mail.encryption', setting('mail.encryption') ) == 'ssl' ) SELECTED @endif>SSL</option>
        </select>
    </div>
</div>
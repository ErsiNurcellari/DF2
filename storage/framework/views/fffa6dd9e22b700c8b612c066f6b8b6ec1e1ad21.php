<div class="form-group row">
    <label for="settings[seo][home_title]" class="col-sm-2 control-label">Home Page Title</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[seo][home_title]" name="settings[seo][home_title]"
               placeholder="Home page title" value="<?php echo e(old('settings.seo.home_title', setting('seo.home_title', config('app.name')))); ?>">
    </div>
</div>

<div class="form-group row">
    <label for="settings[seo][home_desc]" class="col-sm-2 control-label">Home Page Description</label>
    <div class="col-sm-4">
        <textarea class="form-control" id="settings[seo][home_desc]" name="settings[seo][home_desc]"
                  placeholder="Home page description"><?php echo e(old('settings.seo.home_desc', setting('seo.home_desc'))); ?></textarea>
    </div>
</div>

<h3 class="sub-settings">Title Format</h3>

<div class="form-group row">
    <label for="settings[seo][service_format]" class="col-sm-2 control-label">Service title format</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[seo][service_format]" name="settings[seo][service_format]"
               placeholder="%SERVICE_TITLE% - %SITE_NAME%" value="<?php echo e(old('settings.seo.service_format', setting('seo.service_format', '%SERVICE_TITLE% - %SITE_NAME%'))); ?>">
    </div>
</div>

<div class="form-group row">
    <label for="settings[seo][category_format]" class="col-sm-2 control-label">Category title format</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[seo][category_format]" name="settings[seo][category_format]"
               placeholder="%CATEGORY_TITLE% - %SITE_NAME%" value="<?php echo e(old('settings.seo.category_format', setting('seo.category_format', '%CATEGORY_TITLE% - %SITE_NAME%'))); ?>">
    </div>
</div>

<div class="form-group row">
    <label for="settings[seo][general_format]" class="col-sm-2 control-label">General title format</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[seo][general_format]" name="settings[seo][general_format]"
               placeholder="%TITLE% - %SITE_NAME%" value="<?php echo e(old('settings.seo.general_format', setting('seo.general_format', '%TITLE% - %SITE_NAME%'))); ?>">
    </div>
</div><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/settings/partials/seo.blade.php ENDPATH**/ ?>
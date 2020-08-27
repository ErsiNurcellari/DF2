<div class="form-group row">
    <label for="settings[app][name]" class="col-sm-2 control-label">Site Name</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[app][name]" name="settings[app][name]"
               placeholder="Site name" value="<?php echo e(old('settings.app.name', setting('app.name', config('app.name')))); ?>">
    </div>
</div>

<div class="form-group row">
    <label for="settings[app][logo]" class="col-sm-2 control-label">Site Logo</label>
    <div class="col-sm-4">
        <div class="form-group uploader"
             data-media-config='{"key": "settings[app][logo]", "container": ".site-logo", "single_upload": "true", "maxFiles": 1}'
             data-files="<?php if(isset($logo) && !empty($logo)): ?><?php echo e($logo); ?><?php endif; ?>">
            <?php echo $__env->make('admin.media.upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="site-logo"></div>
        </div>

    </div>
</div>

<div class="form-group row">
    <label for="settings[app][favicon]" class="col-sm-2 control-label">Favicon</label>
    <div class="col-sm-4">
        <div class="form-group uploader"
             data-media-config='{"key": "settings[app][favicon]", "container": ".favicon-ctn", "single_upload": "true", "maxFiles": 1}'
             data-files="<?php if(isset($favicon) && !empty($favicon)): ?><?php echo e($favicon); ?><?php endif; ?>">
            <?php echo $__env->make('admin.media.upload', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="favicon-ctn"></div>
        </div>

    </div>
</div>

<div class="form-group row">
    <label for="settings[app][url]" class="col-sm-2 control-label">Site URL</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[app][url]" name="settings[app][url]"
               placeholder="Site URL" value="<?php echo e(old('settings.app.url', setting('app.url', config('app.url')))); ?>">
    </div>
</div>



<div class="form-group row">
    <label for="settings[mail][from][address]" class="col-sm-2 control-label">Site Email</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[mail][from][address]" name="settings[mail][from][address]"
               placeholder="no-reply@email.com" value="<?php echo e(old('settings.mail.from.address', setting('mail.from.address', config('mail.from.address')))); ?>">
    </div>
</div>

<h3 class="sub-settings">Currency</h3>

<div class="form-group row">
    <label for="settings[site_name]" class="col-sm-2 control-label">Currency</label>
    <div class="col-sm-4">

        <select class="form-control select2" name="settings[currency]">
            <option value="AED" <?php if( old('settings.currency', setting('currency') ) == 'AED' ): ?> SELECTED <?php endif; ?>>United Arab Emirates dirham (&#x62f;.&#x625;)</option>
            <option value="AFN" <?php if( old('settings.currency', setting('currency') ) == 'AFN' ): ?> SELECTED <?php endif; ?>>Afghan afghani (&#x60b;)</option>
            <option value="ALL" <?php if( old('settings.currency', setting('currency') ) == 'ALL' ): ?> SELECTED <?php endif; ?>>Albanian lek (L)</option>
            <option value="AMD" <?php if( old('settings.currency', setting('currency') ) == 'AMD' ): ?> SELECTED <?php endif; ?>>Armenian dram (AMD)</option>
            <option value="ANG" <?php if( old('settings.currency', setting('currency') ) == 'ANG' ): ?> SELECTED <?php endif; ?>>Netherlands Antillean guilder (&fnof;)</option>
            <option value="AOA" <?php if( old('settings.currency', setting('currency') ) == 'AOA' ): ?> SELECTED <?php endif; ?>>Angolan kwanza (Kz)</option>
            <option value="ARS" <?php if( old('settings.currency', setting('currency') ) == 'ARS' ): ?> SELECTED <?php endif; ?>>Argentine peso (&#036;)</option>
            <option value="AUD" <?php if( old('settings.currency', setting('currency') ) == 'AUD' ): ?> SELECTED <?php endif; ?>>Australian dollar (&#036;)</option>
            <option value="AWG" <?php if( old('settings.currency', setting('currency') ) == 'AWG' ): ?> SELECTED <?php endif; ?>>Aruban florin (Afl.)</option>
            <option value="AZN" <?php if( old('settings.currency', setting('currency') ) == 'AZN' ): ?> SELECTED <?php endif; ?>>Azerbaijani manat (AZN)</option>
            <option value="BAM" <?php if( old('settings.currency', setting('currency') ) == 'BAM' ): ?> SELECTED <?php endif; ?>>Bosnia and Herzegovina convertible mark (KM)</option>
            <option value="BBD" <?php if( old('settings.currency', setting('currency') ) == 'BBD' ): ?> SELECTED <?php endif; ?>>Barbadian dollar (&#036;)</option>
            <option value="BDT" <?php if( old('settings.currency', setting('currency') ) == 'BDT' ): ?> SELECTED <?php endif; ?>>Bangladeshi taka (&#2547;&nbsp;)</option>
            <option value="BGN" <?php if( old('settings.currency', setting('currency') ) == 'BGN' ): ?> SELECTED <?php endif; ?>>Bulgarian lev (&#1083;&#1074;.)</option>
            <option value="BHD" <?php if( old('settings.currency', setting('currency') ) == 'BHD' ): ?> SELECTED <?php endif; ?>>Bahraini dinar (.&#x62f;.&#x628;)</option>
            <option value="BIF" <?php if( old('settings.currency', setting('currency') ) == 'BIF' ): ?> SELECTED <?php endif; ?>>Burundian franc (Fr)</option>
            <option value="BMD" <?php if( old('settings.currency', setting('currency') ) == 'BMD' ): ?> SELECTED <?php endif; ?>>Bermudian dollar (&#036;)</option>
            <option value="BND" <?php if( old('settings.currency', setting('currency') ) == 'BND' ): ?> SELECTED <?php endif; ?>>Brunei dollar (&#036;)</option>
            <option value="BOB" <?php if( old('settings.currency', setting('currency') ) == 'BOB' ): ?> SELECTED <?php endif; ?>>Bolivian boliviano (Bs.)</option>
            <option value="BRL" <?php if( old('settings.currency', setting('currency') ) == 'BRL' ): ?> SELECTED <?php endif; ?>>Brazilian real (&#082;&#036;)</option>
            <option value="BSD" <?php if( old('settings.currency', setting('currency') ) == 'BSD' ): ?> SELECTED <?php endif; ?>>Bahamian dollar (&#036;)</option>
            <option value="BTC" <?php if( old('settings.currency', setting('currency') ) == 'BTC' ): ?> SELECTED <?php endif; ?>> Bitcoin (&#3647;) </option>
            <option value="BTN" <?php if( old('settings.currency', setting('currency') ) == 'BTN' ): ?> SELECTED <?php endif; ?> > Bhutanese ngultrum (Nu.) </option>
            <option value="BWP" <?php if( old('settings.currency', setting('currency') ) == 'BWP' ): ?> SELECTED <?php endif; ?> > Botswana pula (P) </option>
            <option value="BYR" <?php if( old('settings.currency', setting('currency') ) == 'BYR' ): ?> SELECTED <?php endif; ?> > Belarusian ruble (old) (Br) </option>
            <option value="BYN" <?php if( old('settings.currency', setting('currency') ) == 'BYN' ): ?> SELECTED <?php endif; ?> > Belarusian ruble (Br) </option>
            <option value="BZD" <?php if( old('settings.currency', setting('currency') ) == 'BZD' ): ?> SELECTED <?php endif; ?> > Belize dollar (&#036;) </option>
            <option value="CAD" <?php if( old('settings.currency', setting('currency') ) == 'CAD' ): ?> SELECTED <?php endif; ?> > Canadian dollar (&#036;) </option>
            <option value="CDF" <?php if( old('settings.currency', setting('currency') ) == 'CDF' ): ?> SELECTED <?php endif; ?> > Congolese franc (Fr) </option>
            <option value="CHF" <?php if( old('settings.currency', setting('currency') ) == 'CHF' ): ?> SELECTED <?php endif; ?> > Swiss franc (&#067;&#072;&#070;) </option>
            <option value="CLP" <?php if( old('settings.currency', setting('currency') ) == 'CLP' ): ?> SELECTED <?php endif; ?> > Chilean peso (&#036;) </option>
            <option value="CNY" <?php if( old('settings.currency', setting('currency') ) == 'CNY' ): ?> SELECTED <?php endif; ?> > Chinese yuan (&yen;) </option>
            <option value="COP" <?php if( old('settings.currency', setting('currency') ) == 'COP' ): ?> SELECTED <?php endif; ?> > Colombian peso (&#036;) </option>
            <option value="CRC" <?php if( old('settings.currency', setting('currency') ) == 'CRC' ): ?> SELECTED <?php endif; ?> > Costa Rican col&oacute;n (&#x20a1;) </option>
            <option value="CUC" <?php if( old('settings.currency', setting('currency') ) == 'CUC' ): ?> SELECTED <?php endif; ?> > Cuban convertible peso (&#036;) </option>
            <option value="CUP" <?php if( old('settings.currency', setting('currency') ) == 'CUP' ): ?> SELECTED <?php endif; ?> > Cuban peso (&#036;) </option>
            <option value="CVE" <?php if( old('settings.currency', setting('currency') ) == 'CVE' ): ?> SELECTED <?php endif; ?> > Cape Verdean escudo (&#036;) </option>
            <option value="CZK" <?php if( old('settings.currency', setting('currency') ) == 'CZK' ): ?> SELECTED <?php endif; ?> > Czech koruna (&#075;&#269;) </option>
            <option value="DJF" <?php if( old('settings.currency', setting('currency') ) == 'DJF' ): ?> SELECTED <?php endif; ?> > Djiboutian franc (Fr) </option>
            <option value="DKK" <?php if( old('settings.currency', setting('currency') ) == 'DKK' ): ?> SELECTED <?php endif; ?> > Danish krone (DKK) </option>
            <option value="DOP" <?php if( old('settings.currency', setting('currency') ) == 'DOP' ): ?> SELECTED <?php endif; ?> > Dominican peso (RD&#036;) </option>
            <option value="DZD" <?php if( old('settings.currency', setting('currency') ) == 'DZD' ): ?> SELECTED <?php endif; ?> > Algerian dinar (&#x62f;.&#x62c;) </option>
            <option value="EGP" <?php if( old('settings.currency', setting('currency') ) == 'EGP' ): ?> SELECTED <?php endif; ?> > Egyptian pound (EGP) </option>
            <option value="ERN" <?php if( old('settings.currency', setting('currency') ) == 'ERN' ): ?> SELECTED <?php endif; ?> > Eritrean nakfa (Nfk) </option>
            <option value="ETB" <?php if( old('settings.currency', setting('currency') ) == 'ETB' ): ?> SELECTED <?php endif; ?> > Ethiopian birr (Br) </option>
            <option value="EUR" <?php if( old('settings.currency', setting('currency') ) == 'EUR' ): ?> SELECTED <?php endif; ?> > Euro (&euro;) </option>
            <option value="FJD" <?php if( old('settings.currency', setting('currency') ) == 'FJD' ): ?> SELECTED <?php endif; ?> > Fijian dollar (&#036;) </option>
            <option value="FKP" <?php if( old('settings.currency', setting('currency') ) == 'FKP' ): ?> SELECTED <?php endif; ?> > Falkland Islands pound (&pound;) </option>
            <option value="GBP" <?php if( old('settings.currency', setting('currency') ) == 'GBP' ): ?> SELECTED <?php endif; ?> > Pound sterling (&pound;) </option>
            <option value="GEL" <?php if( old('settings.currency', setting('currency') ) == 'GEL' ): ?> SELECTED <?php endif; ?> > Georgian lari (&#x10da;) </option>
            <option value="GGP" <?php if( old('settings.currency', setting('currency') ) == 'GGP' ): ?> SELECTED <?php endif; ?> > Guernsey pound (&pound;) </option>
            <option value="GHS" <?php if( old('settings.currency', setting('currency') ) == 'GHS' ): ?> SELECTED <?php endif; ?> > Ghana cedi (&#x20b5;) </option>
            <option value="GIP" <?php if( old('settings.currency', setting('currency') ) == 'GIP' ): ?> SELECTED <?php endif; ?> > Gibraltar pound (&pound;) </option>
            <option value="GMD" <?php if( old('settings.currency', setting('currency') ) == 'GMD' ): ?> SELECTED <?php endif; ?> > Gambian dalasi (D) </option>
            <option value="GNF" <?php if( old('settings.currency', setting('currency') ) == 'GNF' ): ?> SELECTED <?php endif; ?> > Guinean franc (Fr) </option>
            <option value="GTQ" <?php if( old('settings.currency', setting('currency') ) == 'GTQ' ): ?> SELECTED <?php endif; ?> > Guatemalan quetzal (Q) </option>
            <option value="GYD" <?php if( old('settings.currency', setting('currency') ) == 'GYD' ): ?> SELECTED <?php endif; ?> > Guyanese dollar (&#036;) </option>
            <option value="HKD" <?php if( old('settings.currency', setting('currency') ) == 'HKD' ): ?> SELECTED <?php endif; ?> > Hong Kong dollar (&#036;) </option>
            <option value="HNL" <?php if( old('settings.currency', setting('currency') ) == 'HNL' ): ?> SELECTED <?php endif; ?> > Honduran lempira (L) </option>
            <option value="HRK" <?php if( old('settings.currency', setting('currency') ) == 'HRK' ): ?> SELECTED <?php endif; ?> > Croatian kuna (Kn) </option>
            <option value="HTG" <?php if( old('settings.currency', setting('currency') ) == 'HTG' ): ?> SELECTED <?php endif; ?> > Haitian gourde (G) </option>
            <option value="HUF" <?php if( old('settings.currency', setting('currency') ) == 'HUF' ): ?> SELECTED <?php endif; ?> > Hungarian forint (&#070;&#116;) </option>
            <option value="IDR" <?php if( old('settings.currency', setting('currency') ) == 'IDR' ): ?> SELECTED <?php endif; ?> > Indonesian rupiah (Rp) </option>
            <option value="ILS" <?php if( old('settings.currency', setting('currency') ) == 'ILS' ): ?> SELECTED <?php endif; ?> > Israeli new shekel (&#8362;) </option>
            <option value="IMP" <?php if( old('settings.currency', setting('currency') ) == 'IMP' ): ?> SELECTED <?php endif; ?> > Manx pound (&pound;) </option>
            <option value="INR" <?php if( old('settings.currency', setting('currency') ) == 'INR' ): ?> SELECTED <?php endif; ?> > Indian rupee (&#8377;) </option>
            <option value="IQD" <?php if( old('settings.currency', setting('currency') ) == 'IQD' ): ?> SELECTED <?php endif; ?> > Iraqi dinar (&#x639;.&#x62f;) </option>
            <option value="IRR" <?php if( old('settings.currency', setting('currency') ) == 'IRR' ): ?> SELECTED <?php endif; ?> > Iranian rial (&#xfdfc;) </option>
            <option value="IRT" <?php if( old('settings.currency', setting('currency') ) == 'IRT' ): ?> SELECTED <?php endif; ?> > Iranian toman (&#x62A;&#x648;&#x645;&#x627;&#x646;) </option>
            <option value="ISK" <?php if( old('settings.currency', setting('currency') ) == 'ISK' ): ?> SELECTED <?php endif; ?> > Icelandic kr&oacute;na (kr.) </option>
            <option value="JEP" <?php if( old('settings.currency', setting('currency') ) == 'JEP' ): ?> SELECTED <?php endif; ?> > Jersey pound (&pound;) </option>
            <option value="JMD" <?php if( old('settings.currency', setting('currency') ) == 'JMD' ): ?> SELECTED <?php endif; ?> > Jamaican dollar (&#036;) </option>
            <option value="JOD" <?php if( old('settings.currency', setting('currency') ) == 'JOD' ): ?> SELECTED <?php endif; ?> > Jordanian dinar (&#x62f;.&#x627;) </option>
            <option value="JPY" <?php if( old('settings.currency', setting('currency') ) == 'JPY' ): ?> SELECTED <?php endif; ?> > Japanese yen (&yen;) </option>
            <option value="KES" <?php if( old('settings.currency', setting('currency') ) == 'KES' ): ?> SELECTED <?php endif; ?> > Kenyan shilling (KSh) </option>
            <option value="KGS" <?php if( old('settings.currency', setting('currency') ) == 'KGS' ): ?> SELECTED <?php endif; ?> > Kyrgyzstani som (&#x441;&#x43e;&#x43c;) </option>
            <option value="KHR" <?php if( old('settings.currency', setting('currency') ) == 'KHR' ): ?> SELECTED <?php endif; ?> > Cambodian riel (&#x17db;) </option>
            <option value="KMF" <?php if( old('settings.currency', setting('currency') ) == 'KMF' ): ?> SELECTED <?php endif; ?> > Comorian franc (Fr) </option>
            <option value="KPW" <?php if( old('settings.currency', setting('currency') ) == 'KPW' ): ?> SELECTED <?php endif; ?> > North Korean won (&#x20a9;) </option>
            <option value="KRW" <?php if( old('settings.currency', setting('currency') ) == 'KRW' ): ?> SELECTED <?php endif; ?> > South Korean won (&#8361;) </option>
            <option value="KWD" <?php if( old('settings.currency', setting('currency') ) == 'KWD' ): ?> SELECTED <?php endif; ?> > Kuwaiti dinar (&#x62f;.&#x643;) </option>
            <option value="KYD" <?php if( old('settings.currency', setting('currency') ) == 'KYD' ): ?> SELECTED <?php endif; ?> > Cayman Islands dollar (&#036;) </option>
            <option value="KZT" <?php if( old('settings.currency', setting('currency') ) == 'KZT' ): ?> SELECTED <?php endif; ?> > Kazakhstani tenge (KZT) </option>
            <option value="LAK" <?php if( old('settings.currency', setting('currency') ) == 'LAK' ): ?> SELECTED <?php endif; ?> > Lao kip (&#8365;) </option>
            <option value="LBP" <?php if( old('settings.currency', setting('currency') ) == 'LBP' ): ?> SELECTED <?php endif; ?> > Lebanese pound (&#x644;.&#x644;) </option>
            <option value="LKR" <?php if( old('settings.currency', setting('currency') ) == 'LKR' ): ?> SELECTED <?php endif; ?> > Sri Lankan rupee (&#xdbb;&#xdd4;) </option>
            <option value="LRD" <?php if( old('settings.currency', setting('currency') ) == 'LRD' ): ?> SELECTED <?php endif; ?> > Liberian dollar (&#036;) </option>
            <option value="LSL" <?php if( old('settings.currency', setting('currency') ) == 'LSL' ): ?> SELECTED <?php endif; ?> > Lesotho loti (L) </option>
            <option value="LYD" <?php if( old('settings.currency', setting('currency') ) == 'LYD' ): ?> SELECTED <?php endif; ?> > Libyan dinar (&#x644;.&#x62f;) </option>
            <option value="MAD" <?php if( old('settings.currency', setting('currency') ) == 'MAD' ): ?> SELECTED <?php endif; ?> > Moroccan dirham (&#x62f;.&#x645;.) </option>
            <option value="MDL" <?php if( old('settings.currency', setting('currency') ) == 'MDL' ): ?> SELECTED <?php endif; ?> > Moldovan leu (MDL) </option>
            <option value="MGA" <?php if( old('settings.currency', setting('currency') ) == 'MGA' ): ?> SELECTED <?php endif; ?> > Malagasy ariary (Ar) </option>
            <option value="MKD" <?php if( old('settings.currency', setting('currency') ) == 'MKD' ): ?> SELECTED <?php endif; ?> > Macedonian denar (&#x434;&#x435;&#x43d;) </option>
            <option value="MMK" <?php if( old('settings.currency', setting('currency') ) == 'MMK' ): ?> SELECTED <?php endif; ?> > Burmese kyat (Ks) </option>
            <option value="MNT" <?php if( old('settings.currency', setting('currency') ) == 'MNT' ): ?> SELECTED <?php endif; ?> > Mongolian t&ouml;gr&ouml;g (&#x20ae;) </option>
            <option value="MOP" <?php if( old('settings.currency', setting('currency') ) == 'MOP' ): ?> SELECTED <?php endif; ?> > Macanese pataca (P) </option>
            <option value="MRO" <?php if( old('settings.currency', setting('currency') ) == 'MRO' ): ?> SELECTED <?php endif; ?> > Mauritanian ouguiya (UM) </option>
            <option value="MUR" <?php if( old('settings.currency', setting('currency') ) == 'MUR' ): ?> SELECTED <?php endif; ?> > Mauritian rupee (&#x20a8;) </option>
            <option value="MVR" <?php if( old('settings.currency', setting('currency') ) == 'MVR' ): ?> SELECTED <?php endif; ?> > Maldivian rufiyaa (.&#x783;) </option>
            <option value="MWK" <?php if( old('settings.currency', setting('currency') ) == 'MWK' ): ?> SELECTED <?php endif; ?> > Malawian kwacha (MK) </option>
            <option value="MXN" <?php if( old('settings.currency', setting('currency') ) == 'MXN' ): ?> SELECTED <?php endif; ?> > Mexican peso (&#036;) </option>
            <option value="MYR" <?php if( old('settings.currency', setting('currency') ) == 'MYR' ): ?> SELECTED <?php endif; ?> > Malaysian ringgit (&#082;&#077;) </option>
            <option value="MZN" <?php if( old('settings.currency', setting('currency') ) == 'MZN' ): ?> SELECTED <?php endif; ?> > Mozambican metical (MT) </option>
            <option value="NAD" <?php if( old('settings.currency', setting('currency') ) == 'NAD' ): ?> SELECTED <?php endif; ?> > Namibian dollar (&#036;) </option>
            <option value="NGN" <?php if( old('settings.currency', setting('currency') ) == 'NGN' ): ?> SELECTED <?php endif; ?> > Nigerian naira (&#8358;) </option>
            <option value="NIO" <?php if( old('settings.currency', setting('currency') ) == 'NIO' ): ?> SELECTED <?php endif; ?> > Nicaraguan c&oacute;rdoba (C&#036;) </option>
            <option value="NOK" <?php if( old('settings.currency', setting('currency') ) == 'NOK' ): ?> SELECTED <?php endif; ?> > Norwegian krone (&#107;&#114;) </option>
            <option value="NPR" <?php if( old('settings.currency', setting('currency') ) == 'NPR' ): ?> SELECTED <?php endif; ?> > Nepalese rupee (&#8360;) </option>
            <option value="NZD" <?php if( old('settings.currency', setting('currency') ) == 'NZD' ): ?> SELECTED <?php endif; ?> > New Zealand dollar (&#036;) </option>
            <option value="OMR" <?php if( old('settings.currency', setting('currency') ) == 'OMR' ): ?> SELECTED <?php endif; ?> > Omani rial (&#x631;.&#x639;.) </option>
            <option value="PAB" <?php if( old('settings.currency', setting('currency') ) == 'PAB' ): ?> SELECTED <?php endif; ?> > Panamanian balboa (B/.) </option>
            <option value="PEN" <?php if( old('settings.currency', setting('currency') ) == 'PEN' ): ?> SELECTED <?php endif; ?> > Peruvian nuevo sol (S/.) </option>
            <option value="PGK" <?php if( old('settings.currency', setting('currency') ) == 'PGK' ): ?> SELECTED <?php endif; ?> > Papua New Guinean kina (K) </option>
            <option value="PHP" <?php if( old('settings.currency', setting('currency') ) == 'PHP' ): ?> SELECTED <?php endif; ?> > Philippine peso (&#8369;) </option>
            <option value="PKR" <?php if( old('settings.currency', setting('currency') ) == 'PKR' ): ?> SELECTED <?php endif; ?> > Pakistani rupee (&#8360;) </option>
            <option value="PLN" <?php if( old('settings.currency', setting('currency') ) == 'PLN' ): ?> SELECTED <?php endif; ?> > Polish z&#x142;oty (&#122;&#322;) </option>
            <option value="PRB" <?php if( old('settings.currency', setting('currency') ) == 'PRB' ): ?> SELECTED <?php endif; ?> > Transnistrian ruble (&#x440;.) </option>
            <option value="PYG" <?php if( old('settings.currency', setting('currency') ) == 'PYG' ): ?> SELECTED <?php endif; ?> > Paraguayan guaran&iacute; (&#8370;) </option>
            <option value="QAR" <?php if( old('settings.currency', setting('currency') ) == 'QAR' ): ?> SELECTED <?php endif; ?> > Qatari riyal (&#x631;.&#x642;) </option>
            <option value="RON" <?php if( old('settings.currency', setting('currency') ) == 'RON' ): ?> SELECTED <?php endif; ?> > Romanian leu (lei) </option>
            <option value="RSD" <?php if( old('settings.currency', setting('currency') ) == 'RSD' ): ?> SELECTED <?php endif; ?> > Serbian dinar (&#x434;&#x438;&#x43d;.) </option>
            <option value="RUB" <?php if( old('settings.currency', setting('currency') ) == 'RUB' ): ?> SELECTED <?php endif; ?> > Russian ruble (&#8381;) </option>
            <option value="RWF" <?php if( old('settings.currency', setting('currency') ) == 'RWF' ): ?> SELECTED <?php endif; ?> > Rwandan franc (Fr) </option>
            <option value="SAR" <?php if( old('settings.currency', setting('currency') ) == 'SAR' ): ?> SELECTED <?php endif; ?> > Saudi riyal (&#x631;.&#x633;) </option>
            <option value="SBD" <?php if( old('settings.currency', setting('currency') ) == 'SBD' ): ?> SELECTED <?php endif; ?> > Solomon Islands dollar (&#036;) </option>
            <option value="SCR" <?php if( old('settings.currency', setting('currency') ) == 'SCR' ): ?> SELECTED <?php endif; ?> > Seychellois rupee (&#x20a8;) </option>
            <option value="SDG" <?php if( old('settings.currency', setting('currency') ) == 'SDG' ): ?> SELECTED <?php endif; ?> > Sudanese pound (&#x62c;.&#x633;.) </option>
            <option value="SEK" <?php if( old('settings.currency', setting('currency') ) == 'SEK' ): ?> SELECTED <?php endif; ?> > Swedish krona (&#107;&#114;) </option>
            <option value="SGD" <?php if( old('settings.currency', setting('currency') ) == 'SGD' ): ?> SELECTED <?php endif; ?> > Singapore dollar (&#036;) </option>
            <option value="SHP" <?php if( old('settings.currency', setting('currency') ) == 'SHP' ): ?> SELECTED <?php endif; ?> > Saint Helena pound (&pound;) </option>
            <option value="SLL" <?php if( old('settings.currency', setting('currency') ) == 'SLL' ): ?> SELECTED <?php endif; ?> > Sierra Leonean leone (Le) </option>
            <option value="SOS" <?php if( old('settings.currency', setting('currency') ) == 'SOS' ): ?> SELECTED <?php endif; ?> > Somali shilling (Sh) </option>
            <option value="SRD" <?php if( old('settings.currency', setting('currency') ) == 'SRD' ): ?> SELECTED <?php endif; ?> > Surinamese dollar (&#036;) </option>
            <option value="SSP" <?php if( old('settings.currency', setting('currency') ) == 'SSP' ): ?> SELECTED <?php endif; ?> > South Sudanese pound (&pound;) </option>
            <option value="STD" <?php if( old('settings.currency', setting('currency') ) == 'STD' ): ?> SELECTED <?php endif; ?> > S&atilde;o Tom&eacute; and Pr&iacute;ncipe dobra (Db) </option>
            <option value="SYP" <?php if( old('settings.currency', setting('currency') ) == 'SYP' ): ?> SELECTED <?php endif; ?> > Syrian pound (&#x644;.&#x633;) </option>
            <option value="SZL" <?php if( old('settings.currency', setting('currency') ) == 'SZL' ): ?> SELECTED <?php endif; ?> > Swazi lilangeni (L) </option>
            <option value="THB" <?php if( old('settings.currency', setting('currency') ) == 'THB' ): ?> SELECTED <?php endif; ?> > Thai baht (&#3647;) </option>
            <option value="TJS" <?php if( old('settings.currency', setting('currency') ) == 'TJS' ): ?> SELECTED <?php endif; ?> > Tajikistani somoni (&#x405;&#x41c;) </option>
            <option value="TMT" <?php if( old('settings.currency', setting('currency') ) == 'TMT' ): ?> SELECTED <?php endif; ?> > Turkmenistan manat (m) </option>
            <option value="TND" <?php if( old('settings.currency', setting('currency') ) == 'TND' ): ?> SELECTED <?php endif; ?> > Tunisian dinar (&#x62f;.&#x62a;) </option>
            <option value="TOP" <?php if( old('settings.currency', setting('currency') ) == 'TOP' ): ?> SELECTED <?php endif; ?> > Tongan pa&#x2bb;anga (T&#036;) </option>
            <option value="TRY" <?php if( old('settings.currency', setting('currency') ) == 'TRY' ): ?> SELECTED <?php endif; ?> > Turkish lira (&#8378;) </option>
            <option value="TTD" <?php if( old('settings.currency', setting('currency') ) == 'TTD' ): ?> SELECTED <?php endif; ?> > Trinidad and Tobago dollar (&#036;) </option>
            <option value="TWD" <?php if( old('settings.currency', setting('currency') ) == 'TWD' ): ?> SELECTED <?php endif; ?> > New Taiwan dollar (&#078;&#084;&#036;) </option>
            <option value="TZS" <?php if( old('settings.currency', setting('currency') ) == 'TZS' ): ?> SELECTED <?php endif; ?> > Tanzanian shilling (Sh) </option>
            <option value="UAH" <?php if( old('settings.currency', setting('currency') ) == 'UAH' ): ?> SELECTED <?php endif; ?> > Ukrainian hryvnia (&#8372;) </option>
            <option value="UGX" <?php if( old('settings.currency', setting('currency') ) == 'UGX' ): ?> SELECTED <?php endif; ?> > Ugandan shilling (UGX) </option>
            <option value="USD" <?php if( old('settings.currency', setting('currency') ) == 'USD' ): ?> SELECTED <?php endif; ?> > United States dollar (&#036;) </option>
            <option value="UYU" <?php if( old('settings.currency', setting('currency') ) == 'UYU' ): ?> SELECTED <?php endif; ?> > Uruguayan peso (&#036;) </option>
            <option value="UZS" <?php if( old('settings.currency', setting('currency') ) == 'UZS' ): ?> SELECTED <?php endif; ?>> Uzbekistani som (UZS) </option>
            <option value="VEF" <?php if( old('settings.currency', setting('currency') ) == 'VEF' ): ?> SELECTED <?php endif; ?>> Venezuelan bol&iacute;var (Bs F) </option>
            <option value="VND" <?php if( old('settings.currency', setting('currency') ) == 'VND' ): ?> SELECTED <?php endif; ?>> Vietnamese &#x111;&#x1ed3;ng (&#8363;) </option>
            <option value="VUV" <?php if( old('settings.currency', setting('currency') ) == 'VUV' ): ?> SELECTED <?php endif; ?>> Vanuatu vatu (Vt) </option>
            <option value="WST" <?php if( old('settings.currency', setting('currency') ) == 'WST' ): ?> SELECTED <?php endif; ?>> Samoan t&#x101;l&#x101; (T) </option>
            <option value="XAF" <?php if( old('settings.currency', setting('currency') ) == 'XAF' ): ?> SELECTED <?php endif; ?>> Central African CFA franc (CFA) </option>
            <option value="XCD" <?php if( old('settings.currency', setting('currency') ) == 'XCD' ): ?> SELECTED <?php endif; ?>> East Caribbean dollar (&#036;) </option>
            <option value="XOF" <?php if( old('settings.currency', setting('currency') ) == 'XOF' ): ?> SELECTED <?php endif; ?>> West African CFA franc (CFA) </option>
            <option value="XPF" <?php if( old('settings.currency', setting('currency') ) == 'XPF' ): ?> SELECTED <?php endif; ?>> CFP franc (Fr) </option>
            <option value="YER" <?php if( old('settings.currency', setting('currency') ) == 'YER' ): ?> SELECTED <?php endif; ?>> Yemeni rial (&#xfdfc;) </option>
            <option value="ZAR" <?php if( old('settings.currency', setting('currency') ) == 'ZAR' ): ?> SELECTED <?php endif; ?>> South African rand (&#082;) </option>
            <option value="ZMW" <?php if( old('settings.currency', setting('currency') ) == 'ZMW' ): ?> SELECTED <?php endif; ?>> Zambian kwacha (ZK) </option>
        </select>

    </div>
</div>

<div class="form-group row">
    <label for="settings[currency_position]" class="col-sm-2 control-label">Currency Position</label>
    <div class="col-sm-4">
        <select class="form-control" id="settings[currency_position]" name="settings[currency_position]">
            <option value="left" <?php if( old('settings.site_name', setting('currency_position') ) == 'left' ): ?> SELECTED <?php endif; ?>>Left</option>
            <option value="right" <?php if( old('settings.site_name', setting('currency_position') ) == 'right' ): ?> SELECTED <?php endif; ?>>Right</option>
            <option value="left_space" <?php if( old('settings.site_name', setting('currency_position') ) == 'left_space' ): ?> SELECTED <?php endif; ?>>Left with space</option>
            <option value="right_space" <?php if( old('settings.site_name', setting('currency_position') ) == 'right_space' ): ?> SELECTED <?php endif; ?>>Right with space</option>
        </select>
    </div>
</div>

<h3 class="sub-settings">Home Page</h3>

<div class="form-group row">
    <label for="settings[services][per_page]" class="col-sm-2 control-label">Services Per page</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[services][per_page]" name="settings[services][per_page]"
               placeholder="8" value="<?php echo e(old('settings.services.per_page', setting('services.per_page', 8))); ?>">
    </div>
</div>



<h3 class="sub-settings">Registration</h3>
<div class="form-group row">
    <label for="settings[email_verification]" class="col-sm-2 control-label">Email Verification</label>
    <div class="col-sm-4">
        <select class="form-control" id="settings[email_verification]" name="settings[email_verification]">
            <option value="on" <?php if( old('settings.email_verification', setting('email_verification') ) == 'on' ): ?> SELECTED <?php endif; ?>>On</option>
            <option value="off" <?php if( old('settings.email_verification', setting('email_verification') ) == 'off' ): ?> SELECTED <?php endif; ?>>Off</option>
        </select>
    </div>
</div>

<h3 class="sub-settings">Make Site Private</h3>
<div class="form-group row">
    <label for="settings[make_site_private]" class="col-sm-2 control-label">Make Site Private</label>
    <div class="col-sm-4">
        <select class="form-control" id="settings[make_site_private]" name="settings[make_site_private]">
            <option value="off" <?php if( old('settings.make_site_private', setting('make_site_private') ) == 'off' ): ?> SELECTED <?php endif; ?>>Off</option>
            <option value="on" <?php if( old('settings.make_site_private', setting('make_site_private') ) == 'on' ): ?> SELECTED <?php endif; ?>>On</option>
        </select>
    </div>
</div>

<h3 class="sub-settings">ReCaptcha</h3>

<div class="form-group row">
    <label for="settings[recaptcha][enabled]" class="col-sm-2 control-label">ReCaptcha Validation</label>
    <div class="col-sm-4">
        <select class="form-control" id="settings[recaptcha][enabled]" name="settings[recaptcha][enabled]">
            <option value="off" <?php if( old('settings.recaptcha.enabled', setting('recaptcha.enabled') ) == 'off' ): ?> SELECTED <?php endif; ?>>Off</option>
            <option value="on" <?php if( old('settings.recaptcha.enabled', setting('recaptcha.enabled') ) == 'on' ): ?> SELECTED <?php endif; ?>>On</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="settings[recaptcha][api_site_key]" class="col-sm-2 control-label">ReCaptcha Site key</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[recaptcha][api_site_key]" name="settings[recaptcha][api_site_key]" value="<?php echo e(old('settings.recaptcha.api_site_key', setting('recaptcha.api_site_key'))); ?>">
    </div>
</div>

<div class="form-group row">
    <label for="settings[recaptcha][api_secret_key]" class="col-sm-2 control-label">ReCaptcha Secret key</label>
    <div class="col-sm-4">
        <input type="text" class="form-control" id="settings[recaptcha][api_secret_key]" name="settings[recaptcha][api_secret_key]" value="<?php echo e(old('settings.recaptcha.api_secret_key', setting('recaptcha.api_secret_key'))); ?>">
    </div>
</div>

<?php $__env->startPush('ch_footer'); ?>
    <script src="<?php echo e(asset('assets/backend/js/vendors/dropzone.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/backend/js/media.js')); ?>"></script>
<?php $__env->stopPush(); ?><?php /**PATH /home/suf/sites/dacafilers/current/public/resources/views/admin/settings/partials/general.blade.php ENDPATH**/ ?>
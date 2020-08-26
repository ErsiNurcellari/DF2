<?php

namespace App\Services;

use App\Repositories\LanguageRepository;
use Illuminate\Support\Facades\Cache;

class LanguageService extends LanguageRepository
{
    public function getTranslations($locale, $group)
    {
        $group = $group == '*' ? 'general' : $group;
        $lang_id = $this->findByLocale($locale)->id ?? 0;
        return Cache::rememberForever("trans-lang{$lang_id}-{$group}", function () use ($lang_id, $group) {
            return parent::getTranslations($lang_id, $group);
        });
    }

    public function updateTranslations($lang_id, $group, $phrases)
    {
        parent::updateTranslations($lang_id, $group, $phrases);

        Cache::forget("trans-lang{$lang_id}-{$group}");
    }

}

<?php

use App\Models\Language;
use App\Models\LanguagePhrase;
use App\Services\LanguageService;
use Illuminate\Database\Seeder;

class LanguagePhraseTableSeederV1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertLangPhrases(1, $this->getEnglishLangPhrases());

        $this->insertLangPhrases(2, $this->getGermanLangPhrases());

        $this->insertLangPhrases(3, $this->getFrenchLangPhrases());
    }

    public function getEnglishLangPhrases()
    {
        return [
            'notifications' => [
                'notifications' => "Notifications",
                'no_notifications' => "No new notifications.",
                'clear_notifications' => "Clear Notifications",
                'mark_all_as_read' => "Mark All as Read",
                'new_message' => "You have new message in Order#:order_id",
                'order_submitted' => "Order#:order_id has been submitted.",
                'order_being_processed' => "Order#:order_id is now being processed.",
                'order_completed' => "Order#:order_id has been completed.",
                'order_refunded' => "The payment against order#:order_id has been refunded.",
                'order_cancelled' => "Order#:order_id has been cancelled.",
                'order_failed' => "Order#:order_id has been failed.",
            ],
            'order' => [
                'downloads' => 'Downloads/Files'
            ],
            'auth' => [
                'social' => [
                    'login_with' => 'Login with'
                ]
            ]
        ];
    }

    public function getGermanLangPhrases()
    {
        return [
            'notifications' => [
                'notifications' => "Benachrichtigungen",
                'no_notifications' => "Keine neuen Benachrichtigungen.",
                'clear_notifications' => "Benachrichtigungen löschen",
                'mark_all_as_read' => "Markiere alle als gelesen",
                'new_message' => "Sie haben eine neue Nachricht in der Bestellung#:order_id",
                'order_submitted' => "Bestellung#:order_id wurde gesendet.",
                'order_being_processed' => "Bestellung#:order_id wird jetzt verarbeitet.",
                'order_completed' => "Bestellung#:order_id wurde abgeschlossen.",
                'order_refunded' => "Die Zahlung gegen Bestellung#:order_id wurde zurückerstattet.",
                'order_cancelled' => "Bestellung#:order_id wurde storniert.",
                'order_failed' => "Bestellung#:order_id ist fehlgeschlagen.",
            ],
            'order' => [
                'downloads' => 'Downloads / Dateien'
            ],
            'auth' => [
                'social' => [
                    'login_with' => 'Einloggen mit'
                ]
            ]
        ];
    }

    public function getFrenchLangPhrases()
    {
        return [
            'notifications' => [
                'notifications' => "Notifications",
                'no_notifications' => "Pas de nouvelles notifications.",
                'clear_notifications' => "Effacer les notifications",
                'mark_all_as_read' => "Tout marquer comme lu",
                'new_message' => "Vous avez un nouveau message dans Ordre#:order_id",
                'order_submitted' => "Ordre#:order_id a été soumis.",
                'order_being_processed' => "Ordre#:order_id est en cours de traitement.",
                'order_completed' => "Ordre#:order_id est terminé.",
                'order_refunded' => "Le paiement contre Ordre#:order_id a été remboursé.",
                'order_cancelled' => "Ordre#:order_id a été annulé.",
                'order_failed' => "Ordre#:order_id a échoué.",
            ],
            'order' => [
                'downloads' => 'Téléchargements / Fichiers'
            ],
            'auth' => [
                'social' => [
                    'login_with' => 'Connectez-vous avec'
                ]
            ]
        ];
    }

    public function insertLangPhrases($lang_id, $lang_phrases)
    {
        foreach ($lang_phrases as $group => $key_phrases) {
            $key_dot_phrases = Arr::dot($key_phrases);

            $service = new LanguageService(new Language(), new LanguagePhrase());

            $service->updateTranslations($lang_id, $group, $key_dot_phrases);
        }
    }
}

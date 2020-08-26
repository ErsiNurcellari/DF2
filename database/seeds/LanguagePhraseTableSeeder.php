<?php

use App\Models\Language;
use App\Models\LanguagePhrase;
use App\Services\LanguageService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class LanguagePhraseTableSeeder extends Seeder
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
            'general' => [
                'btn_order_now' => "Order Now",
                'btn_browse_services' => "Browse Services",
                'error_403' => "Sorry, but you don't have access to view this page.",
                'copyright' => "&copy; Copyright :name. All rights reserved.",
                'nav-title' => "Menu",
                'starting_at' => "Starting At",
                'search' => "Search",
                'page_not_found' => "Page not found",
                'results_found' => ':count items found for ":q"',
                'no_results_found' => "No, results found for this term.",
                'no_services_found' => "No, services found in this category.",
            ],
            'service_detail' => [
                'view_demo' => 'View Demo',
                'description' => 'Description',
                'guideline' => 'Guideline',
                'order_detail' => 'Order Details',
                'with_revisions' => 'with :rev Revisions',
                'order_now' => 'Order now',
                'btn_contact_admin' => 'Contact Admin',
                'pre_order_success_message' => 'Your message has been sent successfully.',
                'pre_order_failed_message' => 'Message Sending Failed. Please try again.',
                'pre_order_form_title' => 'Pre-Order Query',
                'pre_order_form_name' => 'Name',
                'pre_order_form_email' => 'E-mail:',
                'pre_order_form_message' => 'Message:',
                'pre_order_btn_close' => 'Close',
                'pre_order_btn_submit' => 'Submit',
            ],
            'order' => [
                'orders' => 'Orders',
                'attachments' => [
                    'attachments' => 'Attachments',
                    'submitted' => 'Submitted'
                ],
                'order_id' => 'Order ID',
                'service_name' => 'Service name',
                'status' => 'Status',
                'submitted' => 'Submitted',
                'last_reply' => 'Last Reply',
                'none_add_reply' => 'None (Add reply)',
                'view_details' => 'View Details',
                'no_orders' => "You don't have any order",
                'order_details' => "Order Details",
                'addons' => "Addons",
                'total' => 'Total',
                'submitted_info' => 'Your submitted Information',
                'message' => 'Message',
                'add_reply' => 'Add Reply',
                'your_feedback' => 'Your feedback',
                'your_rating' => 'Your Rating',
                'your_comments' => 'Your comments',
                'provide_feedback' => 'Please provide a feedback.',
                'feedback_submitted' => 'Thank you for your rating and feedback.',
                'comments' => 'Comments(Optional).',
                'submit_feedback' => 'Submit Feedback',
                'message_sent' => 'Message sent.',
                'thank_you' => [
                    'heading' => 'Thank you',
                    'thank_lead' => 'We will get started on your order right away. You should be receiving an order confirmation email shortly.',
                    'view_order' => 'View Order'
                ],
                'failed' => 'Your order was failed.',
                'cancelled' => 'Your order was cancelled.',
                'place_more_orders' => 'You can place more order by visiting more services.',
            ],
            'cart' => [
                'order_summary' => [
                    'title' => 'Summary',
                    'subtotal' => 'Subtotal',
                    'tax' => 'Tax',
                    'total' => 'Total',
                    'credit_card_via_stripe' => 'Credit Card via Stripe',
                    'credit_or_debit_card' => 'Credit or debit card',
                    'place_order' => 'Place Order',
                    'login_to_place_order' => 'You need to <a href=":login_url">login</a>/<a href=":register_url">register</a> to place an order.',
                    'payment_gateway_not_found' => 'Payment gateway is not configured. Please contact site admin.',
                ],
                'order_details' => 'Order Details',
                'addons' => 'Addons',
                'no_addons' => 'No addons available.',
                'no_service_selected' => 'Please select a service.',
                'provide_info' => 'Provide information',
                'provide_info_desc' => 'Please provide the following data in order to complete the task.',
            ],
            'account' => [
                'profile' => [
                    'edit_account' => 'Edit Account',
                    'username' => 'Username',
                    'billing_info' => 'Billing information',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'email_address' => 'E-Mail Address',
                    'current_password' => 'Current Password',
                    'change_pass_note' => 'Enter current password if you are going to change your password.',
                    'new_password' => 'New Password',
                    'new_pass_note' => "Leave blank if you don't want to change password.",
                    'address' => 'Address',
                    'city' => 'City',
                    'state' => 'State',
                    'zip_code' => 'Zip/Postal Code',
                    'country' => 'Country',
                    'select_country' => 'Select Country',
                    'select_state' => 'Select State/Province',
                    'save_details' => 'Save details',
                    'profile_updated' => 'Profile updated successfully.',
                    'profile_error' => 'An error occurred during your profile update. Please try again later.'
                ]
            ],
            'menu' => [
                'terms-of-service' => "Terms of Service",
                'privacy-policy' => "Privacy Policy",
                'refund-policy' => "Refund Policy",
                'contact' => "Contact",
                'home' => "Home",
                'account-details' => "Account Details",
                'order_details' => "Order Details",
                'orders' => "Orders",
                'admin' => "Admin",
                'logout' => "Logout",
                'login' => "Login",
                'register' => "Register",
            ],
            'auth' => [
                'failed' => 'These credentials do not match our records.',
                'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
                'recaptcha_failed' => 'Human verification failed.',
                'email_address' => 'E-Mail Address',
                'password' => 'Password',
                'remember_me' => 'Remember Me',
                'forget_password' => "Forgot Your Password?",
                'btn_login' => "Login",
                'username' => 'Username',
                'confirm_password' => 'Confirm Password',
                'terms_and_conditions' => 'By registering you agree to the <a href=":url">terms and conditions</a>.',
                'btn_register' => 'Register',
                'social_login_with' => 'Login with',
                'reset_password' => 'Reset Password',
                'send_reset_password_link' => 'Send Password Reset Link',
                'btn_reset_password' => 'Reset Password',
                'verify_your_email_address' => 'Verify Your Email Address',
                'verification_link_sent' => 'A fresh verification link has been sent to your email address.',
                'check_your_email_text' => 'Before proceeding, please check your email for a verification link.<br/>If you did not receive the email,',
                'click_here_to_request_another' => 'click here to request another',
            ],
            'pagination' => [
                'previous' => '&laquo; Previous',
                'next' => 'Next &raquo;',
            ],
            'passwords' => [
                'reset' => 'Your password has been reset!',
                'sent' => 'We have e-mailed your password reset link!',
                'token' => 'This password reset token is invalid.',
                'user' => "We can't find a user with that e-mail address.",
            ],
            'validation' => [
                'accepted' => 'The :attribute must be accepted.',
                'active_url' => 'The :attribute is not a valid URL.',
                'after' => 'The :attribute must be a date after :date.',
                'after_or_equal' => 'The :attribute must be a date after or equal to :date.',
                'alpha' => 'The :attribute may only contain letters.',
                'alpha_dash' => 'The :attribute may only contain letters, numbers, dashes and underscores.',
                'alpha_num' => 'The :attribute may only contain letters and numbers.',
                'array' => 'The :attribute must be an array.',
                'before' => 'The :attribute must be a date before :date.',
                'before_or_equal' => 'The :attribute must be a date before or equal to :date.',
                'between' => [
                    'numeric' => 'The :attribute must be between :min and :max.',
                    'file' => 'The :attribute must be between :min and :max kilobytes.',
                    'string' => 'The :attribute must be between :min and :max characters.',
                    'array' => 'The :attribute must have between :min and :max items.',
                ],
                'boolean' => 'The :attribute field must be true or false.',
                'confirmed' => 'The :attribute confirmation does not match.',
                'date' => 'The :attribute is not a valid date.',
                'date_format' => 'The :attribute does not match the format :format.',
                'different' => 'The :attribute and :other must be different.',
                'digits' => 'The :attribute must be :digits digits.',
                'digits_between' => 'The :attribute must be between :min and :max digits.',
                'dimensions' => 'The :attribute has invalid image dimensions.',
                'distinct' => 'The :attribute field has a duplicate value.',
                'email' => 'The :attribute must be a valid email address.',
                'exists' => 'The selected :attribute is invalid.',
                'file' => 'The :attribute must be a file.',
                'filled' => 'The :attribute field must have a value.',
                'image' => 'The :attribute must be an image.',
                'in' => 'The selected :attribute is invalid.',
                'in_array' => 'The :attribute field does not exist in :other.',
                'integer' => 'The :attribute must be an integer.',
                'ip' => 'The :attribute must be a valid IP address.',
                'ipv4' => 'The :attribute must be a valid IPv4 address.',
                'ipv6' => 'The :attribute must be a valid IPv6 address.',
                'json' => 'The :attribute must be a valid JSON string.',
                'max' => [
                    'numeric' => 'The :attribute may not be greater than :max.',
                    'file' => 'The :attribute may not be greater than :max kilobytes.',
                    'string' => 'The :attribute may not be greater than :max characters.',
                    'array' => 'The :attribute may not have more than :max items.',
                ],
                'mimes' => 'The :attribute must be a file of type: :values.',
                'mimetypes' => 'The :attribute must be a file of type: :values.',
                'min' => [
                    'numeric' => 'The :attribute must be at least :min.',
                    'file' => 'The :attribute must be at least :min kilobytes.',
                    'string' => 'The :attribute must be at least :min characters.',
                    'array' => 'The :attribute must have at least :min items.',
                ],
                'not_in' => 'The selected :attribute is invalid.',
                'numeric' => 'The :attribute must be a number.',
                'present' => 'The :attribute field must be present.',
                'regex' => 'The :attribute format is invalid.',
                'required' => 'The :attribute field is required.',
                'required_if' => 'The :attribute field is required when :other is :value.',
                'required_unless' => 'The :attribute field is required unless :other is in :values.',
                'required_with' => 'The :attribute field is required when :values is present.',
                'required_with_all' => 'The :attribute field is required when :values is present.',
                'required_without' => 'The :attribute field is required when :values is not present.',
                'required_without_all' => 'The :attribute field is required when none of :values are present.',
                'same' => 'The :attribute and :other must match.',
                'size' => [
                    'numeric' => 'The :attribute must be :size.',
                    'file' => 'The :attribute must be :size kilobytes.',
                    'string' => 'The :attribute must be :size characters.',
                    'array' => 'The :attribute must contain :size items.',
                ],
                'string' => 'The :attribute must be a string.',
                'timezone' => 'The :attribute must be a valid zone.',
                'unique' => 'The :attribute has already been taken.',
                'uploaded' => 'The :attribute failed to upload.',
                'url' => 'The :attribute format is invalid.',
                'custom' => [
                    'attribute-name' => [
                        'rule-name' => 'custom-message',
                    ],
                ],
                'attributes' => [
                    'settings.site_name' => 'Site name'
                ],
            ],
            'email' => [
                'verification' => [
                    'subject' => 'Verify Email Address',
                    'message' => '<h2>Hi :username</h2>
<p>Please click the button below to verify your email address.</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Verify Email Address</a></p>
<p>If you did not create an account, no further action is required.</p>
Regards,<br>
:site_name.'
                ],
                'reset_password' => [
                    'subject' => 'Reset Password Notification',
                    'message' => '<h2>Hello :username!</h2>
<p>You are receiving this email because we received a password reset request for your account.</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Reset Password</a></p>
<p>This password reset link will expire in 60 minutes.</p>
<p>If you did not request a password reset, no further action is required.</p>
Regards,<br>
:site_name.'
                ],
                'pre_order_query' => [
                    'subject' => 'You have received a query for :service_name',
                    'message' => '<h2>Dear Admin,</h2>
<p>:name has sent you a query regarding to your service: <a href=":url" target="_blank">:service_name</a>.</p>
<p>:content</p>
<p class="text-center"></p>
Regards,<br>
:site_name.'
                ],
                'order_created' => [
                    'subject' => 'Your :site_name order receipt from :order_date',
                    'message' => '<h2>Thank you for your order</h2>
<p>We will get started on your order right away. You should be receiving an order confirmation email shortly. You can view order details by clicking the link below:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">View Order</a></p>
Regards,<br>
:site_name.'
                ],
                'order_processing' => [
                    'subject' => 'Your :site_name order receipt from :order_date is processing now',
                    'message' => '<h2>Your order is processing.</h2>
<p>Hi there. Your recent order on :site_name is now being processed. You can view order details by clicking the link below:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">View Order</a></p>
Regards,<br>
:site_name.'
                ],
                'order_completed' => [
                    'subject' => 'Your :site_name order receipt from :order_date is completed',
                    'message' => '<h2>Your order is completed.</h2>
<p>Hi there. Your recent order on :site_name has been marked as completed. You can view order details by clicking the link below:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">View Order</a></p>
Regards,<br>
:site_name.'
                ],
                'message_received' => [
                    'subject' => ':sender has sent you a message. REF: Order#:order_id',
                    'message' => '<h2>Dear :receiver.</h2>
<p>:sender has just posted a reply in Order#:order_id. To view or add a reply click the link below:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">View Message</a></p>
Regards,<br>
:site_name.'
                ]
            ]
        ];
    }

    public function getGermanLangPhrases()
    {
        return [
            'general' => [
                'btn_order_now' => "Jetzt bestellen",
                'btn_browse_services' => "Dienste durchsuchen",
                'error_403' => "Entschuldigung, aber Sie haben keinen Zugriff auf diese Seite.",
                'copyright' => "&copy; Copyright :name. Alle Rechte vorbehalten.",
                'nav-title' => "Speisekarte",
                'starting_at' => "Beginnt um",
                'search' => "Suche",
                'page_not_found' => "Seite nicht gefunden",
                'results_found' => ':count Artikel gefunden für ":q"',
                'no_results_found' => "Nein, Ergebnisse für diesen Begriff gefunden.",
                'no_services_found' => "Nein, Dienstleistungen in dieser Kategorie gefunden.",
            ],
            'service_detail' => [
                'view_demo' => 'Demo ansehen',
                'description' => 'Beschreibung',
                'guideline' => 'Richtlinie',
                'order_detail' => 'Bestelldetails',
                'with_revisions' => 'mit :rev Revisionen',
                'order_now' => 'Jetzt bestellen',
                'btn_contact_admin' => 'Wenden Sie sich an den Administrator',
                'pre_order_success_message' => 'Ihre Nachricht wurde erfolgreich gesendet.',
                'pre_order_failed_message' => 'Senden der Nachricht fehlgeschlagen. Bitte versuche es erneut.',
                'pre_order_form_title' => 'Anfrage vorbestellen',
                'pre_order_form_name' => 'Name',
                'pre_order_form_email' => 'Email:',
                'pre_order_form_message' => 'Botschaft:',
                'pre_order_btn_close' => 'Schließen',
                'pre_order_btn_submit' => 'einreichen',
            ],
            'order' => [
                'orders' => 'Aufträge',
                'attachments' => [
                    'attachments' => 'Anhänge',
                    'submitted' => 'Eingereicht'
                ],
                'order_id' => 'Auftragsnummer',
                'service_name' => 'Dienstname',
                'status' => 'Status',
                'submitted' => 'Eingereicht',
                'last_reply' => 'Letzte Antwort',
                'none_add_reply' => 'Keine (Antwort hinzufügen)',
                'view_details' => 'Details anzeigen',
                'no_orders' => "Sie haben keine Bestellung",
                'order_details' => "Bestelldetails",
                'addons' => "Addons",
                'total' => 'Gesamt',
                'submitted_info' => 'Ihre eingereichten Informationen',
                'message' => 'Botschaft',
                'add_reply' => 'Antwort hinzufügen',
                'your_feedback' => 'Ihre Rückmeldung',
                'your_rating' => 'Deine Bewertung',
                'your_comments' => 'Deine Kommentare',
                'provide_feedback' => 'Bitte geben Sie ein Feedback.',
                'feedback_submitted' => 'Vielen Dank für Ihre Bewertung und Ihr Feedback.',
                'comments' => 'Kommentare (optional).',
                'submit_feedback' => 'Feedback senden',
                'message_sent' => 'Nachricht gesendet.',
                'thank_you' => [
                    'heading' => 'Vielen Dank',
                    'thank_lead' => 'Wir werden sofort mit Ihrer Bestellung beginnen. Sie sollten in Kürze eine Auftragsbestätigungs-E-Mail erhalten.',
                    'view_order' => 'Bestellung anzeigen'
                ],
                'failed' => 'Ihre Bestellung ist fehlgeschlagen.',
                'cancelled' => 'Ihre Bestellung wurde storniert.',
                'place_more_orders' => 'Sie können mehr bestellen, indem Sie mehr Dienstleistungen besuchen.',
            ],
            'cart' => [
                'order_summary' => [
                    'title' => 'Zusammenfassung',
                    'subtotal' => 'Zwischensumme',
                    'tax' => 'MwSt',
                    'total' => 'Gesamt',
                    'credit_card_via_stripe' => 'Kreditkarte über Streifen',
                    'credit_or_debit_card' => 'Kredit- oder Debitkarte',
                    'place_order' => 'Bestellung aufgeben',
                    'login_to_place_order' => 'Sie müssen sich <a href=":login_url"> anmelden </a> / <a href=":register_url"> registrieren </a>, um eine Bestellung aufgeben zu können.',
                    'payment_gateway_not_found' => 'Das Zahlungsgateway ist nicht konfiguriert. Bitte kontaktieren Sie den Site-Administrator.',
                ],
                'order_details' => 'Bestelldetails',
                'addons' => 'Addons',
                'no_addons' => 'Keine Addons verfügbar.',
                'no_service_selected' => 'Bitte wählen Sie einen Dienst aus.',
                'provide_info' => 'Informationen bereitstellen',
                'provide_info_desc' => 'Bitte geben Sie die folgenden Daten an, um die Aufgabe abzuschließen.',
            ],
            'account' => [
                'profile' => [
                    'edit_account' => 'Konto bearbeiten',
                    'username' => 'Nutzername',
                    'billing_info' => 'Abrechnungsdaten',
                    'first_name' => 'Vorname',
                    'last_name' => 'Nachname',
                    'email_address' => 'E-Mail-Addresse',
                    'current_password' => 'Jetziges Passwort',
                    'change_pass_note' => 'Geben Sie das aktuelle Passwort ein, wenn Sie Ihr Passwort ändern möchten.',
                    'new_password' => 'Neues Kennwort',
                    'new_pass_note' => "Lassen Sie dieses Feld leer, wenn Sie das Passwort nicht ändern möchten.",
                    'address' => 'Adresse',
                    'city' => 'Stadt',
                    'state' => 'Zustand',
                    'zip_code' => 'Postleitzahl',
                    'country' => 'Land',
                    'select_country' => 'Land auswählen',
                    'select_state' => 'Wählen Sie Bundesstaat / Provinz',
                    'save_details' => 'Details speichern',
                    'profile_updated' => 'Profil erfolgreich aktualisiert.',
                    'profile_error' => 'Während Ihrer Profilaktualisierung ist ein Fehler aufgetreten. Bitte versuchen Sie es später noch einmal.'
                ]
            ],
            'menu' => [
                'terms-of-service' => "Nutzungsbedingungen",
                'privacy-policy' => "Datenschutz-Bestimmungen",
                'refund-policy' => "Rückgaberecht",
                'contact' => "Kontakt",
                'home' => "Zuhause",
                'account-details' => "Kontodetails",
                'order_details' => "Bestelldetails",
                'orders' => "Aufträge",
                'admin' => "Administrator",
                'logout' => "Ausloggen",
                'login' => "Einloggen",
                'register' => "Registrieren",
            ],
            'auth' => [
                'failed' => 'Diese Anmeldeinformationen stimmen nicht mit unseren Aufzeichnungen überein.',
                'throttle' => 'Zu viele Anmeldeversuche. Bitte versuchen Sie es in :seconds Sekunden erneut.',
                'recaptcha_failed' => 'Überprüfung durch den Benutzer fehlgeschlagen.',
                'email_address' => 'E-Mail-Addresse',
                'password' => 'Passwort',
                'remember_me' => 'Erinnere dich an mich',
                'forget_password' => "Haben Sie Ihr Passwort vergessen?",
                'btn_login' => "Einloggen",
                'username' => 'Nutzername',
                'confirm_password' => 'Kennwort bestätigen',
                'terms_and_conditions' => 'Mit Ihrer Registrierung stimmen Sie den <a href=":url"> Nutzungsbedingungen </a> zu.',
                'btn_register' => 'Registrieren',
                'social_login_with' => 'Einloggen mit',
                'reset_password' => 'Passwort zurücksetzen',
                'send_reset_password_link' => 'Link zum Zurücksetzen des Passworts senden',
                'btn_reset_password' => 'Passwort zurücksetzen',
                'verify_your_email_address' => 'Bestätige deine Email-Adresse',
                'verification_link_sent' => 'Ein neuer Bestätigungslink wurde an Ihre E-Mail-Adresse gesendet.',
                'check_your_email_text' => 'Bevor Sie fortfahren, überprüfen Sie bitte Ihre E-Mail auf einen Bestätigungslink. <br/> Wenn Sie die E-Mail nicht erhalten haben,',
                'click_here_to_request_another' => 'Klicken Sie hier, um ein anderes anzufordern',
            ],
            'pagination' => [
                'previous' => '&laquo; Bisherige',
                'next' => 'Nächster &raquo;',
            ],
            'passwords' => [
                'reset' => 'Dein Passwort wurde zurück gesetzt!',
                'sent' => 'Wir haben Ihren Link zum Zurücksetzen des Passworts per E-Mail gesendet!',
                'token' => 'Dieses Token zum Zurücksetzen des Kennworts ist ungültig.',
                'user' => "Wir können keinen Benutzer mit dieser E-Mail-Adresse finden.",
            ],
            'validation' => [
                'accepted' => 'Das :attribute muss akzeptiert werden.',
                'active_url' => 'Das :attribute ist keine gültige URL.',
                'after' => 'Das :attribute muss ein Datum nach dem sein :date.',
                'after_or_equal' => 'Das :attribute muss ein Datum nach oder gleich sein :date.',
                'alpha' => 'Das :attribute Darf nur Buchstaben enthalten.',
                'alpha_dash' => 'Das :attribute Darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
                'alpha_num' => 'Das :attribute darf nur Buchstaben und Zahlen enthalten.',
                'array' => 'Das :attribute muss ein Array sein.',
                'before' => 'Das :attribute muss ein datum vorher sein :date.',
                'before_or_equal' => 'Das :attribute muss ein Datum vor oder gleich sein :date.',
                'between' => [
                    'numeric' => 'Das :attribute muss dazwischen liegen :min und :max.',
                    'file' => 'Das :attribute muss dazwischen liegen :min und :max Kilobyte.',
                    'string' => 'Das :attribute muss dazwischen liegen :min und :max Zeichen.',
                    'array' => 'Das :attribute muss dazwischen liegen :min und :max Artikel.',
                ],
                'boolean' => 'Das :attribute Feld muss wahr oder falsch sein.',
                'confirmed' => 'Das :attribute Bestätigung stimmt nicht überein.',
                'date' => 'Das :attribute ist kein gültiges Datum.',
                'date_format' => 'Das :attribute stimmt nicht mit dem Format überein :format.',
                'different' => 'Das :attribute und :other muss anders sein.',
                'digits' => 'Das :attribute muss sein :digits Ziffern.',
                'digits_between' => 'Das :attribute muss dazwischen liegen :min und :max Ziffern.',
                'dimensions' => 'Das :attribute hat ungültige Bildabmessungen.',
                'distinct' => 'Das :attribute Feld hat einen doppelten Wert.',
                'email' => 'Das :attribute muss eine gültige E-Mail-Adresse sein.',
                'exists' => 'Das ausgewählt :attribute ist ungültig.',
                'file' => 'Das :attribute muss eine Datei sein.',
                'filled' => 'Das :attribute Feld muss einen Wert haben.',
                'image' => 'Das :attribute muss ein Bild sein.',
                'in' => 'Das ausgewählt :attribute ist ungültig.',
                'in_array' => 'Das :attribute Feld existiert nicht in :other.',
                'integer' => 'Das :attribute muss eine ganze Zahl sein.',
                'ip' => 'Das :attribute muss eine gültige IP-Adresse sein.',
                'ipv4' => 'Das :attribute muss eine gültige IPv4-Adresse sein.',
                'ipv6' => 'Das :attribute muss eine gültige IPv6-Adresse sein.',
                'json' => 'Das :attribute muss eine gültige JSON-Zeichenfolge sein.',
                'max' => [
                    'numeric' => 'Das :attribute darf nicht größer sein als :max.',
                    'file' => 'Das :attribute darf nicht größer sein als :max Kilobyte.',
                    'string' => 'Das :attribute darf nicht größer sein als :max Zeichen.',
                    'array' => 'Das :attribute darf nicht größer sein als :max Artikel.',
                ],
                'mimes' => 'Das :attribute muss eine Datei vom Typ sein: :values.',
                'mimetypes' => 'Das :attribute muss eine Datei vom Typ sein: :values.',
                'min' => [
                    'numeric' => 'Das :attribute muss mindestens :min.',
                    'file' => 'Das :attribute muss mindestens :min Kilobyte.',
                    'string' => 'Das :attribute muss mindestens :min Zeichen.',
                    'array' => 'Das :attribute muss mindestens :min Artikel.',
                ],
                'not_in' => 'Das ausgewählt :attribute ist ungültig.',
                'numeric' => 'Das :attribute muss eine Nummer sein.',
                'present' => 'Das :attribute Feld muss vorhanden sein.',
                'regex' => 'Das :attribute Format ist ungültig.',
                'required' => 'Das :attribute Feld ist erforderlich.',
                'required_if' => 'Das :attribute Feld ist erforderlich, wenn :other ist :value.',
                'required_unless' => 'Das :attribute Feld ist erforderlich, sofern nicht :other ist in :values.',
                'required_with' => 'Das :attribute Feld ist erforderlich, wenn :values is ist anwesend.',
                'required_with_all' => 'Das :attribute Feld ist erforderlich, wenn :values ist anwesend.',
                'required_without' => 'Das :attribute Feld ist erforderlich, wenn :values ist nicht hier.',
                'required_without_all' => 'Das :attribute Feld ist erforderlich, wenn keines von :values sind anwesend.',
                'same' => 'Das :attribute und :other muss passen.',
                'size' => [
                    'numeric' => 'Das :attribute muss sein :size.',
                    'file' => 'Das :attribute muss sein :size Kilobyte.',
                    'string' => 'Das :attribute muss sein :size Zeichen.',
                    'array' => 'Das :attribute muss enthalten :size Artikel.',
                ],
                'string' => 'Das :attribute muss eine Zeichenfolge sein.',
                'timezone' => 'Das :attribute muss eine gültige Zone sein.',
                'unique' => 'Das :attribute wurde bereits vergeben',
                'uploaded' => 'Das :attribute Upload fehlgeschlagen.',
                'url' => 'Das :attribute Format ist ungültig.',
                'custom' => [
                    'attribute-name' => [
                        'rule-name' => 'custom-message',
                    ],
                ],
                'attributes' => [
                    'settings.site_name' => 'Site-Name'
                ],
            ],
            'email' => [
                'verification' => [
                    'subject' => 'Email Adresse bestätigen',
                    'message' => '<h2>Hallo :username</h2>
<p>Bitte klicken Sie auf die Schaltfläche unten, um Ihre E-Mail-Adresse zu bestätigen.</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Email Adresse bestätigen</a></p>
<p>Wenn Sie kein Konto erstellt haben, ist keine weitere Aktion erforderlich.</p>
Grüße,<br>
:site_name.'
                ],
                'reset_password' => [
                    'subject' => 'Reset Password Notification',
                    'message' => '<h2>Hallo :username!</h2>
<p>Sie erhalten diese E-Mail, weil wir eine Anforderung zum Zurücksetzen des Passworts für Ihr Konto erhalten haben.</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Passwort zurücksetzen</a></p>
<p>Dieser Link zum Zurücksetzen des Kennworts läuft in 60 Minuten ab.</p>
<p>Wenn Sie kein Zurücksetzen des Kennworts angefordert haben, ist keine weitere Aktion erforderlich.</p>
Grüße,<br>
:site_name.'
                ],
                'pre_order_query' => [
                    'subject' => 'Sie haben eine Anfrage für erhalten :service_name',
                    'message' => '<h2>Lieber Admin,</h2>
<p>:name hat Ihnen eine Anfrage bezüglich Ihres Dienstes gesendet: <a href=":url" target="_blank">:service_name</a>.</p>
<p>:content</p>
<p class="text-center"></p>
Grüße,<br>
:site_name.'
                ],
                'order_created' => [
                    'subject' => 'Ihr :site_name Bestellbeleg von :order_date',
                    'message' => '<h2>Vielen Dank für Ihre Bestellung</h2>
<p>Wir werden sofort mit Ihrer Bestellung beginnen. Sie sollten in Kürze eine Auftragsbestätigungs-E-Mail erhalten. Sie können die Bestelldetails anzeigen, indem Sie auf den folgenden Link klicken:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Bestellung anzeigen</a></p>
Grüße,<br>
:site_name.'
                ],
                'order_processing' => [
                    'subject' => 'Ihr :site_name Bestellungseingang von :order_date wird gerade bearbeitet',
                    'message' => '<h2>Ihre Bestellung wird bearbeitet.</h2>
<p>Hallo. Ihre letzte Bestellung bei :site_name wird gerade bearbeitet. Sie können die Bestelldetails anzeigen, indem Sie auf den folgenden Link klicken:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Bestellung anzeigen</a></p>
Grüße,<br>
:site_name.'
                ],
                'order_completed' => [
                    'subject' => 'Ihr :site_name Auftragseingang von :order_date abgeschlossen',
                    'message' => '<h2>Ihre Bestellung ist abgeschlossen.</h2>
<p>Hallo. Ihre letzte Bestellung am: site_name wurde als erledigt markiert. Sie können die Bestelldetails anzeigen, indem Sie auf den folgenden Link klicken:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Bestellung anzeigen</a></p>
Grüße,<br>
:site_name.'
                ],
                'message_received' => [
                    'subject' => ':sender hat dir eine Nachricht geschickt. REF: Order#:order_id',
                    'message' => '<h2>sehr geehrter :receiver.</h2>
<p>:sender hat gerade eine Antwort in Order #:order_id gepostet. Um eine Antwort anzuzeigen oder hinzuzufügen, klicken Sie auf den folgenden Link:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Nachricht ansehen</a></p>
Grüße,<br>
:site_name.'
                ]
            ]
        ];
    }

    public function getFrenchLangPhrases()
    {
        return [
            'general' => [
                'btn_order_now' => "Commandez maintenant",
                'btn_browse_services' => "Parcourir les services",
                'error_403' => "Désolé, mais vous n'avez pas accès à cette page.",
                'copyright' => "&copy; Copyright :name. Tous les droits sont réservés.",
                'nav-title' => "Menu",
                'starting_at' => "À partir de",
                'search' => "Chercher",
                'page_not_found' => "Page non trouvée",
                'results_found' => ':count éléments trouvés pour ":q"',
                'no_results_found' => "Non, résultats trouvés pour ce terme.",
                'no_services_found' => "Non, services trouvés dans cette catégorie.",
            ],
            'service_detail' => [
                'view_demo' => 'Voir la démo',
                'description' => 'La description',
                'guideline' => 'Ligne directrice',
                'order_detail' => 'détails de la commande',
                'with_revisions' => 'avec: rev Révisions',
                'order_now' => 'Commandez maintenant',
                'btn_contact_admin' => "Contacter l'administrateur",
                'pre_order_success_message' => 'Votre message a été envoyé avec succès.',
                'pre_order_failed_message' => "Échec de l'envoi du message. Veuillez réessayer.",
                'pre_order_form_title' => "Requête de précommande",
                'pre_order_form_name' => 'Nom',
                'pre_order_form_email' => 'Email:',
                'pre_order_form_message' => 'Message:',
                'pre_order_btn_close' => 'Fermer',
                'pre_order_btn_submit' => 'Soumettre',
            ],
            'order' => [
                'orders' => 'Orders',
                'attachments' => [
                    'attachments' => 'Pièces jointes',
                    'submitted' => 'Soumis'
                ],
                'order_id' => 'numéro de commande',
                'service_name' => 'Nom du service',
                'status' => 'Statut',
                'submitted' => 'Soumise',
                'last_reply' => 'Dernière réponse',
                'none_add_reply' => 'Aucun (Ajouter une réponse)',
                'view_details' => 'Voir les détails',
                'no_orders' => "Vous n'avez aucune commande",
                'order_details' => "détails de la commande",
                'addons' => "Extensions",
                'total' => 'Totale',
                'submitted_info' => 'Vos informations soumises',
                'message' => 'Message',
                'add_reply' => 'Ajouter une réponse',
                'your_feedback' => 'Vos réactions',
                'your_rating' => 'Votre note',
                'your_comments' => 'Vos commentaires',
                'provide_feedback' => 'Veuillez fournir une rétroaction.',
                'feedback_submitted' => 'Merci pour votre évaluation et vos commentaires.',
                'comments' => 'Commentaires (optionnel).',
                'submit_feedback' => 'Soumettre des commentaires',
                'message_sent' => 'Message envoyé.',
                'thank_you' => [
                    'heading' => 'Je vous remercie',
                    'thank_lead' => 'Nous commencerons immédiatement votre commande. Vous devriez recevoir un e-mail de confirmation de commande sous peu.',
                    'view_order' => "Voir l'ordre"
                ],
                'failed' => 'Votre commande a échoué.',
                'cancelled' => 'Votre commande a été annulée.',
                'place_more_orders' => 'Vous pouvez passer plus de commande en visitant plus de services.',
            ],
            'cart' => [
                'order_summary' => [
                    'title' => 'Sommaire',
                    'subtotal' => 'Total',
                    'tax' => 'Impôt',
                    'total' => 'Total',
                    'credit_card_via_stripe' => 'Carte de crédit via Stripe',
                    'credit_or_debit_card' => 'carte de crédit ou de débit',
                    'place_order' => 'Passer la commande',
                    'login_to_place_order' => 'Vous devez <a href=":login_url"> vous connecter </a> / <a href=":register_url"> vous inscrire </a> pour passer une commande.',
                    'payment_gateway_not_found' => 'La passerelle de paiement n\'est pas configurée. Veuillez contacter l\'administrateur du site.',
                ],
                'order_details' => 'détails de la commande',
                'addons' => 'Extensions',
                'no_addons' => 'Aucun module complémentaire disponible.',
                'no_service_selected' => 'Veuillez sélectionner un service.',
                'provide_info' => 'Fournir des informations',
                'provide_info_desc' => 'Veuillez fournir les données suivantes afin de terminer la tâche.',
            ],
            'account' => [
                'profile' => [
                    'edit_account' => 'Modifier le compte',
                    'username' => 'Nom d\'utilisateur',
                    'billing_info' => 'Détails de facturation',
                    'first_name' => 'Prénom',
                    'last_name' => 'Nom de famille',
                    'email_address' => 'Adresse électronique',
                    'current_password' => 'Mot de passe actuel',
                    'change_pass_note' => 'Saisissez le mot de passe actuel si vous souhaitez modifier votre mot de passe.',
                    'new_password' => 'nouveau mot de passe',
                    'new_pass_note' => "Laissez vide si vous ne voulez pas changer de mot de passe.",
                    'address' => 'Adresse',
                    'city' => 'Ville',
                    'state' => 'Etat',
                    'zip_code' => 'Zip / code postal',
                    'country' => 'Pays',
                    'select_country' => 'Choisissez le pays',
                    'select_state' => 'Sélectionnez l\'état / la province',
                    'save_details' => 'Enregistrer les détails',
                    'profile_updated' => 'Mise à jour du profil réussie.',
                    'profile_error' => 'Une erreur s\'est produite lors de la mise à jour de votre profil. Veuillez réessayer plus tard.'
                ]
            ],
            'menu' => [
                'terms-of-service' => "Conditions d'utilisation",
                'privacy-policy' => "Politique de confidentialité",
                'refund-policy' => "Politique de remboursement",
                'contact' => "Contact",
                'home' => "Accueil",
                'account-details' => "Détails du compte",
                'order_details' => "détails de la commande",
                'orders' => "Orders",
                'admin' => "Admin",
                'logout' => "Se déconnecter",
                'login' => "S'identifier",
                'register' => "S'inscrire",
            ],
            'auth' => [
                'failed' => 'Ces informations d\'identification ne correspondent pas à nos enregistrements.',
                'throttle' => 'Trop de tentatives de connexion. Veuillez réessayer dans :seconds secondes.',
                'recaptcha_failed' => 'La vérification humaine a échoué.',
                'email_address' => 'Adresse électronique',
                'password' => 'Mot de passe',
                'remember_me' => 'Souviens-toi de moi',
                'forget_password' => "Mot de passe oublié?",
                'btn_login' => "S'identifier",
                'username' => 'Nom d\'utilisateur',
                'confirm_password' => 'Confirmez le mot de passe',
                'terms_and_conditions' => 'En vous inscrivant, vous acceptez les <a href=":url"> conditions générales </a>.',
                'btn_register' => 'S\'inscrire',
                'social_login_with' => 'Connectez-vous avec',
                'reset_password' => 'réinitialiser le mot de passe',
                'send_reset_password_link' => 'Envoyer le lien de réinitialisation du mot de passe',
                'btn_reset_password' => 'réinitialiser le mot de passe',
                'verify_your_email_address' => 'Vérifiez votre adresse e-mail',
                'verification_link_sent' => 'Un nouveau lien de vérification a été envoyé à votre adresse e-mail.',
                'check_your_email_text' => 'Avant de continuer, veuillez vérifier votre e-mail pour un lien de vérification. <br/> Si vous n\'avez pas reçu l\'e-mail,',
                'click_here_to_request_another' => 'cliquez ici pour en demander un autre',
            ],
            'pagination' => [
                'previous' => '&laquo; précédente',
                'next' => 'suivante &raquo;',
            ],
            'passwords' => [
                'reset' => 'Votre mot de passe a été réinitialisé!',
                'sent' => 'Nous avons envoyé par e-mail votre lien de réinitialisation de mot de passe!',
                'token' => 'Ce jeton de réinitialisation de mot de passe n\'est pas valide.',
                'user' => "Nous ne pouvons pas trouver un utilisateur avec cette adresse e-mail.",
            ],
            'validation' => [
                'accepted' => 'Le :attribute doit être accepté.',
                'active_url' => ':attribute n\'est pas une URL valide.',
                'after' => 'Le :attribute doit être une date après le :date.',
                'after_or_equal' => 'Le :attribute doit être une date postérieure ou égale à :date.',
                'alpha' => 'Le :attribute ne peut contenir que des lettres.',
                'alpha_dash' => 'Le :attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
                'alpha_num' => 'Le :attribute ne peut contenir que des lettres et des chiffres.',
                'array' => 'Le :attribute doit être un tableau.',
                'before' => 'Le :attribute doit être une date antérieure au :date.',
                'before_or_equal' => 'Le :attribute doit être une date antérieure ou égale à :date.',
                'between' => [
                    'numeric' => 'Le :attribute doit être compris entre :min et :max.',
                    'file' => 'Le :attribute doit être compris entre :min et :max kilo-octets.',
                    'string' => 'Le :attribute doit être compris entre :min et :max caractères.',
                    'array' => 'Le :attribute doit avoir entre :min et :max éléments.',
                ],
                'boolean' => 'Le champ :attribute doit être vrai ou faux.',
                'confirmed' => 'La confirmation :attribute ne correspond pas.',
                'date' => 'Le :attribute n\'est pas une date valide.',
                'date_format' => 'Le :attribute ne correspond pas au format :format.',
                'different' => 'Les :attribute et :other doivent être différents.',
                'digits' => 'Le :attribute doit être :digits chiffres.',
                'digits_between' => 'Le :attribute doit être compris entre :min et :max chiffres.',
                'dimensions' => 'Le :attribute a des dimensions d\'image non valides.',
                'distinct' => 'Le champ :attribute a une valeur en double.',
                'email' => 'Le :attribute doit être une adresse e-mail valide.',
                'exists' => 'Le :attribute sélectionné n\'est pas valide.',
                'file' => 'Le :attribute doit être un fichier.',
                'filled' => 'Le champ :attribute doit avoir une valeur.',
                'image' => 'Le :attribute doit être une image.',
                'in' => 'Le <a> sélectionné n\'est pas valide.',
                'in_array' => 'Le champ :attribute n\'existe pas dans :other.',
                'integer' => 'Le :attribute doit être un entier.',
                'ip' => 'Le :attribute doit être une adresse IP valide.',
                'ipv4' => ':attribute doit être une adresse IPv4 valide.',
                'ipv6' => ':attribute doit être une adresse IPv6 valide.',
                'json' => 'Le :attribute doit être une chaîne JSON valide.',
                'max' => [
                    'numeric' => 'Le :attribute ne doit pas être supérieur à :max.',
                    'file' => 'Le :attribute ne doit pas être supérieur à :max kilo-octets.',
                    'string' => 'Le :attribute ne peut pas être supérieur à :max caractères.',
                    'array' => 'Le :attribute ne peut pas avoir plus de :max éléments.',
                ],
                'mimes' => 'Le :attribute doit être un fichier de type: :values.',
                'mimetypes' => 'Le :attribute doit être un fichier de type: :values.',
                'min' => [
                    'numeric' => 'Le :attribute doit être au moins :min.',
                    'file' => 'Le :attribute doit être d\'au moins :min kilo-octets.',
                    'string' => 'Le :attribute doit être au moins :min caractères.',
                    'array' => 'Le :attribute doit avoir au moins :min éléments.',
                ],
                'not_in' => 'Le :attribute sélectionné n\'est pas valide.',
                'numeric' => 'Le :attribute doit être un nombre.',
                'present' => 'Le champ :attribute doit être présent.',
                'regex' => 'Le format :attribute n\'est pas valide.',
                'required' => 'Le champ :attribute est obligatoire.',
                'required_if' => 'Le champ :attribute est obligatoire lorsque :other est :value.',
                'required_unless' => 'Le champ :attribute est obligatoire sauf si :other est dans :values.',
                'required_with' => 'Le champ :attribute est obligatoire lorsque :values est présent.',
                'required_with_all' => 'Le champ :attribute est obligatoire lorsque :values est présent.',
                'required_without' => 'Le champ :attribute est obligatoire lorsque :values n\'est pas présent.',
                'required_without_all' => 'Le champ :attribute est obligatoire quand aucun de :values n\'est présent.',
                'same' => 'Les :attribute et :other doivent correspondre.',
                'size' => [
                    'numeric' => 'Le :attribute doit être :size.',
                    'file' => 'Le :attribute doit être :size kilo-octets.',
                    'string' => 'Les :attribute doivent être des caractères :size.',
                    'array' => 'Le :attribute doit contenir des éléments :size.',
                ],
                'string' => 'Le :attribute doit être une chaîne.',
                'timezone' => 'Le :attribute doit être une zone valide.',
                'unique' => 'Le :attribute a déjà été pris.',
                'uploaded' => 'Le :attribute n\'a pas pu être téléchargé.',
                'url' => 'Le format :attribute n\'est pas valide.',
                'custom' => [
                    'attribute-name' => [
                        'rule-name' => 'custom-message',
                    ],
                ],
                'attributes' => [
                    'settings.site_name' => 'Nom du site'
                ],
            ],
            'email' => [
                'verification' => [
                    'subject' => 'Vérifier l\'adresse e-mail',
                    'message' => '<h2>Salut :username</h2>
<p>Veuillez cliquer sur le bouton ci-dessous pour vérifier votre adresse e-mail.</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Vérifier l\'adresse e-mail</a></p>
<p>Si vous n\'avez pas créé de compte, aucune autre action n\'est requise.</p>
Cordialement,<br>
:site_name.'
                ],
                'reset_password' => [
                    'subject' => 'Réinitialiser la notification de mot de passe',
                    'message' => '<h2>Bonjour :username!</h2>
<p>Vous recevez cet e-mail, car nous avons reçu une demande de réinitialisation du mot de passe pour votre compte.</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">réinitialiser le mot de passe</a></p>
<p>Ce lien de réinitialisation de mot de passe expirera dans 60 minutes.</p>
<p>Si vous n\'avez pas demandé de réinitialisation de mot de passe, aucune autre action n\'est requise.</p>
Cordialement,<br>
:site_name.'
                ],
                'pre_order_query' => [
                    'subject' => 'Vous avez reçu une requête pour :service_name',
                    'message' => '<h2>Cher administrateur,</h2>
<p>:name vous a envoyé une requête concernant votre service: <a href=":url" target="_blank">:service_name</a>.</p>
<p>:content</p>
<p class="text-center"></p>
Cordialement,<br>
:site_name.'
                ],
                'order_created' => [
                    'subject' => 'Votre :site_name reçu de commande de :order_date',
                    'message' => '<h2>Nous vous remercions de votre commande</h2>
<p>Nous commencerons immédiatement votre commande. Vous devriez recevoir un e-mail de confirmation de commande sous peu. Vous pouvez voir les détails de la commande en cliquant sur le lien ci-dessous:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Voir l\'ordre</a></p>
Cordialement,<br>
:site_name.'
                ],
                'order_processing' => [
                    'subject' => 'Votre :site_name reçu de commande de :order_date est en cours de traitement',
                    'message' => '<h2>Votre commande est en cours de traitement.</h2>
<p>Salut. Votre commande récente sur :site_name est en cours de traitement. Vous pouvez voir les détails de la commande en cliquant sur le lien ci-dessous:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Voir l\'ordre</a></p>
Cordialement,<br>
:site_name.'
                ],
                'order_completed' => [
                    'subject' => 'Votre :site_name reçu de commande de :order_date est terminé',
                    'message' => '<h2>Votre commande est terminée.</h2>
<p>Salut. Votre commande récente sur :site_name a été marquée comme terminée. Vous pouvez voir les détails de la commande en cliquant sur le lien ci-dessous:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Voir l\'ordre</a></p>
Cordialement,<br>
:site_name.'
                ],
                'message_received' => [
                    'subject' => ':sender vous a envoyé un message. REF: Numéro de commande :order_id',
                    'message' => '<h2>Cher :receiver.</h2>
<p>:sender vient de publier une réponse dans la commande n °:order_id. Pour afficher ou ajouter une réponse, cliquez sur le lien ci-dessous:</p>
<p class="text-center"><a href=":url" class="action-btn button button-primary" target="_blank">Voir message</a></p>
Cordialement,<br>
:site_name.'
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

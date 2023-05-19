<x-mail::message>
# Bonjour

Nous avons reçu une demande de réinitialisation de mot de passe pour votre compte. Veuillez suivre le lien ci-dessous pour procéder à la réinitialisation :
<x-mail::button :url="$url"> Lien de réinitialisation</x-mail::button>

Veuillez noter que ce lien de réinitialisation est valable pendant 5 minutes. Si vous ne demandez pas de réinitialisation de mot de passe, veuillez ignorer cet e-mail.<br><br>

Assurez-vous de garder votre mot de passe en sécurité et de ne le partager avec personne.<br><br>
Si vous rencontrez des problèmes ou avez des questions, n'hésitez pas à nous contacter à l'adresse {{env('APP_CONTACT')}}.<br><br>
Cordialement,<br>
L'équipe de support technique {{ config('app.name') }}; L'avenir en commun
</x-mail::message>

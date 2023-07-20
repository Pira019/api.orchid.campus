<x-mail::message>
# Bonjour {{$name}},

Nous sommes ravis de t'accueillir au sein de l'équipe d'Orchid-Campus en tant que gestionnaire de notre site de tutoriels en ligne pour études à l'étranger. Ton expertise et tes compétences seront un atout précieux pour notre projet, et nous avons hâte de travailler ensemble pour offrir une expérience exceptionnelle à nos utilisateurs.<br>

Pour te connecter à notre système, voici tes informations d'identification : <br>

Nom d'utilisateur : {{$userName}}

<x-mail::button :url="$urlToconnect">Lien pour réinitialiser votre mot de passe</x-mail::button>  <br>

N'hésite pas à te familiariser avec notre plateforme dès que possible. Si tu rencontres le moindre problème de connexion ou si tu as besoin d'aide pour te familiariser avec notre système, n'hésite pas à contacter ou à solliciter l'aide de l'un de nos collègues. Nous sommes là pour t'accompagner dans cette nouvelle aventure professionnelle. <br>

Une fois de plus, bienvenue dans l'équipe Orchid-Campus ! Nous sommes impatients de travailler ensemble et de réaliser de grandes choses.<br>

Cordialement,<br>
L'équipe {{ config('app.name') }}; L'avenir en commun
</x-mail::message>


<?php
use App\Models\Auteur;
use App\Models\CodeEmail;
use App\Models\Commentaire;
use App\Models\Contact;
use App\Models\Gerant;
use App\Models\LivreNotification;
use App\Models\Manuscrit;
use App\Models\Message;
use App\Models\Pays;
use App\Models\Publication;
use App\Models\Publicite;
use App\Models\ReponseCommentaire;
use App\Models\StoreProduit;
use App\Models\User;
?>

@extends('layouts.header')

@section('content')

    @if(isset($_COOKIE['id']))
        @include('included.menu_bar_users')
    @else
        @include('included.menu_bar')
    @endif

    <div class="container white">
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 col-sm-12"><br /><br /><br /><br />
                <h1 class="text-center">CONDITIONS D’UTILISATION DE CUBE BOOKS</h1><br />


                <div class="text-justify black-text">
                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><strong>CUBE BOOKS est une plateforme de vente, d&rsquo;&eacute;ditions, de diffusion et d&rsquo;abonnement de livres aux formats papier, num&eacute;rique, audio et autres. Nous collaborons avec les maisons d&rsquo;&eacute;ditions locales et internationales pour vous proposer le meilleur des livres de jeunes auteurs, mais aussi de grands auteurs confirm&eacute;s. Notre ambition :&nbsp;</strong><strong>offrir aux lecteurs des produits de qualit&eacute;, attrayants et d&rsquo;excellente facture. Nous entendons &eacute;galement donner la parole &agrave; des auteurs engag&eacute;s pour l&rsquo;Afrique et le monde, et donner aux auteurs africains le succ&egrave;s &eacute;ditorial et financier qu&rsquo;ils m&eacute;ritent.&nbsp;</strong></p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">CUBE BOOKS permet 05 activit&eacute;s principales :</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">- <b style="mso-bidi-font-weight:normal;">L&rsquo;achat de livres</b> en diff&eacute;rents formats (Audio, papier, Pdf et e-Pub, abonnement) : les lecteurs peuvent acqu&eacute;rir les livres des auteurs nationaux et internationaux en diff&eacute;rents formats, et les &laquo; payer &raquo; en ligne et se faire livrer chez eux ou recevoir le livre par mail (formats audio, pdf, e-pub) ou lire sur directement sur la plateforme en s&rsquo;abonnant, avec possibilit&eacute; de choisir 05 livres &agrave; lire sur la plateforme.</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">- <b style="mso-bidi-font-weight:normal;">La vente de livres</b> sous diff&eacute;rents formats (Audio, papier, num&eacute;rique Pdf et e-Pub) : la possibilit&eacute; est donn&eacute;e aux maisons d&rsquo;&eacute;ditions, mais aussi directement &agrave; tout auteur &agrave; son propre compte, de publier leurs livres sur CUBE BOOKS et de g&eacute;rer la promotion de leurs ouvrages et contr&ocirc;ler l&rsquo;&eacute;volution des ventes et les rentr&eacute;es d&rsquo;argent. CUBE BOOKS pr&eacute;l&egrave;ve 10% sur chaque vente effectu&eacute;e au travers de la plateforme et ceci n&rsquo;inclut pas les frais d&rsquo;utilisation pr&eacute;lev&eacute;s par les moyens de paiement int&eacute;gr&eacute;s &agrave; la plateforme. <b style="mso-bidi-font-weight:  normal;"><i style="mso-bidi-font-style:normal;">Apr&egrave;s mise en ligne d&rsquo;un ouvrage l&rsquo;auteur, la maison d&rsquo;&eacute;dition&hellip; s&rsquo;engagent &agrave; mettre &agrave; disposition de la plateforme, des exemplaires des diff&eacute;rents formats de livre &agrave; vendre. Ils seront g&eacute;r&eacute;s sur une base de donn&eacute;es locale pour r&eacute;pondre aux besoins des clients (formats pdf, epub, vid&eacute;o, audio) et les formats papiers seront mis &agrave; disposition dans les boutiques et librairies partenaires de CUBE pour les ventes physiques.</i></b></p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><b style="mso-bidi-font-weight:normal;">IMPORTANT</b> : A chaque vente valid&eacute;e sur la plateforme, la maison d&rsquo;&eacute;ditions, l&rsquo;&eacute;crivain ou toute personne ayant ajout&eacute; un ouvrage sur la plateforme re&ccedil;oit automatiquement une confirmation de vente. Ceci permet &agrave; l&rsquo;auteur ou &agrave; la maison d&rsquo;&eacute;ditions de suivre l&rsquo;&eacute;volution des ventes des livres.</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">- <b style="mso-bidi-font-weight:normal;">Les discussions entre auteurs, lecteurs et &eacute;diteurs&nbsp;</b>: Apr&egrave;s cr&eacute;ation de son compte sur CUBE BOOKS, les lecteurs et les auteurs peuvent se rencontrer sur la plateforme, discuter autour d&rsquo;un livre, les lecteurs donnant leurs impressions et retours de lecture &agrave; un auteur et les auteurs partageant leur vision et cr&eacute;ativit&eacute; avec leurs lecteurs. Tout ceci permettra de cr&eacute;er de vraies communaut&eacute;s d&rsquo;acteurs du livre portant la litt&eacute;rature dans nos pays et faire de CUBE BOOKS un r&eacute;seau social pour &eacute;crivains et amoureux de la litt&eacute;rature.</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">- <b style="mso-bidi-font-weight:normal;">L&rsquo;organisation d&rsquo;&eacute;v&egrave;nements litt&eacute;raires</b> (caf&eacute;s litt&eacute;raires, d&eacute;dicaces, promotions&hellip;) : une fois inscrits sur la plateforme les auteurs ou les maisons d&rsquo;&eacute;ditions &hellip;peuvent organiser un &eacute;v&egrave;nement pour pr&eacute;senter un livre ou cr&eacute;er une communaut&eacute; autour d&rsquo;un auteur ou d&rsquo;un ouvrage.</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">- <b style="mso-bidi-font-weight:normal;">L&rsquo;envoi de manuscrit pour &ecirc;tre &eacute;dit&eacute;</b> (caf&eacute;s litt&eacute;raires, d&eacute;dicaces, promotions&hellip;) : une fois inscrits sur la plateforme toute personne peut envoyer un tapuscrit pour &ecirc;tre &eacute;dit&eacute; chez un des &eacute;diteurs partenaires de la plateforme (AGAU EDITIONS, AGO MEDIA, EDITIONS AWOUDY, EDITIONS CONTINENTS&hellip;)</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;">Pour nous contacter, nous poser une question n&#39;h&eacute;sitez pas : <a href="mailto:equipedecube@gmail.com">equipedecube@gmail.com</a></p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><strong>&nbsp;</strong></p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><strong>&nbsp;</strong></p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><strong>&nbsp;</strong></p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><strong>ARTICLE 1 :&nbsp;</strong><strong>CONDITIONS GENERALES</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les pr&eacute;sentes conditions g&eacute;n&eacute;rales de vente s&#39;appliquent &agrave; toutes les commandes re&ccedil;ues par CUBE BOOKS.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 2 : DISPONIBILITE DES ARTICLES</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Nos livres et &nbsp; &nbsp; &nbsp;autres articles disponibles sur CUBE BOOKS sont propos&eacute;s dans la limite des stocks disponibles. Bien que les donn&eacute;es de la plateforme soient r&eacute;guli&egrave;rement mises &agrave; jour, certains livres peuvent &ecirc;tre provisoirement ou d&eacute;finitivement indisponibles.
                        <br>En cas d&#39;indisponibilit&eacute;, CUBE BOOKS pr&eacute;viendra les utilisateurs de la plateforme ou un client soit par mail soit au travers de son compte cr&eacute;&eacute; sur la plateforme. Nous nous engageons n&eacute;anmoins &agrave; toujours faire de notre meilleur pour vous trouver tout livre que vous rechercherez et vous livrer le plus rapidement possible.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 3 : COMMANDES</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les commandes peuvent &ecirc;tre pass&eacute;es de la mani&egrave;re suivante :</p>

                    <ul type="disc">
                        <li style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;      text-align:justify;line-height:normal;mso-list:l0 level1 lfo1;tab-stops:      list 36.0pt;">Par la plateforme : <a href="https://cubebooks.saeicube.com">https://cubebooks.saeicube.com</a></li>
                        <li style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;      text-align:justify;line-height:normal;mso-list:l0 level1 lfo1;tab-stops:      list 36.0pt;">Par WhatsApp: 000228 90 53 51 21</li>
                        <li style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;      text-align:justify;line-height:normal;mso-list:l0 level1 lfo1;tab-stops:      list 36.0pt;">Par e-mail : <a href="mailto:equipedecube@gmail.com">equipedecube@gmail.com</a><u>&nbsp;</u></li>
                    </ul>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Pour un meilleur suivi, nous vous recommandons de toujours laisser un adresse e-mail valide lors de vos commandes, m&ecirc;me les commandes de livres papiers.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 4 : PRIX</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les prix de nos livres sont indiqu&eacute;s sur notre site en FCFA, en dollars et dans d&rsquo;autres monnaies locales. Suivant le moyen de paiement s&eacute;lectionn&eacute; les conversions sont faites et les sommes d&eacute;bit&eacute;es au client correspondent aux prix fix&eacute;s par les maisons d&rsquo;&eacute;ditions et les auteurs ayant mis leur livre sur la plateforme. Les frais d&#39;exp&eacute;dition ou de livraison dans le cadre d&rsquo;un livre papier ne sont pas inclus sur la plateforme et seront envoy&eacute;s par mail ou le moyen de communication fourni par le client.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les prix indiqu&eacute;s sont modifiables &agrave; tout moment sans pr&eacute;avis par les &eacute;diteurs, l&rsquo;auteur ou la plateforme.
                        <br>Les produits sur la plateforme demeurent la propri&eacute;t&eacute; de CUBE BOOKS, des Maisons d&rsquo;&eacute;ditions partenaires et des auteurs de la plateforme, jusqu&#39;au paiement complet du prix, quelle que soit la date de livraison du produit.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 5 : PAIEMENT</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Le r&egrave;glement des achats ou abonnement s&#39;effectue :</p>

                    <p style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:  justify;line-height:normal;"><strong>-Pour les commandes pass&eacute;es sur le site, exclusivement par carte bancaire (Carte Bleue, Visa, Mastercard, Eurocard, American Express, Diners Club), via Paypal ou suivant le Mobile Money s&eacute;lectionn&eacute; (PayGate, WeCashUp, FedaPay&hellip;).</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Dans le cadre de PayPal ou de l&rsquo;utilisation d&rsquo;une carte bancaire, le client doit indiquer le num&eacute;ro de sa carte, ainsi que sa date de validit&eacute; et les trois chiffres du cryptogramme figurant au dos de celle-ci, directement dans la zone pr&eacute;vue &agrave; cet effet (saisie s&eacute;curis&eacute;e par cryptage SSL). Aucune donn&eacute;e bancaire n&#39;est enregistr&eacute;e sur CUBE BOOKS ou sur l&rsquo;une des plateformes interm&eacute;diaires, le paiement se faisant via le site s&eacute;curis&eacute; de la banque du client. Le montant des commandes r&eacute;gl&eacute;es par carte bancaire ou PayPal est encaiss&eacute; le jour de la commande.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">-<strong>Pour les commandes par WhatsApp ou par e-mail,</strong> le client peut r&eacute;gler par carte bancaire, Mobile Money ou un autre moyen en utilisant notre &laquo; formulaire de paiement &raquo; qui lui sera communiqu&eacute; lors de la validation de la commande.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Aucun payement ne se fait ou ne se fera en dehors des canaux propos&eacute;s par la plateforme pour des raisons de s&eacute;curit&eacute; et de contr&ocirc;le des flux de donn&eacute;es et de transfert d&rsquo;argent et assurer au client d&rsquo;avoir sa commande et aux auteurs et maisons d&rsquo;&eacute;ditions de suivre les flux de revenus autour de leurs &oelig;uvres.</p>

                    <p style="margin:0cm;margin-bottom:.0001pt;text-align:justify;line-height:18.75pt;"><strong>IMPORTANT :&nbsp;</strong>Une fois l&rsquo;achat valid&eacute;, les conversions se font automatiquement, quelle que soit la devise dans laquelle le prix du livre a &eacute;t&eacute; formul&eacute; sur la plateforme. Ainsi les conversions se font du FCFA, Euro et cetera vers le dollar pour PayPal par exemple (cas o&ugrave; les prix sont d&eacute;finis en Fcfa ou Euro) et de dollar vers le Fcfa pour PayGate par exemple (cas o&ugrave; les prix sont d&eacute;finis en Dollar sur la plateforme).</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">
                        <br><strong>ARTICLE 6 : LIVRAISON</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les livres num&eacute;riques et audio sont envoy&eacute;s sur le mail ou num&eacute;ro WhatsApp fourni par le client apr&egrave;s paiement des frais de commande.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les livres physiques sont livr&eacute;s &agrave; l&#39;adresse de livraison indiqu&eacute;e lors de la commande. Afin d&#39;optimiser la livraison, il est conseill&eacute; d&#39;indiquer une adresse &agrave; laquelle votre commande pourra &ecirc;tre r&eacute;ceptionn&eacute;e aux heures ouvrables. Les livres papier peuvent &eacute;galement &ecirc;tre confi&eacute;s aux compagnies de transport partenaires afin de couvrir toutes les villes et tous les pays de la sous-r&eacute;gion. Les livres peuvent &eacute;galement &ecirc;tre envoy&eacute;s par les compagnies a&eacute;riennes.
                        <br>Les frais et d&eacute;lais de livraison, suivant les zones et les pays sont consultables &agrave; l&rsquo;adresse suivante sur la plateforme <a href="https://cubebooks.saeicube.com/fraisetdelais">https://cubebooks.saeicube.com/fraisetdelais</a>
                        <br>Concernant les livraisons d&rsquo;un pays &agrave; l&rsquo;autre, les articles command&eacute;s sont import&eacute;s dans le pays de destination et peuvent s&rsquo;alourdir d&rsquo;autres frais de d&eacute;douanement qui seront &agrave; la charge du client. Il lui appartient de prendre aupr&egrave;s des autorit&eacute;s locales concern&eacute;es les informations n&eacute;cessaires et de veiller &agrave; respecter scrupuleusement les formalit&eacute;s sp&eacute;cifiques &agrave; l&#39;importation des livres sur le territoire du pays de destination. Les &eacute;ventuels frais de douanes ou taxes locales sont &agrave; la charge exclusive du client.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 7 : SATISFAIT OU REMBOURSE</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Si le livre ne convient pas &agrave; la commande faite, pour quelque raison que ce soit, le client dispose d&#39;un d&eacute;lai de r&eacute;tractation d&rsquo;une semaine (07 jours) &agrave; compter de la r&eacute;ception pour faire retour de sa commande. L&#39;article doit &ecirc;tre retourn&eacute; obligatoirement dans son emballage d&#39;origine, en parfait &eacute;tat, et accompagn&eacute; de la facture correspondante.
                        <br>Le retour du livre se fait sans p&eacute;nalit&eacute;, &agrave; l&#39;exception des frais de retour.
                        <br>Les articles ab&icirc;m&eacute;s, endommag&eacute;s ou salis par le client ne sont pas repris.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 8 : INFORMATIONS NOMINATIVES OU PRIVEES</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">CUBE BOOKS et ses partenaires traitent toutes les informations concernant sa client&egrave;le avec la plus stricte confidentialit&eacute;.
                        <br>Lors de la commande, seules sont demand&eacute;es les informations indispensables (nom, pr&eacute;nom, adresse, e-mail) pour un traitement efficace et un suivi attentif de la commande. Ces donn&eacute;es saisies en ligne sont enregistr&eacute;es sur un serveur s&eacute;curis&eacute; et sont conserv&eacute;es tout le temps de la dur&eacute;e de la relation commerciale.
                        <br>Toutes les mesures raisonnables sont prises pour :
                        <br>- s&eacute;curiser les donn&eacute;es contre une potentielle intrusion ou utilisation non-autoris&eacute;e.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 7 : EXCLUSION DE RESPONSABILITE</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les ouvrages propos&eacute;s r&eacute;pondent &agrave; la l&eacute;gislation en vigueur, suivant les pays des auteurs et &eacute;diteurs de la plateforme CUBE BOOKS. CUBE BOOKS d&eacute;cline toute responsabilit&eacute; si l&#39;article livr&eacute; ne respecte pas la l&eacute;gislation du pays de livraison (censure, interdiction d&#39;un titre ou d&#39;un auteur...).
                        <br>La responsabilit&eacute; de CUBE BOOKS n&#39;est pas engag&eacute;e en cas d&#39;inex&eacute;cution du contrat due &agrave; une rupture de stock ou une indisponibilit&eacute; des livres, en cas de gr&egrave;ve totale ou partielle des services d&#39;exp&eacute;dition, en cas de force majeure, d&#39;inondation, d&#39;incendie, etc.
                        <br>Sa responsabilit&eacute; n&#39;est pas non plus engag&eacute;e &agrave; l&#39;&eacute;gard du contenu des sites Internet sur lesquels des liens hypertextes peuvent renvoyer &agrave; partir de son propre site.
                        <br>CUBE BOOKS ne peut, en aucun cas, garantir l&#39;absence totale d&#39;erreur mat&eacute;rielle, de d&eacute;ficience technique ou autre.
                        <br>En particulier, et sans s&rsquo;y limiter, CUBE BOOKS ne garantit pas la continuit&eacute; des services disponibles sur le Site.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">En cas de mise &agrave; jour des logiciels, l&rsquo;Utilisateur peut rencontrer des probl&egrave;mes de connexion. La responsabilit&eacute; de CUBE BOOKS ne peut aucunement &ecirc;tre recherch&eacute;e suite &agrave; ces difficult&eacute;s.
                        <br>CUBE BOOKS met en &oelig;uvre tous les moyens &agrave; sa disposition pour garantir la fiabilit&eacute; des donn&eacute;es pr&eacute;sentes sur le site, mais ne peut &ecirc;tre tenu responsable, directement ou indirectement, des donn&eacute;es mises en lignes ou de leurs utilisations. Plus g&eacute;n&eacute;ralement, CUBE BOOKS ne peut &ecirc;tre tenu responsable des dommages cons&eacute;cutifs, sp&eacute;ciaux ou accidentels, directs ou indirects, r&eacute;sultant de l&rsquo;acc&egrave;s ou de l&rsquo;utilisation de sa plateforme.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 8 : ACCEPTATION DU CLIENT</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">En cliquant sur le bouton &quot;<em>Valider</em>&quot;, le Client d&eacute;clare accepter la commande et l&#39;int&eacute;gralit&eacute; des pr&eacute;sentes conditions g&eacute;n&eacute;rales de vente.
                        <br>Les donn&eacute;es enregistr&eacute;es par CUBE BOOKS pourront constituer la preuve de l&#39;ensemble des op&eacute;rations et des transactions financi&egrave;res effectu&eacute;es par le client.
                        <br>Les pr&eacute;sentes conditions g&eacute;n&eacute;rales de vente sont modifiables &agrave; tout moment sans pr&eacute;avis. Les conditions &agrave; jour sont consultables &agrave; tout moment sur le site <a href="https://cubebooks.saeicube.com/">https://cubebooks.saeicube.com/</a>&nbsp;</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>Protection du droit de propri&eacute;t&eacute; intellectuelle</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Le site <a href="https://cubebooks.saeicube.com/">https://cubebooks.saeicube.com/</a> est une &oelig;uvre prot&eacute;g&eacute;e : CUBE BOOKS est titulaire de droits d&#39;auteurs ou droits d&rsquo;exploitation sur chacune des pages constituant ce site, sur son arborescence ainsi que sur les &eacute;l&eacute;ments y figurant.
                        <br>Ainsi, notamment les marques, logos, graphismes, photographies, animations, vid&eacute;os et textes contenus sur le site sont la propri&eacute;t&eacute; intellectuelle de CUBE BOOKS ou de ses partenaires et ne peuvent &ecirc;tre reproduits, utilis&eacute;s ou repr&eacute;sent&eacute;s sans son autorisation expresse ou celle de ses partenaires, sous peine de poursuites judiciaires.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>Respect par l&rsquo;Utilisateur des droits de propri&eacute;t&eacute; intellectuelle</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">L&rsquo;Utilisateur garantit qu&rsquo;il ne modifiera pas, ne louera pas, ne pr&ecirc;tera pas, ne vendra pas, ou ne distribuera pas les &oelig;uvres diffus&eacute;es ou command&eacute;es sur le site <a href="https://cubebooks.saeicube.com/">https://cubebooks.saeicube.com/</a>, et qu&rsquo;il ne se servira pas, de tout ou partie du site, notamment pour la r&eacute;alisation d&rsquo;&oelig;uvres d&eacute;riv&eacute;es.
                        <br>L&rsquo;impression n&rsquo;est autoris&eacute;e qu&rsquo;&agrave; l&rsquo;usage priv&eacute; et exclusif de l&rsquo;Utilisateur, &agrave; l&rsquo;exclusion de toute autre utilisation sans autorisation pr&eacute;alable &eacute;crite de CUBE BOOKS et ses partenaires.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 9 : LITIGE - DROIT APPLICABLE AUX RELATIONS AVEC LE CLIENT</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">Les ventes r&eacute;alis&eacute;es par CUBE BOOKS &agrave; partir de son site Internet, par WhatsApp ou par e-mail sont r&eacute;gies exclusivement par le droit OHADA.
                        <br>Les pr&eacute;sentes Conditions G&eacute;n&eacute;rales de vente sont r&eacute;gies, interpr&eacute;t&eacute;es et appliqu&eacute;es conform&eacute;ment au droit OHADA. Tout litige naissant de l&rsquo;utilisation du Site sera soumis &agrave; la comp&eacute;tence exclusive des juridictions du syst&egrave;me OHADA.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>ARTICLE 10 : GESTION DES COOKIES SUR LE SITE INTERNET</strong></p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;">L&rsquo;utilisateur est inform&eacute; que lors de ses visites sur le site <a href="https://cubebooks.saeicube.com/">https://cubebooks.saeicube.com/</a> un cookie peut s&rsquo;installer automatiquement sur son logiciel de navigation.
                        <br>Le cookie est un bloc de donn&eacute;es qui ne permet pas d&rsquo;identifier les utilisateurs mais sert &agrave; enregistrer des informations relatives &agrave; la navigation de celui-ci sur le site. Le param&eacute;trage du logiciel de navigation permet d&rsquo;informer de la pr&eacute;sence de cookie et &eacute;ventuellement, de la refuser.
                        <br>Nos serveurs ne sont pas configur&eacute;s pour collecter des informations personnelles sur les visiteurs du site en dehors des donn&eacute;es techniques suivantes : provenance des connexions (fournisseur d&rsquo;acc&egrave;s), adresse IP, type et version du navigateur utilis&eacute;. En aucun cas, nous ne collectons l&rsquo;adresse e-mail des visiteurs sans que ces derniers ne nous la communiquent d&eacute;lib&eacute;r&eacute;ment.
                        <br>Il s&rsquo;agit de statistiques agr&eacute;g&eacute;es permettant de conna&icirc;tre les pages les plus et les moins populaires, les chemins pr&eacute;f&eacute;r&eacute;s, les niveaux d&rsquo;activit&eacute; par jour de la semaine et par heure de la journ&eacute;e, les principales erreurs clients ou serveur et am&eacute;liorer l&rsquo;exp&eacute;rience client.</p>

                    <p style="mso-margin-top-alt:auto;mso-margin-bottom-alt:auto;  text-align:justify;line-height:normal;mso-outline-level:2;"><strong>MENTIONS LEGALES</strong></p>

                    <p style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:  justify;line-height:normal;"><strong>CUBE BOOKS</strong></p>

                    <p style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:  justify;line-height:normal;">BP 4556, Lom&eacute; &ndash; Togo</p>

                    <p style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:  justify;line-height:normal;"><a href="mailto:equipedecube@gmail.com">equipedecube@gmail.com</a></p>

                    <p style="margin-bottom:0cm;margin-bottom:.0001pt;text-align:  justify;line-height:normal;">WhatsApp : 00228 90 53 51 21</p>

                    <p style="margin-bottom:0cm;margin-bottom:.0001pt;line-height:  normal;">Mise &agrave; jour des conditions g&eacute;n&eacute;rales de vente et mentions l&eacute;gales le 17 Octobre 2020.</p>


                    <br /><br /><br />

                </div>

            </div>
        </div>
    </div>

@endsection

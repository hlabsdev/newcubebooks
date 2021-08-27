<small><b>Informations du client</b></small><br />
<div>
    <b>Nom et prénom(s)</b> : {{ $nom_prenom }}<br />
    <b>Email</b> : {{ $email }}<br />
    <b>Téléphone</b> : {{ $telephone }}<br />
    <b>Pays</b> : {{ $pays }}<br />
    <b>Ville</b> : {{ $ville }}<br />
    <b>Quartier</b> : {{ $quartier }}<br />
</div><br />
<small><b>Informations du produit</b></small>
<table border="1"  style="border-collapse: collapse;">
    <thead>
        <tr>
            <td width="50" style="text-align: center;">
                Id
            </td>
            <th>
                Nom du produit
            </th>
            <th width="100" style="text-align: center;">
                Qté
            </th>
            <th width="150" style="text-align: center;">
                Montant
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                {{ $id_produit }}
            </td>
            <td>
                {{ $nom_produit }}
            </td>
            <td style="text-align: right;">
                {{ $quantite_produit }}
            </td>
            <td style="text-align: right;">
                {{ $prix_produit }} F CFA
            </td>
        </tr>
    </tbody>
</table>
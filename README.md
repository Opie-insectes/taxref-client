TaxRef client
=============

Client PHP basé sur le composant Symfony HttpClient pour parcourir l'API TaxRef.

Pré-requis :

- PHP 8.2

Supporte les routes suivantes :

- `/taxa/autocomplete` (paramètres manquants)
- `/taxa/{id}` (paramètres manquants)
- `/taxa/{id}/media` (paramètres manquants)

Pour chaque route supportée, il existe une commande correspondante pour utiliser
le client depuis un terminal :

```bash
symfony console taxa:autocomplete Aeshna  # /taxa/autocomplete
# Résultats: 30
#         Aeshna caerulea [cdNom 65435] [cdRef 65435]
#         Aeshna cyanea [cdNom 65440] [cdRef 65440]
#         …
```

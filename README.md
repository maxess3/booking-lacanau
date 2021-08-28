# booking-lacanau

### Principe de fonctionnement :

    * Chaque utilisateur connecté peut réserver une ou plusieurs réservations. Les réservations demandées par l’utilisateur sont placées automatiquement sous le statut suivant : « en attente d’approbation par un administrateur »
    
    * Chaque utilisateur peut enregistrer une réservation (avec le statut en attente, ou approuvé) à son calendrier personnel via le bouton ajouter au calendrier (Fonctionnalité disponible seulement sur ordinateur pour le moment, ne marche pas sur certains navigateurs sur mobile).
    
    * Lorsque l’utilisateur est connecté à sa session, ses propres réservations apparaissent en bleu. Les autres réservations apparaissent grisées.
    
    * Chaque utilisateur peut supprimer seulement ses propres réservations.
    
    * Chaque utilisateur peut afficher plus d’informations temporelles concernant le statut de ses réservations via le bouton « info » situé à coté du statut.
    
    * L’admin à le droit de changer le statut d’une réservation.
    
    * Il existe plusieurs statut concernant une réservation : En attente d’approbation (0), Approuvé (1), Annulé (2)

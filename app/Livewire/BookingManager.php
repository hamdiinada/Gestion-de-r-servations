<?php

namespace App\Http\Livewire;

use App\Models\Booking; // Importez le modèle Booking
use App\Models\Property; // Importez le modèle Property
use Livewire\Component;
use Carbon\Carbon; // Importez Carbon pour la manipulation des dates

class BookingManager extends Component
{
    public Property $property; // Propriété passée au composant (Model Binding)
    public $startDate; // Date de début de la réservation, liée au formulaire
    public $endDate; // Date de fin de la réservation, liée au formulaire
    public $message = ''; // Message de retour pour l'utilisateur (succès/erreur)
    public $messageType = ''; // Type du message ('success' ou 'error')

    // Règles de validation pour les champs du formulaire
    protected $rules = [
        'startDate' => ['required', 'date', 'after_or_equal:today'], // Doit être une date valide, égale ou après aujourd'hui
        'endDate' => ['required', 'date', 'after:startDate'], // Doit être une date valide, après la date de début
    ];

    /**
     * Méthode de montage du composant.
     * Appelé une seule fois lors de l'initialisation du composant.
     *
     * @param \App\Models\Property $property L'instance de la propriété à gérer.
     */
    public function mount(Property $property)
    {
        $this->property = $property;
    }

    /**
     * (Optionnel) Valide les champs en temps réel à chaque modification.
     * Décommentez si vous voulez une validation instantanée au fur et à mesure que l'utilisateur tape.
     */
    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    /**
     * Gère la soumission du formulaire de réservation.
     * Effectue la validation, vérifie la disponibilité et crée la réservation.
     */
    public function makeBooking()
    {
        $this->resetMessages(); // Réinitialise les messages précédents avant une nouvelle tentative

        // Exécute la validation des données d'entrée
        $this->validate();

        // Convertit les dates de début et de fin en objets Carbon pour faciliter les comparaisons
        $start = Carbon::parse($this->startDate);
        $end = Carbon::parse($this->endDate);

        // Vérifie les chevauchements de réservations existantes pour cette propriété
        // Le `where(function ($query) use ($start, $end)` est crucial pour gérer toutes les conditions de chevauchement.
        $existingBookings = Booking::where('property_id', $this->property->id)
            ->where(function ($query) use ($start, $end) {
                // Cas 1: Une réservation existante commence ou se termine dans la période demandée
                $query->whereBetween('start_date', [$start, $end])
                      ->orWhereBetween('end_date', [$start, $end])
                      // Cas 2: La période demandée est à l'intérieur d'une réservation existante
                      ->orWhere(function ($query) use ($start, $end) {
                          $query->where('start_date', '<', $start)
                                ->where('end_date', '>', $end);
                      });
            })
            ->count(); // Compte le nombre de réservations qui chevauchent

        // Si des réservations existantes sont trouvées, affiche un message d'erreur
        if ($existingBookings > 0) {
            $this->message = "Cette propriété n'est pas disponible pour les dates sélectionnées. Veuillez choisir une autre période.";
            $this->messageType = 'error';
            return; // Arrête l'exécution de la fonction
        }

        try {
            // Crée une nouvelle réservation dans la base de données
            Booking::create([
                'user_id' => auth()->id(), // Récupère l'ID de l'utilisateur actuellement authentifié
                'property_id' => $this->property->id,
                'start_date' => $start,
                'end_date' => $end,
            ]);

            $this->message = "Votre réservation a été effectuée avec succès !";
            $this->messageType = 'success';
            $this->resetForm(); // Réinitialise les champs du formulaire après une réservation réussie

        } catch (\Exception $e) {
            // En cas d'erreur lors de l'enregistrement, affiche un message générique
            $this->message = "Une erreur est survenue lors de la réservation. Veuillez réessayer.";
            $this->messageType = 'error';
            // Il est recommandé de loguer l'erreur pour le débogage en production :
            // \Log::error("Erreur de réservation: " . $e->getMessage());
        }
    }

    /**
     * Réinitialise les champs du formulaire à leur état initial.
     */
    protected function resetForm()
    {
        $this->startDate = null;
        $this->endDate = null;
    }

    /**
     * Réinitialise les messages de notification affichés à l'utilisateur.
     */
    protected function resetMessages()
    {
        $this->message = '';
        $this->messageType = '';
    }

    /**
     * Méthode de rendu du composant Livewire.
     * Retourne la vue Blade associée à ce composant.
     */
    public function render()
    {
        return view('livewire.booking-manager');
    }
}
<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'description',
        'price_per_night',
    ];

    /**
     * Définit la relation entre une propriété et ses réservations.
     * Une propriété peut avoir plusieurs réservations.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

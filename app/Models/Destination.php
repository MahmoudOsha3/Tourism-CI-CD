<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Destination model.
 * For now SiteController builds a few in-memory instances (no table needed).
 * Later: create the migration (name, slug, image, price, description) and query it normally.
 */
class Destination extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'price', 'description'];

    /** route('destinations.show', $destination) will use the slug. */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

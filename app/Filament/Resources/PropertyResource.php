<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property; // Importez le modèle Property
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class; // Le modèle Eloquent associé à cette ressource

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2'; // Icône affichée dans le menu de navigation
    protected static ?string $modelLabel = 'Propriété'; // Nom singulier du modèle dans l'UI Filament
    protected static ?string $pluralModelLabel = 'Propriétés'; // Nom pluriel du modèle dans l'UI Filament
    protected static ?string $navigationGroup = 'Gestion Immobilière'; // Groupe de navigation dans la barre latérale

    /**
     * Définit le schéma du formulaire pour la création et l'édition des propriétés.
     *
     * @param \Filament\Forms\Form $form
     * @return \Filament\Forms\Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nom de la propriété') // Libellé du champ
                    ->required() // Rendu obligatoire
                    ->maxLength(255), // Longueur maximale
                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(65535) // Longueur maximale pour un TEXT
                    ->rows(5), // Nombre de lignes pour le textarea
                Forms\Components\TextInput::make('price_per_night')
                    ->label('Prix par nuit (TND)')
                    ->required()
                    ->numeric() // Saisie numérique
                    ->prefix('TND') // Ajoute un préfixe visuel
                    ->inputMode('decimal'), // Précise le mode de saisie pour les décimales
            ]);
    }

    /**
     * Définit le schéma de la table pour l'affichage des propriétés.
     *
     * @param \Filament\Tables\Table $table
     * @return \Filament\Tables\Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nom')
                    ->searchable() // Permet de rechercher par ce champ
                    ->sortable(), // Permet de trier par ce champ
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50), // Limite l'affichage à 50 caractères
                Tables\Columns\TextColumn::make('price_per_night')
                    ->label('Prix / Nuit')
                    ->money('TND') // Affiche la valeur en format monétaire (ex: "150.00 TND")
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime() // Affiche la date et l'heure
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Peut être masqué par défaut dans la table
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Mis à jour le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Ajoutez des filtres ici si vous en avez besoin (ex: par fourchette de prix)
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // Bouton d'édition
                Tables\Actions\DeleteAction::make(), // Bouton de suppression
            ])
            ->bulkActions([
                // Actions de masse (appliquer à plusieurs enregistrements sélectionnés)
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(), // Suppression en masse
                ]),
            ]);
    }

    /**
     * Définit les relations à afficher pour cette ressource.
     *
     * @return array<string, \Filament\Resources\RelationManagers\RelationManager>
     */
    public static function getRelations(): array
    {
        return [
            // Vous pourriez ajouter ici une relation 'BookingsRelationManager' pour voir les réservations d'une propriété.
        ];
    }

    /**
     * Définit les pages associées à cette ressource.
     *
     * @return array<string, array<string, string>>
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProperties::route('/'), // Page de liste (ex: /admin/properties)
            'create' => Pages\CreateProperty::route('/create'), // Page de création (ex: /admin/properties/create)
            'edit' => Pages\EditProperty::route('/{record}/edit'), // Page d'édition (ex: /admin/properties/1/edit)
        ];
    }
}

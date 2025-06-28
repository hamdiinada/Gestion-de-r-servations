<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking; // Importez le modèle Booking
use App\Models\Property; // Importez le modèle Property
use App\Models\User;     // Importez le modèle User (pour les listes déroulantes)
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class; // Le modèle Eloquent associé

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days'; // Icône pour le calendrier
    protected static ?string $modelLabel = 'Réservation';
    protected static ?string $pluralModelLabel = 'Réservations';
    protected static ?string $navigationGroup = 'Gestion Immobilière'; // Le même groupe que les Propriétés

    /**
     * Définit le schéma du formulaire pour la création et l'édition des réservations.
     *
     * @param \Filament\Forms\Form $form
     * @return \Filament\Forms\Form
     */
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Utilisateur')
                    ->options(User::all()->pluck('name', 'id')) // Liste déroulante des utilisateurs (Nom => ID)
                    ->searchable() // Permet de rechercher dans la liste déroulante
                    ->required(),
                Forms\Components\Select::make('property_id')
                    ->label('Propriété')
                    ->options(Property::all()->pluck('name', 'id')) // Liste déroulante des propriétés (Nom => ID)
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->label('Date de début')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->label('Date de fin')
                    ->required()
                    ->afterOrEqual('start_date'), // La date de fin doit être égale ou après la date de début
            ]);
    }

    /**
     * Définit le schéma de la table pour l'affichage des réservations.
     *
     * @param \Filament\Tables\Table $table
     * @return \Filament\Tables\Table
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name') // Affiche le nom de l'utilisateur lié
                    ->label('Utilisateur')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('property.name') // Affiche le nom de la propriété liée
                    ->label('Propriété')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Date de début')
                    ->date() // Affiche en format date
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Date de fin')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Créé le')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Vous pouvez ajouter des filtres ici (ex: par utilisateur, par propriété, par dates)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            //
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}


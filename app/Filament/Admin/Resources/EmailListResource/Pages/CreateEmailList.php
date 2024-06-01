<?php

namespace App\Filament\Admin\Resources\EmailListResource\Pages;

use App\Filament\Admin\Resources\EmailListResource;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateEmailList extends CreateRecord
{
    protected static string $resource = EmailListResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordCreation(array $data): Model
    {
        $currentTeam = Filament::getTenant();

        // Check if the 'default' key is set and true
        if (isset($data['default']) && $data['default'] == true) {

            // Check if there's already a default record for the given team_id
            $existingDefault = static::getModel()::where('team_id', $currentTeam->id)
                ->where('default', true)
                ->get();

            // If an existing default record is found, update it to not be default
            if ($existingDefault->count() > 0) {
                static::getModel()::whereIn('id', $existingDefault->pluck('id')->toArray())->update(['default' => false]);
            }
        } else {
            // If no default is set in the current data, check if there's no default record for the team
            $defaultExists = static::getModel()::where('team_id', $currentTeam->id)
                ->where('default', true)
                ->exists();

            // If no default record exists for the team, set this record as default
            if (! $defaultExists) {
                $data['default'] = true;
            }
        }

        // Create the new record
        return static::getModel()::create($data);
    }
}

<?php

namespace App\Filament\Admin\Resources\EmailListResource\Pages;

use Filament\Actions;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Admin\Resources\EmailListResource;

class EditEmailList extends EditRecord
{
    protected static string $resource = EmailListResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordUpdate(Model $record, array $data): Model
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
            if (!$defaultExists) {
                $data['default'] = true;
            }
        }

        $record->update($data);

        return $record;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}

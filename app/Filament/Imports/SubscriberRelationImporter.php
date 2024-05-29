<?php

namespace App\Filament\Imports;

use App\Models\Tag;
use Filament\Forms;
use App\Models\EmailList;
use App\Models\Subscriber;
use Illuminate\Support\Arr;
use Filament\Facades\Filament;
use App\Enum\SubscriberStatusType;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class SubscriberRelationImporter extends Importer
{
    protected static ?string $model = Subscriber::class;

    public static function getOptionsFormComponents(): array
    {
        return [
            Forms\Components\Select::make('tags')
                ->label('Tags')
                ->options(Tag::query()->where('team_id', Filament::getTenant()->id)->pluck('name', 'id'))
                ->multiple()
                ->searchable(),
        ];
    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('email')
                ->label('Email')
                ->requiredMapping()
                ->rules(['required', 'email', 'max:255'])
                ->example('johndoe@gmail.com'),
            ImportColumn::make('first_name')
                ->label('First Name')
                ->requiredMapping()
                ->rules(['nullable', 'string', 'max:255'])
                ->example('John'),
            ImportColumn::make('last_name')
                ->label('Last Name')
                ->requiredMapping()
                ->rules(['nullable', 'string', 'max:255'])
                ->example('Doe'),
        ];
    }

    public function resolveRecord(): ?Subscriber
    {
        return new Subscriber([
            'email' => $this->data['email'],
            'first_name' => $this->data['first_name'],
            'last_name' => $this->data['last_name'],
            'status' => SubscriberStatusType::SUBSCRIBED->value,
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your subscriber import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }

    public function saveRecord(): void
    {
        // Save the subscriber instance
        $this->record->save();

        // Attach the subscriber to the email list
        $emailList = EmailList::findOrFail($this->options['email_list_id']);
        $emailList->subscribers()->attach($this->record->id);

        // Attach the tags
        $subscriber = Subscriber::findOrFail($this->record->id);
        $subscriber->tags()->attach($this->options['tags']);
    }
}

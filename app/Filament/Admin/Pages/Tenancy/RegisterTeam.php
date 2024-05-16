<?php

namespace App\Filament\Admin\Pages\Tenancy;

use App\Models\Team;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Tenancy\RegisterTenant;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class RegisterTeam extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register Team';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->placeholder('Team Name')
                    ->required()
                    ->string()
                    ->minLength(2)
                    ->maxLength(30)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->placeholder('e.g. team-name')
                    ->required()
                    ->string()
                    ->unique()
                    ->helperText(new HtmlString('The slug will be automatically formatted in lowercase and with dashes. Example: <span class="font-semibold text-primary-800 dark:text-primary-300">Team Name</span> to <span class="font-semibold text-primary-800 dark:text-primary-300">team-name</span>.')),
                TimezoneSelect::make('timezone')
                    ->searchable()
                    ->required()
                    ->timezoneType('GMT'),
            ]);
    }

    protected function handleRegistration(array $data): Team
    {
        $data['user_id'] = auth()->user()->id;
        $data['slug'] = Str::slug($data['slug']);

        $team = Team::create($data);

        $team->users()->attach(auth()->user());

        return $team;
    }
}

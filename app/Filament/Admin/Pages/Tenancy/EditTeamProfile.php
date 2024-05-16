<?php

namespace App\Filament\Admin\Pages\Tenancy;

use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Pages\Tenancy\EditTenantProfile;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class EditTeamProfile extends EditTenantProfile
{
    /**
     * @var \App\Models\Team
     */
    public $tenant;

    public static function getLabel(): string
    {
        return 'Edit Team Profile';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Team Profile Settings')
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
                            ->unique(ignoreRecord: true)
                            ->helperText(new HtmlString('The slug will be automatically formatted in lowercase and with dashes. Example: <span class="font-semibold text-primary-800 dark:text-primary-300">Team Name</span> to <span class="font-semibold text-primary-800 dark:text-primary-300">team-name</span>.')),
                        TimezoneSelect::make('timezone')
                            ->searchable()
                            ->required()
                            ->timezoneType('GMT'),
                    ]),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['slug'] = Str::slug($data['slug']);

        return $data;
    }

    protected function getRedirectUrl(): ?string
    {
        return route('filament.admin.tenant.profile', ['tenant' => $this->tenant->slug]);
    }
}

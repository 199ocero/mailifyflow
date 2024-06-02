<?php

use App\Filament\Admin\Resources\EmailListResource;
use App\Filament\Admin\Resources\EmailListResource\Pages\CreateEmailList;
use App\Models\EmailList;

use function Pest\Livewire\livewire;

beforeEach(function () {
    asUser();
});

it('can render email list create page', function () {
    $this->get(EmailListResource::getUrl('create'))->assertSuccessful();
});

it('can create new email list', function () {
    $newData = EmailList::factory()->make();

    livewire(CreateEmailList::class)
        ->fillForm([
            'name' => $newData->name,
            'description' => $newData->description,
            'active' => $newData->active,
            'default' => $newData->default,
        ])
        ->call('create')
        ->assertHasNoFormErrors();

    $this->assertDatabaseHas(EmailList::class, [
        'name' => $newData->name,
        'description' => $newData->description,
        'active' => $newData->active,
        'default' => $newData->default,
    ]);
});

it('can validate email list input', function () {
    livewire(CreateEmailList::class)
        ->fillForm([
            'name' => null,
            'description' => null,
            'active' => null,
            'default' => null,
        ])
        ->call('create')
        ->assertHasFormErrors([
            'name' => 'required',
            'description' => 'required',
            'active' => 'required',
            'default' => 'required',
        ]);
});

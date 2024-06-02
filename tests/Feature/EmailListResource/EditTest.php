<?php

use App\Filament\Admin\Resources\EmailListResource;
use App\Filament\Admin\Resources\EmailListResource\Pages\EditEmailList;
use App\Models\EmailList;

use function Pest\Livewire\livewire;

beforeEach(function () {
    asUser();
});

it('can render email list edit page', function () {
    $this->get(EmailListResource::getUrl('edit', [
        'record' => EmailList::factory()->create(),
    ]))->assertSuccessful();
});

it('can retrieve data for email list edit', function () {
    $emailList = EmailList::factory()->create();

    livewire(EditEmailList::class, [
        'record' => $emailList->getRouteKey(),
    ])
        ->assertFormSet([
            'name' => $emailList->name,
            'description' => $emailList->description,
            'active' => $emailList->active,
            'default' => $emailList->default,
        ]);
});

it('can save email list data', function () {
    $emailList = EmailList::factory()->create();
    $newData = EmailList::factory()->create();

    livewire(EditEmailList::class, [
        'record' => $emailList->getRouteKey(),
    ])
        ->fillForm([
            'name' => $newData->name,
            'description' => $newData->description,
            'active' => $newData->active,
            'default' => $newData->default,
        ])
        ->call('save')
        ->assertHasNoFormErrors();

    expect($emailList->refresh())
        ->name->toBe($newData->name)
        ->description->toBe($newData->description)
        ->active->toBe($newData->active)
        ->default->toBe(false); // should be false if there is already a default
});

it('can validate email list input', function () {
    $emailList = EmailList::factory()->create();

    livewire(EditEmailList::class, [
        'record' => $emailList->getRouteKey(),
    ])
        ->fillForm([
            'name' => null,
            'description' => null,
            'active' => null,
            'default' => null,
        ])
        ->call('save')
        ->assertHasFormErrors([
            'name' => 'required',
            'description' => 'required',
            'active' => 'required',
            'default' => 'required',
        ]);
});

<?php

use App\Filament\Admin\Resources\EmailListResource;
use App\Filament\Admin\Resources\EmailListResource\Pages\ListEmailLists;
use App\Models\EmailList;

use function Pest\Livewire\livewire;

beforeEach(function () {
    asUser();
});

it('can render email list page', function () {
    $this->get(EmailListResource::getUrl('index'))->assertSuccessful();
});

it('can list email lists', function () {
    $emailList = EmailList::factory(10)->create();

    livewire(ListEmailLists::class)
        ->assertCanSeeTableRecords($emailList);
});

<?php

use App\Filament\Admin\Resources\EmailListResource\Pages\ListEmailLists;
use App\Models\EmailList;

use function Pest\Livewire\livewire;

beforeEach(function () {
    asUser();
});

it('can delete email list data', function () {
    $emailList = EmailList::factory()->create();

    livewire(ListEmailLists::class, [
        'record' => $emailList->getRouteKey(),
    ])
        ->callTableAction('delete_single_email_list', $emailList);

    $this->assertModelMissing($emailList);
});

it('can bulk delete email list data', function () {
    $emailLists = EmailList::factory(10)->create();

    livewire(ListEmailLists::class)
        ->callTableBulkAction('delete_email_list', $emailLists);

    foreach ($emailLists as $emailList) {
        $this->assertModelMissing($emailList);
    }
});

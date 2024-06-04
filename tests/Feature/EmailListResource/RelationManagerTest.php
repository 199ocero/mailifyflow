<?php

use App\Filament\Admin\Resources\EmailListResource\Pages\EditEmailList;
use App\Filament\Admin\Resources\EmailListResource\RelationManagers\SubscribersRelationManager;
use App\Models\EmailList;
use App\Models\Subscriber;
use App\Models\Tag;

use function Pest\Livewire\livewire;

beforeEach(function () {
    asUser();
});

it('can list email lists subscribers', function () {
    $emailList = EmailList::factory()->has(Subscriber::factory()->count(3)->has(Tag::factory()->count(1)))->create();

    livewire(SubscribersRelationManager::class, [
        'ownerRecord' => $emailList,
        'pageClass' => EditEmailList::class,
    ])
        ->loadTable()
        ->assertCanSeeTableRecords($emailList->subscribers)
        ->assertCountTableRecords($emailList->subscribers()->count());
});

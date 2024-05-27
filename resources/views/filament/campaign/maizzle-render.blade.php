<table align="center">
    <tr>
        <td class="w-[700px] max-w-full">
            <table class="w-full my-7">
                <tr>
                    <td class="p-12 text-gray-800 bg-white rounded shadow-sm sm:px-6">
                        <div class="grid gap-1">
                            @foreach ($templateContent as $key => $item)
                                @switch($item['type'])
                                    @case('heading')
                                        @include('filament.campaign.blocks.heading', ['data' => $item])
                                    @break

                                    @case('paragraph')
                                        @include('filament.campaign.blocks.paragraph', ['data' => $item])
                                    @break

                                    @case('bulletList')
                                        @include('filament.campaign.blocks.bullet-list', ['data' => $item])
                                    @break

                                    @case('orderedList')
                                        @include('filament.campaign.blocks.ordered-list', [
                                            'data' => $item,
                                        ])
                                    @break

                                    @case('tiptapBlock')
                                        @if ($item['attrs']['type'] == 'buttonBlock')
                                            @include('filament.campaign.blocks.button', ['data' => $item])
                                        @elseif ($item['attrs']['type'] == 'quoteBlock')
                                            @include('filament.campaign.blocks.quote', ['data' => $item])
                                        @elseif ($item['attrs']['type'] == 'contentBlock')
                                            @include('filament.campaign.blocks.content')
                                        @endif
                                    @break

                                    @case('horizontalRule')
                                        @include('filament.campaign.blocks.divider')
                                    @break

                                    @default
                                @endswitch
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

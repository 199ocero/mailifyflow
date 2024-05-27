<?php

namespace App\Filament\Admin\Resources\CampaignResource\Pages;

use App\Models\Template;
use Filament\Facades\Filament;
use App\Services\MaizzleConverter;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Admin\Resources\CampaignResource;

class CreateCampaign extends CreateRecord
{
    protected static string $resource = CampaignResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $team = Filament::getTenant();
        $template = Template::find($data['template_id']);

        $extractedHtmlCss = html_css_extractor($template->template_content, $data['campaign_content']);

        $convertedContent = MaizzleConverter::make()->convert(
            $data['subject'],
            $data['preheader'],
            'bg-gray-50',
            $extractedHtmlCss
        );

        $data['team_id'] = $team->id;
        $data['converted_content'] = $convertedContent;

        return $data;
    }
}

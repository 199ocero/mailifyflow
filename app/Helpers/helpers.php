<?php

use Illuminate\Support\Facades\View;

if (! function_exists('html_css_extractor')) {
    function html_css_extractor(string|array $templateContent, string|array $campaignContent): string
    {
        return View::make('filament.campaign.maizzle-render', [
            'templateContent' => tiptap_converter()->asJSON(
                $templateContent,
                true
            )['content'],
            'campaignContent' => tiptap_converter()->asJSON(
                $campaignContent,
                true
            )['content'],
        ])->render();
    }
}

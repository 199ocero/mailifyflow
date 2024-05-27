@props(['data'])
@php
    $html = '';

    if (isset($data['content'])) {
        foreach ($data['content'] as $element) {
            if ($element['type'] == 'text') {
                $text = $element['text'];
            }

            $marks = isset($element['marks']) ? $element['marks'] : [];

            foreach ($marks as $mark) {
                switch ($mark['type']) {
                    case 'bold':
                        $text = "<strong>{$text}</strong>";
                        break;
                    case 'italic':
                        $text = "<em>{$text}</em>";
                        break;
                    case 'underline':
                        $text = "<u>{$text}</u>";
                        break;
                    case 'strike':
                        $text = "<del>{$text}</del>";
                        break;
                    case 'link':
                        $attrs = $mark['attrs'];
                        $href = $attrs['href'] ?? '#';
                        $class = $attrs['class'] ?? '';
                        $id = $attrs['id'] ?? '';
                        $style = $attrs['style'] ?? '';
                        $target = $attrs['target'] ?? '';
                        $hreflang = $attrs['hreflang'] ?? '';
                        $rel = $attrs['rel'] ?? '';
                        $referrerpolicy = $attrs['referrerpolicy'] ?? '';

                        $attrString = "href=\"{$href}\"";
                        $attrString .= $class ? " class=\"{$class}\"" : '';
                        $attrString .= $id ? " id=\"{$id}\"" : '';
                        $attrString .= $style ? " style=\"{$style}\"" : '';
                        $attrString .= $target ? " target=\"{$target}\"" : '';
                        $attrString .= $hreflang ? " hreflang=\"{$hreflang}\"" : '';
                        $attrString .= $rel ? " rel=\"{$rel}\"" : '';
                        $attrString .= $referrerpolicy ? " referrerpolicy=\"{$referrerpolicy}\"" : '';

                        $text = "<a class='text-blue-600 underline dark:text-blue-400' {$attrString}>{$text}</a>";
                        break;
                }
            }

            $html .= $text;
        }
    }
@endphp
<p class="w-full m-0 leading-6">
    @if (empty($html))
        <br>
    @else
        {!! $html !!}
    @endif
</p>

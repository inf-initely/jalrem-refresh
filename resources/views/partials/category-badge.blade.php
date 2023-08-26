@if ($category == 'Indepth')
    <span class="badge rounded-pill py-1 px-3 bg-success">{{ __('Indepth') }}</span>
@elseif ($category == 'Jurnal Artikel')
    <span class="badge rounded-pill py-1 px-3 bg-secondary">{{ __('Journal Article') }}</span>
@endif

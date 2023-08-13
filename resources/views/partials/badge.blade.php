@if ($ks->isi == 'Indepth')
    <span class="badge rounded-pill py-1 px-3 bg-success">{{ __('Indepth') }}</span>
@elseif ($ks->isi == 'Jurnal Artikel')
    <span class="badge rounded-pill py-1 px-3 bg-secondary">{{ __('Journal Article') }}</span>
@endif

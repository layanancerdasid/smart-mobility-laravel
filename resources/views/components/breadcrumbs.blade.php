@if (count($breadcrumbs) > 0)
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
            @foreach ($breadcrumbs as $breadcrumb)
                <li class="breadcrumb-item {{ $breadcrumb['active'] ? 'active' : '' }}">
                    @if (!$breadcrumb['active'])
                        <a href="{{ $breadcrumb['url'] }}" class="text-white text-decoration-none">
                            {{ $breadcrumb['name'] }}
                        </a>
                    @else
                        <span class="text-white">{{ $breadcrumb['name'] }}</span>
                    @endif
                </li>
            @endforeach
        </ol>
    </nav>
@endif

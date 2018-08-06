@if(count($monster->skilleffects))
    @foreach($monster->skilleffects as $effect)
        @if(!$effect->icon_filename == '')
            <div class="media">
                <div class="media-left">
                        <img src="<?= asset('storage/data/images/' . $effect->icon_filename) ?>">
                </div>
                <div class="media-body">
                    <h4>
                        {{ $effect->name }}
                    </h4>
                    <p>
                        {{ $effect->description }}
                    </p>
                </div>
            </div>
        @else
        @endif
    @endforeach
@else
    php artisan migrate:skilleffects
@endif
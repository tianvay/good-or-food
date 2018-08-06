<div class="media">
    @foreach($monster->bros() as $bro)
        <div class="media-left">
                <a href="{{ url('/monsters/' . $bro->id) }}">
                    <img src="{{ asset('storage/data/images/element_' . strtolower($bro->element) . ".png" ) }}" alt ="{{ $bro->name }}" title="{{ $bro->name }}">
                </a>
        </div>
    @endforeach
</div>
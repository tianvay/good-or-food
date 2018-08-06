@if(isset($monster))
    <a href="<?= url('/monsters/' . $monster->id) ?>">
        <div class="media-left monsterpic">
            <img src="<?= asset('storage/data/images/' . $monster->pic) ?>">
        </div>
    </a>
@endif
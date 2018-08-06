<div class="monsterfilter">
    <div class="media">
        <div class="media-left">
            <a href="{{url("/monsters?element=wind")}}">
                <img src="{{asset("storage/data/images/element_wind.png")}}">
            </a>
        </div>
        <div class="media-left">
            <a href="{{url("/monsters?element=water")}}">
                <img src="{{asset("storage/data/images/element_water.png")}}">
            </a>
        </div>
        <div class="media-left">
            <a href="{{url("/monsters?element=fire")}}">
                <img src="{{asset("storage/data/images/element_fire.png")}}">
            </a>
        </div>
        <div class="media-left">
            <a href="{{url("/monsters?element=light")}}">
                <img src="{{asset("storage/data/images/element_light.png")}}">
            </a>
        </div>
        <div class="media-left">
            <a href="{{url("/monsters?element=dark")}}">
                <img src="{{asset("storage/data/images/element_dark.png")}}">
            </a>
        </div>
        <div class="media-body">
            <form method="get" action="{{url('/monsters')}}">
                <div class="form-group">
                    <input type="name" class="form-control" id="name" placeholder="Name" name="name" required>
                    <button type="submit" class="btn btn-primary">Find!</button>
                </div>
            </form>
        </div>
    </div>
    <hr>
</div>
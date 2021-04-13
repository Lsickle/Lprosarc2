<aside class="main-sidebar">
    <section class="sidebar">
        {{-- @if (! Auth::guest()) --}}
        <div class="user-panel container">
            <div class="pull-left image" style="max-width: 3.2em; max-height: 3.2em;">
            @if(file_exists(public_path().'/img/ImagesProfile/'.Auth::user()->UsAvatar) && Auth::user()->UsAvatar <> null)
                <img class="img-circle" src="../../../img/ImagesProfile/{{Auth::user()->UsAvatar }}" alt="User Image">
            @else
                <img class="img-circle" src="../../../img/robot400x400.gif" alt="User Image">
            @endif
            </div>
            <div class="pull-left info" style="overflow:hidden; max-width: 10em; max-height: 3.1em; height: auto; width: auto; position: absolute; top: 0.5em;">
                <p style=" overflow:hidden; text-overflow: ellipsis;" data-toggle="tooltip" title="{{ Auth::user()->name }}"><span>{{ Auth::user()->name }}</span></p>
                <a href="#"><i class="fa fa-circle text-success" class="treeview-menu"></i><span> {{ Auth::user()->UsRol }}</span></a>
            </div>
        </div>
        {{-- @endif --}}
        {{-- {!! Menu::sidebar() !!} --}}
    </section>
</aside>

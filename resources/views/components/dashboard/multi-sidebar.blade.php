@props(['route', 'label', 'icon', 'submenus'])

<li
    @if (is_array(eval("return $route;")) && collect(eval("return $route;"))->contains(request()->route()->getName())) class="active-page"
    @elseif(!is_array(eval("return $route;")) && request()->routeIs(eval("return $route;")))
    class="active-page" @endif>
    <a href="#"><i class="material-icons-two-tone">{{ $icon }}</i>{{ $label }}<i
            class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
    @if (count($submenus) > 0)
        <ul class="sub-menu">
            @foreach ($submenus as $submenu)
                <li>
                    <a href="{{ is_array($submenu['route']) ? route($submenu['route'][0]) : route($submenu['route']) }}"
                        @if (is_array($submenu['route']) && collect($submenu['route'])->contains(request()->route()->getName())) class="active"
                        @elseif(!is_array($submenu['route']) && request()->routeIs($submenu['route']))
                        class="active" @endif>
                        {{ $submenu['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>

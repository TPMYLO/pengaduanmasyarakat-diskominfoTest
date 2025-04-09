@props(['routes' => [], 'icon', 'label'])

<li class="{{ in_array(request()->route()->getName(), (array) $routes) ? 'active-page' : '' }}">
    <a href="{{ is_array($routes) ? route($routes[0]) : route($routes) }}"
        {{ in_array(request()->route()->getName(), (array) $routes) ? 'class="active"' : '' }}>
        <i class="material-icons-two-tone">{{ $icon }}</i>{{ $label ?? '' }}</a>
</li>

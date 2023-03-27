<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
        data-accordion="false">
        @foreach ($items as $item)
        <li class="nav-item menu-open">
            <a href="{{$item['route']}}" class="nav-link {{$item['route'] == $active ? 'active' : ''}}">
                <i class="{{$item['icon']}}"></i>
                <p>
                    {{$item['title']}}
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
        </li>
        @endforeach
        </ul>
        </nav>

<div>
    <!-- Breathing in, I calm body and mind. Breathing out, I smile. - Thich Nhat Hanh -->
    <li class="nav-item dropdown">

  <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            @if ($countNotifications)
            <span class="badge badge-warning navbar-badge">{{$countNotifications}}</span>
            @endif

        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">{{$countNotifications}} Notifications</span>
           @foreach ($notifications as $notification)

            <div class="dropdown-divider"></div>
            {{-- لما ابعت هاد البراميتر بطلع نوت فاوند بدنا حل --}}
            <a href="{{$notification->data['action'] }}?notification_id={{$notification->id}}" class="dropdown-item @if ($notification->unread()) text-bold  @endif">
              {{-- <input type="hidden" name="notification_id" value="{{$notification->id}}"> --}}
                <i class="{{$notification->data['logo']}}"></i> {{$notification->data['body']}}
                <span class="float-right text-muted text-sm">{{$notification->created_at->shortAbsoluteDiffForHumans()}}</span>
            </a>

            @endforeach
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
    </li>
</div>

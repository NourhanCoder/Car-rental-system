 <div class="top_nav">
     <div class="nav_menu">
         <div class="nav toggle">
             <a id="menu_toggle"><i class="fa fa-bars"></i></a>
         </div>
         <nav class="nav navbar-nav">
             <ul class=" navbar-right">
                 <li class="nav-item dropdown open" style="padding-left: 15px;">
                     <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                         data-toggle="dropdown" aria-expanded="false">
                         @if (auth()->user()->image)
                             <img src="{{ asset('storage/' . auth()->user()->image) }}"
                                 alt="{{ auth()->user()->full_name }}">
                         @else
                             <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->full_name) }}"
                                 alt="{{ auth()->user()->name }}">
                         @endif
                         {{ auth()->user()->full_name }}
                     </a>
                     <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item" href="javascript:;"> Profile</a>
                         <a class="dropdown-item" href="javascript:;">
                             <span class="badge bg-red pull-right">50%</span>
                             <span>Settings</span>
                         </a>
                         <a class="dropdown-item" href="javascript:;">Help</a>
                         <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log
                             Out</a>
                     </div>
                 </li>

                 <li role="presentation" class="nav-item dropdown open">
                     <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                         data-toggle="dropdown" aria-expanded="false">
                         <i class="fa fa-envelope-o"></i>
                         @if ($unreadCount > 0)
                             <span class="badge bg-green">{{ $unreadCount }}</span>
                         @endif
                     </a>
                     <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                         @forelse($unreadMessages as $msg)
                             <li class="nav-item">
                                 <a class="dropdown-item" href="{{ route('admin.contacts.show', $msg->id) }}">
                                     <span>
                                         <span>{{ $msg->first_name }} {{ $msg->last_name }}</span>
                                         <span class="time">{{ $msg->created_at->diffForHumans() }}</span>
                                     </span>
                                     <span class="message">
                                         {{ Str::limit($msg->message, 50) }}
                                     </span>
                                 </a>
                             </li>
                         @empty
                             <li class="nav-item">
                                 <a class="dropdown-item text-center">
                                     <span>No unread messages</span>
                                 </a>
                             </li>
                         @endforelse

                         @if ($unreadCount > 0)
                             <li class="nav-item">
                                 <div class="text-center">
                                     <a class="dropdown-item" href="{{ route('admin.contacts.index') }}">
                                         <strong>See All Messages</strong>
                                         <i class="fa fa-angle-right"></i>
                                     </a>
                                 </div>
                             </li>
                         @endif
                     </ul>
                 </li>

                 {{-- <li class="nav-item">
                     <div class="text-center">
                         <a class="dropdown-item">
                             <strong>See All Alerts</strong>
                             <i class="fa fa-angle-right"></i>
                         </a>
                     </div>
                 </li> --}}
             </ul>
             </li>
             </ul>
         </nav>
     </div>
 </div>

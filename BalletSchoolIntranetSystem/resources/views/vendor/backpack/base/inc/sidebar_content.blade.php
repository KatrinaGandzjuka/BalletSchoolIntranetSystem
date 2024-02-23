{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> Users</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('location') }}"><i class="nav-icon la la-compass"></i> Locations</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('group') }}"><i class="nav-icon la la-group"></i> Groups</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('costume') }}"><i class="nav-icon la la-tshirt"></i> Costumes</a></li>

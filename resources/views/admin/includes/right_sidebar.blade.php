<aside class="control-sidebar control-sidebar-light">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <div class="d-flex flex-column">
            <div>
              <a href="" style="text-style:none"> Change Password </a>
            </div>
            <hr/>
            <div>
              <a href="" style="font-weight:bold;text-color:black"> Profile </a>
            </div>
            <hr/>
            <div>
              <a  href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
           </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
               @csrf
           </form>
            </div>
        </div>
    </div>
  </aside>
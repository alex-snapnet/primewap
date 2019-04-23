      <nav class="sidebar sidebar-offcanvas" id="sidebar" style="width: 219px;">

        <ul class="nav">

          <li class="nav-item nav-profile">

            <div class="nav-link">

              <div class="user-wrapper">

                <div class="profile-image">

                  <img src="../../images/faces/face1.jpg" alt="profile image">

                </div>

                <div class="text-wrapper">

                  <p class="profile-name">{{Auth::user()->name}}</p>

                  <div>

                    <small class="designation text-muted">{{ucfirst(str_replace('_',' ',Auth::user()->type))}}</small>

                    <span class="status-indicator online"></span>

                  </div>

                </div>

              </div>

              @if (Auth::user()->type == 'prime_admin')

              <a href="{{ route('agrolytic.index') }}" class="btn btn-success btn-block">New Agrolytic

              @endif 

                <i class="mdi mdi-plus"></i>

              </a>

            </div>

          </li>

          <li class="nav-item">

            <a class="nav-link" href="{{ route('agrolytic.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">View Agrolytic</span>

            </a>

          </li>

          <!-- prime_super_admin -->
          <!-- primesuperadmin@pa.com -->
          <!-- primesuperadmin -->

          <!-- {{ Auth::user()->type }} -->

          @if (Auth::user()->type == 'prime_super_admin')

          <li class="nav-item">

            <a class="nav-link" href="{{ route('group.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Agrolytic Groups</span>

            </a>

          </li>

          

           <li class="nav-item">

            <a class="nav-link" href="{{ route('category.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Categories</span>

            </a>

          </li>


          <li class="nav-item">

            <a class="nav-link" href="{{ route('sector.index') }}">

            <i class="menu-icon mdi mdi-television"></i>

            <span class="menu-title">Sectors</span>

            </a>

          </li>



           <li class="nav-item">

            <a class="nav-link" href="{{ route('user.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Manage User(s)</span>

            </a>

          </li>

         <li class="nav-item">

            <a class="nav-link" href="{{ route('customer.index') }}">

              <i class="menu-icon mdi mdi-television"></i>

              <span class="menu-title">Customers</span>

            </a>

          </li>

          @endif

        </ul>

      </nav>

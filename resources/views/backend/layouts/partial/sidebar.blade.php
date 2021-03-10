  <!-- sidebar menu area start -->
  <div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{url('/admin')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>
                    </li>
                    <!-- nav link item--->
                    <li class="">
                        <a href="{{ url('/') }}" target="_blank" aria-expanded="true"><i class="ti-home"></i><span>Visit mysite</span></a>
                    </li>

                    <!-- nav link item--->
                    <li  class="{{ Route::is('admin.contact.index') || Route::is('admin.contact.emailview')? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i><span>Mail Box</span></a>
                        <ul class="collapse {{ Route::is('admin.contact.index') || Route::is('admin.contact.emailview')? 'active' : '' }}">
                            <li><a href=""> <i class="ti-control-record"></i> <span>Compose</span></a></li>
                            <li class="{{ Route::is('admin.contact.index') || Route::is('admin.contact.emailview')? 'active' : '' }}"><a href="{{url('/admin/contact')}}"> <i class="ti-control-record"></i> <span>All Mail</span></a></li>
                            <li><a href=""> <i class="ti-control-record"></i> <span>Sent Mail</span></a></li>
                        </ul>
                    </li>
                    <!-- nav link item--->
                     <li  class=" {{ Route::is('admin.personalinfo.view') || Route::is('admin.personalinfo.edit') || Route::is('admin.sociallink.index')||Route::is('admin.service.index') || Route::is('admin.education.index') || Route::is('admin.experience.index') || Route::is('admin.skillknowledge.index') || Route::is('admin.achievementsite.index') || Route::is('admin.researchsite.index')? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i><span>Profile setting</span></a>
                        <ul class="collapse {{ Route::is('admin.sociallink.index') || Route::is('admin.personalinfo.view') || Route::is('admin.personalinfo.edit') ||Route::is('admin.service.index') || Route::is('admin.education.index') || Route::is('admin.experience.index') || Route::is('admin.skillknowledge.index') || Route::is('admin.achievementsite.index') || Route::is('admin.researchsite.index')? 'active' : '' }}">
                            <li class=" {{ Route::is('admin.personalinfo.view') || Route::is('admin.personalinfo.edit') ? 'active' : '' }}"><a href="{{ url('admin/personalinfo/view') }}"> <i class="ti-control-record"></i> <span>Personal information</span></a></li>
                            <li class="{{ Route::is('admin.sociallink.index') ? 'active' : '' }} "><a href="{{ url('/admin/sociallink') }}"> <i class="ti-control-record"></i><span>Social Link</span></a></li>
                            <li class="{{ Route::is('admin.service.index')? 'active' : '' }}"><a href="{{ url('/admin/service') }}"> <i class="ti-control-record"></i><span>Service</span></a></li>
                            <li class="{{ Route::is('admin.education.index')? 'active' : '' }}"><a href="{{ url('/admin/education') }}"> <i class="ti-control-record"></i><span>Education</span></a></li>

                            <li class="{{ Route::is('admin.experience.index')? 'active' : '' }}"><a href="{{ url('/admin/experience') }}"> <i class="ti-control-record"></i><span>Experience</span></a></li>

                            <li class="{{ Route::is('admin.achievementsite.index')? 'active' : '' }}"><a href="{{ url('admin/achievementsite') }}"> <i class="ti-control-record"></i><span>Achievements</span></a></li>

                            <li class="{{ Route::is('admin.researchsite.index')? 'active' : '' }}"><a href="{{ url('admin/researchsite') }}"> <i class="ti-control-record"></i><span>Research</span></a></li>

                            <li class="{{ Route::is('admin.skillknowledge.index')? 'active' : '' }}"><a href="{{ url('/admin/skillknowledge') }}"> <i class="ti-control-record"></i><span>Skill knowledge</span></a></li>
                        </ul>
                    </li>
                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.work.skill.index') || Route::is('admin.work.edit')|| Route::is('admin.work.index') || Route::is('admin.work.create')|| Route::is('admin.category.index') || Route::is('admin.category.create')? 'active' : '' }}">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-desktop"></i><span>Work Management
                            </span></a>
                        <ul class="collapse{{ Route::is('admin.work.skill.index') || Route::is('admin.work.index') || Route::is('admin.work.create')||Route::is('admin.category.index')|| Route::is('admin.category.create')? 'active' : '' }}">
                            <li class="{{ Route::is('admin.work.create') || Route::is('admin.work.edit') || Route::is('admin.work.index')? 'active' : '' }}"><a href="{{url('/admin/work/')}}"> <i class="ti-control-record"></i> <span>Project List</span></a></li>
                            <li class="{{ Route::is('admin.category.create')||Route::is('admin.category.index')? 'active' : '' }}"><a href="{{url('/admin/category')}}"> <i class="ti-control-record"></i> <span>Category</span></a></li>
                            <li class="{{ Route::is('admin.work.skill.index')? 'active' : '' }}"><a href="{{ url('/admin/workskill') }}"> <i class="ti-control-record"></i> <span>Skill</span></a></li>
                        </ul>
                    </li>
                    <!-- nav link item--->

                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.freelanceesite.index')? 'active' : '' }}">
                        <a href="{{ url('admin/freelanceesite') }}" aria-expanded="true"><i class="ti-star"></i><span>Freelance sites</span></a>
                    </li>

                    <!-- nav link item--->
                    <li class="{{ Route::is('admin.iconsite')? 'active' : '' }}">
                        <a href="{{ url('admin/iconsite') }}" aria-expanded="true"><i class="ti-widget"></i><span>Icon</span></a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>
<!-- sidebar menu area end -->

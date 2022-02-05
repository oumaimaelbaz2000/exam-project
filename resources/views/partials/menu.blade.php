<aside class="main-sidebar">
    <section class="sidebar" style="height: auto;">
        <ul class="sidebar-menu tree" data-widget="tree">
            <li>
                <a href="{{ route("admin.home") }}">
                    <i class="fas fa-fw fa-tachometer-alt">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            @can('user_management_access')
                <li class="treeview">
                    <a href="#">
                        <i class="fa-fw fas fa-users">

                        </i>
                        <span>{{ trans('cruds.userManagement.title') }}</span>
                        <span class="pull-right-container"><i class="fa fa-fw fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        @can('permission_access')
                            <li class="{{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                <a href="{{ route("admin.permissions.index") }}">
                                    <i class="fa-fw fas fa-unlock-alt">

                                    </i>
                                    <span>{{ trans('cruds.permission.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('role_access')
                            <li class="{{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                <a href="{{ route("admin.roles.index") }}">
                                    <i class="fa-fw fas fa-briefcase">

                                    </i>
                                    <span>{{ trans('cruds.role.title') }}</span>

                                </a>
                            </li>
                        @endcan
                        @can('user_access')
                            <li class="{{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                <a href="{{ route("admin.users.index") }}">
                                    <i class="fa-fw fas fa-user">

                                    </i>
                                    <span>{{ trans('cruds.user.title') }}</span>

                                </a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan
            @can('question_access')
                <li class="{{ request()->is("admin/questions") || request()->is("admin/questions/*") ? "active" : "" }}">
                    <a href="{{ route("admin.questions.index") }}">
                        <i class="fa-fw fas fa-question-circle">

                        </i>
                        <span>{{ trans('cruds.question.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('certificat_access')
                <li class="{{ request()->is("admin/certificats") || request()->is("admin/certificats/*") ? "active" : "" }}">
                    <a href="{{ route("admin.certificats.index") }}">
                        <i class="fa-fw fas fa-user-graduate">

                        </i>
                        <span>{{ trans('cruds.certificat.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('subject_access')
                <li class="{{ request()->is("admin/subjects") || request()->is("admin/subjects/*") ? "active" : "" }}">
                    <a href="{{ route("admin.subjects.index") }}">
                        <i class="fa-fw fab fa-wpforms">

                        </i>
                        <span>{{ trans('cruds.subject.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('examan_access')
                <li class="{{ request()->is("admin/examen") || request()->is("admin/examen/*") ? "active" : "" }}">
                    <a href="{{ route("admin.examen.index") }}">
                        <i class="fa-fw fas fa-chalkboard-teacher">

                        </i>
                        <span>{{ trans('cruds.examan.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('entrainement_access')
                <li class="{{ request()->is("admin/entrainements") || request()->is("admin/entrainements/*") ? "active" : "" }}">
                    <a href="{{ route("admin.entrainements.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.entrainement.title') }}</span>

                    </a>
                </li>
            @endcan
            @can('statistique_access')
                <li class="{{ request()->is("admin/statistiques") || request()->is("admin/statistiques/*") ? "active" : "" }}">
                    <a href="{{ route("admin.statistiques.index") }}">
                        <i class="fa-fw fas fa-cogs">

                        </i>
                        <span>{{ trans('cruds.statistique.title') }}</span>

                    </a>
                </li>
            @endcan
            @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                @can('profile_password_edit')
                    <li class="{{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                        <a href="{{ route('profile.password.edit') }}">
                            <i class="fa-fw fas fa-key">
                            </i>
                            {{ trans('global.change_password') }}
                        </a>
                    </li>
                @endcan
            @endif
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>
    </section>
</aside>
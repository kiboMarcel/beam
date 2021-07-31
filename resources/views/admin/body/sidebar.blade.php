@php
$prefix = Request::route()->getprefix();
$route = Route::current()->getName();

@endphp


<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar">
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu ">
                <a href=" {{ route('dashboard') }} " class="dropdown-toggle"
                    data-active="{{ $route == 'dashboard' ? 'true' : 'false' }}">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        <span>Dashboard</span>
                    </div>

                </a>

            </li>

            @if (Auth::user()->role == 'Admin')
                <li class="menu">
                    <a href="#users" data-toggle="collapse" data-active="{{ $prefix == '/users' ? 'true' : 'false' }}"
                        aria-expanded="false" class="dropdown-toggle">
                        <div class="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-users">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>Utilisateurs</span>
                        </div>
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg>
                        </div>
                    </a>
                    <ul class="collapse submenu list-unstyled {{ $prefix == '/users' ? 'show' : '' }}"" id="users"
                        data-parent="#accordionExample">
                        <li class="{{ $route == 'user.view' ? 'active' : '' }}">
                            <a href="{{ route('user.view') }}"> Voir Utilisateurs </a>
                        </li>
                        <li class="{{ $route == 'user.add' ? 'active' : '' }}">
                            <a href="{{ route('user.add') }}"> Ajouter Utilisateur </a>
                        </li>
                    </ul>
                </li>
            @endif


            <li class="menu">
                <a href="#setups" data-toggle="collapse" data-active="{{ $prefix == '/setups' ? 'true' : 'false' }}"
                    aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-layers">
                            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                            <polyline points="2 17 12 22 22 17"></polyline>
                            <polyline points="2 12 12 17 22 12"></polyline>
                        </svg>
                        <span>Gestion globale</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $prefix == '/setups' ? 'show' : '' }}" id="setups"
                    data-parent="#accordionExample">
                    <li class="{{ $route == 'student.class.view' ? 'active' : '' }}">
                        <a href="{{ route('student.class.view') }}"> Classe </a>
                    </li>

                    <li class="{{ $route == 'student.year.view' ? 'active' : '' }}">
                        <a href="{{ route('student.year.view') }}"> Année Scolaire </a>
                    </li>

                    <li class="{{ $route == 'student.branch.view' ? 'active' : '' }}">
                        <a href="{{ route('student.branch.view') }}"> Series / Filieres </a>
                    </li>

                    <li class="{{ $route == 'student.group.view' ? 'active' : '' }}">
                        <a href="{{ route('student.group.view') }}"> Groupes </a>
                    </li>

                    <li class="{{ $route == 'fee.category.view' ? 'active' : '' }}">
                        <a href="{{ route('fee.category.view') }}"> Type de Paymement </a>
                    </li>

                    <li class="{{ $route == 'fee.amount.view' ? 'active' : '' }}">
                        <a href="{{ route('fee.amount.view') }}"> Montant des Payements </a>
                    </li>

                    <li class="{{ $route == 'exam.type.view' ? 'active' : '' }}">
                        <a href="{{ route('exam.type.view') }}"> types D'examen</a>
                    </li>

                    <li class="{{ $route == 'slice.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('slice.view') }}"> Tranche </a>
                    </li>

                    <li class="{{ $route == 'subject.type.view' ? 'active' : '' }}">
                        <a href="{{ route('subject.type.view') }}"> Matières</a>
                    </li>

                    <li class="{{ $route == 'assign.subject.view' ? 'active' : '' }}">
                        <a href="{{ route('assign.subject.view') }}"> Attribuer Matière </a>
                    </li>

                    <li class="{{ $route == 'assign.class.view' ? 'active' : '' }}">
                        <a href="{{ route('assign.class.view') }}"> Attribuer Classe </a>
                    </li>

                    <li class="{{ $route == 'designation.view' ? 'active' : '' }}">
                        <a href="{{ route('designation.view') }}"> Designation </a>
                    </li>

                    <li class="{{ $route == 'season.view' ? 'active' : '' }}">
                        <a href="{{ route('season.view') }}"> Trim/Sem </a>
                    </li>

                </ul>
            </li>


            <li class="menu">
                <a href="#student" data-toggle="collapse"
                    data-active="{{ $prefix == '/students' ? 'true' : 'false' }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-user-check">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="8.5" cy="7" r="4"></circle>
                            <polyline points="17 11 19 13 23 9"></polyline>
                        </svg>
                        <span>Gestion Eleves</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $prefix == '/students' ? 'show' : '' }}" id="student"
                    data-parent="#accordionExample">

                    <li class="{{ $route == 'student.registration.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('student.registration.view') }}"> Eleve </a>
                    </li>

                    <li class="{{ $route == 'student.registration.add' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('student.registration.add') }}"> Inscription </a>
                    </li>
                   {{--  <li class="{{ $route == 'registration.fee.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('registration.fee.view') }}"> Inscription </a>
                    </li> --}}

                    <li class="{{ $route == 'schooling.fee.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('schooling.fee.view') }}"> Scolarité </a>
                    </li>



                </ul>
            </li>

            <li class="menu">
                <a href="#employee" data-toggle="collapse"
                    data-active="{{ $prefix == '/employees' ? 'true' : 'false' }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-paperclip">
                            <path
                                d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                            </path>
                        </svg>
                        <span>Gest. Employés</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $prefix == '/employees' ? 'show' : '' }}" id="employee"
                    data-parent="#accordionExample">

                    <li class="{{ $route == 'employee.registration.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('employee.registration.view') }}"> Employer </a>
                    </li>

                    <li class="{{ $route == 'employee.salary.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('employee.salary.view') }}"> Salaire employer </a>
                    </li>

                    <li class="{{ $route == 'employee.leave.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('employee.leave.view') }}"> Permissions </a>
                    </li>

                    <li class="{{ $route == 'employee.attendance.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('employee.attendance.view') }}"> Présence Employer </a>
                    </li>

                    {{-- <li class="{{ $route == 'employee.month.salary.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('employee.attendance.view') }}">  </a>
                    </li> --}}


                </ul>
            </li>

            <li class="menu">
                <a href="#marks" data-toggle="collapse" data-active="{{ $prefix == '/marks' ? 'true' : 'false' }}"
                    aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-pen-tool">
                            <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                            <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                            <path d="M2 2l7.586 7.586"></path>
                            <circle cx="11" cy="11" r="2"></circle>
                        </svg>
                        <span>Gest. Note</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $prefix == '/marks' ? 'show' : '' }}" id="marks"
                    data-parent="#accordionExample">

                    <li class="{{ $route == 'marks.entry.add' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('marks.entry.add') }}"> Ajouter Note </a>
                    </li>

                    <li class="{{ $route == 'marks.entry.edit' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('marks.entry.edit') }}"> Modifier Note </a>
                    </li>




                </ul>
            </li>

            <li class="menu">
                <a href="#accountManagement" data-toggle="collapse"
                    data-active="{{ $prefix == '/accountSalary' ? 'true' : 'false' }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-dollar-sign">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                        <span>Gest. Payment</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $prefix == '/accountSalary' ? 'show' : '' }}"
                    id="accountManagement" data-parent="#accordionExample">

                    <li class="{{ $route == 'account.salary.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('account.salary.view') }}"> Salaire employee </a>
                    </li>






                </ul>
            </li>

            <li class="menu">
                <a href="#reportManagement" data-toggle="collapse"
                    data-active="{{ $prefix == '/reportManagement' ? 'true' : 'false' }}" aria-expanded="false"
                    class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-award">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                        <span>Gest. Supplementaire</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ $prefix == '/reportManagement' ? 'show' : '' }}"
                    id="reportManagement" data-parent="#reportManagement">

                    <li class="{{ $route == 'marksheet.generate.view' ? 'active' : '' }}">
                        <a type="submit" href="{{ route('marksheet.generate.view') }}"> Releve de Note </a>
                    </li>






                </ul>
            </li>

           {{--  <li class="menu">
                <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-cpu">
                            <rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect>
                            <rect x="9" y="9" width="6" height="6"></rect>
                            <line x1="9" y1="1" x2="9" y2="4"></line>
                            <line x1="15" y1="1" x2="15" y2="4"></line>
                            <line x1="9" y1="20" x2="9" y2="23"></line>
                            <line x1="15" y1="20" x2="15" y2="23"></line>
                            <line x1="20" y1="9" x2="23" y2="9"></line>
                            <line x1="20" y1="14" x2="23" y2="14"></line>
                            <line x1="1" y1="9" x2="4" y2="9"></line>
                            <line x1="1" y1="14" x2="4" y2="14"></line>
                        </svg>
                        <span>Apps</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-chevron-right">
                            <polyline points="9 18 15 12 9 6"></polyline>
                        </svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                    <li>
                        <a href="apps_chat.html"> Chat </a>
                    </li>
                    <li>
                        <a href="apps_mailbox.html"> Mailbox </a>
                    </li>
                    <li>
                        <a href="apps_todoList.html"> Todo List </a>
                    </li>
                    <li>
                        <a href="apps_notes.html"> Notes </a>
                    </li>
                    <li>
                        <a href="apps_scrumboard.html">Scrumboard</a>
                    </li>
                    <li>
                        <a href="apps_contacts.html"> Contacts </a>
                    </li>
                    <li>
                        <a href="apps_invoice.html"> Invoice List </a>
                    </li>
                    <li>
                        <a href="apps_calendar.html"> Calendar </a>
                    </li>
                </ul>
            </li> --}}


            <li class="menu">
                <a href=" {{ route('profil.view') }} "
                    data-active="{{ $prefix == '/profile' ? 'true' : 'false' }}" class="dropdown-toggle">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-settings">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path
                                d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                            </path>
                        </svg>
                        <span>Parametre compte</span>
                    </div>

                </a>

            </li>


        </ul>
        <!-- <div class="shadow-bottom"></div> -->

    </nav>

</div>

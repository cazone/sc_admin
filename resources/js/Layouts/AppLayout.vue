<template>
   <Head :title="title" />
  <div id="layout-d" class="theme-blue">

    <!-- Navigation -->
    <div class="header fixed-top px-lg-5 px-md-2 shadow-sm">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                <!-- Brand -->
                <Link :href="route('dashboard')">
                <a  class="me-3 me-lg-4 brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 64 80" fill="none">
                        <path d="M58.8996 22.7L26.9996 2.2C23.4996 -0.0999999 18.9996 0 15.5996 2.5C12.1996 5 10.6996 9.2 11.7996 13.3L15.7996 26.8L3.49962 39.9C-3.30038 47.7 3.79962 54.5 3.89962 54.6L3.99962 54.7L36.3996 78.5C36.4996 78.6 36.5996 78.6 36.6996 78.7C37.8996 79.2 39.1996 79.4 40.3996 79.4C42.9996 79.4 45.4996 78.4 47.4996 76.4C50.2996 73.5 51.1996 69.4 49.6996 65.6L45.1996 51.8L58.9996 39.4C61.7996 37.5 63.3996 34.4 63.3996 31.1C63.4996 27.7 61.7996 24.5 58.8996 22.7ZM46.7996 66.7V66.8C48.0996 69.9 46.8996 72.7 45.2996 74.3C43.7996 75.9 41.0996 77.1 37.9996 76L5.89961 52.3C5.29961 51.7 1.09962 47.3 5.79962 42L16.8996 30.1L23.4996 52.1C24.3996 55.2 26.5996 57.7 29.5996 58.8C30.7996 59.2 31.9996 59.5 33.1996 59.5C35.0996 59.5 36.9996 58.9 38.6996 57.8C38.7996 57.8 38.7996 57.7 38.8996 57.7L42.7996 54.2L46.7996 66.7ZM57.2996 36.9C57.1996 36.9 57.1996 37 57.0996 37L44.0996 48.7L36.4996 25.5V25.4C35.1996 22.2 32.3996 20 28.9996 19.3C25.5996 18.7 22.1996 19.8 19.8996 22.3L18.2996 24L14.7996 12.3C13.8996 8.9 15.4996 6.2 17.3996 4.8C18.4996 4 19.8996 3.4 21.4996 3.4C22.6996 3.4 23.9996 3.7 25.2996 4.6L57.1996 25.1C59.1996 26.4 60.2996 28.6 60.2996 30.9C60.3996 33.4 59.2996 35.6 57.2996 36.9Z" fill="black"/>
                    </svg>
                </a>
                </Link>

                <!-- header rightbar icon -->
                <div class="h-right d-flex align-items-center me-5 me-lg-0 order-1">

                    <div class="dropdown user-profile ms-2 ms-sm-3">
                        <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown">
                            <img class="avatar rounded-circle img-thumbnail" :src="$page.props.user.profile_photo_url" alt="">
                        </a>
                        <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                            <div class="card border-0 w240">
                                <div class="card-body border-bottom">
                                    <div class="d-flex py-1">
                                        <img class="avatar rounded-circle" :src="$page.props.user.profile_photo_url" alt="">
                                        <div class="flex-fill ms-3">
                                            <p class="mb-0 text-muted"><span class="fw-bold"> {{ $page.props.user.name }}</span></p>
                                            <small class="text-muted"> {{ $page.props.user.email }}</small>
                                            <form @submit.prevent="logout">
                                                <jet-dropdown-link as="button">
                                                  Cerra sesión
                                                </jet-dropdown-link>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-group m-2">
                                    <Link :href="route('profile.show')" >
                                        <a  class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-cog"></i>Tu perfil</a>
                                     </Link>

                                    <!-- <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-tag"></i>Customization</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-users"></i>Manage team</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-calendar"></i>My Events</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0"><i class="w30 fa fa-credit-card"></i>My Statements</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- menu toggler -->
                <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- main menu -->
                <div class="collapse navbar-collapse order-0" id="mainHeader">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                        <Link :href="route('dashboard')">
                         <a class="nav-link active"><i class="fa fa-dashboard me-2"></i><span>Dashboard</span></a>
                        </Link>

                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-users me-2"></i><span>Clientes</span>
                            </a>
                            <ul class="dropdown-menu rounded-lg shadow border-0 dropdown-animation">
                                 <Link :href="route('clientes.index')" >
                                    <li><a class="dropdown-item" href="#">Listado</a></li>
                                </Link>
                                 <Link :href="route('clientes.create')" >
                                    <li><a class="dropdown-item" href="#">Nuevo</a></li>
                                </Link>

                            </ul>
                        </li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-users me-2"></i><span>Prestamos</span>
                            </a>
                            <ul class="dropdown-menu rounded-lg shadow border-0 dropdown-animation">
                                 <Link :href="route('adelanto.index')" >
                                    <li><a class="dropdown-item" href="#">Listado</a></li>
                                </Link>
                                 <Link :href="route('adelanto.create')" >
                                    <li><a class="dropdown-item" href="#">Nuevo</a></li>
                                </Link>

                            </ul>
                        </li>


                    </ul>
                </div>

            </div>
        </nav>

        <!-- Search: div -->

    </div>

    <!-- main body area -->
    <div class="main px-lg-5 px-md-2">

        <!-- Body: Header -->
        <div class="body-header border-bottom d-flex py-lg-3 py-md-2">
            <slot name="header"></slot>
            <!-- <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <small class="text-muted">Welcome back</small>
                        <h1 class="h4 mt-1">Dashboard</h1>
                    </div>
                    <div class="col-auto">
                        <a href="https://themeforest.net/user/wrraptheme" title="Download" target="_blank" class="btn btn-white border lift">Download</a>
                        <button type="button" class="btn btn-dark lift">Generate Report</button>
                    </div>
                </div>
            </div> -->
        </div>

        <!-- Body: Body -->
        <div class="body d-flex py-lg-4 py-3">
            <div class="container-fluid">

               <slot></slot>

            </div>
        </div>

        <!-- Body: Footer -->
        <div class="body-footer d-flex">
            <div class="container-fluid">
                <div class="col-12">
                    <div class="card mb-3 border-0">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col">
                                    <p class="font-size-sm mb-0">Desarrollo de <span class="d-none d-sm-inline-block">SC REDES </span></p>
                                </div>
                                <div class="col-auto">
                                    <div class="d-flex justify-content-end">
                                        <!-- List Dot -->
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item">
                                                <a class="list-separator-link" href="http://scredes.com.mx/">Acerca</a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="list-separator-link" href="http://scredes.com.mx/" target="_blank">Licencia</a>
                                            </li>
                                        </ul>
                                        <!-- End List Dot -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



</div>
</template>

<script>
import JetApplicationLogo from '@/Jetstream/ApplicationLogo.vue'
import JetBanner from '@/Jetstream/Banner.vue'
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetNavLink from '@/Jetstream/NavLink.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default {
  props: {
    title: String,
  },
  components: {
    Head,
    JetApplicationLogo,
    JetBanner,
    JetApplicationMark,
    JetDropdown,
    JetDropdownLink,
    JetNavLink,
    Link,
  },

  data() {
    return {
      showingNavigationDropdown: false,
        url: null
    }
  },
  mounted() {
       this.url = process.env.MIX_APP_URL;
  },

  methods: {
    switchToTeam(team) {
      this.$inertia.put(route('current-team.update'), {
        'team_id': team.id
      }, {
        preserveState: false
      })
    },

    logout() {
      this.$inertia.post(route('logout'));
    },
  },

  computed: {
    path() {
      return window.location.pathname
    }
  }
}
</script>

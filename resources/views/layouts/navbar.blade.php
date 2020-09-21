<nav class="navbar navbar-expand-lg navbar-light col-12 col-lg-2 align-items-baseline">
    <div class="collapse navbar-collapse" id="side-navbar">

        {{--Navbar--}}
        <ul class="navbar-nav d-flex flex-column">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'generator' }" exact>Generatorius</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'search' }">Istorija</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'list' }">Maršrutų sąrašas</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'cars-list' }">Automobilių sąrašas</router-link>
            </li>
        </ul>
        {{--Navbar--}}

    </div>
</nav>
import Generator from '../views/Generator';
import Search from '../views/History';
import List from '../views/Schools';
import CarsList from '../views/Cars';
import NotFound from '../views/NotFound';

export default {
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '*',
            component: NotFound,
        },
        {
            path: '/',
            component: Generator,
            name: 'generator'
        },
        {
            path: '/paieska',
            component: Search,
            name: 'search'
        },
        {
            path: '/mokyklos',
            component: List,
            name: 'list'
        },
        {
            path: '/automobiliai',
            component: CarsList,
            name: 'cars-list'
        },
        {
            path: '/prisijungti',
            component: List,
            name: 'login'
        },
    ]
}
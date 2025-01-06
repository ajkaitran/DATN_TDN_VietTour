// import './css/admin.css'
// import './css/style_admin.scss'
// import './css/style_main.scss'
import './App.css'
import { useRoutes } from 'react-router-dom';
// import 'slick-carousel';
import Home from './user/Home';
import GetTourById from './user/GetTourByCate';
import BookTour from './user/BookTour';
import DetailTour from './user/DetailTour';
import InternationalTour from './user/TourQuocTe';
import '@fortawesome/fontawesome-free/css/all.min.css';
import TourNoiDia from './user/TourNoiDia';
import SearchTour from './user/SearchTour';

const routeConfig = [
  {
    path: "/Order",
    element: <BookTour/>
  },
  {
    path:"/home",
    element:< Home/>
  },
  {
    path: "/tour",
    element: < GetTourById />
  },
  {
    path: "/search-tour",
    element: <SearchTour/>
  },
  {
    path: "/Tour-quoc-te",
    element: <InternationalTour />
  },
  {
    path: "/Tour-noi-dia",
    element: <TourNoiDia />
  },
  {
    path: "/Detail",
    element: <DetailTour />
  },
  
];
function App() {
  const routes = useRoutes(routeConfig);
  
  return <div>{routes}</div>
}

export default App

import './css/admin.css'
import './css/style_admin.scss'
import './App.css'
import { useRoutes } from 'react-router-dom';
import Layout from './admin/layout';
import 'slick-carousel';
import Home from './user/Home';
import GetTourById from './user/GetTourById';
import BookTour from './user/BookTour';
import InternationalTour from './user/InternationalTour';

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
    path: "/Tour-quoc-te",
    element: <InternationalTour />
  },
  
];
function App() {
  const routes = useRoutes(routeConfig);
  
  return <div>{routes}</div>
}

export default App

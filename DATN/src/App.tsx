import './css/admin.css'
import './css/style_admin.scss'
import './App.css'
import { useRoutes } from 'react-router-dom';
import Layout from './admin/layout';
import 'slick-carousel';
import Banner from './user/component/Banner';
import Home from './user/Home';

const routeConfig = [
  {
    path: "/admin",
    element: <Layout />
  },
  {
    path:"/home",
    element:< Home/>
  },
  {
    path: "/Banner",
    element: < Banner />
  }
  
];
function App() {
  const routes = useRoutes(routeConfig);
  
  return <div>{routes}</div>
}

export default App
import React from 'react';
import { Routes, Route } from 'react-router-dom';
import Home from './user/Home';
import GetTourByCate from './user/GetTourByCate';
import BookTour from './user/BookTour';
import DetailTour from './user/DetailTour';
import InternationalTour from './user/TourQuocTe';
import TourNoiDia from './user/TourNoiDia';
import SearchTour from './user/SearchTour';

function App() {
  return (
    <Routes>
      <Route path="/Order" element={<BookTour />} />
      <Route path="/home" element={<Home />} />
      <Route path="/tour" element={<GetTourByCate />} />
      <Route path="/search-tour" element={<SearchTour />} />
      <Route path="/Tour-quoc-te" element={<InternationalTour />} />
      <Route path="/Tour-noi-dia" element={<TourNoiDia />} />
      <Route path="/Detail" element={<DetailTour />} />
      <Route path="/" element={<DetailTour />} />
    </Routes>
  );
}

export default App;

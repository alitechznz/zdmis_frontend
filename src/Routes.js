import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Navbar from './components/Navbar';
import LoginPage from './pages/LoginPage';
import IncidentReporting from './components/IncidentReporting';
import GPSTracking from './components/GPSTracking';
import WeatherAlerts from './components/WeatherAlerts';
import CommunicationModule from './components/CommunicationModule';

const isAuthenticated = () => {
  // Replace with real authentication logic
  return localStorage.getItem('authenticated') === 'true';
};

const PrivateRoute = ({ element }) => {
  return isAuthenticated() ? element : <Navigate to="/login" />;
};

const AppRoutes = () => (
  <Router>
    <Routes>
      <Route path="/login" element={<LoginPage />} />
      <Route
        path="/"
        element={<PrivateRoute element={<><Navbar /><h1>Welcome to My App</h1></>} />}
      />
      <Route
        path="/incident-reporting"
        element={<PrivateRoute element={<><Navbar /><IncidentReporting /></>} />}
      />
      <Route
        path="/gps-tracking"
        element={<PrivateRoute element={<><Navbar /><GPSTracking /></>} />}
      />
      <Route
        path="/weather-alerts"
        element={<PrivateRoute element={<><Navbar /><WeatherAlerts /></>} />}
      />
      <Route
        path="/communication"
        element={<PrivateRoute element={<><Navbar /><CommunicationModule /></>} />}
      />
    </Routes>
  </Router>
);

export default AppRoutes;

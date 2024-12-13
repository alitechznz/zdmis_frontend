import React from 'react';
import { NavLink } from 'react-router-dom';

const Navbar = () => (
  <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
    <div className="container-fluid">
      <NavLink className="navbar-brand" to="/">My App</NavLink>
      <button
        className="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
      >
        <span className="navbar-toggler-icon"></span>
      </button>
      <div className="collapse navbar-collapse" id="navbarNav">
        <ul className="navbar-nav">
          <li className="nav-item">
            <NavLink className="nav-link" to="/incident-reporting">Incident Reporting</NavLink>
          </li>
          <li className="nav-item">
            <NavLink className="nav-link" to="/gps-tracking">GPS Tracking</NavLink>
          </li>
          <li className="nav-item">
            <NavLink className="nav-link" to="/weather-alerts">Weather Alerts</NavLink>
          </li>
          <li className="nav-item">
            <NavLink className="nav-link" to="/communication">Communication</NavLink>
          </li>
        </ul>
      </div>
    </div>
  </nav>
);

export default Navbar;

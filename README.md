# Cinema Management System

This is a comprehensive web application built with **PHP** and **JavaScript** designed to streamline the entire cinema operation, from user ticket reservations to administrative management of films and user roles.

---

## Table of Contents

* [Features](#features)
* [How it Works](#how-it-works)
* [User Roles](#user-roles)
    * [Customer](#customer)
    * [Employee](#employee)
    * [Administrator](#administrator)
* [Authentication](#authentication)
* [Technology Stack](#technology-stack)

---

## Features

This application offers a robust set of features tailored to different user types:

* **Online Ticket Reservation:** Users can easily browse available movie screenings, select a desired time and date, and reserve their tickets.
* **QR Code Ticketing:** Upon successful reservation, a unique QR code is generated for each ticket, serving as a digital entry pass.
* **QR Code Scanning for Employees:** Cinema employees can scan customer QR codes to quickly access reservation details, including the customer's name, surname, and projection specifics.
* **Projection Management (Employee & Admin):** Employees and administrators can add new movie screenings and delete existing ones.
* **Movie Management (Admin Only):** Administrators have the exclusive ability to add new films to the cinema's database.
* **User Role Management (Admin Only):** Administrators can change the roles of existing users, promoting them to employees or administrators, or demoting them to regular customers.

---

## How it Works

The application provides a user-friendly interface for customers similar to popular movie reservation systems. When a customer reserves a projection, the system generates a unique QR code for their ticket. At the cinema entrance, employees use a dedicated interface to scan these QR codes, instantly retrieving all relevant reservation information. This ensures a smooth and efficient check-in process.

For cinema staff, separate interfaces are provided to manage projections. Administrators have the highest level of access, allowing them to control the entire movie catalog and manage user privileges within the system.

---

## User Roles

The application defines three distinct user roles, each with specific permissions and functionalities:

### Customer

* Browse available movie screenings.
* Select a desired projection time and date.
* Reserve tickets.
* Receive a QR code for their reservation.

### Employee

* Scan customer QR codes to view reservation details (customer name, surname, projection details).
* Add new movie projections.
* Delete existing movie projections.

### Administrator

* All functionalities of an **Employee** and a **Customer**.
* Add new movies to the cinema's database.
* Change the roles (Customer, Employee, Administrator) of existing users.

---

## Authentication

The application offers flexible authentication options for user convenience:

* **Standard Registration/Login:** Users can register and log in using a traditional email and password combination.
* **Google Login/Registration:** For a seamless experience, users can also register and log in directly using their Google accounts.

---

## Technology Stack

* **Backend:** PHP
* **Frontend:** JavaScript
* **Database:** MySQL

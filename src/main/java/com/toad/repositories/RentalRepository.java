package com.toad.repositories;

import java.util.List;

import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import com.toad.entities.Rental;

// This will be AUTO IMPLEMENTED by Spring into a Bean called userRepository
// CRUD refers Create, Read, Update, Delete
public interface RentalRepository extends CrudRepository<Rental, Integer> {

    @Query(value = "SELECT c.first_name AS customer_firstname, c.last_name AS customer_lastname, f.title, s.first_name AS staff_firstname, s.last_name AS staff_lastname, r.rental_date, r.return_date, r.last_update, r.rental_id " +
           "FROM rental r " +
           "JOIN Inventory i ON r.inventory_id = i.inventory_id " +
           "JOIN film f ON i.film_id = f.film_id " +
           "JOIN customer c ON r.customer_id = c.customer_id " +
           "JOIN staff s ON r.staff_id = s.staff_id ", nativeQuery = true)

    List<Object[]> sortRentalInformations();

    @Query(value = "SELECT c.first_name AS customer_firstname, c.last_name AS customer_lastname, f.title, s.first_name AS staff_firstname, s.last_name AS staff_lastname, r.rental_date, r.return_date, r.last_update, r.rental_id " +
           "FROM rental r " +
           "JOIN Inventory i ON r.inventory_id = i.inventory_id " +
           "JOIN film f ON i.film_id = f.film_id " +
           "JOIN customer c ON r.customer_id = c.customer_id " +
           "JOIN staff s ON r.staff_id = s.staff_id " +
           "WHERE r.rental_id = :rentalId", nativeQuery = true)
    List<Object[]> findRentalInformationsById(@Param("rentalId") Integer rentalId);

}
package com.toad.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.toad.entities.Rental;
import com.toad.repositories.RentalRepository;

@Controller
@RequestMapping(path = "/toad/rental")
public class RentalController {
    @Autowired
    private RentalRepository RentalRepository; 

    @PutMapping(path = "/update/{rental_id}")
    public @ResponseBody String updateRental(
            @PathVariable Integer rental_id,
            @RequestParam String rental_date,
            @RequestParam Integer inventory_id,
            @RequestParam Integer customer_id,
            @RequestParam String return_date,
            @RequestParam Integer staff_id,
            @RequestParam String last_update) {

        Rental rental = RentalRepository.findById(rental_id).orElse(null);
        String message_retour;
        
        if (rental != null) {

            rental.setRentalId(rental_id);
            rental.setRentalDate(rental_date);
            rental.setInventoryId(inventory_id);
            rental.setCustomerId(customer_id);
            rental.setReturnDate(return_date);
            rental.setStaffId(staff_id);
            rental.setLastUpdate(last_update);
            RentalRepository.save(rental);
            
            message_retour = "Rental Updated";
        } else {
            message_retour = "Rental not found";
        }
        return message_retour;
    }

    @PostMapping(path = "/add")
    public @ResponseBody String createRental(
            @RequestParam String rental_date,
            @RequestParam Integer inventory_id,
            @RequestParam Integer customer_id,
            @RequestParam String return_date,
            @RequestParam Integer staff_id,
            @RequestParam String last_update) {
    
        Rental newRental = new Rental();

        newRental.setRentalId(Integer.valueOf(0));
        newRental.setRentalDate(rental_date);
        newRental.setInventoryId(inventory_id);
        newRental.setCustomerId(customer_id);
        newRental.setReturnDate(null);
        newRental.setStaffId(staff_id);
        newRental.setLastUpdate(last_update);
    
        RentalRepository.save(newRental);
    
        return "Location créée avec succès !";
    }

    @DeleteMapping(path = "/delete/{id}")
    public @ResponseBody String deleteRental(@PathVariable Integer id) {
       String message;
        if (RentalRepository.existsById(id)) {
            RentalRepository.deleteById(id);
            message = "Location supprimé";
        } else {
            message = "Location avec cet ID n'existe pas";
        } return message;
    }

    @GetMapping(path = "/all")
    public @ResponseBody Iterable<Rental> getAllUsers() {
        return RentalRepository.findAll();
    }

    @GetMapping(path = "/getById")
    public @ResponseBody Rental getRentalById(@RequestParam Integer id) {
        Rental rental = RentalRepository.findById(id).orElse(null);
        if (rental != null) {
            Rental filteredRental = new Rental();
            filteredRental.setRentalId(rental.getRentalId());
            filteredRental.setRentalDate(rental.getRentalDate());
            filteredRental.setInventoryId(rental.getInventoryId());
            filteredRental.setCustomerId(rental.getCustomerId());
            filteredRental.setReturnDate(rental.getReturnDate());
            filteredRental.setStaffId(rental.getStaffId());
            filteredRental.setLastUpdate(rental.getLastUpdate());
            return filteredRental;
        }
        return null;
    }
}

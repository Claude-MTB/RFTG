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

import com.toad.entities.Customer;
import com.toad.repositories.CustomerRepository;

@Controller
@RequestMapping(path = "/toad/customer") // This means URL's start with /film (after Application path)
public class CustomerController {

    @Autowired
    private CustomerRepository customerRepository;

    @PostMapping(path="/add")
    public @ResponseBody String addNewCustomer (
    @RequestParam Integer store_id,
    @RequestParam String first_name,
    @RequestParam String last_name,
    @RequestParam String email,
    @RequestParam Integer address_id,
    @RequestParam Integer active,
    @RequestParam java.sql.Timestamp create_update,
    @RequestParam java.sql.Timestamp last_update,
    @RequestParam Integer password,
    @RequestParam Integer age) {
    // CREATION D'UN CLIENT
    Customer newCustomer = new Customer();
    newCustomer.setStoreId(store_id);
    newCustomer.setFirstName(first_name);
    newCustomer.setLastName(last_name);
    newCustomer.setEmail(email);
    newCustomer.setActive(active);
    newCustomer.setAddressId(address_id);
    newCustomer.setCreateDate(create_update);
    newCustomer.setLastUpdate(last_update);     
    newCustomer.setPassword(password);
    newCustomer.setAge(age);       
    customerRepository.save(newCustomer);

    return "Client Créer";
}


    @PutMapping(path = "/update/{customerId}")
    public @ResponseBody String updateRepository(
        @PathVariable Integer customerId,
        @RequestParam Integer storeId,
        @RequestParam String firstName,
        @RequestParam String lastName,
        @RequestParam String email,
        @RequestParam Integer addressId,
        @RequestParam int active,
        @RequestParam java.sql.Timestamp createDate,
        @RequestParam java.sql.Timestamp lastUpdate,
        @RequestParam int password,
        @RequestParam int age,
        @RequestParam java.sql.Timestamp createUpdate) {
        
        String Texte = "";
        Customer customer = customerRepository.findById(customerId).orElse(null);
        if (customer == null) {
            // ERREUR LORS DE LA MISE A JOUR DU CLIENT
            Texte = "Erreur lors de la mise à jour du client";
            return Texte;
        }
        else {
            // MISE A JOUR DU CLIENT
            customer.setStoreId(storeId);
            customer.setFirstName(firstName);
            customer.setLastName(lastName);
            customer.setEmail(email);
            customer.setAddressId(addressId);
            customer.setActive(active);
            customer.setCreateDate(createDate);
            customer.setLastUpdate(lastUpdate);
            customerRepository.save(customer);
            customer.setPassword(password);
            customer.setAge(age);
            Texte = "Mise à jour du Client";
        }
        return Texte;
    }


    @DeleteMapping(path = "/delete/{id}")
    public @ResponseBody String deleteCustomer(@PathVariable Integer id) {
        customerRepository.deleteById(id);
        return "Customer delete";
    }

    @GetMapping(path = "/getById")
    public @ResponseBody Customer getCustomerById(@RequestParam Integer id) {
        Customer customer = customerRepository.findById(id).orElse(null);
        if (customer != null) {
        Customer filteredCustomer = new Customer();
        filteredCustomer.setCustomerId(customer.getCustomerId());
        filteredCustomer.setStoreId(customer.getStoreId());
        filteredCustomer.setFirstName(customer.getFirstName());
        filteredCustomer.setLastName(customer.getLastName());
        filteredCustomer.setEmail(customer.getEmail());
        filteredCustomer.setAddressId(customer.getAddressId());
        filteredCustomer.setActive(customer.getActive());
        filteredCustomer.setCreateDate(customer.getCreateDate());
        filteredCustomer.setLastUpdate(customer.getLastUpdate());
        filteredCustomer.setPassword(customer.getPassword());
        filteredCustomer.setAge(customer.getAge());

        return filteredCustomer;
        }
        return null;
    }

    @GetMapping(path = "/getByEmail")
    public @ResponseBody Customer getCustomerByEmail(@RequestParam String email) {
        Customer customer = customerRepository.findByEmail(email).orElse(null);
        if (customer != null) {
        Customer filteredCustomer = new Customer();
        filteredCustomer.setCustomerId(customer.getCustomerId());
        filteredCustomer.setStoreId(customer.getStoreId());
        filteredCustomer.setFirstName(customer.getFirstName());
        filteredCustomer.setLastName(customer.getLastName());
        filteredCustomer.setEmail(customer.getEmail());
        filteredCustomer.setAddressId(customer.getAddressId());
        filteredCustomer.setActive(customer.getActive());
        filteredCustomer.setCreateDate(customer.getCreateDate());
        filteredCustomer.setLastUpdate(customer.getLastUpdate());
        filteredCustomer.setPassword(customer.getPassword());
        filteredCustomer.setAge(customer.getAge());

        return filteredCustomer;
        }
        return null;
    }

    @GetMapping(path="/all")
    public @ResponseBody Iterable<Customer> getAllCustomer() {
        return customerRepository.findAll();
    }
}


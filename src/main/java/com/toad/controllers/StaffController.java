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
import com.toad.entities.Staff;
import com.toad.repositories.StaffRepository;

@Controller
@RequestMapping(path = "/toad/staff")
public class StaffController {
  @Autowired
  private StaffRepository staffRepository;

  @PostMapping(path = "/add")
  public @ResponseBody String addNewStaff(
    @RequestParam String first_name, 
    @RequestParam String last_name, 
    @RequestParam Integer address_id, 
    @RequestParam String email,
    @RequestParam Integer store_id,
    @RequestParam Integer active,
    @RequestParam String username, 
    @RequestParam String password,   
    @RequestParam String last_update,
    @RequestParam Integer role_id 
    ) {
    Staff n = new Staff();
    n.setFirstName(first_name);
    n.setLastName(last_name);
    n.setAdressId(address_id);
    n.setEmail(email);
    n.setStoreId(store_id);
    n.setActive(active);
    n.setUsername(username);
    n.setPassword(password);
    n.setLastUpdate(last_update);
    n.setRoleId(role_id);
    staffRepository.save(n);
    return "Staff sauvegardé";
  }

  @DeleteMapping(path = "/delete/{id}")
  public @ResponseBody String deleteFilm(@PathVariable Integer id) {
    staffRepository.deleteById(id);
    return "Staff Supprimée";
  }

  @PutMapping(path = "/update/{staff_id}")
  public @ResponseBody String updateUser(
    @PathVariable Integer staff_id, 
    @RequestParam String first_name, 
    @RequestParam String last_name, 
    @RequestParam Integer address_id, 
    @RequestParam String email,
    @RequestParam Integer store_id,
    @RequestParam Integer active,
    @RequestParam String username, 
    @RequestParam String password,   
    @RequestParam String last_update,
    @RequestParam Integer role_id 
    ) {
    Staff staff = staffRepository.findById(staff_id).orElse(null);
    String message_retour;
    if (staff != null) {
      staff.setFirstName(first_name);
      staff.setLastName(last_name);
      staff.setAdressId(address_id);
      staff.setEmail(email);
      staff.setStoreId(store_id);
      staff.setActive(active);
      staff.setUsername(username);
      staff.setPassword(password);
      staff.setLastUpdate(last_update);
      staff.setRoleId(role_id);
      staffRepository.save(staff);
      message_retour = "Staff Updated";
    } else {
      message_retour = "Staff not found";
    }
    return message_retour;
  }

  @GetMapping(path = "/all")
  public @ResponseBody Iterable<Staff> getAllStaffs() {
    return staffRepository.findAll();
  }

  @GetMapping(path = "/getById")
  public @ResponseBody Staff getStaffById(@RequestParam Integer id) {
    Staff staff = staffRepository.findById(id).orElse(null);
    if (staff != null) {
      Staff filteredStaff = new Staff();
      filteredStaff.setStaffId(staff.getStaffId());
      filteredStaff.setFirstName(staff.getFirstName());
      filteredStaff.setLastName(staff.getLastName());
      filteredStaff.setAdressId(staff.getAdressId());
      filteredStaff.setEmail(staff.getEmail());
      filteredStaff.setStoreId(staff.getStoreId());
      filteredStaff.setActive(staff.getActive());
      filteredStaff.setUsername(staff.getUsername());
      filteredStaff.setPassword(staff.getPasword());
      filteredStaff.setLastUpdate(staff.getLastUpdate());
      filteredStaff.setRoleId(staff.getRoleId());

      return filteredStaff;
    }
    return null;
  }

  @GetMapping(path = "/getByEmail")
  public @ResponseBody Staff getStaffByEmail(@RequestParam String email) {
    Staff staff = staffRepository.findByEmail(email).orElse(null);
    if (staff != null) {
      Staff filteredStaff = new Staff();
      filteredStaff.setStaffId(staff.getStaffId());
      filteredStaff.setFirstName(staff.getFirstName());
      filteredStaff.setLastName(staff.getLastName());
      filteredStaff.setAdressId(staff.getAdressId());
      filteredStaff.setEmail(staff.getEmail());
      filteredStaff.setStoreId(staff.getStoreId());
      filteredStaff.setActive(staff.getActive());
      filteredStaff.setUsername(staff.getUsername());
      filteredStaff.setPassword(staff.getPasword());
      filteredStaff.setLastUpdate(staff.getLastUpdate());
      filteredStaff.setRoleId(staff.getRoleId());

      return filteredStaff;
    }
    return null;
  }
}
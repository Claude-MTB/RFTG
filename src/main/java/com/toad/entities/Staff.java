package com.toad.entities;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity // This tells Hibernate to make a table out of this class
public class Staff {
  @Id
  @GeneratedValue(strategy=GenerationType.IDENTITY)
  private Integer staff_id;
  private String first_name;
  private String last_name;
  private Integer address_id;
  private String email;
  private Integer store_id;
  private Integer active;
  private String username;
  private String password;
  private String last_update;
  private Integer role_id;

  public Integer getStaffId() {
    return staff_id;
  }

  public void setStaffId(Integer staff_id) {
    this.staff_id = staff_id;
  }

  public String getFirstName() {
    return first_name;
  }

  public void setFirstName(String first_name) {
    this.first_name = first_name;
  }

    public String getLastName() {
    return last_name;
  }

  public void setLastName(String last_name) {
    this.last_name = last_name;
  }

  public Integer getAdressId() {
    return address_id;
  }

  public void setAdressId(Integer address_id) {
    this.address_id = address_id;
  }

    public Integer getStoreId() {
    return store_id;
  }

  public void setStoreId(Integer store_id) {
    this.store_id = store_id;
  }

  public Integer getActive() {
    return active;
  }

  public void setActive(Integer active) {
    this.active = active;
  }

  public String getUsername() {
    return username;
  }

  public void setUsername(String username) {
    this.username = username;
  }

  public String getPasword() {
    return password;
  }

  public void setPassword(String password) {
    this.password = password;
  }

  public String getLastUpdate() {
    return last_update;
  }

  public void setLastUpdate(String last_update) {
    this.last_update = last_update;
  }

  public Integer getRoleId() {
    return role_id;
  }

  public void setRoleId(Integer role_id) {
    this.role_id = role_id;
  } 

  public String getEmail() {
    return email;
  }

  public void setEmail(String email) {
    this.email = email;
  }
}
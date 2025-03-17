package com.toad.entities;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;

@Entity // This tells Hibernate to make a table out of this class
public class Customer {
    @Id
    @GeneratedValue(strategy=GenerationType.AUTO)
    @Column (name="customer_id")
    private Integer customerId;
    @Column (name="store_id")
    private Integer storeId;
    @Column (name="first_name")
    private String firstName;
    @Column (name="last_name")
    private String lastName;
    @Column (name="email")
    private String email;
    @Column (name="address_id")
    private Integer addressId;
    @Column (name="active")
    private int active;
    @Column (name="create_date")
    private java.sql.Timestamp createDate;
    @Column (name="last_update")
    private java.sql.Timestamp lastUpdate;
    @Column (name="password")
    private int password;
    @Column (name="age")
    private int age;
  
    public void setCustomerId(Integer customerId) {
      this.customerId = customerId;
    }
    public Integer getCustomerId() {
      return customerId;
    }
   
    public void setStoreId(Integer storeId) {
      this.storeId = storeId;
    }
    public Integer getStoreId() {
      return storeId;
    }
  
    public void setFirstName(String firstName) {
      this.firstName = firstName;
    }
    public String getFirstName() {
      return firstName;
    }
  
    public void setLastName(String lastName) {
      this.lastName = lastName;
    }
   
    public String getLastName() {
      return lastName;
    }
    public String getEmail() {
      return email;
    }
    public void setEmail(String email) {
      this.email = email;
    }
    public void setAddressId(Integer addressId) {
      this.addressId = addressId;
    }
   
    public Integer getAddressId() {
      return addressId;
    }
    public int getActive() {
      return active;
    }
    public void setActive(int active) {
      this.active = active;
    }
    public java.sql.Timestamp getCreateDate() {
      return createDate;
    }
    public void setCreateDate(java.sql.Timestamp createDate) {
      this.createDate = createDate;
    }
    public java.sql.Timestamp getLastUpdate() {
      return lastUpdate;
    }
    public void setLastUpdate(java.sql.Timestamp lastUpdate) {
      this.lastUpdate = lastUpdate;
    }
    public int getPassword() {
      return password;
    }
    public void setPassword(int password) {
      this.password = password;
    }
    public int getAge() {
      return age;
    }
    public void setAge(int age) {
      this.age = age;
    }
    }
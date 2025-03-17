package com.toad.entities;
 
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
 
@Entity // This tells Hibernate to make a table out of this class
public class Director {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Integer director_id; // BIGINT
 
    private String nom;
 
    private String prenom;
 
    private java.sql.Timestamp date_naissance; // Year is typically handled as Integer
 
    private String nationnalite; // TINYINT
 
    // Getters and Setters
    public Integer getdirector_id() {
        return director_id;
    }
 
    public void setdirector_id(Integer director_id) {
        this.director_id = director_id;
    }
 
    public String getnom() {
        return nom;
    }
 
    public void setnom(String nom) {
        this.nom = nom;
    }
 
    public String getprenom() {
        return prenom;
    }
 
    public void setprenom(String prenom) {
        this.prenom = prenom;
    }
 
    public java.sql.Timestamp getdate_naissance() {
        return date_naissance;
    }
 
    public void setdate_naissance(java.sql.Timestamp date_naissance) {
        this.date_naissance = date_naissance;
    }
 
    public String getnationnalite() {
        return nationnalite;
    }
 
    public void setnationnalite(String nationnalite) {
        this.nationnalite = nationnalite;
    }
 
}
 
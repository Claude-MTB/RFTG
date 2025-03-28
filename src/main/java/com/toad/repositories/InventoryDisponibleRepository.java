package com.toad.repositories;

import java.util.List;
import org.antlr.v4.runtime.atn.SemanticContext.AND;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.CrudRepository;
import org.springframework.data.repository.query.Param;

import com.toad.entities.Inventory;

public interface InventoryDisponibleRepository extends CrudRepository<Inventory, Integer> {

    
    @Query(value = "SELECT MIN(inventory_id) FROM inventory WHERE film_id = :filmId AND inventory.existe = true AND NOT EXISTS (SELECT rental.inventory_id FROM rental WHERE rental.inventory_id = inventory.inventory_id AND rental.return_date IS NOT NULL);", nativeQuery = true)
    Integer findFreeInventoryId(@Param("filmId") Integer filmId);
    
    @Query(value = "SELECT DISTINCT i.inventory_id from inventory i JOIN rental r ON i.inventory_id = r.inventory_id WHERE NOT EXISTS (select 1 from rental r1 where r1.inventory_id = r.inventory_id and r1.return_date is null) and i.film_id = :filmId and i.existe = true;", nativeQuery = true)
                List<Integer> findFreeInventoryIdDVD(@Param("filmId") Integer filmId);
}

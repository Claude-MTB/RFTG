package com.toad.controllers;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import com.toad.entities.Inventory;
import com.toad.repositories.InventoryDisponibleRepository;
import com.toad.repositories.InventoryRepository;

@Controller
@RequestMapping(path = "/toad/inventory")
public class InventoryController {
    @Autowired
    private InventoryRepository inventoryRepository;
    @Autowired
    private InventoryDisponibleRepository inventoryDisponibleRepository;

    @PostMapping(path = "/add")
    public @ResponseBody String addNewInventory(
            @RequestParam Integer film_id,
            @RequestParam Integer store_id,
            @RequestParam java.sql.Timestamp last_update) {

        Inventory inventory = new Inventory();
        Integer inventoryCount = (int) inventoryRepository.count() + 1;
        inventory.setInventoryId(inventoryCount);
        inventory.setFilmId(film_id);
        inventory.setStoreId(store_id);
        inventory.setLastUpdate(last_update);

        inventoryRepository.save(inventory);
        return "Inventaire Sauvegardé : " + inventoryCount;
    }

    // film_id:1
    // store_id:1
    // last_update:2024-01-01 00:00:00.0


    @GetMapping(path = "/all")
    public @ResponseBody Iterable<Inventory> getAllInventories() {
        return inventoryRepository.findAll();
    }

    @GetMapping(path = "/getById")
    public @ResponseBody Inventory getInventoryById(@RequestParam Integer id) {
        Inventory inventory = inventoryRepository.findById(id).orElse(null);
        if (inventory != null) {
            Inventory filteredInventory = new Inventory();
            filteredInventory.setInventoryId(inventory.getInventoryId());
            filteredInventory.setFilmId(inventory.getFilmId());
            filteredInventory.setStoreId(inventory.getStoreId());
            filteredInventory.setLastUpdate(inventory.getLastUpdate());
            return filteredInventory;
        }
        return null;
    }
    @PutMapping(path = "/update/{id}")
    public @ResponseBody String updateInventory(
            @PathVariable Integer id,
            @RequestParam Integer film_id,
            @RequestParam Integer store_id,
            @RequestParam java.sql.Timestamp last_update) {
        
        Inventory inventory = inventoryRepository.findById(id).orElse(null);
        String message;

        if (inventory == null) {
            message = "Inventaire non trouvé";
        } else {
            inventory.setFilmId(film_id);
            inventory.setStoreId(store_id);
            inventory.setLastUpdate(last_update);

            inventoryRepository.save(inventory);
            message = "Inventaire Mis à Jour";
        }

        return message;
    }

    // film_id:1
    // store_id:1
    // last_update:2024-01-01 00:00:00.0

    

    @DeleteMapping(path = "/delete/{id}")
    public @ResponseBody String deleteInventory(@PathVariable Integer id) {
        inventoryRepository.deleteById(id);
        return "Inventaire Supprimé";
    }
    @GetMapping(path = "/getStockByStore")
    public @ResponseBody List<Map<String, Object>> getGroupedInventory() {
        List<Object[]> groupedResults = inventoryRepository.findGroupedInventory();
        List<Map<String, Object>> jsonResults = new ArrayList<>();
        for (Object[] row : groupedResults) {
            Map<String, Object> result = new HashMap<>();
            result.put("storeId", convertToInteger(row[0]));
            result.put("filmId", convertToInteger(row[1]));
            result.put("title", row[2]);
            result.put("addressId", convertToInteger(row[3]));
            result.put("address", row[4]);
            result.put("district", row[5]);
            result.put("quantity", row[6]);
   
            jsonResults.add(result);
        }
 
        return jsonResults;
    }
   
  @GetMapping("/available")
    public @ResponseBody Integer getAvailableFilmIds() {
        Integer availableFilmIds = inventoryDisponibleRepository.findFreeInventoryIds();
        return availableFilmIds;
    }

    /**
     * Méthode utilitaire pour convertir dynamiquement un objet en Integer.
     */
    private Integer convertToInteger(Object value) {
        if (value instanceof Byte) {
            return ((Byte) value).intValue();
        } else if (value instanceof Short) {
            return ((Short) value).intValue();
        } else if (value instanceof Integer) {
            return (Integer) value;
        } else {
            throw new IllegalArgumentException("Type inattendu : " + value.getClass().getName());
        }
    }
    
}

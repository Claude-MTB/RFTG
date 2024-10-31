package com.toad.controllers;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import com.toad.entities.Director;
import com.toad.repositories.DirectorRepository;

@Controller
@RequestMapping(path = "/toad/director")
public class DirectorController {
  @Autowired // This means to get the bean called userRepository
  // Which is auto-generated by Spring, we will use it to handle the data
  private DirectorRepository directorRepository;

  @GetMapping(path = "/all")
  public @ResponseBody Iterable<Director> getAllDirectors() {
    // This returns a JSON or XML with the users
    return directorRepository.findAll();
  }

  @GetMapping(path = "/getById")
  public @ResponseBody Director getDirectorById(@RequestParam Integer id) {
    Director director = directorRepository.findById(id).orElse(null);
    if (director != null) {
      Director filteredDirector = new Director();
      filteredDirector.setdirector_id(director.getdirector_id());
      filteredDirector.setnom(director.getnom());
      filteredDirector.setprenom(director.getprenom());
      filteredDirector.setdate_naissance(director.getdate_naissance());
      filteredDirector.setnationalite(director.getnationalite());
      return filteredDirector;
    }
    return null;
  }

  @DeleteMapping(path = "/delete/{id}")
  public @ResponseBody String deleteFilm(@PathVariable Integer id) {
    directorRepository.deleteById(id);
    return "Réalisateur supprimé";
  }

  @PutMapping(path = "/add") // Map ONLY POST Requests
  public @ResponseBody String PutDirector(@RequestParam Integer director_id, @RequestParam String nom,
      @RequestParam String prenom, @RequestParam java.sql.Timestamp date_naissance, @RequestParam String nationalite) {
    // @ResponseBody means the returned String is the response, not a view name
    // @RequestParam means it is a parameter from the GET or POST request

    Director n = new Director();
    n.setdirector_id(director_id);
    n.setnom(nom);
    n.setprenom(prenom);
    n.setdate_naissance(date_naissance);
    n.setnationalite(nationalite);
    directorRepository.save(n);
    return "Saved";
  }

}
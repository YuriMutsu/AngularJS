package com.tmtai.web.banhang.thietbimaytinh.controller;

import com.tmtai.web.banhang.thietbimaytinh.entity.Users;
import com.tmtai.web.banhang.thietbimaytinh.service.UserService;
import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.util.UriComponentsBuilder;

import java.util.List;

/**
 * Created by tranm on 26-Nov-17.
 */

@RestController
@RequestMapping("/users")
public class RestUsersController {

    private Logger log = Logger.getLogger(RestController.class);

    @Autowired
    UserService userService;

    @RequestMapping(value = "", method = RequestMethod.GET)
    public ResponseEntity<List<Users>> getAllUsers(){
        List<Users> Userss = (List<Users>) userService.findAll();
        return new ResponseEntity<List<Users>>(Userss, HttpStatus.OK);
    }

    @GetMapping("/{id}")
    public ResponseEntity<Users> user(@PathVariable(value = "id") int id){
        System.out.println(id);
        Users Users = userService.findById(id);
        log.info(Users);
        return new ResponseEntity<Users>(Users, HttpStatus.OK);
    }

    @GetMapping("/delete/{id}")
    public ResponseEntity<Void> deleteUsers(@PathVariable(value = "id") int id){
        Users Users = userService.findById(id);
        userService.delete(id);
        log.info("DELETE " + Users.getFristname());
        return new ResponseEntity<Void>(HttpStatus.NO_CONTENT);
    }

    @PostMapping("/add")
    public  ResponseEntity<Void> addUsers(@RequestBody Users user, UriComponentsBuilder builder){
        HttpHeaders headers = new HttpHeaders();
        if (userService.isExist(user.getId())){
            log.info("Users is Exist");
        }else{
            userService.save(user);
            headers.setLocation(builder.path("/users/add/{id}").buildAndExpand(user.getId()).toUri());
            log.info("SAVED " + user.getFristname());
        }
        return new ResponseEntity<Void>(headers, HttpStatus.CREATED);
    }

    @PutMapping("update")
    public  ResponseEntity<Users> updateUsers(@RequestBody Users user){
        Users usr = userService.findById(user.getId());
        usr.setAddress(user.getAddress());
        usr.setBirthday(user.getBirthday());
        usr.setEmail(user.getEmail());
        usr.setFristname(user.getFristname());
        usr.setLastname(user.getLastname());
        usr.setPassword(user.getPassword());
        usr.setPhone(user.getPhone());
        userService.save(usr);
        return ResponseEntity.ok(usr);
    }
}

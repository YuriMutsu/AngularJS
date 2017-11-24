package com.example.demo.controller;

import java.util.List;

import org.apache.log4j.Logger;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.repository.query.Param;
import org.springframework.http.HttpHeaders;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestAttribute;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RestController;
import org.springframework.web.util.UriComponentsBuilder;

import com.example.demo.entity.User;
import com.example.demo.service.UserService;

@RestController
public class RestUserController {

	private Logger log = Logger.getLogger(RestController.class);
	
	@Autowired
	UserService userService;
	
	@GetMapping("/users")
	public List<User> getAllUser(){
		List<User> users = (List<User>) userService.findAll();
		return users;
	}
	
	@GetMapping("/user/{id}")
	public ResponseEntity<User> user(@PathVariable(value = "id") int id){
		System.out.println(id);
		User user = userService.findById(id);
		log.info(user);
		return new ResponseEntity<User>(user, HttpStatus.OK);
	}
	
	@GetMapping("/delete/user/{id}")
	public ResponseEntity<Void> deleteUser(@PathVariable(value = "id") int id){
		User user = userService.findById(id);
		userService.delete(id);
		log.info("DELETE " + user.getName());
		return new ResponseEntity<Void>(HttpStatus.NO_CONTENT);
	}
	
	@PostMapping("/add/user")
	public  ResponseEntity<Void> addUser(@RequestBody User user, UriComponentsBuilder builder){
		HttpHeaders headers = new HttpHeaders();
		if (userService.isExist(user.getId())){
			log.info("USER is Exist");
		}else{
			userService.save(user);
			headers.setLocation(builder.path("/add/user/{id}").buildAndExpand(user.getId()).toUri());
			log.info("SAVED " + user.getName());
		}
		 return new ResponseEntity<Void>(headers, HttpStatus.CREATED);
	}
	
	@PutMapping("update/user")
	public  ResponseEntity<User> updateUser(@RequestBody User user){
		User usr = userService.findById(user.getId());
		usr.setAddress(user.getAddress());
		usr.setBirthday(user.getBirthday());
		usr.setEmail(user.getEmail());
		usr.setName(user.getName());
		usr.setPassword(user.getPassword());
		usr.setPhone(user.getPhone());
		userService.save(usr);
		return ResponseEntity.ok(usr);
	}
}

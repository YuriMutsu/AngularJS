package com.example.demo.service;

import com.example.demo.entity.User;

public interface UserService {

	public void save(User user);

	public void delete(int id);
	
	public void update(User user);

	public Iterable<User> findAll();

	public User findById(int id);
	
	public User findByUsername(String username);

	public int count();
	
	boolean isExist(int id);

}
